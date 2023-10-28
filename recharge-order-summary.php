<?php require'connection.php'; 
if(!isset($_POST['recharge_time'])){header('Location:'.SITE_PATH); 
die();} $home_active=''; 
$title='Online Recharge, Bill Payments , DTH, Prepaid &amp; 
Postpaid Mobile Recharge - '.SITE_NAME; 
$extraMetaTags="<base href='".SITE_PATH."'/recharge-order-summary'"; 
require 'header.php'; 
if(isset($_SESSION['coupon'])){ unset($_SESSION['coupon']); 
unset($_SESSION['coupon_discount']); 
} $rechargeAmount=0; 
$recharge_time=get_safe_value($con, $_POST['recharge_time']); 
if (!isset($_SESSION['USER_LOGIN'])) { ?>
<div id="content">
   <div class="container pt-5 pb-4">
      <div class="row">
         <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
            <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
               <p class="text-4 font-weight-300 text-muted text-center mb-4">Please login to continue!</p>
               <form id="loginForm" method="post">
                  <div class="form-group"> <input type="email" class="form-control" id="loginemail" required placeholder="Mobile or Email"> <label id="login_name_error" style="display: none;" class="error text-danger m-1 text-capitalize" for="loginemail"></label> </div>
                  <div class="form-group"> <input type="password" class="form-control" id="loginpassword" required placeholder="Password"> <label id="login_password_error" style="display: none;" class="error text-danger m-1 text-capitalize" for="loginpassword"></label> </div>
                  <div class="row my-4">
                     <div class="col">
                        <div class="form-check text-2 custom-control custom-checkbox"> <input id="remember-me" name="remember" class="custom-control-input" type="checkbox"> <label class="custom-control-label" for="remember-me">Remember Me</label> </div>
                     </div>
                     <div class="col text-2 text-right"><a class="btn-link hover" data-toggle="modal" data-target="#forgot-password-modal" data-dismiss="modal">Forgot Password ?</a></div>
                  </div>
                  <label id="login_error_msg" class="error text-danger m-1 text-capitalize" style="position: relative; bottom: 7px; display: none;"></label> <button class="btn btn-primary btn-block mb-4" id="loginBtn" type="button" onclick="siginin('recharge-order-summary')">Login</button> 
               </form>
               <p class="text-2 text-center mb-0">New to <?php echo SITE_NAME; ?>? <a class="btn-link" href="<?php echo SITE_PATH.'signup'; ?>">Sign Up</a></p>
            </div>
         </div>
      </div>
   </div>
</div>
<?php } else { $uid=$_SESSION['USER_ID'];   $prevBal=mysqli_fetch_assoc(mysqli_query($con,"select * from wallet where user_id='$uid' order by id desc limit 1")); $prevUpdatedBal=$prevBal['updated_balance']+$prevBal['updated_cashback']; ?>
<div id="content">
<div class="container">
   <div class="row my-5">
      <div class="col-lg-11 mx-auto">
         <div class="row widget-steps">
            <div class="col-3 step complete">
               <div class="step-name">Order</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a> 
            </div>
            <div class="col-3 step active">
               <div class="step-name">Summary</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a> 
            </div>
            <div class="col-3 step disabled">
               <div class="step-name">Payment</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a> 
            </div>
            <div class="col-3 step disabled">
               <div class="step-name">Done</div>
               <div class="progress">
                  <div class="progress-bar"></div>
               </div>
               <a class="step-dot hover"></a> 
            </div>
         </div>
      </div>
      <div class="col-lg-12 text-center mt-5">
         <h2 class="text-8">Order Summary</h2>
         <p class="lead">Confirm Details</p>
      </div>
      <?php if($_POST['billerType']=='prepaid_recharge'){ $operator=''; 
      $tmp_opr=''; 
      $get_operator=get_safe_value($con,$_POST['operator']); 
      if(($get_operator=='' && !isset($_SESSION['USER_LOGIN']) || $get_operator=='')) { header('Location:'.SITE_PATH); 
      die(); 
      } else if ($get_operator=='bharti airtel ltd') { $operator='airtel'; 
         $tmp_opr='airtel_plan'; 
      } else if($get_operator=='reliance jio infocomm ltd (rjil)'){ $operator='reliance jio'; 
         $tmp_opr='jio_plan'; 
      } else if($get_operator=='vodafone idea ltd (formerly idea cellular ltd)'){ $operator='vodafone idea'; 
         $tmp_opr='vi_plan'; 
      } else if($get_operator=='mahanagar telephone nigam ltd (mtnl)'){ $operator='mtnl'; 
         $tmp_opr='mtnl_plan'; 
      } else { $operator='bsnl'; 
         $tmp_opr='bsnl_plan'; 
      } 
      $MobileNumber=get_safe_value($con,$_POST['mobile']); 
      $operatorCircle=get_safe_value($con,$_POST['circle']); 
      $rechargeAmount=get_safe_value($con,$_POST['amount']); 
      $operator_type=get_safe_value($con,$_POST['operator_type']); 
      $fetchPlan=mysqli_fetch_assoc(mysqli_query($con, "select * from ".$tmp_opr." where amount='$rechargeAmount'")); 
      $recharge_api_balance=recharge_api_balance; 
      if(time()-$recharge_time>=300){ unset($_SESSION['selected_operator']); 
      unset($_SESSION['page_time']); 
      unset($_SESSION['rechOperator']); 
      header('Location:'.SITE_PATH); 
      die();}?>
      <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
         <div class="bg-white shadow-sm rounded p-3 p-sm-4 mb-0 mb-sm-4">
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Mobile Number:</p>
               <p class="col-sm text-sm-right font-weight-500">(+91) <?php echo $MobileNumber; ?></p>
            </div>
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Operator:</p>
               <p class="col-sm text-sm-right font-weight-500 text-capitalize"><?php echo $operator.' | '.$operator_type; ?></p>
            </div>
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Operator Circle:</p>
               <p class="col-sm text-sm-right font-weight-500 text-capitalize"><?php echo $operatorCircle; ?></p>
            </div>
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Plan:</p>
               <p class="col-sm text-sm-right font-weight-500 text-capitalize"><?php if (isset($fetchPlan['type'])) { echo $fetchPlan['type']; } else { echo "Custom"; } ?></p>
            </div>
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Validity:</p>
               <p class="col-sm text-sm-right font-weight-500"> <?php if (isset($fetchPlan['validity'])) { echo $fetchPlan['validity'].' Days'; } else { echo "As per Plan"; } ?> </p>
            </div>
            <div class="row">
               <p class="col-sm text-muted mb-0 mb-sm-3">Amount:</p>
               <p class="col-sm text-sm-right font-weight-500">₹<?php echo $rechargeAmount; ?></p>
            </div>
            <div class="row">
               <p class="col-12 text-muted mb-0">Plan Description:</p>
               <p class="col-12 text-1"> <?php if (isset($fetchPlan['description'])) { echo $fetchPlan['description']; } else { echo "Not Available"; } ?> </p>
            </div>
            <div class="bg-light-4 rounded p-3">
               <div class="row">
                  <div class="col-sm text-3 font-weight-600">Payment Amount</div>
                  <div class="col-sm text-sm-right text-5 font-weight-500">₹<?php echo $rechargeAmount; ?></div>
               </div>
            </div>
            <p class="text-center my-4" id="applyCouponCollapse"><u class="btn-link pointer" data-toggle="collapse" data-target="#couponCode" aria-expanded="false" aria-controls="couponCode">Apply a Coupon Code</u></p>
            <div id="couponCode" class="bg-light-3 p-4 rounded collapse mb-4">
               <h3 class="text-4">Coupon Code</h3>
               <div class="input-group form-group mb-0"> <input class="form-control" placeholder="Coupon Code" id="coupon_code" aria-label="Promo Code" type="text"> <span class="input-group-append"> <button class="btn btn-secondary" type="button" id="applyCouponBtn" onclick="applyCoupon('<?php echo $rechargeAmount; ?>','prepaid_recharge')">APPLY</button> <button class="btn btn-secondary" type="button" id="removeCouponBtn" style="display: none;" onclick="removeCoupon()">REMOVE</button> </span> </div>
            </div>
            
            <div class="form-check text-2 custom-control <?php echo ($prevUpdatedBal==0 || $prevUpdatedBal>=$rechargeAmount)?'d-none':''; ?> custom-checkbox"> <input id="WalletUse" name="WalletUse" value="Yes" class="custom-control-input" type="checkbox"> <label class="custom-control-label" onclick="UseWalletBalance('<?php echo $rechargeAmount; ?>','<?php echo $prevUpdatedBal; ?>')" for="WalletUse">Use Available Balance <a class="pointer">₹<?php echo $prevUpdatedBal;?>.00</a></label> </div>

            <?php $_SESSION['rechOperator']=$operator; if($prevUpdatedBal>=$rechargeAmount){ $rechPlan= (isset($fetchPlan['type'])) ? $fetchPlan['type'] : "Custom"; $validity=(isset($fetchPlan['validity']))?$fetchPlan['validity']:0;?>
            <p class="mt-4 mb-0 text-light"> <a onclick="payBtnMsgPrepaidRecharge('<?php echo $operator; ?>','<?php echo $rechargeAmount; ?>','<?php echo $MobileNumber; ?>','<?php echo $rechPlan; ?>','<?php echo $operatorCircle; ?>','<?php echo $rechargeAmount; ?>','<?php echo $validity; ?>','<?php echo $operator_type; ?>')" id="payBtn1" style="color: #fff;" class="btn btn-primary btn-block">Pay with Wallet ₹<?php echo $rechargeAmount; ?> <i class="fas fa-angle-double-right"></i></a> <a id="fakepayBtn1" style="color: #fff;display: none;" data-toggle="tooltip" data-original-title="Unavailable payment method for this coupon" title="Unavailable payment method for this coupon" class="btn btn-primary btn-block">Pay with Wallet ₹<?php echo $rechargeAmount; ?> <i class="fas fa-angle-double-right"></i></a> </p>
            <?php } else { ?>
            <p class="mt-4 mb-0 text-light"><a class="btn btn-primary btn-block" data-toggle="tooltip" data-original-title="Insufficient Balance ₹<?php echo $prevUpdatedBal;?>.00" title="Insufficient Balance ₹<?php echo $prevUpdatedBal;?>.00">Pay with Wallet ₹<?php echo $rechargeAmount; ?></a></p>
            <?php } ?>
            <p class="mt-2 mb-0 text-light"><a id="payBtn2" class="btn btn-danger btn-block" onclick="performRecharge('<?php echo $MobileNumber; ?>','<?php echo $rechargeAmount; ?>','<?php echo $operator; ?>','<?php echo $operatorCircle; ?>','<?php if(isset($fetchPlan['validity'])){ echo $fetchPlan['validity']; } else { echo 0;} ?>','<?php if(isset($fetchPlan['type'])){ echo $fetchPlan['type']; } else { echo 'custom';} ?>','<?php echo $operator_type; ?>','<?php echo SITE_PATH.'pay/recharge/'; ?>','<?php echo $prevUpdatedBal;?>')">Pay Now ₹<?php echo $rechargeAmount; ?> <i class="fas fa-angle-double-right"></i></a>
               <a id="fakepayBtn2" style="display: none;" class="btn btn-danger btn-block" onclick="short_temp_msg('error', 'Unavailable Now')">Pay Now ₹<?php echo $rechargeAmount; ?> <i class="fas fa-angle-double-right"></i></a></p>
         </div>
      </div>
      <?php } else if($_POST['billerType']=='dth_recharge') { $rechargeAmount=get_safe_value($con,$_POST['DTHamount']); 
      if(time()-$recharge_time>=300){ 
         unset($_SESSION['page_time']); 
         unset($_SESSION['rechOperator']); 
         header('Location:'.SITE_PATH); 
         die(); 
      }?>
      <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
         <div class="bg-white shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="row">
               <div class="col-sm text-muted">DTH Operator</div>
               <div class="col-sm text-sm-right text-capitalize font-weight-600"><?php echo get_safe_value($con,$_POST['DTHoperator']); ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">DTH VC/Card Number</div>
               <div class="col-sm text-sm-right text-capitalize font-weight-600"><?php echo get_safe_value($con,$_POST['cardNumber']); ?></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-sm text-muted">Amount</div>
               <div class="col-sm text-sm-right text-capitalize font-weight-600">₹<?php echo $rechargeAmount; ?></div>
            </div>
            <hr>
            <div class="bg-light-4 rounded p-3">
               <div class="row">
                  <div class="col-sm text-3 font-weight-600">Payment Amount</div>
                  <div class="col-sm text-sm-right text-5 font-weight-500">₹<?php echo $rechargeAmount; ?></div>
               </div>
            </div>
            <p class="text-center my-4" id="applyCouponCollapse"><u class="btn-link pointer" data-toggle="collapse" data-target="#couponCode" aria-expanded="false" aria-controls="couponCode">Apply a Coupon Code</u></p>
            <div id="couponCode" class="bg-light-3 p-4 rounded collapse mb-4">
               <h3 class="text-4">Coupon Code</h3>
               <div class="input-group form-group mb-0"> <input class="form-control" placeholder="Coupon Code" id="coupon_code" aria-label="Promo Code" type="text"> <span class="input-group-append"> <button class="btn btn-secondary" type="button" id="applyCouponBtn" onclick="applyCoupon('<?php echo $rechargeAmount; ?>','dth_recharge')">APPLY</button> <button class="btn btn-secondary" type="button" id="removeCouponBtn" style="display: none;" onclick="removeCoupon()">REMOVE</button> </span> </div>
            </div>
         </div>
         <div class="form-check text-2 <?php echo ($prevUpdatedBal==0 || $prevUpdatedBal>=$rechargeAmount)?'d-none':''; ?> custom-control custom-checkbox"> <input id="WalletUse" name="WalletUse" value="Yes" class="custom-control-input" type="checkbox"> <label class="custom-control-label" onclick="UseWalletBalance('<?php echo $rechargeAmount; ?>','<?php echo $prevUpdatedBal; ?>')" for="WalletUse">Use Available Balance <a class="pointer">₹<?php echo $prevUpdatedBal;?>.00</a></label> </div>
         <?php if($prevUpdatedBal>=$rechargeAmount) { ?>
         <p class="mt-4 mb-0 text-light"> <a onclick="payBtnMsgDth('<?php echo get_safe_value($con,$_POST['DTHoperator']); ?>', '<?php echo get_safe_value($con,$_POST['cardNumber']); ?>', '<?php echo $rechargeAmount; ?>')" id="payBtn1" style="color: #fff;" class="btn btn-primary btn-block">Pay with Wallet <i class="fas fa-angle-double-right"></i></a> <a id="fakepayBtn1" style="color: #fff;display: none;" data-toggle="tooltip" data-original-title="Unavailable payment method for this coupon" title="Unavailable payment method for this coupon" class="btn btn-primary btn-block">Pay with Wallet <i class="fas fa-angle-double-right"></i></a> </p>
         <?php } else { ?>
         <p class="mt-4 mb-0 text-light"><a class="btn btn-primary btn-block" data-toggle="tooltip" data-original-title="Insufficient Balance ₹<?php echo $prevUpdatedBal;?>.00" title="Insufficient Balance ₹<?php echo $prevUpdatedBal;?>.00">Pay with Wallet</a></p>
         <?php } ?>
         <p class="mt-2 mb-0 text-light"><a id="payBtn2" class="btn btn-danger btn-block" onclick="PerformDTHRecharge('<?php echo get_safe_value($con,$_POST['DTHoperator']); ?>','<?php echo get_safe_value($con,$_POST['cardNumber']); ?>','<?php echo $rechargeAmount; ?>','<?php echo SITE_PATH.'pay/dth/'; ?>','<?php echo $prevUpdatedBal;?>')">Pay Now ₹<?php echo $rechargeAmount; ?>.00 <i class="fas fa-angle-double-right"></i></a></p>
         <?php } ?>
      </div>
   </div>
</div>
<?php } ?>
<form id="submitCouponForm"><input type="hidden" id="FinalcouponCode" name="FinalcouponCode"><input type="hidden" name="rechargeAmt" value="<?php echo $rechargeAmount; ?>" name="rechargeAmt" id="rechargeAmt"><input type="hidden" name="billerType" id="billerType"></form>
<?php require 'footer.php'; if (isset($_POST['operator_type']) && $operator_type=='postpaid') { echo '<script type="text/javascript">nopostpaidmodal()</script>';} if ($rechargeAmount>$recharge_api_balance) { echo '<script type="text/javascript">notSufficientAmount()</script>';} ?>