<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
</head>
<body>
    <?php
        $password = $_GET["password"];
        if($password==1111){
            echo "안녕하세요 고객님";
        }else{
            echo "누구?";
        }
     ?>
</body>
</html>
