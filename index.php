<?php
// Reads the variables sent via POST
$sessionId   = $_POST["sessionId"];  
$serviceCode = $_POST["serviceCode"];  
$text = $_POST["text"];
$phone = $_POST["phoneNumber"];
$amount;
//This is the first menu screen

function checkamount($text){
    $data = explode('*', $text);
    if(isset($data[1]) && $data[0] == 1){
        return true;
    }
}

function checkduration($text){
    $data = explode('*', $text);
    if(isset($data[2]) && $data[0] == 1){
        return true;
    }
}

function checkippis($text){
    $data = explode('*', $text);
    if(isset($data[3]) && $data[0] == 1){
        return true;
    }
}
function checkconfirmation($text){
    $data = explode('*', $text);
    if(isset($data[4]) && $data[1] == 1 ){
        return true;
    }
}

function getdata($text){
    $data = explode('*', $text);
    return $data;
}

if ( $text == "" ) {
    $response  = "CON Hi, welcome to Credit Wallet Self-Service.  \n";
    $response .= "1. Enter 1 to apply for loan. \n";
    $response .= "2. Enter 2 for loan liquidation. \n";
    $response .= "3. Enter 3 for loan balance. \n";
    
}
// Menu for a user who selects '1' from the first menu
// Will be brought to this second menu screen
else if ($text == "1") {
    $response  = "CON Enter Amount \n";
    // $amount = $text;

// $response .= "1. Table for 2 \n";
// $response .= "2. Table for 4 \n";
// $response .= "3. Table for 6 \n";
// $response .= "4. Table for 8 \n";
}
//Menu for a user who selects '1' from the second menu above
// Will be brought to this third menu screen
else if (checkconfirmation($text)) {
    $response = "END  Good SEND TO FOLA. \n";
}


else if (checkippis($text)) {
    $response = "CON Enter any key to Confirm. $text \n";
    $response .= " Amount ".getdata($text)[1]." \n";
    $response .= " Duration ".getdata($text)[2]." Months \n";
    $response .= " Ippis Number ".getdata($text)[3]."\n";
}


else if (checkduration($text)) {
    if (getdata($text)[2] < 12 && getdata($text)[2] > 1) {
        $response = "CON Enter Ippis Number \n";
    } else {
        $response = "END Duration should be between 2 - 12 months";
    }
    // $response .= "Please Enter 1 to confirm .$text. \n";
}

else if (checkamount($text)) {
    $response = "CON Enter Duration (2 - 12 Months) \n";
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