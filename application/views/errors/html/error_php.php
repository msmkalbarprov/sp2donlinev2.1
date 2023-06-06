
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
	?>
	<h4>A PHP Error was encountered</h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Backtrace:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			File: <?php echo $error['file'] ?><br />
			Line: <?php echo $error['line'] ?><br />
			Function: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>
	<?php

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

