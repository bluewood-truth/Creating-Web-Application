<?php
    include "script.php";

    if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['content'])){
        header('Location:http://localhost/ex04/');
        exit;
    }

    function filter($conn, $text){
        return htmlspecialchars(mysqli_real_escape_string($conn,$text));
    }

    $nickname = filter($conn,$_POST['nickname']);
    $password = sha1($_POST['password']);
    $content = str_replace("\n","<br>",$_POST['content']);
    $content = filter($conn,$content);

    $sql = "INSERT INTO `guestbook` (nickname,password,content,datetime) values('".$nickname."','".$password."','".$content."',now())";
    mysqli_query($conn, $sql);
    header('Location:http://localhost/ex04/');
 ?>
