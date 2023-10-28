<?php 
   require'connection.php';
   $uid=$_SESSION['USER_ID'];
   date_default_timezone_set("Asia/Kolkata");
   $added_on=date('Y-m-d H:i:s');         
   $home_active='';
    $title='Online Recharge, Bill Payments , DTH, Prepaid &amp; Postpaid Mobile Recharge - '.SITE_NAME;
   require 'header.php';
   
   $tmp_order_id = (isset($_SESSION['order_id'])) ? $_SESSION['order_id'] : 0 ;
     if ($tmp_order_id==0) {
       header('Location:orders');
       die();
     }
   $fetchPlan=mysqli_fetch_assoc(mysqli_query($con, "select * from mobile_recharge_orders where id='$tmp_order_id'"));
   $operatorReferenceId='not-available';
   $operatorStatus='pending';
   $payment_mode='wallet';
   //if payment is from gateway else wallet
   $pid = (isset($_REQUEST["payment-id"])?$_REQUEST["payment-id"]:"wallet");
   if ($pid!='wallet') {
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
             $transaction_status = "Success";
         } else {
             $transaction_status = "Failed";
             $payment_id=$response['data']['transaction']['payment_id'];
         }
     }
     mysqli_query($con, "UPDATE `mobile_recharge_orders` SET `status` = '".strtolower($transaction_status)."', `transaction_id`='$order_id' WHERE `mobile_recharge_orders`.`id` = '$tmp_order_id'");
     if ($fetchPlan['payment_method']=='partial') {
       $wallet_order_id=$_SESSION['wallet_order_id'];
       mysqli_query($con, "UPDATE `wallet` SET `transaction_id` = '$order_id' WHERE `wallet`.`id` = '$wallet_order_id'");
     }
   }
   else{
    $order_id=rand(11111,99999).rand(11111,99999).rand(1111,9999);
   }
   if (isset($_SESSION['txn_sucess'])) {
     $transaction_status='Success';
   }
   $coupon='';
   if ($transaction_status=='Success') {
   
       if(isset($_SESSION['coupon'])){
         $coupon=$_SESSION['coupon'];
         $validate_coupon="select * from coupons where code='$coupon'";
         if(mysqli_query($con, $validate_coupon) && mysqli_num_rows(mysqli_query($con, $validate_coupon))>0){
           $get_coupon=mysqli_fetch_assoc(mysqli_query($con,$validate_coupon));
           $discount=$_SESSION['coupon_discount'];

           $wallet_detail=mysqli_fetch_assoc(mysqli_query($con,"select * from wallet where user_id='$uid' order by `wallet`.`id` desc limit 1"));
           $bal=$wallet_detail['updated_balance'];
           $cb=$wallet_detail['updated_cashback'];
           // $newcb=$prevCb+$discount; 
     
           $newcb=$cb+$discount;
           $newBal=$discount+$bal+$cb;
           $payment_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
           $netcb=0;
           
     
           // else{ 
             mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'cashback-credited', '$discount', '$order_id', '$payment_id', 'success', '$bal', '$discount', '$newcb', '$coupon', '$added_on')");
             mysqli_query($con, "UPDATE `users` SET `wallet` = '$newBal' WHERE `users`.`id` = '$uid'");
             
           // }
     
         }
       }
       $fetchOrderDetail=mysqli_fetch_assoc(mysqli_query($con, "select * from mobile_recharge_orders where id='$tmp_order_id'"));
       $rechargeOperatorId=0;
       $rechargeOperatorStateCode=0;
 
       if ($fetchOrderDetail['operator']=='bharti airtel ltd') {
         $rechargeOperatorId=1;
       }
       else if ($fetchOrderDetail['operator']=='reliance jio infocomm ltd (rjil)') {
         $rechargeOperatorId=8;
       }
       else if ($fetchOrderDetail['operator']=='vodafone idea ltd (formerly vodafone india ltd)') {
         $rechargeOperatorId=3;
       }
       else if ($fetchOrderDetail['operator']=='bharat sanchar nigam ltd (bsnl)') {
         $rechargeOperatorId=4;
       }
       else if ($fetchOrderDetail['operator']=='mahanagar telephone nigam ltd (mtnl)') {
         $rechargeOperatorId=182;
       }
       else{
         $rechargeOperatorId=0;
       }
       switch ($fetchOrderDetail['operator_circle']) {
         case 'delhi':
         $rechargeOperatorStateCode=1;
           break;
         case 'delhi':
         $rechargeOperatorStateCode=1;
           break;
         case 'maharashtra':
         $rechargeOperatorStateCode=4;
           break;
         case 'andhra pradesh':
         $rechargeOperatorStateCode=5;
           break;
         case 'tamil nadu':
         $rechargeOperatorStateCode=23;
           break;
         case 'karnataka':
         $rechargeOperatorStateCode=7;
           break;
         case 'gujarat':
         $rechargeOperatorStateCode=8;
           break;
         case 'uttar pradesh (east)':
         $rechargeOperatorStateCode=9;
           break;
         case 'madhya pradesh':
         $rechargeOperatorStateCode=10;
           break;
         case 'west bengal':
         $rechargeOperatorStateCode=12;
           break;
         case 'rajasthan':
         $rechargeOperatorStateCode=13;
           break;
         case 'kerala':
         $rechargeOperatorStateCode=14;
           break;
         case 'punjab':
         $rechargeOperatorStateCode=15;
           break;
         case 'haryana':
         $rechargeOperatorStateCode=16;
           break;
         case 'bihar':
         $rechargeOperatorStateCode=17;
           break;
         case 'odisha':
         $rechargeOperatorStateCode=18;
           break;
         case 'assam':
         $rechargeOperatorStateCode=19;
           break;
         case 'himachal pradesh':
         $rechargeOperatorStateCode=21;
           break;
         case 'jammu and kashmir':
         $rechargeOperatorStateCode=22;
           break;
         case 'jharkhand':
         $rechargeOperatorStateCode=24;
           break;
         case 'chhattisgarh':
         $rechargeOperatorStateCode=25;
           break;
         case 'goa':
         $rechargeOperatorStateCode=26;
           break;
         case 'meghalaya':
         $rechargeOperatorStateCode=28;
           break;
         case 'mizoram':
         $rechargeOperatorStateCode=29;
           break;
         case 'sikkim':
         $rechargeOperatorStateCode=31;
           break;
         case 'tripura':
         $rechargeOperatorStateCode=32;
           break;
         case 'uttar pradesh (west)':
         $rechargeOperatorStateCode=42;
           break;
         default:
         $rechargeOperatorStateCode=31;
           break;
       }
       if (recharge_api_balance>=$fetchOrderDetail['amount'] && $fetchOrderDetail['operator_type']=='prepaid') {
         //   $curl = curl_init();
         //   curl_setopt_array($curl, array(
             // CURLOPT_URL => 'https://www.kwikapi.com/api/v2/recharge.php?api_key='.RechargeApi.'&number='.$fetchOrderDetail['mobile'].'&amount='.$fetchOrderDetail['amount'].'&opid='.$rechargeOperatorId.'&state_code='.$rechargeOperatorStateCode.'&order_id='.$fetchOrderDetail['transaction_id'],
         //     CURLOPT_RETURNTRANSFER => true,
         //     CURLOPT_ENCODING => '',
         //     CURLOPT_MAXREDIRS => 10,
         //     CURLOPT_TIMEOUT => 0,
         //     CURLOPT_FOLLOWLOCATION => true,
         //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         //     CURLOPT_CUSTOMREQUEST => 'GET',
         //   ));
     
         //   $response = curl_exec($curl);
     
         //   curl_close($curl);
         // $res=(array)json_decode($response);
         // $operatorReferenceId=$res['opr_id'];
         // $operatorStatus=$res['status'];
     
         // mysqli_query($con, "UPDATE `mobile_recharge_orders` SET `operator_reference_id` = '".strtolower($operatorReferenceId)."', `operator_status`='".strtolower($operatorStatus)."' WHERE `mobile_recharge_orders`.`id` = '$tmp_order_id'");
   
       }
             
     
   }
   if ($transaction_status=='Failed') {
     if ($fetchPlan['payment_method']=='partial') {
        $rollbacktxn=mysqli_fetch_assoc(mysqli_query($con, "select * from wallet where id='$wallet_order_id'"));
        $payment_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
        mysqli_query($con, "UPDATE `wallet` SET `status` = 'failed' WHERE `wallet`.`id` = '$wallet_order_id'");
        mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'cashback-credited', '".$rollbacktxn['amount']."', '$order_id', '$payment_id', 'success', '0', '".$rollbacktxn['amount']."', '".$rollbacktxn['amount']."', 'not-available', '$added_on')");
        mysqli_query($con, "UPDATE `users` SET `wallet` = '".$rollbacktxn['amount']."' WHERE `users`.`id` = '$uid'");
        unset($_SESSION['wallet_order_id']);
       }
   }
   $fetchPlan=mysqli_fetch_assoc(mysqli_query($con, "select * from mobile_recharge_orders where id='$tmp_order_id'"));
   ?>
