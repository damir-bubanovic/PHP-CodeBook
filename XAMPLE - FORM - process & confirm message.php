<?php 
/*Processing user input into variables*/
/*REMEMBER - for PHP take NAME of element, for JS take ID of element*/
/*Alternative Code \n means new line, great for text messages*/
/*\n only works if everything is in " " */
$firstName = $_POST["firstname"];
$lastName = $_POST["lastname"];
$eMail = $_POST["email"];
$messAge = $_POST["message"];
$subject = "Business - User message";
$messageTo = "damir.bubanovic@yahoo.com";
$messageText = "Heads UP! Business message! \n" .
"$firstName $lastName wrote a message: \n" .
"Message says: \n $messAge \n";

/*Sent mail to admin ( mail() function )*/
mail($messageTo, $subject, $messageText, "From: " . $eMail);

/*message report*/
print "Message has been sucessfuly send!";
?>