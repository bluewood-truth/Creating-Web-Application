<?php
    // include "script.php";
 ?>


<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/ex04/style.css">
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
            <li id='cid999'>
               <div class='comment-nickname'>테스트</div>
               <div class='comment-content'>

               </div>
               <div class='comment-datetime'>2020-03-20 16:25:36</div>
               <div class='comment-buttons'>
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="수정">
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="삭제">
               </div>
           </li>
             <li id='cid999'>
               <div class='comment-nickname'>테스트</div>
               <div class='comment-content'><p class="cmt-text">테스트입니다.</p></div>
               <div class='comment-datetime'>2020-03-20 16:25:36</div>
               <div class='comment-buttons'>
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="수정">
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="삭제">
               </div>
            </li>
            <?php
                // $table = mysqli_query($conn,"SELECT * FROM guestbook ORDER BY id DESC");
                // while($row = mysqli_fetch_assoc($table)){
                //     echo "<li class='cmt' id='cid".$row["id"]."'>";
                //     echo "<div class='comment-nickname'>".$row["nickname"]."</div>";
                //     echo "<div class='comment-content'><p class="cmt-text">".$row["content"]."</p></div>";
                //     echo "<div class='comment-datetime'>".$row["datetime"]."</div>";
                //     echo "<div class='comment-buttons'>";
                //     echo "<input type='button' onclick='edit_delete_btn(this)' class='comment-button' value='수정'>";
                //     echo "<input type='button' onclick='edit_delete_btn(this)' class='comment-button' value='삭제'>";
                //     echo "</div></li>";
                // }
             ?>
        </ul>
    </div>
</div>
</article>
<script>
    var edit_or_del = "";

    function edit_delete_btn(target){
        var comment = target.closest("div.comment-container li");
        var cid = comment.id;
        edit_or_del = target.value;

        var datetime_box = comment.getElementsByClassName("comment-datetime")[0];

        // console.log(edit_or_del);

        // 패스워드박스가 이미 존재한다면 return
        if(datetime_box.getElementsByClassName("password-box")[0]){
            return;
        }

        // 다른 코멘트를 체크해서 패스워드박스가 존재하고 cid가 다를 경우 패스워드박스를 제거한다
        var cmt_array = $(".cmt").toArray();
        for(var i=0; i < cmt_array.length; i++){

            var one_cmt = cmt_array[i];
            var passwordbox = one_cmt.getElementsByClassName("password-box");

            if(one_cmt.id != cid && passwordbox.length != 0){
                passwordbox[0].remove();
            }
        }

        datetime_box.innerHTML = datetime_box.innerHTML + '\
            <div class="password-box">\
                <input type="password" id="password-input" name="password" maxlength="20" placeholder="비밀번호">\
                <input type="button" class="password-button" value="확인" onclick="password_check('+"'"+edit_or_del+"'"+')">\
                <input type="button" class="password-button" value="취소" onclick="'+"this.closest('div.password-box').remove()"+'">\
            </div>';
    }

    function password_check(edit_or_del){
        var pi = document.getElementById("password-input");
        var cid = pi.closest("div.comment-container li").id;
        var input_pw = pi.value;

        if(input_pw.length==0){
            return;
        }

        $.ajax({
            url:"password.php",
            method:"POST",
            dataType: "text",
            data: {'password':input_pw, 'cid':cid.replace("cid","")},
            success:function(data){
                var is_match = data=="true" ? true : false;
                if(!is_match){
                    alert("비밀번호가 다릅니다.");
                    return;
                }
                if(edit_or_del == "삭제"){
                    if(confirm("삭제하시겠습니까?")){
                        $.ajax({
                            url:"delete_comment.php",
                            method:"POST",
                            data: {'cid':cid.replace("cid","")},
                            success:function(data){
                                window.location.reload();
                            }}
                        );
                    }else{
                        return;
                    }
                } else if(edit_or_del == "수정"){
                    edit_comment(cid);
                }
            }
        });
    }

    function edit_comment(cid){
        var comment = document.getElementById(cid);
        var pre_text = comment.getElementsByClassName("comment-content").innerText;

        var html = '\
        <div class="editbox">\
            <textarea class="editbox" rows=4>'+pre_text+'</textarea>\
            <div class="comment-buttons">\
                <input type="button" onclick="edit_delete_btn(this)" class="comment-button" value="확인">\
                <input type="button" onclick="this.closest("div.editbox").remove()" class="comment-button" value="취소">\
            </div>\
        </div>';

        var content_box = comment.getElementsByClassName('comment-content');
    }
</script>

</body>
</html>
