<?php
require_once ('functions2.php');
?>
<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
	<!--<![endif]-->
	<head>
		<title>Home - Hear a Tale</title>
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
			<?php
				if(preg_match('/(?i)msie [1]/',$_SERVER['HTTP_USER_AGENT'])) {
			?>

			<div style="margin-top:20px; margin-left:0; width:80%;" class="IE-warning">
			<b>
				The version of Internet Explorer you are using may not support Hear a Tale's video player.<br>
				Please consider using a more reliable web browser:<br>
				<a href="https://www.google.com/chrome/browser/">
					<img src="http://icons.iconarchive.com/icons/google/chrome/128/Google-Chrome-icon.png">
				</a>
				<a href="https://www.mozilla.org/en-US/firefox/new/">
					<img src="http://img2.wikia.nocookie.net/__cb20090607180304/gta/pl/images/4/49/Firefox_(logo).png">
				</a>

			</b>
			</div>

			<?php } ?>
			<h3 style="color: red"> Alert:  We recently upgraded our hosting plan and some files were lost in ‘migration’.  We will restore the missing files as soon as possible.</h3>
			<fieldset><legend>
					<a href='alphabet.php'><img style ='max-width: 100%' src='images/alphabet_letters1.png' align='right'></a>
					<a href='children.php'><img style='height:50px' src='images/section_icons/Children.png'>Children's Section</a>
			</legend></fieldset>
			<div style='width:100%; overflow:hidden; margin-left:0 auto; margin-right: 0 auto;'>
			<?php	twoRowTitleCarousel("Children"); ?>
			</div>
			<br/>

			<fieldset><legend>
					<a href='ADULT_home.php'>Students and Adults</a>
			</legend></fieldset>
			<div style='width:100%; overflow:hidden;'>
			<?php	authorCarousel("Students and Adults"); ?>
			</div>
			<br/>

			<!-- <fieldset><legend>
					<a href='SOUTHERN_home.php'>Southern Literature</a>
			</legend></fieldset>
			<div style='width:100%; overflow:hidden;'>
			<?php	authorCarousel("Southern Literature"); ?>
			</div>
			<br/>
			-->

		</div>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
