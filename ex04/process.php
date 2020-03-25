<?php
    include "script.php";

    if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['content'])){
        header('Location:http://localhost/ex04/');
        exit;
    }

    $nickname = filter($conn,$_POST['nickname']);
    $password = sha1($_POST['password']);
    $content = filter($conn,$_POST['content'],true);
    
    $sql = "INSERT INTO `guestbook` (nickname,password,content,datetime) values('".$nickname."','".$password."','".$content."',now())";

    mysqli_query($conn, $sql);
    header('Location:http://localhost/ex04/');
 ?>
