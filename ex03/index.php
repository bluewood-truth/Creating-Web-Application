<?php
    include "script.php";
 ?>

<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/ex03/style.css">
</head>
<body>
<article>
<div class="guestbook">
    <form name="guestbook_form" method="post" action="process.php"><div class="write-box">
        <div class="write-box-head">
            <p><input type="text" name="nickname" placeholder="닉네임" required="reqired"></p>
            <p><input type="password" name="password" placeholder="비밀번호" required="reqired"></p>
        </div>
        <textarea class="write-content" name="content" rows="8" cols="80" required="reqired"></textarea>
        <input class="write-button" type="submit" id="write_btn" name="write_btn" value="등록">
    </div></form>
    <div class="comment-container">
        <ul>
            <?php
                $table = mysqli_query($conn,"SELECT * FROM guestbook ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($table)){
                    echo "<li id='cid".$row["id"]."'>";
                    echo "<div class='comment-nickname'>".$row["nickname"]."</div>";
                    echo "<div class='comment-content'>".$row["content"]."</div>";
                    echo "<div class='comment-datetime'>".$row["datetime"]."</div>";
                    echo "<div class='comment-buttons'><button class='comment-button'>수정</button>";
                    echo "<button class='comment-button'>삭제</button></div></li>";
                }
             ?>
        </ul>
    </div>
</div>
</article>
</body>
</html>
