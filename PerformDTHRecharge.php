<?php require 'connection.php';
$DTHoperator=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['DTHoperator']))); 
$cardNumber=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['cardNumber']))); 
$rechargeAmount=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['rechargeAmount']))); 
$coupon_code=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['coupon_code']))); 
$WalletUse=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['WalletUse'])));
$balance=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['balance'])));
$payment_method=($WalletUse=='yes')?'partial':'online';
$userId=0; 
if($coupon_code==''){ unset($_SESSION['coupon']); 
unset($_SESSION['coupon_discount']); 
} if (isset($_SESSION['USER_ID'])) { $userId=$_SESSION['USER_ID']; 
} date_default_timezone_set("Asia/Kolkata"); 
$added_on=date('Y-m-d H:i:s'); 
mysqli_query($con, "INSERT INTO `dth_recharge_orders` (`user_id`, `dth_number`, `dth_operator`, `amount`, `coupon`, `status`, `transaction_id`, `payment_method`, `operator_reference_id`, `operator_status`, `date`) VALUES ('$userId', '$cardNumber', '$DTHoperator', '$rechargeAmount', '$coupon_code', 'pending', 'not-available', '$payment_method', 'not-available', 'pending', '$added_on')"); 
$_SESSION['order_id']=mysqli_insert_id($con); 


 $difference_amount=($WalletUse=='yes')?$rechargeAmount-$balance:$rechargeAmount;
 if ($payment_method=='partial') {
    $payment_id_tmp=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999); 
    mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$userId', 'paid-from-wallet', '$balance', 'not-available', '$payment_id_tmp', 'success', '0', '0', '0', 'not-available', '$added_on')"); 
    $_SESSION['wallet_order_id']=mysqli_insert_id($con);
    mysqli_query($con, "UPDATE `users` SET `wallet` = '0' WHERE `users`.`id` = '$userId'");
 }
echo $difference_amount;


?>