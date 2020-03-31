<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    // 로그인되어있는 상태라면 바로 방명록으로
    if(isset($_SESSION['login'])){
        header("Location:http://uraman.m-hosting.kr/ex_merge/guestbook");
    }
 ?>

<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://uraman.m-hosting.kr/ex_merge/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <article>
        <div class="login-box">
            <form class="login-form" method="POST" action="login_process.php">
                <div>
                    <input placeholder="아이디" name="id" class="userinfo" type="text" required="reqired"><br>
                    <input placeholder="비밀번호" name="password" class="userinfo" type="password" required="reqired">
                </div>
                <input type="submit" class="login-button" value="로그인"></input>
            </form>
            <a class="join-link" href="http://uraman.m-hosting.kr/ex_merge/join/">회원가입</a>
            <br><br><hr color=white><br>
            <input type="button" class="login-button" value="비회원 로그인" onclick='location.href="http://uraman.m-hosting.kr/ex_merge/guestbook/"'>
        </div>
    </article>
</body>
</html>
