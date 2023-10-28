<?php
// print_r($_GET);
// die();
require '../src/Payment.php';
require '../src/Validator.php';
require '../src/Crypto.php';
require '../../connection.php';

// $line_number=$_SESSION['line_no'];
// $amount=mysqli_fetch_assoc(mysqli_query($con,"select buyer_name, buyer_email, buyer_number, total_price from `order` where id='$line_number' "));
// gettype(print_r($amount));
// (int)$b_num=$amount['buyer_number'];
if (!isset($_SESSION['USER_LOGIN'])) { header('Location:'.SITE_PATH); }
// $coupon='';
$forrechargeamount=strip_tags(mysqli_real_escape_string($con,$_GET['amount']));
// if(isset($_GET['coupon'])){
// $coupon=strip_tags(mysqli_real_escape_string($con,$_GET['coupon']));
// }
$type=strip_tags(mysqli_real_escape_string($con,$_GET['type']));

if ($type=='recharge') {
$product_name   = "Recharge Payment";// $_POST['product_name'];
$surl=SITE_PATH.'recharge-status';
}
else if($type=='dthRecharge'){
$product_name   = "DTH Payment";// $_POST['product_name'];
$surl=SITE_PATH.'dth-recharge-status';
}
else{
$product_name   = "Add Money";// $_POST['product_name'];
$surl=SITE_PATH.'wallet-temp';
}

$fname          = ucfirst($_SESSION['USER_NAME']);
$amount         = $forrechargeamount;//$_POST['amount'];
$email          = $_SESSION['USER_EMAIL'];
$country        = " ";
$contact        = $_SESSION['USER_MOBILE'];
$state          = " ";
$city           = " ";
$postalcode     = " ";
$address        = " ";

/**
 *  Parameters requires to initialize an object of Payment are as follow.
 *  mid => Merchant Id provided by Paykun
 *  accessToken => Access Token provided by Paykun
 *  encKey =>  Encryption provided by Paykun
 *  isLive => Set true for production environment and false for sandbox or testing mode
 *  isCustomTemplate => Set true for non composer projects, will disable twig template
 */

// $obj = new \Paykun\Checkout\Payment('<merchantId>', '<accessToken>', '<encryptionKey>', true, true);
 
$obj = new \Paykun\Checkout\Payment('867302054722361', '50C2C64D49C362BC090FFCA9B3783A82', '8280AAA6E09FA53699611AF096ED3BBA', false, true);

$successUrl = $surl;// str_replace("request.php", SITE_PATH.'order_placed.php', $_SERVER['HTTP_REFERER']);
$failUrl 	= $surl;//str_replace("request.php", "failed", $_SERVER['HTTP_REFERER']);

// Initializing Order
$obj->initOrder(generateByMicrotime(), $product_name,  $amount, $successUrl,  $failUrl, 'USD');

// Add Customer
$obj->addCustomer($fname, $email, $contact);

// Add Shipping address
$obj->addShippingAddress('', '', '', '', '');

$obj->addBillingAddress('', '', '', '', '');
// Add Billing Address

//Enable if require custom fields
$obj->setCustomFields(array('udf_1' => 'Some Dummy text'));
//Render template and submit the form
echo $obj->submit();


/* Check for transaction status
 * Once your success or failed url called then create an instance of Payment same as above and then call getTransactionInfo like below
 *  $obj = new Payment('merchantUId', 'accessToken', 'encryptionKey', true, true); //Second last false if sandbox mode
 *  $transactionData = $obj->getTransactionInfo(Get payment-id from the success or failed url);
 *  Process $transactionData as per your requirement
 *
 * */


function generateByMicrotime() {
    $microtime = str_replace('.', '', microtime(true));
    return (substr($microtime, 0, 14));
}
?>