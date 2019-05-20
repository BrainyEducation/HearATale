<?php
require_once ('functions2.php');

$url = $_GET['url'];
$sourceCategory = $_GET['cat'];

$play = NULL;

if($url != ""){
	ensureDataLoaded();

	foreach ($data as $work) {
		if ($work['FileLocation'] == $url) {
            if (strpos($work['Category'], 'Students') !== FALSE) { //make sure result is in right category
                $play = $work;
                break;
            }
		}
	}

	$previousVideo = NULL;
	$nextVideo = NULL;

    // $otherParts = '';

    // // only works if the book has chapters
    // if( $play['Chapter'] != '' ) {
    //     $otherParts = getAllPartsOutOfPool($play['Title'], getAllInCategory("Southern Literature"));
    //     if(count($otherParts) > 1){
    //         $thisPart = $play['Chapter'];
    //         for($i = 0; $i < count($otherParts); $i++){
    //             if($thisPart == $otherParts[$i]['Chapter']){
    //                 if($i != 0) $previousVideo = $otherParts[$i - 1];
    //                 if($i != (count($otherParts) - 1)) $nextVideo = $otherParts[$i + 1];
    //             }
    //         }
    //     }
    // } else {
    // // will work for all works by the same author
    //     $otherParts = getAllByAuthorOutOfPool_absolute($play['Author'], getAllInCategory("Southern Literature"));
    //     if(count($otherParts) > 1){
    //         $thisPart = $play['Title'];
    //         for($i = 0; $i < count($otherParts); $i++){
    //             if($thisPart == $otherParts[$i]['Title']){
    //                 if($i != 0) $previousVideo = $otherParts[$i - 1];
    //                 if($i != (count($otherParts) - 1)) $nextVideo = $otherParts[$i + 1];
    //             }
    //         }
    //     }
    // }

    $otherParts = '';

    // only works if the book has chapters
    if( $play['Chapter'] != '' ) {
        $otherParts = getAllPartsOutOfPool($play['Title'], getAllInCategory("Students and Adults"));
        if(count($otherParts) > 1){
            $thisPart = $play['Chapter'];
            for($i = 0; $i < count($otherParts); $i++){
                if($thisPart == $otherParts[$i]['Chapter']){
                    if($i != 0) $previousVideo = $otherParts[$i - 1];
                    if($i != (count($otherParts) - 1)) $nextVideo = $otherParts[$i + 1];
                }
            }
        }
    } else {
    // will work for all works by the same author
        $otherParts = getAllByAuthorOutOfPool_absolute($play['Author'], getAllInCategory("Students and Adults"));
        if(count($otherParts) > 1){
            $thisPart = $play['Title'];
            for($i = 0; $i < count($otherParts); $i++){
                if($thisPart == $otherParts[$i]['Title']){
                    if($i != 0) $previousVideo = $otherParts[$i - 1];
                    if($i != (count($otherParts) - 1)) $nextVideo = $otherParts[$i + 1];
                }
            }
        }
    }
    
    $fixedTitle = $play['Title'];
    $fixedTitle = str_replace(":", "~", $fixedTitle);
    if($fixedTitle[0] == " "){
        $fixedTitle = substr($fixedTitle, 1);
    }
    
    $textFileName = "work_text/" . $fixedTitle;
    if($play['Chapter'] != null){
        $textFileName .= "," . $play['Chapter'];
    }
    $textFileName .= "-" . convertAuthorName($play['Author']) . ".txt";
    
    //only use by-chapter texts if there isn't a text for the whole book
    if($play['Chapter'] != null){
        $nameNoChapter = "work_text/" . $fixedTitle;
        $nameNoChapter .= "-" . convertAuthorName($play['Author']) . ".txt";
        if(file_exists($nameNoChapter)) {
            $textFileName = $nameNoChapter;
        }
    }

}

