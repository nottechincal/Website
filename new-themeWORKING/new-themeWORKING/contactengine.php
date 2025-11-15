<?php

$EmailFrom = "support@rapidtechsolutions.au";
$EmailTo = "tahir@rapidtechsolutions.au";
$Subject = "Message from your site";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Message = Trim(stripslashes($_POST['Message'])); 

// validation
$validationOK = true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $Message;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// Send confirmation email to customer
if ($success) {
    $customerSubject = "Thank you for contacting Rapid Tech Solutions";
    $customerMessage = "Dear $Name,\n\nThank you for your message. We will get back to you shortly.\n\nBest regards,\nRapid Tech Solutions Team";
    mail($Email, $customerSubject, $customerMessage, "From: <$EmailFrom>");
}

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.php\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
}
?>