<!-- Content
   ============================================= -->
<div id="content">
<div class="container">
   <div class="row my-5">
      <div class="col-md-11 mx-auto">
         <!-- Steps Progress bar
            ============================================= -->
         <div class="row widget-steps">
            <div class="col-3 step complete">
               <div class="step-name">Order</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a>
            </div>
            <div class="col-3 step complete">
               <div class="step-name">Summary</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a>
            </div>
            <?php if($transaction_status=='Success'){ ?>
            <div class="col-3 step complete">
               <div class="step-name">Payment</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a>
            </div>
            <?php } else{ ?>
            <div class="col-3 step incomplete">
               <div class="step-name">Payment</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a>
            </div>
            <?php } ?>
            <div class="col-3 step complete">
               <div class="step-name">Done</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a>
            </div>
         </div>
      </div>
      <!-- Steps Progress bar end --> 
      <?php if($transaction_status=='Success'){ ?>
      <div class="col-lg-12 text-center mt-5">
         <p class="text-success text-16 line-height-07"><i class="fas fa-check-circle"></i></p>
         <h2 class="text-8">Recharge Successful</h2>
         <p class="lead">We are processing the same and you will be notified via email.</p>
      </div>
      <?php } else{ ?>
      <div class="col-lg-12 text-center mt-5">
         <p class="text-success text-16 line-height-07"><i class="far fa-times-circle"></i></p>
         <h2 class="text-8">Recharge Failed</h2>
         <p class="lead">Transaction Failed and you will be notified via email.</p>
      </div>
      <?php }?>
      <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
         <div class="bg-white shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="row">
               <div class="col-sm text-muted">Transactions ID</div>
               <div class="col-sm text-sm-right font-weight-600"><?php echo $fetchPlan['transaction_id']; ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Date</div>
               <div class="col-sm text-sm-right font-weight-600"><?php echo date('d-M-Y', strtotime($fetchPlan['date'])); ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Mode of Payment</div>
               <div class="col-sm text-sm-right font-weight-600 text-capitalize"><?php echo $payment_mode; ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Transaction Status</div>
               <div class="col-sm text-sm-right font-weight-600 text-success"><?php echo $transaction_status; ?></div>
            </div>
            <hr>
            <?php if($operatorStatus!=''){ ?>
            <div class="row">
               <div class="col-sm text-muted">Operator Status</div>
               <div class="col-sm text-sm-right font-weight-600 text-capitalize text-success"><?php echo $operatorStatus; ?></div>
            </div>
            <hr>
            <?php } ?>
            <?php if($operatorReferenceId!='not-available'){ ?>
            <div class="row">
               <div class="col-sm text-muted">Operator Refernce Id</div>
               <div class="col-sm text-sm-right font-weight-600 text-success"><?php echo $operatorReferenceId; ?></div>
            </div>
            <hr>
            <?php } ?>
            <div class="row">
               <div class="col-sm text-muted">Mobile No</div>
               <div class="col-sm text-sm-right font-weight-600">(+91) <?php echo $fetchPlan['mobile']; ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Recharge Plan</div>
               <div class="col-sm text-sm-right font-weight-600 text-capitalize"><?php echo $fetchPlan['plan']; ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Payment Amount</div>
               <div class="col-sm text-sm-right text-6 font-weight-500">₹<?php echo $fetchPlan['amount']; ?></div>
            </div>
         </div>
         <div class="text-center">
            <!-- <a href="javascript:window.print();" class="btn-link text-muted mx-3 my-2 align-items-center d-inline-flex"><span class="text-5 mr-2"><i class="far fa-file-pdf"></i></span>Save as PDF</a> -->
            <a href="receipt/mobile/<?php echo $fetchPlan['transaction_id'] ?>" target="_blank()" class="btn-link text-muted mx-3 my-2 align-items-center d-inline-flex"><span class="text-5 mr-2"><i class="fas fa-print"></i></span>Invoice</a>
            <!-- <a href="#" class="btn-link text-muted mx-3 my-2 align-items-center d-inline-flex"><span class="text-5 mr-2"><i class="far fa-envelope"></i></span>Email Receipt</a> -->
            <p class="mt-4 mb-0"><a href="<?php echo SITE_PATH; ?>" class="btn btn-primary">Make another Recharge</a></p>
         </div>
      </div>
   </div>
