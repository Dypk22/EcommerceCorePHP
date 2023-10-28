<?php 
   require'connection.php';
   require 'functions.php';
   date_default_timezone_set("Asia/Kolkata");
   $added_on=date('Y-m-d H:i:s');
   $name=strtolower(get_safe_value($con,$_POST['name']));
   $email=strtolower(get_safe_value($con,$_POST['email']));
   $mobile=strtolower(get_safe_value($con,$_POST['mobile']));
   $password=strtolower(get_safe_value($con,$_POST['password']));
   $unameArray=explode(' ', $name);
   $rand_id=rand(111111111,999999999);
   $tmp_name=(strlen($name)>10)?substr($name, 0, 9):$name;
   $refer_code=$tmp_name.secure_random_string(5).secure_random_string(5);
   $refered_by=strtolower(get_safe_value($con,$_POST['refered_by']));
   $refercb=refer_code_discount;
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   echo 'invalid email';
   }
   elseif (strlen($mobile)!=10) {
   echo 'invalid mobile';
   }else{
   $check1=mysqli_query($con, "select * from users where email='$email'");
   $check2=mysqli_query($con, "select * from users where mobile='$mobile'");
   if (mysqli_num_rows($check1)>0) {
   echo "email present";
   }elseif (mysqli_num_rows($check2)>0) {
   echo "mobile present";
   }else{
   mysqli_query($con,"INSERT INTO `users` (`name`, `email`, `mobile`, `password`, `wallet`, `refer_code`, `refered_by`, `added_on`, `email_status`, `token`, `mobile_status`, `status`) VALUES ('$name', '$email', '$mobile', '$password', '0', '$refer_code', '$refered_by', '$added_on', 'unverified', '$rand_id', 'unverified', '0')");
   $insertId=mysqli_insert_id($con);
   $_SESSION['USER_ID']=$insertId;
   $_SESSION['USER_NAME']=$name;
   $_SESSION['USER_EMAIL']=$email;
   $_SESSION['USER_MOBILE']=$mobile;
   $_SESSION['USER_LOGIN']='yes';
   mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$insertId', 'sign-up', '0', 'not-available', 'not-available', 'success', '0', '0', '0', 'not-available', '$added_on');");
   if ($refered_by!='' && $refercb!=0) {
      mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$insertId', 'referal-bonus', '$refercb', 'not-available', 'not-available', 'success', '0', '$refercb', '$refercb', 'not-available', '$added_on');");
      mysqli_query($con, "UPDATE `users` SET `wallet` = '$refercb' WHERE `users`.`id` = '$insertId'");
   }
   // echo "inserted";
   $otp=rand(1111,9999);
   if (isset($_SESSION['first_time_register_otp'])) { unset($_SESSION['first_time_register_otp']); }
   $_SESSION['first_time_register_otp']=$otp;
   // $mobile_sms_msg='OTP for '.SITE_NAME.' Verification is - '.$otp;
   // send_mobile_sms($mobile_sms_msg,$mobile);
   send_otp_mail($otp,$email,$name);
   }
   }
   ?>