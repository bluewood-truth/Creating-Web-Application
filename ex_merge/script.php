<?php
    ini_set('display_errors', 1);
    session_start();
    $conn = mysqli_connect("localhost",'uraman','!Q2w3e4r');
    mysqli_select_db($conn, 'uraman');

    function filter($conn, $text, $is_text=false){
        $text = htmlspecialchars($text);
        if($is_text ){
            $text = str_replace("\n","<br>",$text);
        }
        $text = mysqli_real_escape_string($conn,$text);

        return $text;
    }

    function get_userinfo_by_id($id, $desired_item){
        global $conn;
        $sql = "SELECT ".$desired_item." FROM `userinfo` WHERE user_id='".$id."'";
        $result = mysqli_query($conn,$sql);
        return mysqli_fetch_assoc($result)[$desired_item];
    }
?>
