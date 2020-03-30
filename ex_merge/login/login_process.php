<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    $sql = "SELECT password FROM `userinfo` WHERE user_id='".$_POST['id']."'";
    $result = mysqli_query($conn,$sql);
    $db_pw = mysqli_fetch_assoc($result)['password'];

    $input_pw = sha1($_POST["password"]);

    if($db_pw == $input_pw){
        $_SESSION['login'] = $_POST['id'];
        header("Location:http://uraman.m-hosting.kr/ex_merge/guestbook");
        exit;
    }

    echo '<script>
            alert("아이디나 비밀번호가 틀렸습니다.");
            location.href="http://uraman.m-hosting.kr/ex_merge";
        </script>'
 ?>
