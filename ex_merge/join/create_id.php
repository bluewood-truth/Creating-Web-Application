<?php
    include $_SERVER["DOCUMENT_ROOT"]."/ex_merge/script.php";

    // 필수항목이 빈칸이면 메인 화면으로
    $necessary = array($_POST['id'], $_POST['pw'], $_POST['nickname'],$_POST['mail_id'], $_POST['mail_domain'], $_POST['hp0'], $_POST['hp1'], $_POST['hp2']);
    foreach ($necessary as $item) {
        if(empty($item)){
            header('Location:http://uraman.m-hosting.kr/ex_merge/');
            exit;
        }
    }

    $id = filter($conn,$_POST['id']);
    $nickname = filter($conn,$_POST['nickname']);
    $password = sha1($_POST['pw']);
    $email = filter($conn,$_POST['mail_id'])."@".filter($conn,$_POST['mail_domain']);
    $phone_number = filter($conn,$_POST['p0'])."-".filter($conn,$_POST['p1'])."-".filter($conn,$_POST['p2']);
    $mobile_number = filter($conn,$_POST['hp0'])."-".filter($conn,$_POST['hp1'])."-".filter($conn,$_POST['hp2']);
    $comment = filter($conn,$_POST['txtarea'],true);


    // 아이디가 중복이면 메인 화면으로
    $sql = "SELECT id FROM userinfo WHERE user_id = '".$id."'";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($result);
    if(!empty($result)){
        header('Location:http://uraman.m-hosting.kr/ex_merge/');
        exit;
    }


    $sql = "INSERT INTO `userinfo` (user_id, nickname, password, email, phone_number, mobile_number, comment, join_date)
            VALUES('".$id."','".$nickname."','".$password."','".$email."','".$phone_number."','".$mobile_number."','".$comment."',now())";

    mysqli_query($conn, $sql);

    $id_array = mysqli_query($conn,"SELECT id FROM `userinfo` ORDER BY id DESC");
    $joined_id = mysqli_fetch_assoc($id_array)['id'];

    echo '<form action="form.php" method="POST" style="display:none">';
    echo '<input name="data" value="'.$joined_id.'">';
    echo '</form>';
?>

<script>
    document.getElementsByTagName('form')[0].submit();
</script>
