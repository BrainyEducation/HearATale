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

		<title>Biographies - Southern Lit</title>
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

	</head>

	<body>
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/SOUTHERN_header.php'); ?>

			<?php aboutHeaderSouthern("Introduction"); ?>
            <h1 style="width:100%; text-align:center;">Support</h1>
            <div style="width:80%; margin-left:10%; margin-right:10%; margin-bottom: 50px;">
                <p>This Southern literature audiobook website was made possible by a generous grant from the Watson Brown Foundation.</p>
                <p>Most of our Southern literature texts are at least several decades old, out of copyright, and free to reproduce.  Later material on our site, so far as we can tell, has also entered the public domain or we have permission to reproduce it.  If we’re mistaken please let us know and we’ll remove the material from the site.  We’re grateful that two excellent, award-winning contemporary authors, Louise Shivers and Molly Brodak, have given us permission to use material recorded in their own voices.</p>

                <h4 style="float:left; margin-top:0px;">Return <a href="index.php">Home</a></h3>
                <h4 style="text-align:right;">Continue to <a href="ABOUT_SL_voices.php">voices</a></h3>
            </div>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
