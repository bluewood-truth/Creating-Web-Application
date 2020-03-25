<?php
    include "script.php";

    if($_SESSION["cid".$_POST["password"]] != 'valid'){
        exit;
    }

    $text = filter($_POST['text']);
    $sql = 'UPDATE `guestbook` SET content="'.$text.'" WHERE id='.$_POST['cid'];
    mysqli_query($conn,$sql);

    unset($_SESSION["cid".$_POST["password"]]);
 ?>
