<?php
// Reads the variables sent via POST
$sessionId   = $_POST["sessionId"];  
$serviceCode = $_POST["serviceCode"];  
$text = $_POST["text"];
$phone = $_POST["phoneNumber"];
$amount;
$duration;
$_POST["step"] = 1;
//This is the first menu screen

function checkamount($text){
    $data = explode('*', $text);
    // if(isset($data[1])){
    //     return true;
    // }
    $_POST["amount"] = $data[1]; 
}

function checkduration($text) {
    $data = explode('*', $text);
    if(isset($data[1]) && isset($data[2])){
        $_POST["amount"] = $data[1];
        $_POST["duration"] = $data[2];
        return true;
    }
}

if ( $_POST["step"] == 1 ) {
    $response  = "CON Hi welcome to credit wallet ussd potal application.  \n";
    $response .= "1. Enter 1 to apple for loan \n";
    $response .= "2. Enter 2 for loan liquidation \n";
    $_POST["step"] = 2;
}
// Menu for a user who selects '1' from the first menu
// Will be brought to this second menu screen
else if ($_POST["step"] == 2) {
    $response  = "CON Enter Amount \n";
    $amount = checkamount($text);
    $step = 3;
// $response .= "1. Table for 2 \n";
// $response .= "2. Table for 4 \n";
// $response .= "3. Table for 6 \n";
// $response .= "4. Table for 8 \n";
}
//Menu for a user who selects '1' from the second menu above
// Will be brought to this third menu screen
else if ($step = 3) {
// $response = "CON Enter Duration (2 - 12 Months) \n";
$response .= 'Please Enter 1 to confirm '.$_POST["amount"].' \n';
}

else if (checkduration($text)) {
    $response = "CON Enter IPPIS Number ".$_POST['amount'].". \n";
    // $response .= "Please Enter 1 to confirm .$text. \n";
}

else if ($text == "1*1*1") {
$response = "CON Table for 2 cost -N- 50,000.00 \n";
$response .= "Enter 1 to continue \n";
$response .= "Enter 0 to cancel";
}
else if ($text == "1*1*1*1") {
$response = "END Your Table reservation for 2 has been booked";
}
else if ($text == "1*1*1*0") {
$response = "END Your Table reservation for 2 has been canceled";
}
// Menu for a user who selects "2" from the second menu above
// Will be brought to this fourth menu screen
else if ($text == "1*2") {
$response = "CON You are about to book a table for 4 \n";
$response .= "Please Enter 1 to confirm \n";
}
// Menu for a user who selects "1" from the fourth menu screen
else if ($text == "1*2*1") {
$response = "CON Table for 4 cost -N- 150,000.00 \n";
$response .= "Enter 1 to continue \n";
$response .= "Enter 0 to cancel";
}
else if ($text == "1*2*1*1") {
$response = "END Your Table reservation for 4 has been booked";
}
else if ($text == "1*2*1*0") {
$response = "END Your Table reservation for 4 has been canceled";
}
// Menu for a user who enters "3" from the second menu above
// Will be brought to this fifth menu screen
else if ($text == "1*3") {
$response = "CON You are about to book a table for 6 \n";
$response .= "Please Enter 1 to confirm \n";
}
// Menu for a user who enters "1" from the fifth menu
else if ($text == "1*3*1") {
$response = "CON Table for 6 cost -N- 250,000.00 \n";
$response .= "Enter 1 to continue \n";
$response .= "Enter 0 to cancel";
}
else if ($text == "1*3*1*1") {
$response = "END Your Table reservation for 6 has been booked";
}
else if ($text == "1*3*1*0") {
$response = "END Your Table reservation for 6 has been canceled";
}
// Menu for a user who enters "4" from the second menu above
// Will be brought to this sixth menu screen
else if ($text == "1*4") {
$response = "CON You are about to book a table for 8 \n";
$response .= "Please Enter 1 to confirm \n";
}
// Menu for a user who enters "1" from the sixth menu
else if ($text == "1*4*1") {
$response = "CON Table for 8 cost -N- 250,000.00 \n";
$response .= "Enter 1 to continue \n";
$response .= "Enter 0 to cancel";
}
else if ($text == "1*4*1*1") {
$response = "END Your Table reservation for 8 has been booked";
}
else if ($text == "1*4*1*0") {
$response = "END Your Table reservation for 8 has been canceled";
}
//echo response
header('Content-type: text/plain');
echo $response
?>