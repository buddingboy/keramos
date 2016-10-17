<?php

$con = mysqli_connect ("127.0.0.1" , "keramosiitbhu" , "123705@Sk");
mysqli_select_db( $con , "keramos" );

/* Configuration */
$subject = 'Registration KERAMOS'; // Set email subject line here
$partsub = 'You have been registered for Keramos - IIT (BHU) Varanasi';
$mailto  = 'keramos@itbhu.ac.in'; // Email address to send the form to
/* END Configuration */

$name     	= $_POST['name'];
$email          = $_POST['email'];
$mobile       = $_POST['mobile'];
$college       = $_POST['college'];
$city       = $_POST['city'];
$event       = $_POST['opt'];

$events ="";  
foreach($event as $event1)  
   {  
      $events .= $event1.",";  
   }  
   
$timestamp 	= date("F jS Y, h:iA.", time());

// HTML for email to send submission details
$body = "
<br>
<p>You have been registered for Keramos - IIT (BHU) Varanasi with following details.</p>
<p><b>Name</b>: $name <br>
<b>Email</b>: $email<br>
<b>mobile</b>: $mobile <br>
<b>college</b>: $college<br>
<b>city</b>: $city <br>
<b>events</b>: $events<br></p>
<p>This form was submitted on <b>$timestamp</b></p>

<p>Website: www.keramosiitbhu.in</p>
";

// Success Message
$success = "
<div class=\"row\">
    <div class=\"thankyou\">
        <h3>You have been Successfully Registered for Keramos.</h3>
        <p>You have also been notified by email for the same. In case you don't get email contact Keramos@iitbhu.ac.in</p>
		<p>Thank You! Have a nice day.</p>
    </div>
</div>
";

$headers = "From: $name <$email> \r\n";
$headers .= "Reply-To: $email \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$partheaders = "From: Keramos - IIT (BHU) Varanasi <$mailto> \r\n";
$partheaders .= "Reply-To: $mailto \r\n";
$partheaders .= "MIME-Version: 1.0\r\n";
$partheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = "<html><body>$body</body></html>";


$sql = "INSERT INTO registration (name, email , mobile, college, city, events, timestamp ) VALUES ('$name', '$email', '$mobile', '$college', '$city', '$events', '$timestamp')";


if (mysqli_query($con, $sql) && mail($mailto, $subject, $message, $headers) && mail($email, $partsub, $message, $partheaders)) {
    echo "$success"; // success
} else {
    echo 'Registration failed, Please Try Again. In case of repeated failure contact keramos@iitbhu.ac.in'; // failure
}

?>