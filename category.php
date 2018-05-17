<?php
require_once ('functions2.php');

$category = $_GET['cat'];

if($category == "Children") header( 'Location: children.php' ) ;

$data = getAllInCategory($category);
if(sizeof($data) == 0){
	$error = true;
}

$categoryExploded = explode("/", $category);
$categoryName = $categoryExploded[sizeof($categoryExploded) - 1];
$thumbnailCat = "images/section_icons/" . str_replace(" ", "_", str_replace("/", "!", $category)) . ".png";

$allSubcats = array();

//get list of all subcategories
foreach($data as $work){
	$subcat = $work['Category'];
	if(!in_array($subcat, $allSubcats)){
		array_push($allSubcats, $subcat);
	}
}

$subcats = array();

foreach($allSubcats as $subcat){
	if (strpos($subcat, $category . "/") === 0){
		$subcatExploded = explode("/", $subcat);
		array_push($subcats, $subcatExploded[sizeof($subcatExploded) - 1]);
	}
}

if(sizeof($subcats) == 0) header( 'Location: subcategory.php?cat=' . $category );

?>
<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
	<!--<![endif]-->
	<head>

		<?php
		echo "<title>" . $categoryName . " - Hear a Tale</title>";
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
						if($error) error404("category");
						else{
					?>
					<h1><strong><i>
						<?php
							echo "<a href='children.php'>";
							echo "<img style='padding-right:5px' src=images/section_icons/Children.png>";
							echo "Children's Section: </a>";

							echo $categoryName;
							if(file_exists($thumbnailCat)) echo "<img style='padding-right:5px' src= ". $thumbnailCat . ">";
						?>
					</i></strong></h1></br>

			<?php

			foreach($subcats as $subcat){
				$thumbnail = "images/section_icons/" . str_replace(" ", "_", str_replace("/", "!", $category . "/" . $subcat)) . ".png";
				echo "<a href='subcategory.php?cat=" . $category . "/" . $subcat . "'>";
				echo "<div style='padding-left:105px;'>";
				echo "<fieldset><legend><h2><strong>";
                                
      				if(file_exists($thumbnail)) echo "<img padding-right:5px;' src= ". $thumbnail . ">";
				echo $subcat . "</strong></h2></legend></fieldset></div></a>";
			}

			?>

		</div>

		<?php
		}
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>