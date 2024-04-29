<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$json_data = file_get_contents("php://input");
$dataFormatted = json_decode($json_data, true);

$url = 'http://live.tpay.me/api/TPAY.svc/json/SendFreeMTMessage'; 
$data = array(
    'signature' => $dataFormatted['signature'],
    'messageBody' => $dataFormatted['messageBody'],
    'operatorCode' => $dataFormatted['operatorCode'],
    'subscriptionContractId' => $dataFormatted['subscriptionContractId']
);


$ch = curl_init($url);


curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo $response;
}

curl_close($ch);
