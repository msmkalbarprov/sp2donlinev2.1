<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Error 500 alert - #CodePenChallenges</title>
  <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://simakda.kalbarprov.go.id/sp2d_online/assets/dist/style.css">   

</head>
<body>
<!-- partial:index.partial.html -->

<!-- partial -->
  <?php 

//   echo ENVIRONMENT;
 if (ENVIRONMENT=='development'){ 
	echo "\nDatabase error: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";

 }else{
	?>
	<div id="error">
		<div id="box"></div>
		<h3>ERROR 500</h3>
		<p>Things are a little <span>unstable</span> here</p>
		<p>I suggest come back later</p>
	</div>
	
	<?php
} 
  ?>
</body>
</html>
