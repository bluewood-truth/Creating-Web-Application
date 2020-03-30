<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    if($_POST["check"] == "id"){
        $sql = "SELECT id FROM userinfo WHERE user_id = '".$_POST["id"]."'";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($result);
        echo empty($result) ? 'true' : 'false';
    }
 ?>