$isAudio = substr($url, -4) === ".mp3";

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
		if($play != null && $play['Title'] != "") echo "<title>" . $play['Title'] . " - Hear a Tale</title>";
		else echo "<title>Not Found - Hear a Tale</title>";
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

		<!-- flowplayer imports -->
		<!-- <link rel="stylesheet" type="text/css" href="//releases.flowplayer.org/5.4.6/skin/minimalist.css"> -->
        <link rel="stylesheet" type="text/css" href="//releases.flowplayer.org/7.0.2/skin/skin.css">
		<style>
			.flowplayer {
				background-color: #222;
				background-size: cover;
				max-width: 800px;
			}
			.flowplayer .fp-controls {
				background-color: rgba(235, 245, 255, 0.4)
			}
			.flowplayer .fp-timeline {
				background-color: rgba(187, 220, 252, 0.5)
			}
			.flowplayer .fp-progress {
				background-color: rgba(71, 166, 255, 1)
			}
			.flowplayer .fp-buffer {
				background-color: rgba(156, 207, 255, 1)
			}
			.flowplayer {
				background-color: rgba(222, 222, 222, 0)
			}
		</style>
		
        <style>
                @media(min-width: 700px) {
                    .mobile-view-message {
                        display: none;
                    }
                }
        </style>
        <script src="http://releases.flowplayer.org/7.0.2/flowplayer.min.js"></script>
		<!-- end flowplayer imports -->
		<!-- flowplayer javascript customization -->
        <script>
            flowplayer(function(api, root) {
                api.bind("ready", function() {
					console.log('ready')
					api.resume();

				});

				api.bind("finish", function() {

					<?php if($nextVideo != NULL){ ?>

					window.location.href = "video.php?url=<?php echo $nextVideo['FileLocation'];?>&cat=<?php echo $sourceCategory;?>";

					<?php } ?>

				});

                api.bind("error", function (e, err) {
                    window.setInterval(function(){ location.reload(); }, 3000);
                });

			});


		</script>

	</head>

	<body>
            
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '/SOUTHERN_header.php'); ?>
    
    <div style="max-width: 900px; clear: both; margin: 0 auto;">
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

        <?php	if($play != null){  ?>

            <p style="font-size:200%; line-height:110%;"><b> <?php echo $play['Title'] . ($play['Chapter'] != "" ? ", " . $play['Chapter'] : "")?> </b></p>
            <p class="lightLink" style="font-size:175%;">
                <?php
                $exploded = explode("/", $work['Category']);
                $origin = $exploded[1];
                $type = $exploded[2];
                ?>
                <a href='SOUTHERN_home.php?origin=<?php echo $origin; ?>&type=<?php echo $type; ?>'>
                    <?php 
                        $singularType = $type;
                        
                        if ($type === "Books") { $singularType = "Book"; }
                        else if ($type === "Stories") { $singularType = "Story"; }
                        else if ($type === "Plays") { $singularType = "Play"; }
                        else if ($type === "Poetry") { $singularType = "Poem"; }
                        echo explode(" ", $origin)[0] . " " . $singularType; 
                    ?>
                </a>
            </p>
            <p class="lightLink" style="font-size:175%;"> by
                <a href='SOUTHERN_author.php?author=<?php echo $play['Author']; ?>'>
                    <?php echo convertAuthorName($play['Author']); ?>
                </a>
            </p>
            <br>
            
            <div id="viewer-left" <?php if($isAudio){ ?> style="width: 300px; <?php if(file_exists($textFileName)) { ?> float: right; <?php } ?> padding: 20px; margin-right: 50px;<?php } ?>">
                <?php if($isAudio){ ?>
                    <div style='width:300px; height:auto; background-color:#dddddd;'>

                        <img style='width=auto; height:auto; display: table; margin:0 auto;' src="Thumbnails/<?php echo $play['ThumbnailImage']; ?>">
                    </div>
                <?php } ?>
                
                <div data-swf="//releases.flowplayer.org/7.0.2/flowplayer.swf"
                style="min-height: 120px;"
                class="flowplayer fixed-controls no-toggle play-button color-light"
                data-ratio="0.5625" data-embed="false">
                    <?php if(substr($url, -4) === ".mp3"){ ?>
                    <audio  class="audio-player" controls preload="auto" autoplay>
                        <source type="audio/mp3" src="http://hearatale.org/podcasting/<?php echo $url;	?>" >
                    </audio>
                    <?php } else { ?>
                    <video preload="auto">
                        <source type="video/mp4" src="http://hearatale.org/podcasting/<?php echo $url;	?>"/>
                    </video>
                    <?php } ?>
                    <div class="mobile-view-message">
                    <h5>This audio file may take 5 seconds to load</h5>
                    </div>
                </div>
                


                <?php if($previousVideo != null || $nextVideo != null){ ?>
                    <?php if($isAudio){ ?>
                    <table style="width:300px; margin-top: 20px;">
                    <?php } else { ?>
                    <table style="width:80%; margin-top: 20px;"> 
                    <?php } ?>
                        <tr align="center">
                            <?php if($previousVideo != null){ ?>
                            <td>
                                <a href="SOUTHERN_viewer.php?url=<?php echo $previousVideo['FileLocation']; ?>">
                                    <img src="images/section_icons/arrow_left.png">
                                </a>
                            </td>
                            <?php } ?>
                            <?php if($nextVideo != null){ ?>
                                <td>
                                    <a href="SOUTHERN_viewer.php?url=<?php echo $nextVideo['FileLocation']; ?>">
                                        <img src="images/section_icons/arrow_right.png">
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>

                        <tr align="center">
                            <?php if($previousVideo != null){ ?>
                            <td>
                                <a href="SOUTHERN_viewer.php?url=<?php echo $previousVideo['FileLocation']; ?>">
                                    <?php echo $previousVideo['Chapter']; ?>
                                </a>
                            </td>
                            <?php } ?>
                            <?php if($nextVideo != null){ ?>
                                <td>
                                    <a href="SOUTHERN_viewer.php?url=<?php echo $nextVideo['FileLocation']; ?>">
                                        <?php echo $nextVideo['Chapter']; ?>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>

                <?php } ?>
            </div>
        
            <?php if($isAudio){ ?>
            <div class="viewer-right">
                <?php
                    if(file_exists($textFileName)) {
                        echo '<p style="font-size:200%; line-height:110%;"><b>Written Text</b></p>';
                        echo '<p>';
                        $textFile = fopen($textFileName, "r") or die("Unable to read work text file.");
                        $text = fread($textFile, filesize($textFileName));
                        $text = str_replace("\n\n", "</p><p>", $text);
                        $text = str_replace("\n", ' ', $text);
                        //also replacing this weird other line-break character that showed up a few times
                        $text = str_replace("  ", "</p><p>", $text);
                        $text = str_replace(" ", '</p><p style="margin-top:-10px;">', $text);
                        if (strlen($text) < 2500){
                            echo "<div class='workText' style='max-width: 460px;'>";
                        } else {
                            echo "<div class='workText' style='max-width: 460px;' >";
                        }
                        echo $text . "</div>";
                        fclose($textFile);
                        echo '</p>';
                    }
                ?>

            </div>
            <?php } ?>
        


    <?php
        } else error404('video', false);
        include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
    ?> 
    </div>

<script>
    let player = document.querySelector('.audio-player')
    player.addEventListener('ended', () => {
        window.location.href = "SOUTHERN_viewer.php?url=<?php echo $nextVideo['FileLocation'];?>"
    });
            
</script>
