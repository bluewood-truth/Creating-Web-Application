<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    $sql = "SELECT password FROM `userinfo` WHERE user_id='".$_POST['id']."'";
    $result = mysqli_query($conn,$sql);
    $db_pw = mysqli_fetch_assoc($result)['password'];

    $input_pw = sha1($_POST["password"]);

    // 아이디 비밀번호가 일치하면 해당 id값으로 세션변수 생성
    if($db_pw == $input_pw){
        $_SESSION['login'] = $_POST['id'];
        header('Location:'.$_SERVER['HTTP_REFERER']);
        exit;
    }

    // 아이디가 없거나 비밀번호가 틀렸을 경우
    echo '<script>
            alert("아이디나 비밀번호가 틀렸습니다.");
            location.href=document.referrer;
        </script>'
 ?>
