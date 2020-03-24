<?php
    session_start();
    $conn = mysqli_connect("localhost",'root','qwer1324');
    mysqli_select_db($conn, 'test');
?>
