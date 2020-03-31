<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";
    // 글 작성시
    if($_POST['request'] == "write"){
        // 비회원일 경우
        if(!isset($_SESSION['login'])){
            if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['content'])){
                header('Location:http://uraman.m-hosting.kr/ex_merge/');
                exit;
            }

            $nickname = filter($conn,$_POST['nickname']);
            $password = sha1($_POST['password']);
            $content = filter($conn,$_POST['content'],true);

            $sql = "INSERT INTO `guestbook` (nickname,password,content,datetime) values('".$nickname."','".$password."','".$content."',now())";

            mysqli_query($conn, $sql);
            header('Location:http://uraman.m-hosting.kr/ex_merge/guestbook/');
        }
        // 회원일 경우
        else{
            if(empty($_POST['content'])){
                header('Location:http://uraman.m-hosting.kr/ex_merge/');
                exit;
            }

            $user_id = $_SESSION['login'];
            $nickname = get_userinfo_by_id($user_id, 'nickname');
            $content = filter($conn,$_POST['content'],true);


            $sql = "INSERT INTO `guestbook` (nickname,content,datetime,user_id)
                    values('".$nickname."','".$content."',now(),'".$user_id."')";

            mysqli_query($conn, $sql);
            header('Location:http://uraman.m-hosting.kr/ex_merge/guestbook/');
        }
    }

    // 글 수정시 (ajax)
    if($_POST['request'] == "edit"){
        // 비밀번호를 쳐서 들어왔을 경우
        if($_POST["password"] != ""){
            // 세션 비밀번호와 비교하여 valid가 아니면 exit
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

            $text = filter($conn,$_POST['text'],true);
            $sql = 'UPDATE `guestbook` SET content="'.$text.'" WHERE id='.$_POST['cid'];
            mysqli_query($conn,$sql);

            unset($_SESSION["cid".$_POST["password"]]);
        }
        // 비밀번호를 안치고 들어왔을 경우 (회원의 코멘트)
        else{
            // 자기거면 수정
            $sql = "SELECT user_id FROM `guestbook` WHERE id=".$_POST['cid'];
            $result = mysqli_query($conn, $sql);
            $user_id = mysqli_fetch_assoc($result)['user_id'];
            if($user_id == $_SESSION['login']){
                $text = filter($conn,$_POST['text'],true);
                $sql = 'UPDATE `guestbook` SET content="'.$text.'" WHERE id='.$_POST['cid'];
                mysqli_query($conn,$sql);
            }
        }
    }
 ?>
