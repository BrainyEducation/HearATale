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

		<title>Children's Section - Hear a Tale</title>
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

		<style>
			.carousel_item{
				padding-left: 10px;
				padding-right: 10px;
				width: auto;
				text-align: center;
			}

			.carousel_item img{
				height: 100px;
				width: auto;
			}

			.carousel_text{
				width: 75px;
				margin-left: auto;
				margin-right: auto;
			}
		</style>

	</head>

	<body>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalBody.php');
		?>

		<div class="span9" style="margin-left:5px; margin-right:5px;">

			<div style="clear: both;"></div>

					<h1><strong><i><img src="images/section_icons/Children.png">Children's Section</i></strong></h1>
					</br>

			<?php

			$data = getAllInCategory("Children");
			$subcats = array();

			//get list of all subcategories

			foreach($data as $work){
				$subcat = substr($work['Category'], 9);
				if(!in_array($subcat, $subcats)){
					array_push($subcats, $subcat);
				}
			}

			$subcatGroups = array();
			$subcatSupergroups = array();

			foreach($subcats as $subcat){
				$exploded = explode("/", $subcat);
				$subcatGroups[$exploded[0]] = array();
				if(!in_array($exploded[0], $subcatSupergroups)) array_push($subcatSupergroups, $exploded[0]);

			}
			foreach($subcats as $subcat){
				$exploded = explode("/", $subcat);
				array_push($subcatGroups[$exploded[0]], $exploded[1]);
			}

			foreach($subcatSupergroups as $subcatSuper){
				$thumbnailSuper = "images/section_icons/Children!" . str_replace(" ", "_", str_replace("/", "!", $subcatSuper)) . ".png";
				echo "<a href='category.php?cat=Children/" . $subcatSuper . "'>";
				echo "<div style='padding-left:105px;'>";
				echo "<fieldset><legend><h2><strong>";
				if(file_exists($thumbnailSuper)) echo "<img padding-right:5px;' src= " . $thumbnailSuper . ">";
				echo $subcatSuper . "</strong></h2></legend></fieldset></div></a>";
				/*foreach($subcatGroups[$subcatSuper] as $subcat){
					$thumbnail = "images/section_icons/Children!" . str_replace(" ", "_", str_replace("/", "!", $subcatSuper . "!" . $subcat)) . ".png";
					echo "<fieldset><legend><div style='padding-left:105px'><a href='/category.php?cat=Children/" . $subcatSuper . "/" . $subcat . "'>";
					if(file_exists($thumbnail)) echo "<img style='padding-right:5px' src= ". $thumbnail . ">";
					echo $subcat . "</div></a></legend></fieldset>";
				}
				echo "<br><br>";*/
			}

			?>

		</div>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
