<?php
require_once ('functions2.php');

$category = "Children/Stories/Classic Stories by Appeal";
$data = getAllInCategory($category);

$categoryName = "Classic Stories by Appeal";
$thumbnailCat = "images/section_icons/Children!Stories!Classic_Stories_by_Appeal.png";

$superCat = "Stories";
$thumbnailSuperCat = "images/section_icons/Children!Stories.png";
if(sizeof($categoryExploded) === 3){
	$superCat = $categoryExploded[1];
	$thumbnailSuperCat = "images/section_icons/Children!" . str_replace(" ", "_", str_replace("/", "!", $superCat)) . ".png";
}

function printVideoCard($work){
	echo "<div style='padding-left: 105px; padding-bottom: 5px;'>";
	echo "<div style='float:left;'>";
	echo "<a href='video.php?url=" . $work['FileLocation'] . "&cat=" . $work['Category'] . "'>";
	echo '<img style="height: 135px; width: auto; padding-right: 5px;" src="Thumbnails/' . str_replace("\\", "/", $work['ThumbnailImage']) . '">';
	echo "</div>";
	echo "<div style='width:600px; height: 135px; display: table-cell; vertical-align: middle;'>";
	echo "<h3 style='margin-bottom:0px; padding-top:0px; margin-top:-10px; float:left;'>" . $work['Title'] . "</p></h3></a>";
	if($work["Length"] != "" || $work["Target"] != ""){
		echo "<div style='clear:both; padding-left: 5px; display: table-cell;'>";
		if($work["Target"] != ""){
			echo "<a title='Click for more info' href='ABOUT_storyAppeal.php'>";
			echo "<img style='width:15px' src='images/target_audience/" . $work["Target"] . ".png'></a>";
		}
		if($work["Length"] != "") echo " <b>[</b>" . $work['Length'] . "<b>]</b> ";
		echo "</div>";
	}
	echo "<div style='clear:both; padding-left: 15px; text-align:justify; width:450px;'>";
	echo $work['Description'];
	if($work["Words"] != "") echo " " . $work["Words"] . " words.";
	echo "</div></div></div>";
}

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
		if(count($data) != 0) echo "<title>" . $categoryName . " - Hear a Tale</title>";
		else echo "<title>Not found - Hear a Tale</title>";
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
			if(count($data) == 0){
				error404('category');
			}else{
			?>

			<h1><strong><i>
				<?php
					if($superCat != NULL){
						echo "<a href='category.php?cat=Children/" . $superCat . "'><div>";
						if(file_exists($thumbnailSuperCat)) echo "<img style='padding-right:5px' src= ". $thumbnailSuperCat . ">";
						echo $superCat . ": </a>";
					}
					echo $categoryName;
					if(file_exists($thumbnailCat)) echo "<img style='padding-right:5px;' src= ". $thumbnailCat . ">";
				?>
			</i></strong></h1></br>

			<?php

			$M = array();
			$F = array();
			$B = array();
			$A = array();

			foreach($data as $video){
				if($video['Target'] == "M") array_push($M, $video);
				if($video['Target'] == "F") array_push($F, $video);
				if($video['Target'] == "B") array_push($B, $video);
				if($video['Target'] == "A") array_push($A, $video);
			}

			?>

			<a href="subcategory_appeal.php#general"><h3><img style="width:30px" src="images/target_audience/B.png"> General Appeal</h2></a>
				Stroies marked with a green dot do not emphasize either gender. They may appeal equally to both boys and girls.
			<a href="subcategory_appeal.php#animal"><h3><img style="width:30px" src="images/target_audience/A.png"> Animals and other non-human Protagonists</h2></a>
				Stories marked with a gray dot feature animals and other non-human protagonists. They will likely appeal equally to both boys and girls.
			<a href="subcategory_appeal.php#female"><h3><img style="width:30px" src="images/target_audience/F.png"> Female Protagonist</h2></a>
				Stories marked with a pink dot emphasize female protagonists. They may appeal more to girls.
			<a href="subcategory_appeal.php#male"><h3><img style="width:30px" src="images/target_audience/M.png"> Male Protagonist</h2></a>
				Stories marked with a blue dot emphasize male protagonists. They may appeal more to boys.
			<br>
			<br>


			<?php

			echo '<h2><a id="general"></a><img style="width:25px" src="images/target_audience/B.png"> General Appeal</h2>';
			foreach($B as $video) printVideoCard($video);
			echo '<h2><a id="animal"></a><img style="width:25px" src="images/target_audience/A.png"> Animals and other non-human Protagonists</h2>';
			foreach($A as $video) printVideoCard($video);
			echo '<h2><a id="female"></a><img style="width:25px" src="images/target_audience/F.png"> Female Protagonist</h2>';
			foreach($F as $video) printVideoCard($video);
			echo '<h2><a id="male"></a><img style="width:25px" src="images/target_audience/M.png"> Male Protagonist</h2>';
			foreach($M as $video) printVideoCard($video);

			?>


		<?php
		}
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>