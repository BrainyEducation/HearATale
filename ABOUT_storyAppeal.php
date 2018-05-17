<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions2.php');


?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
	<!--<![endif]-->
	<head>

		<title>Story Appeal Markings - Hear a Tale</title>
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

	</head>

	<body>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalBody.php');
		?>


		<div class="span9" style="margin-left:5px; margin-right:5px;">
			<div style="clear: both;"></div>
			<?php //aboutHeader("Story Appeal Markings"); ?>
			<h1>Story Appeal Markings
			<img style="width:30px" src="images/target_audience/M.png">
			<img style="width:30px" src="images/target_audience/F.png">
			<img style="width:30px" src="images/target_audience/B.png">
			<img style="width:30px" src="images/target_audience/A.png">
			</h1>
			<br>
			These markings appear next to titles of stories within the Children's Section.<br><br>
			They signify whether the story is more likely to appeal to boys or girls. Of course they are just guidelines because every child is different,
			but they are designed to allow teachers, parents, and even the children themselves to choose stories that they will like most.<br><br>
			<h3><img style="width:25px" src="images/target_audience/M.png"> Male Protagonist</p></h3>
			Stories marked with a blue dot emphasize male protagonists. They may appeal more to boys.
			<h3><img style="width:25px" src="images/target_audience/F.png"> Female Protagonist</p></h3>
			Stories marked with a pink dot emphasize female protagonists. They may appeal more to girls.
			<h3><img style="width:25px" src="images/target_audience/B.png"> General Appeal</p></h3>
			Stroies marked with a green dot do not emphasize either gender. They may appeal equally to both boys and girls.
			<h3><img style="width:25px" src="images/target_audience/A.png"> Animals and other non-human Protagonists</p></h3>
			Stories marked with a gray dot feature animals and other non-human protagonists. They will likely appeal equally to both boys and girls.

			<h1>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
