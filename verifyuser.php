<?php 
   require'connection.php';
   require 'functions.php';
   $otp_val_1=get_safe_value($con,$_POST['otp_val_1']);
   $otp_val_2=get_safe_value($con,$_POST['otp_val_2']);
   $otp_val_3=get_safe_value($con,$_POST['otp_val_3']);
   $otp_val_4=get_safe_value($con,$_POST['otp_val_4']);
   $final_otp=$otp_val_1.$otp_val_2.$otp_val_3.$otp_val_4;
   if ($_SESSION['first_time_register_otp']==$final_otp) {
   $uid=$_SESSION['USER_ID'];
   mysqli_query($con, "UPDATE `users` SET `email_status` = 'verified', `status` = '1' WHERE `users`.`id` = '$uid'");
   unset($_SESSION['first_time_register_otp']);
   echo "verified";
   }else{
   echo "unverified";
   }
   ?>