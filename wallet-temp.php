<?php 
   require 'connection.php';
    // if (isset($_SESSION['add_money_coupon'])) {
       // if (!isset($_SESSION['add_money_coupon'])) {header('Location:wallet'); die();}
       $pid = (isset($_REQUEST["payment-id"])?$_REQUEST["payment-id"]:"empty");
       if ($pid!='empty') {
           require 'payment/src/Payment.php';
           require 'payment/src/Crypto.php';
           require 'payment/src/Validator.php';
           $obj = new \Paykun\Checkout\Payment('867302054722361', '50C2C64D49C362BC090FFCA9B3783A82', '8280AAA6E09FA53699611AF096ED3BBA', false, true);
           $response = $obj->getTransactionInfo($_REQUEST['payment-id']);
           if(is_array($response) && !empty($response)) {
               $order_id=$response['data']['transaction']['order']['order_id'];
               $payment_mode=$response['data']['transaction']['payment_mode'];
               $customer_name=$response['data']['transaction']['customer']['name'];
               $customer_mobile=$response['data']['transaction']['customer']['mobile_no'];
               $gross_amount=$response['data']['transaction']['order']['gross_amount'];
               if($response['status'] && $response['data']['transaction']['status'] == "Success") {
                   $payment_id=$response['data']['transaction']['payment_id'];
                   $transaction_status = "success";
               } else {
                   $transaction_status = "failed";
                   $payment_id=$response['data']['transaction']['payment_id'];
               }
           }
       }
       $uid=$_SESSION['USER_ID'];
       $coupon='';
       if (isset($_SESSION['add_money_coupon'])) {
           $coupon=strtolower($_SESSION['add_money_coupon']);
       }
       date_default_timezone_set("Asia/Kolkata");
       $added_on=date('Y-m-d H:i:s');
       $prevBal=mysqli_fetch_assoc(mysqli_query($con,"select * from wallet where user_id='$uid' order by `wallet`.`id` desc limit 1"));
       $prevUpdatedBal=$prevBal['updated_balance'];
       $prevUpdatedCashback=$prevBal['updated_cashback'];
       $newBal=0;
       $discountAmount=0;
       $newcb=0;
       if ($transaction_status=='success') {
           if ($coupon!='') {
               $getCoupon=mysqli_fetch_assoc(mysqli_query($con,"select * from coupons where code='$coupon'"));
               $isCouponUserAlready=mysqli_num_rows(mysqli_query($con,"select * from wallet where user_id='$uid' and coupon_code='".$getCoupon['code']."'"));
                  $coupon_expiry=$getCoupon['expired_on'];
                
                  if ($getCoupon['type2']=='percenatage') {
                      $discountAmount=round(($getCoupon['value']/100)*$gross_amount);
                  } else {
                      // $discountAmount=$getCoupon['value'];
                      $discountAmount=$_SESSION['add_money_coupon_discount'];
                      $newBal=$prevUpdatedBal+$gross_amount;
                      $newcb=$prevUpdatedCashback+$discountAmount;
                  }
                  mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'add-money', '$gross_amount', '$order_id', '$payment_id', '$transaction_status', '$newBal', '0', '$prevUpdatedCashback', '', '$added_on')");
                  // echo "done";   
                  $payment_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
                  mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'cashback-credited', '$discountAmount', '$order_id', '$payment_id', 'success', '$newBal', '$discountAmount', '$newcb', '$coupon', '$added_on')");
              
           }
           else{
               $newBal=$prevUpdatedBal+$gross_amount;
                mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'add-money', '$gross_amount', '$order_id', '$payment_id', '$transaction_status', '$newBal', '0', '$prevUpdatedCashback', '', '$added_on')");
           }
           $finBal=$newBal+$newcb;
           mysqli_query($con, "UPDATE `users` SET `wallet` = '$finBal' WHERE `users`.`id` = '$uid'");
       } 
       else {
           $newBal=$prevUpdatedBal;
           mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'add-money', '$gross_amount', '$order_id', '$payment_id', '$transaction_status', '$newBal', '0', '$prevUpdatedCashback', '', '$added_on')");
       }   
    // }
    unset($_SESSION['add_money_coupon']);
    unset($_SESSION['add_money_coupon_discount']);  
    header('Location:wallet');
   ?>