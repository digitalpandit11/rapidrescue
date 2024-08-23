
<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer library
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone_no'];
    $name = $_POST['name'];

    // Validate and sanitize $phone, perform other necessary validations

    // Process the form
    $formcontent = "From: Phone: $phone \n;";
    $formcontent .= "Name: $name";
    $recipient = "rapidrescuecustomercare@gmail.com";
    // $bcc = "info@vbdigitech.com,support@vbdigitech.com";
    $subject = "Rapid Rescue Care Ambulance Booking Enquiry";
   
    $mailheader = "From: $phone \r\n";
    // $mailheader .= "Bcc: $bcc\r\n";

    // Replace $email with the actual variable holding the email address
    $mailheader .= "Reply-To: $phone\r\n";  // Replace with the appropriate variable
    $mailheader .= "X-Mailer: PHP/" . phpversion();

    // Additional headers for better email delivery
    $mailheader .= "MIME-Version: 1.0\r\n";
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        // $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        // $mail->Username = 'mktg@cadmech.co.in'; // Replace with your Google Workspace email address
        // $mail->Password = 'rygv hvrm ejcz lfly'; // Replace with your Google Workspace email password
        $mail->Username = 'vbdigitech@gmail.com'; 
        $mail->Password = 'gmiu kwvd glmd fzmm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set sender and recipient
        $mail->setFrom('rapidrescuecustomercare@gmail.com','Rapid Rescue Care Ambulance Booking Enquiry');
        $mail->addAddress($recipient);
        $mail->addBCC('support@vbdigitech.com');
        $mail->addBCC('info@vbdigitech.com');
        $mail->addCC(' vbdigitech.notifications@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $formcontent;

        // Send email
        if ($mail->send()) {
            // Email sent successfully, set the session variable
            $_SESSION['form_submitted'] = true;
            // require_once "thank-you.php";
            echo '<script language="javascript" type="text/javascript">';
            echo 'alert("Thank you for contacting us we will call you back soon");';
            echo 'window.location = "index.html";';
            echo '</script>';
        } else {
            // Handle email sending failure
            echo '<script language="javascript" type="text/javascript">';
            echo 'alert("Message failed. Please, Call +91 98607 15106 ");';
            echo 'window.location = "index.html";';
            echo '</script>';
        }
    } catch (Exception $e) {
        // Handle exceptions if email sending fails
        // For example, log the error or display a message to the user
        echo 'Error: ' . $e->getMessage();
    }
}
?>

