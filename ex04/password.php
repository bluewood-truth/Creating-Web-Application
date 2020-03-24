<?php
    include "script.php";
    $sql = "SELECT password FROM guestbook WHERE id=".$_POST['cid'];
    $result = mysqli_query($conn,$sql);
    $db_pw = mysqli_fetch_assoc($result)['password'];
    $result = $db_pw == sha1($_POST['password']);

    echo $result ? 'true' : 'false';

    if($result == "true"){
        $_SESSION['password'] = "valid";
    }
 ?>
