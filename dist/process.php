---
layout: phplayout
name: PHP Only Page
---
<?php

  //form submitted
  $from_user = $_POST['ContactName'];
  $from_phone = $_POST['ContactPhone'];
  $from_email = $_POST['ContactEmail'];
  $from_message = $_POST['ContactMessage'];

  //verify captcha
  $recaptcha_secret = "6LfDfb0SAAAAAGnvvYylSSUijlZDZkrp1Rw6q6zT";
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
  $response = json_decode($response, true);

  if($response["success"] === true) {
    // Send Email
    $subject = "Contact Me Email";
    $txt = "<h3>You have a new contact email from GloryKidd Technologies LLC</h3>";
    $txt = $txt."<p>From User: ".$from_user."<br />";
    $txt = $txt."User Phone: ".$from_phone."<br />";
    $txt = $txt."User Email: ".$from_email."<br />";
    $txt = $txt."User Message: ".$from_message."</p>";
    $txt = $txt."<p>Thanks,<br /> GloryKidd Technologies Staff </p>";

    $to = "sales@glorykidd.com";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: postmaster@glorykidd.com";
    mail($to,$subject,$txt,$headers);
    echo "<script type='text/javascript'>window.location='/thankyou'</script>";
  } else {
    // Failed Request
    echo "<script type='text/javascript'>window.location='/contact'</script>";
  }

?>