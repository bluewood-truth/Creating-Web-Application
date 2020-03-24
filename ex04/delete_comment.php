<?php
    include "script.php";
    if($_SESSION['password'] != 'valid'){
        exit;
    }
    $sql = "DELETE FROM guestbook WHERE id=".$_POST['cid'];
    $result = mysqli_query($conn, $sql);

    unset($_SESSION['password']);
 ?>
