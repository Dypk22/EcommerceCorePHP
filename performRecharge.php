<?php require 'connection.php';
 $MobileNumber=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['MobileNumber'])));
 $rechargeAmount=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['rechargeAmount'])));
 $operator=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['operator'])));
 $operatorCircle=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['operatorCircle'])));
 $validity=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['validity']))).' days';
 $type=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['type'])));
 $operator_type=strip_tags(mysqli_real_escape_string($con,$_POST['operator_type']));
 $couponCode=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['couponCode'])));
 $WalletUse=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['WalletUse'])));
 $balance=strtolower(strip_tags(mysqli_real_escape_string($con,$_POST['balance'])));
 $userId=$_SESSION['USER_ID'];
 $payment_method=($WalletUse=='yes')?'partial':'online';
 if($couponCode==''){ unset($_SESSION['coupon']);
 unset($_SESSION['coupon_discount']);
 }
 if ($operator=='airtel') { $operator='bharti airtel ltd';
 } elseif ($operator=='reliance jio') { $operator='reliance jio infocomm ltd (rjil)';
 } elseif ($operator=='reliance communications') { $operator='reliance communications ltd (rcom)';
 } elseif ($operator=='vodafone idea') { $operator='vodafone idea ltd (formerly vodafone india ltd)';
 } elseif ($operator=='aircel') { $operator='aircel cellular ltd';
 } elseif ($operator=='bsnl') { $operator='bharat sanchar nigam ltd (bsnl)';
 } else { $operator='mahanagar telephone nigam ltd (mtnl)';
 }
 date_default_timezone_set("Asia/Kolkata");
 $added_on=date('Y-m-d H:i:s');
 mysqli_query($con, "INSERT INTO `mobile_recharge_orders` (`user_id`, `mobile`, `operator_type`, `amount`, `operator`, `operator_circle`, `validity`, `plan`, `coupon`,`status`,`transaction_id`, `payment_method`, `operator_reference_id`, `operator_status`,`date`) VALUES ('$userId','$MobileNumber', '$operator_type', '$rechargeAmount', '$operator', '$operatorCircle', '$validity', '$type', '$couponCode', 'failed', 'not-available', '$payment_method', 'not-available', 'pending', '$added_on')");
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