<?php
    include "script.php";
 ?>

<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://uraman.m-hosting.kr/ex04/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<article>
<div class="guestbook">
    <form name="guestbook_form" method="post" action="process.php"><div class="write-box">
        <div class="write-box-head">
            <p><input type="text" name="nickname" placeholder="닉네임" maxlength="15" required="reqired"></p>
            <p><input type="password" name="password" placeholder="비밀번호" maxlength="20" required="reqired"></p>
        </div>
        <textarea class="write-content" name="content" rows="8" cols="80" required="reqired"></textarea>
        <input class="write-button" type="submit" id="write_btn" name="write_btn" value="등록">
    </div></form>
    <div class="comment-container">
        <ul>
            <?php
                $table = mysqli_query($conn,"SELECT * FROM guestbook ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($table)){
                    echo "<li class='cmt' id='cid".$row["id"]."'>";
                    echo "<div class='comment-nickname'>".$row["nickname"]."</div>";
                    echo "<div class='comment-content'>".$row["content"]."</div>";
                    echo "<div class='comment-datetime'>".$row["datetime"]."</div>";
                    echo "<div class='comment-buttons'>";
                    echo "<input type='button' onclick='edit_delete_btn(this)' class='comment-button' value='수정'>";
                    echo "<input type='button' onclick='edit_delete_btn(this)' class='comment-button' value='삭제'>";
                    echo "</div></li>";
                }
             ?>
        </ul>
    </div>
</div>
</article>
<script>
    var edit_or_del = "";

    // 수정or삭제 버튼 눌렀을 때의 처리
    function edit_delete_btn(target){
        var comment = target.closest("div.comment-container li");
        var cid = comment.id;
        edit_or_del = target.value;

        var datetime_box = $(comment).children(".comment-datetime")[0];

        // 패스워드박스가 이미 존재한다면 return
        if($(datetime_box).children(".password-box")[0]){
            return;
        }

        // 다른 코멘트들을 체크해서 패스워드박스가 존재하고 cid가 다를 경우 패스워드박스를 제거한다
        var cmt_array = $(".cmt").toArray();
        for(var i=0; i < cmt_array.length; i++){

            var one_cmt = cmt_array[i];
            var passwordbox = $(one_cmt).children(".password-box");

            if(one_cmt.id != cid && passwordbox.length != 0){
                passwordbox[0].remove();
            }
        }

        // 수정or삭제 버튼 클릭한 코멘트에 패스워드박스 생성
        var pwbox = $('\
            <div class="password-box">\
                <input type="password" id="password-input" name="password" maxlength="20" placeholder="비밀번호">\
                <input type="button" class="password-button" value="확인" onclick="password_check('+"'"+edit_or_del+"'"+')">\
                <input type="button" class="password-button" value="취소" onclick="'+"this.closest('div.password-box').remove()"+'">\
            </div>')[0];

        datetime_box.append(pwbox);
    }

    // 패스워드 치고 [확인] 버튼 눌렀을 때의 처리
    function password_check(edit_or_del){
        var pi = $("input#password-input")[0]; // 패스워드 입력창
        var cid = pi.closest("div.comment-container li").id; // 코멘트 id
        var input_pw = pi.value; // input한 패스워드

        // 패스워드를 입력하지 않았으면 return
        if(input_pw.length==0){
            alert("비밀번호를 입력해주세요.");
            return;
        }

        // 패스워드 체크
        $.ajax({
            url:"password.php",
            method:"POST",
            dataType: "text",
            data: {'password':input_pw, 'cid':cid.replace("cid","")},
            success:function(data){
                console.log(data);
                var is_match = data=="true" ? true : false; //password.php의 결과값은 "ture" or "false"
                // 비밀번호가 다르면 return
                if(!is_match){
                    alert("비밀번호가 다릅니다.");
                    return;
                }
                // 클릭버튼이 [삭제]일 때의 처리
                if(edit_or_del == "삭제"){
                    if(confirm("삭제하시겠습니까?")){
                        // confirm에서 [예] 선택 시 처리
                        $.ajax({
                            url:"delete_comment.php",
                            method:"POST",
                            data: {'cid':cid.replace("cid",""),'password':input_pw},
                            success:function(data){
                                window.location.reload(); // 삭제 후 새로고침
                            }}
                        );
                    // confirm에서 [아니오] 선택 시 세션변수 제거하고 return
                    }else{
                        remove_session(input_pw);
                        return;
                    }
                // 클릭버튼이 [수정]일 때의 처리
                } else if(edit_or_del == "수정"){
                    edit_comment(cid, input_pw);
                    pi.closest('div.password-box').remove();
                }
            }
        });
    }

    function edit_comment(cid, pw){
        var comment = $("#"+cid)[0]; // 해당 코멘트 li
        var content_box = $(comment).children('.comment-content')[0]; // 코멘트 내용 box
        var pre_text = content_box.innerText; // 수정 전 텍스트

        var editbox = $('\
        <div class="editbox">\
            <textarea class="editbox" rows=4>'+pre_text+'</textarea>\
            <div class="comment-buttons">\
                <input type="button" class="comment-button" value="확인">\
                <input type="button" onclick="this.closest('+"'div.editbox'"+').remove();" class="comment-button" value="취소">\
            </div>\
        </div>')[0];

        content_box.append(editbox);

        // [확인] 버튼에 수정기능 리스너 달기
        $("#"+cid+" div.editbox .comment-button")[0].addEventListener("click",function(){
            var new_text = $('textarea.editbox')[0].value;
            $.ajax({
                url:"edit_comment.php",
                method:"POST",
                data: {'cid':cid.replace("cid",""), 'text':new_text,'password':pw},
                success:function(data){
                    window.location.reload(); // 삭제 후 새로고침
                }}
            );
        });
    }

    // 해당 패스워드에 해당하는 세션변수를 제거하는 함수
    function remove_session(pw){
        $.ajax({
            url:"remove_session.php",
            method:"POST",
            data:{"password":pw}
        });
    }
</script>

</body>
</html>
