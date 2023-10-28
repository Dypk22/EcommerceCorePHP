<?php 

require '../../src/Payment.php';
require '../../src/Crypto.php';
require '../../src/Validator.php';


$obj = new \Paykun\Checkout\Payment('867302054722361', '3B45700FD26D4EF3A20185AA5608ECB0', 'CF9F5E14E7EF97F9FD518A5EB95CBBF0', false, true);
$response = $obj->getTransactionInfo($_REQUEST['payment-id']);

echo "<pre>";
var_dump($response);

if(is_array($response) && !empty($response)) {
    if($response['status'] && $response['data']['transaction']['status'] == "Failed") {
        echo "Transaction failed";
    }
}

?>