</div>
<!-- Content end -->
<?php 
   require 'footer.php';
   $fetchOrderDetail=mysqli_fetch_assoc(mysqli_query($con, "select operator from mobile_recharge_orders where id='$tmp_order_id'"));
   if ($fetchOrderDetail['operator']=='bharti airtel ltd') {
       $TmpOperator='airtel';
     }
     else if ($fetchOrderDetail['operator']=='reliance jio infocomm ltd (rjil)') {
       $TmpOperator='reliance jio';
     }
     else if ($fetchOrderDetail['operator']=='vodafone idea ltd (formerly vodafone india ltd)') {
       $TmpOperator='vodafone idea';
     }
     else if ($fetchOrderDetail['operator']=='bharat sanchar nigam ltd (bsnl)') {
       $TmpOperator='BSNL';
     }
     else {
       $TmpOperator='MTNL';
     }
   orderConfirmEmail($fetchPlan['status'],$fetchPlan['amount'],$fetchPlan['mobile'],$TmpOperator,$fetchPlan['operator_type'],$fetchPlan['transaction_id'],$fetchPlan['operator_reference_id'],$fetchPlan['date'],'Mobile Recharge Confirmation', $operatorStatus);
   unset($_SESSION['txn_sucess']);
   unset($_SESSION['order_id']);
   unset($_SESSION['rechOperator']);
   unset($_SESSION['coupon']);
   unset($_SESSION['coupon_discount']);
   ?>