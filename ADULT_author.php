<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions2.php');

$author = $_GET['author'];

$works = getAllByAuthorOutOfPool_absolute($author, getAllInCategory("Students and Adults"));
?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
	<!--<![endif]-->
	<head>
		<title><?php echo convertAuthorName($author) ?> - Hear a Tale</title>
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

			if(count($works) == 0){
				error404("Author", false);
			}

			else{
			?>

				<img class="AuthorPageImage" src="Thumbnails/<?php echo $works[0]['ThumbnailImage']; ?>">
				<div class="AuthorPage">
					<p class="AuthorPageName">
						<b><?php echo convertAuthorName($author) ?></b>
					</p>
					<p class="AuthorPageClassification">
					<?php
						$exploded = explode("/", $works[0]['Category']);
						$category = $exploded[1];
					?>
					<a href="ADULT_home.php?origin=<?php echo $category; ?>">
						<?php echo $category; ?>
					</a>
					</p>
					<?php
						$bioFileName = "author_bio/" . $author . ".txt";
						if(file_exists($bioFileName)) {
							echo '<p class="AuthorPageBio">';
							$bioFile = fopen($bioFileName, "r") or die("Unable to read author biogrophy file.");
							$bioText = fread($bioFile, filesize($bioFileName));
							echo $bioText;
							fclose($bioFile);
							echo '</p>';
						}
					?>

					<div style="clear: both;"></div>

					<?php
						$types = array();
						$types['Poetry'] = array();
						$types['Stories'] = array();
						$types['Books'] = array();
						$types['Nonfiction'] = array();
						$types['Plays'] = array();
						$types['Interviews'] = array();

						foreach($works as $work){
							$type = explode("/", $work['Category'])[2];
                            array_push($types[$type], $work);
						}

						$typeNames = array('Poetry', "Stories", "Nonfiction", "Books", "Plays", "Interviews");
						foreach($typeNames as $type){
							$typeWorks = $types[$type];
							if(count($typeWorks) != 0){
								echo "<p class='AuthorPageCategoryTitle'><b>"
								. "<a href='ADULT_home.php?type=" . $type . "'>"
								. $type . "</a></b></p>";
								foreach($typeWorks as $work){
									echo "<p class='AuthorPageWork'>";
									if($work['FileLocation'] != "") echo "<a href=ADULT_viewer.php?url=" . urlencode($work['FileLocation']) . "&cat=" . urlencode($work['FileLocation']) . ">";
									echo $work['Title'] . ($work['Chapter'] != "" ? ", " . $work['Chapter'] : "");
									if($work['FileLocation'] == "") echo " <i>(Coming soon)</i>";
									if($work['FileLocation'] != "") echo "</a>";
									echo "</p>";
								}
							}
						}


					?>
				</div>

			<?php } ?>

		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>
