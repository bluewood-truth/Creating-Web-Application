<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/ex02/style.css">
</head>
<body>
    <article>
        <h2>회원가입을 축하드립니다!</h2>
        <div class="form_group">
        <?php
            function get_info($label, $n){
                echo '<div class="element-group"><div class="element-label">';
                echo $label;
                echo '</div><div class="element">';
                echo str_replace("\n","<br>",$_POST[$n]);
                echo '</div></div>';
            }

            function get_nums($label, $n1,$n2,$n3){
                echo '<div class="element-group"><div class="element-label">';
                echo $label;
                echo '</div><div class="element">';
                echo $_POST[$n1].'-'.$_POST[$n2].'-'.$_POST[$n3];
                echo '</div></div>';
            }

            function get_mail($label, $n1, $n2){
                echo '<div class="element-group"><div class="element-label">';
                echo $label;
                echo '</div><div class="element">';
                echo $_POST[$n1].'@'.$_POST[$n2];
                echo '</div></div>';
            }
            get_info("아이디","id");
            get_info("패스워드","pw");
            get_mail("이메일","mail_id","mail_domain");
            get_nums("전화번호","p0","p1","p2");
            get_nums("핸드폰번호","hp0","hp1","hp2");
            get_info("자기소개","txtarea");

         ?>
     </div>
    </article>
</body>
</html>
