<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://localhost/basic_phpjs/js/style.css">
	<script src="http://localhost/basic/phpjs/php/script.js"></script>
</head>
<body id="target">
	<header>
		<h1><a href="http://localhost/basic_phpjs/php/">JavaScript</a></h1>
	</header>
	<nav>
		<ol>
            <?php echo file_get_contents("list.txt"); ?>
		</ol>
	</nav>

	<div id="control">
		<input type="button" value="white" id="white"/>
		<input type="button" value="black" id="black" />
	</div>

    <article>
        <?php if(empty($_GET['id']) == false){
            echo file_get_contents($_GET['id'].".txt");
        }
        ?>
    </article>
</body>
</html>
