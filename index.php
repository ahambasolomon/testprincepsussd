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

function checkippis_real($text){
    $data = explode("*", $text);
    if (count($data) == 4) {
        if (end($data) == 1) {
            return true;
        }
    }
}

// function checkippis_realnote($text){
//     $data = explode("*", $text);
//     if (count($data) == 4) {
//         if (end($data) != 1) {
//             return true;
//         }
//     }
// }

function finalconfirmation($text){
    $data = explode('*', $text);
    // if((count($data) == 4 || count($data) == 6) && end($data) == 1){
    //     if ($data[0] == 1) {
    //         return true;
    //     }
    // }
    if (end($data) == 00) {
        // array_pop($data);
        // implode("*", $data);
        // $datalink= explode('*', $text);
        // if(count($datalink) == 4 || count($datalink) == 6){
        //     if ($datalink[0] == 1) {
        //         return true;
        //     }
        // }
        return true;
    }
}

function checkconfirmation($text){
    $data = explode('*', $text);
    if(count($data) == 4 || count($data) == 5){
        if ($data[0] == 1) {
            return true;
        }
    }
}

function getdata($text){
    $data = explode('*', $text);
    return $data;
}




function splitopen($text){
    $data = explode('*', $text);
    return $data;
}


function newcheckamount($text){
    $data = splitopen($text);
    if ($data[0]  == 1) {
        if (count($data) == 2) {
            return true;
        }
    }
}

function newcheckduration($text){
    $data = splitopen($text);
    if ($data[0]  == 1) {
        if (count($data) == 3) {
            return true;
        }
    }
}






if ( $text == "" ) {
    $response  = "CON Hi, welcome to Credit Wallet Self-Service.  \n";
    $response .= "1. Enter 1 to apply for loan. \n";
    $response .= "2. Enter 2 for loan liquidation. \n";
    $response .= "3. Enter 3 for loan balance. \n";
    
}

else if ($text == "1") {  // after 1
    $response  = "CON Enter Amount \n";
}

else if (newcheckamount($text)) {  //  after amount 
    $response = "CON Enter duration (2 - 12 months)";
}

else if (newcheckduration($text)) {  //  after amount 
    $response = "CON do you have IPPIS NUMBER \n";
    $response .= "1. Yes. \n";
    $response .= "2. No. \n";
}



















































































































































































//Menu for a user who selects '1' from the second menu above
// Will be brought to this third menu screen
else if (finalconfirmation($text)){
    $amount = getdata($text)[1];
    $tenur = getdata($text)[2];
    $ippis_result = getdata($text)[4] == null ? ' ' : getdata($text)[4];

//     $request->telephone;
// $request->loan_amount;
// $request->tenor;
// $request->ippisnumber;

    $data = [
        'telephone' => $phone,
        'loan_amount' => $amount,
        'tenor'   => $tenur,
        'ippisnumber' => $ippis_result
    ];
    $url = 'https://api.creditwallet.ng/Creditwallet/public/api/loans/apply/ussd';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $rez = curl_exec($ch);
    $response = "END Loan Application Successful.\n";
}

else if(checkippis_real($text)){
    $response = "CON Enter IPPIS Number \n";

}

else if (checkconfirmation($text)) {
    // $response = "END  Good SEND TO FOLA.".$text." \n";
    $ippis_result = getdata($text)[4] == null ? 'Not applicable' : getdata($text)[4];
    $response = "CON Enter 00 key to Confirm. \n";
    $response .= " Amount: ".getdata($text)[1]." \n";
    $response .= " Duration: ".getdata($text)[2]." Months \n";
    $response .= " Ippis Number: ".$ippis_result." \n";
}


// elseif(checkippis_realnote($text)) {
    
// }

else if (checkippis($text)) {
    //$response  = "CON $text  \n";
    $result = explode("*",$text);
    if ($result[3] == 1) {
        //Another check to get ippis number

    }else{
        //Go straight to confirmation page()
    }
    // $response = "CON $result[0]  \n";
    
    // $response = "CON Enter any key to Confirm. \n";
    // $response .= " Amount ".getdata($text)[1]." \n";
    // $response .= " Duration ".getdata($text)[2]." Months \n";
    // $response .= " Ippis Number ".getdata($text)[3]."\n";
}


else if (checkduration($text)) {
    if (getdata($text)[2] < 12 && getdata($text)[2] > 1) {
        $response = "CON Do you Have Ippis Number \n";
        $response .= "1. Yes. \n";
        $response .= "2. No. \n";
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