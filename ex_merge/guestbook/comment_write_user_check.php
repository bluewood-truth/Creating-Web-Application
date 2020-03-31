<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";
    $sql = "SELECT user_id FROM `guestbook` WHERE id=".$_POST['cid'];
    $result = mysqli_query($conn, $sql);
    echo mysqli_fetch_assoc($result)['user_id'];
 ?>
