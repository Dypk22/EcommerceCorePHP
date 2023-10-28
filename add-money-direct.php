<?php 
   require'connection.php';
   require 'functions.php';
   if (!isset($_POST['amount'])) {header('Location:'.SITE_PATH);}
   $amount=get_safe_value($con,$_POST['amount']);
   $referenceId=get_safe_value($con,$_POST['referenceId']);
   date_default_timezone_set("Asia/Kolkata");
   $added_on=date('Y-m-d H:i:s'); 
   $response=[];
   $userId=$_SESSION['USER_ID'];
   $query=mysqli_query($con, "select * from add_money_direct where reference_id='$referenceId' and user_id='$userId'");
   $check=mysqli_num_rows($query);
   if($amount!=0){
      if($check>0){
         $check1=mysqli_fetch_assoc($query);
         $response['status']=$check1['status'];
         $response['message']='present';
      }else{
         mysqli_query($con, "INSERT INTO `add_money_direct` (`user_id`, `amount`, `reference_id`, `added_on`, `status`, `remarks`) VALUES ('$userId', '$amount', '$referenceId', '$added_on', '0', 'verification pending');");
         $response['message']='inserted';
      }
   }
   else{
      $response['message']='amountZero';
   }
   header('Content-Type: application/json; charset=utf-8');
   echo json_encode($response);
   ?>