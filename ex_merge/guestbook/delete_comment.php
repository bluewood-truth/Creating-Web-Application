<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";
    if($_SESSION["cid".$_POST["password"]] != 'valid'){
        // exit;
    }
    $sql = "DELETE FROM guestbook WHERE id=".$_POST['cid'];
    $result = mysqli_query($conn, $sql);

    unset($_SESSION["cid".$_POST["password"]]);
 ?>
