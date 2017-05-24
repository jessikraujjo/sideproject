<?php 
	require("classes.php");
	$videos = Canal::getVideo();
	$videosFaltam = array_filter($videos, function($k){
		return $k->link == "#";
	});
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SideProject</title>
		<link  rel="stylesheet" type="text/css" href="estilos.css">

	</head>
	<body>
		<div class="cabecalho">
			<h2>#desafio100videos </h2>
		 	<h2>Faltam <?php echo count($videosFaltam);?> </h2>
		</div>
		<?php
		 	foreach ($videos as $video):?>
		 	<a target="_blank" href="<?php echo $video->link ?>" >
		 		<img src="<?php echo $video->image ?>">
		 	</a>
		 		<?php endforeach; ?>
		 	
	</body>
</html>
