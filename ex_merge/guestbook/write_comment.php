<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";
    // 글 작성시
    if($_POST['request'] == "write"){
        if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['content'])){
            header('Location:http://uraman.m-hosting.kr/ex_merge/');
            exit;
        }

        $nickname = filter($conn,$_POST['nickname']);
        $password = sha1($_POST['password']);
        $content = filter($conn,$_POST['content'],true);

        $sql = "INSERT INTO `guestbook` (nickname,password,content,datetime) values('".$nickname."','".$password."','".$content."',now())";

        mysqli_query($conn, $sql);
        header('Location:http://uraman.m-hosting.kr/ex_merge/guestbook/');
    }

    // 글 수정시
    if($_POST['request'] == "edit"){
        if($_SESSION["cid".$_POST["password"]] != 'valid'){
            exit;
        }

        $text = filter($conn,$_POST['text'],true);
        $sql = 'UPDATE `guestbook` SET content="'.$text.'" WHERE id='.$_POST['cid'];
        mysqli_query($conn,$sql);

        unset($_SESSION["cid".$_POST["password"]]);
    }
 ?>
