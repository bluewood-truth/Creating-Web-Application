<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    // 비밀번호를 치고 들어왔을 경우
    if(isset($_POST["password"])){
        if($_SESSION["cid".$_POST["password"]] != 'valid'){
            exit;
        }

        // 코멘트가 회원의 것일 경우 exit
        $sql = 'SELECT user_id FROM `guestbook` WHERE id='.$_POST['cid'];
        $result = mysqli_query($conn,$sql);
        $user_id = mysqli_fetch_assoc($result)['user_id'];
        if(!empty($user_id)){
            exit;
        }

        $sql = "DELETE FROM guestbook WHERE id=".$_POST['cid'];
        $result = mysqli_query($conn, $sql);

        unset($_SESSION["cid".$_POST["password"]]);
    }

    // 비밀번호를 안치고 들어왔을 경우
    else{
        // 자기거면 삭제
        $sql = "SELECT user_id FROM `guestbook` WHERE id=".$_POST['cid'];
        $result = mysqli_query($conn, $sql);
        $user_id = mysqli_fetch_assoc($result)['user_id'];
        if($user_id == $_SESSION['login']){
            $sql = "DELETE FROM guestbook WHERE id=".$_POST['cid'];
            $result = mysqli_query($conn, $sql);
        }
    }

 ?>
