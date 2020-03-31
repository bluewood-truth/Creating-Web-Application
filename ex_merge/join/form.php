<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    $table = mysqli_query($conn,"SELECT * FROM `userinfo` WHERE id=".$_POST['data']);
    $row = mysqli_fetch_assoc($table);
 ?>

<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://uraman.m-hosting.kr/ex_merge/style.css">

</head>
<body>
    <article>
        <h2>회원가입을 축하드립니다!</h2>
        <div class="form_group" style="width:720px">
            <div class="element-group">
                <div class="element-label">아이디</div>
                <div class="element"><? echo $row['user_id'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">가입일자</div>
                <div class="element"><? echo $row['join_date'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">닉네임</div>
                <div class="element"><? echo $row['nickname'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">이메일</div>
                <div class="element"><? echo $row['email'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">전화번호</div>
                <div class="element"><? echo $row['phone_number'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">핸드폰번호</div>
                <div class="element"><? echo $row['mobile_number'] ?></div>
            </div>
            <div class="element-group">
                <div class="element-label">자기소개</div>
                <div class="element"><? echo $row['comment'] ?></div>
            </div>
        </div>
        <br>
        <input type="button" value="로그인 화면으로" class="button" onclick='location.href="http://uraman.m-hosting.kr/ex_merge/login/"'>
    </article>
</body>
</html>
