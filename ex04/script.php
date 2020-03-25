<?php
    session_start();
    $conn = mysqli_connect("localhost",'root','qwer1324');
    mysqli_select_db($conn, 'test');

    function filter($conn, $text, $is_text=false){
        $text = htmlspecialchars($text);
        if($is_text ){
            $text = str_replace("\n","<br>",$text);
        }
        $text = mysqli_real_escape_string($conn,$text);

        return $text;
    }

    function unfilter_text($text){}
?>
