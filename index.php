<?php 
    require 'vendor/autoload.php';

    use AfricasTalking\SDK\AfricasTalking;
    $username = 'sandbox'; // use 'sandbox' for development in the test environment
    $apiKey   = '60b5b9bd42907f026369042a50d14e134e3ca1e34e667653e77b3f27f1d0a420'; // use your sandbox app API key for development in the test environment
    $AT  = new AfricasTalking($username, $apiKey);
    
    // Get one of the services
    $sms      = $AT->sms();
    
    // Use the service

    $result   = $sms->send([
        'to'      => '+2349034426195',
        'message' => 'Hello World insd sdins ! '.$_POST[0].' '
    ]);
    
    print_r($result);
