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
		<title>Contact Us - Hear a Tale</title>
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalHeader.php');
		?>

	</head>

	<body>
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/SOUTHERN_header.php'); ?>


		<div class="span9" style="margin-left:5px; margin-right:5px;">
			<div style="clear: both;"></div>
            <h2>Contact Us</h2>
            <h3>Email: <a href="mailto:rhymeazoo@augusta.edu">rhymeazoo@augusta.edu</a></h3>
            <br>
            <h4 style="float:left; margin-top:-2px; margin-right:10px;">Compose an Email</h4>
            <i>All fields are required.</i>
            <div style="clear:both;"></div>
            <form name="email" method="post" action="ABOUT_contact.php">
            
                <table>
                <tr>
                    <td>
                        <label for="first_name">First Name:</label>
                    </td>
                    <td>
                        <input type="text" name="first_name" maxlength="50" size="30">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="last_name">Last Name:</label>
                    </td>
                    <td>
                        <input type="text" name="last_name" maxlength="50" size="30">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Your email address:</label>
                    </td>
                    <td>
                        <input type="text" name="email" maxlength="100" size="30">
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label for="message">Message:</label>
                    </td>
                    <td>
                        <textarea  name="message" maxlength="10000" cols="50" rows="6"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:left">
                        <input type="submit" value="Send">
                    </td>
                </tr>
                </table>
            
            </form>

            <?php
                if(isset($_POST['email'])) {
                    
                    function died($error) {
                        echo "<h4>We are very sorry, but there were error(s) found with the form you submitted.</h4>";
                        echo $error."";
                        echo "<h5>Please go back and fix these errors.</h5><br /><br />";
                        die();
                    }

                    if(!isset($_POST['first_name']) ||
                        !isset($_POST['last_name']) ||
                        !isset($_POST['email']) ||
                        !isset($_POST['message'])) {
                        died('You forgot to fill out all of the required fields.');
                    }

                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email_from = $_POST['email'];
                    $message = $_POST['message'];
                    $error_message = "";
                    
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                    if(!preg_match($email_exp,$email_from)) {
                        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
                    }

                    $string_exp = "/^[A-Za-z .'-]+$/";
                    if(!preg_match($string_exp,$first_name)) {
                        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
                    }

                    if(!preg_match($string_exp,$last_name)) {
                        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
                    }

                    if(strlen($message) < 2) {
                        $error_message .= 'The message you entered do not appear to be valid.<br />';
                    }

                    if(strlen($error_message) > 0) {
                        died($error_message);
                    }

                    $email_message = "Email from ";

                    function clean_string($string) {
                      $bad = array("content-type","bcc:","to:","cc:","href");
                      return str_replace($bad,"",$string);
                    }

                    $email_message .= clean_string($first_name);
                    $email_message .= " ".clean_string($last_name)."\n";
                    $email_message .= "Email: ".clean_string($email_from)."\n\n";
                    $email_message .= clean_string($message)."\n";

                    $headers = 'Reply-To: '.$email_from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    mail("rhymeazoo@gru.edu", "Message from a Hear a Tale User", $email_message, $headers, '-fwebmaster@hearatale.com'); 

                ?>
            
                <h4>Thank you for contacting us. We will be in touch with you very soon.</h4>

                <?php
                    }
                ?>
            
		<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/globalFooter.php');
		?>