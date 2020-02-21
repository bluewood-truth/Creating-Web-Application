<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
</head>
<body>
    <h1>js</h1>
    <script>
        list = new Array("one", "two", "three");
        document.write(list[2]);
        document.write(list.length);

        i = 0;
        while(i < list.length){
            document.write("<li>"+list[i]+"</li>");
            i += 1;
        }
    </script>
    <h1>php</h1>
    <?php
        $list = array("one", "two", "three");
        echo $list[2];
        echo count($list);

        $i = 0;
        while($i < count($list)){
            echo "<li>".$list[1]."</li>";
            $i += 1;
        }
     ?>
</body>
</html>
