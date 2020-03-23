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
               <div class='comment-content'>테스트입니다.</div>
               <div class='comment-datetime'>2020-03-20 16:25:36</div>
               <div class='comment-buttons'>
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="수정">
                   <input type="button" onclick="edit_delete_btn(this)" class='comment-button' value="삭제">
               </div>
            </li>
            <?php
                // $table = mysqli_query($conn,"SELECT * FROM guestbook ORDER BY id DESC");
                // while($row = mysqli_fetch_assoc($table)){
                //     echo "<li id='cid".$row["id"]."'>";
                //     echo "<div class='comment-nickname'>".$row["nickname"]."</div>";
                //     echo "<div class='comment-content'>".$row["content"]."</div>";
                //     echo "<div class='comment-datetime'>".$row["datetime"]."</div>";
                //     echo "<div class='comment-buttons'><button class='comment-button'>수정</button>";
                //     echo "<button class='comment-button'>삭제</button></div></li>";
                // }
             ?>
        </ul>


    </div>
</div>
</article>
<script>
    function edit_delete_btn(target){
        var comment = target.closest("div.comment-container li");
        var cid = comment.id.replace("cid","");
        var edit_or_del = target.innerText;

        var datetime_block = comment.getElementsByClassName("comment-datetime")[0];
        if(datetime_block.getElementsByClassName("password-box")[0]){
            return;
        }

        datetime_block.innerHTML = datetime_block.innerHTML + '\
            <div class="password-box">\
                <input type="password" id="password-input" maxlength="20" placeholder="비밀번호">\
                <input type="button" class="password-button" value="확인" onclick="password_check()">\
                <input type="button" class="password-button" value="취소" onclick="'+"this.closest('div.password-box').remove()"+'">\
            </div>';
    }

    function password_check(){
        var cid = document.getElementById("password-input").closest("div.comment-container li").id.replace("cid","");
        var edit_or_del = ""
        var input_pw = document.getElementById("password-input").value;
    }
</script>

</body>
</html>
