
<!-- <!DOCTYPE html>
<html lang="en-gb" class="no-js">
	<head>
		<title>Home - Classic Southern Literature</title>
		<link rel="stylesheet" href="../css/main.css">
	</head>

	<body>
		<h1>The Augusta University Audio Library of <br>
		Classic Southen Literature</h1>

		1676 to 1923<br>
		Made possible by the Watson Brown Foundation<br>

		Visit our sister website: <a href="www.hearatale.com">hearatale.com</a>

    </body> -->

	<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions2.php');

$currentLetter = $_GET['letter'];

$type = $_GET['type'];

?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
	<!--<![endif]-->
	<head>
		<title><?php echo "Southern " . ($type == "" || $type  == "All Types" ? "Literature" : $type); ?> - Hear a Tale</title>
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

	</head>

	<body>

	<body class="">
		<?php include ($_SERVER['DOCUMENT_ROOT'] . '/SOUTHERN_header.php'); ?>

			<?php

			$thisPage = "SOUTHERN_home.php" . ($type == "" ? "" : "?type=" . $type);
			$title = "Southern " . ($type == "" || $type  == "All Types" ? "Literature" : $type);
			$allData = cutDuplicates(getAllInCategory("Southern Literature"));
			$showAllAll = ($type == "" || $type == "All Types");
			$catData = array();
			if($showAllAll) $catData = $allData;
			else{
				if($type == "All Types" || $type == "") $type = "/";
				foreach($allData as $work){
					if(strpos($work['Category'], $type) != 0){
						array_push($catData, $work);
					}
				}
			}
			?>
			<div>
				<legend style="text-align: center;"> 
					
					<h5 style="display:inline-block;"><div class="letterPicker">
						<?php
							$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
							foreach($letters as $letter){
								if($currentLetter == $letter){
									echo $letter;
								} else{
									echo "<a href='" . $thisPage . (strpos($thisPage, "?") == 0 ? "?" : "&") . "letter=" . $letter . "'>" . $letter . "</a>";
								}
								if($letter != "Z") echo " · ";
							}
						?>
					</div></h5>
				</legend>

			</div>

			<div style="margin-top:-20px; border-top-style: solid; border-color: gray;">
				<?php southernTypeHeader($type == "" ? "All Types" : $type); ?>
			</div>

	<?php
			echo "<div style='width:100%; height: 70px; overflow:hidden; white-space:nowrap;'>";
			$catData = getAllInCategory("Southern Literature");
			$data = array();
			$authors = array();
			foreach($catData as $work){
				if($work['Author'] == "" || is_null($work['Author'])) continue;
				if(!in_array($work['Author'], $authors)){
					array_push($data, $work);
					array_push($authors, $work['Author']);
				}
			}
			shuffle($data);
			foreach($data as $authorWork) {
				echo "<a href='SOUTHERN_author.php?author=" . $authorWork['Author'] . "'>";
				echo '<img style="height:70px;" src="Thumbnails/' . $authorWork['ThumbnailImage'] . '">';
				echo "</a>";
			}
			echo "</div>";
			echo "<div style='width:100%; height: 3px; background-color:#808080'></div>";
			echo "<br>";
	?>
			


		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
