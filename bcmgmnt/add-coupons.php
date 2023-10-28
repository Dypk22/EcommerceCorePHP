<?php 
   require '../functions.php'; 
   require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'manage-coupon'."'></base>";
   $CouponActive="yes";
   require 'header.php'; 
   if (isset($_POST['UpdateCouponBtn'])) {
      date_default_timezone_set("Asia/Kolkata");
      $code=strtolower(get_safe_value($con,$_POST['code']));
      $status=strtolower(get_safe_value($con,$_POST['status']));
      $type1=strtolower(get_safe_value($con,$_POST['type1']));
      $type2=strtolower(get_safe_value($con,$_POST['type2']));
      $balance_use=strtolower(get_safe_value($con,$_POST['balance_use']));
      $value=strtolower(get_safe_value($con,$_POST['value']));
      $min_order_value=strtolower(get_safe_value($con,$_POST['min_order_value']));
      $operator_for=strtolower(get_safe_value($con,$_POST['operator_for']));
      $max_discount=strtolower(get_safe_value($con,$_POST['max_discount']));
      $usage_time=strtolower(get_safe_value($con,$_POST['usage_time']));
      $created_at=date('Y-m-d');
      $updated_at=date('Y-m-d');
      $expired_on=date('Y-m-d',strtotime(get_safe_value($con,$_POST['expired_on'])));
      mysqli_query($con, "INSERT INTO `coupons` (`code`, `type1`, `type2`, `status`, `balance_use`, `value`, `min_order_value`, `max_discount`, `usage_time`, `operator_for`, `created_at`, `updated_at`, `expired_on`) VALUES ('$code', '$type1', '$type2', '$status', '$balance_use', '$value', '$min_order_value', '$max_discount', '$usage_time','$operator_for', '$created_at', '$updated_at', '$expired_on')");
      // mysqli_query($con, "UPDATE `coupons` SET `status` = '$status', `type1` = '$type1', `type2` = '$type2', `balance_use` = '$balance_use', `value` = '$value', `min_order_value` = '$min_order_value', `max_discount` = '$max_discount', `usage_time` = '$usage_time', `updated_at` = '$updated_at', `created_at` = '$created_at', `operator_for`='$operator_for' WHERE `coupons`.`id` = '".$_GET['id']."'");
      header('Location:'.ADMIN_SITE_PATH.'coupons');
   }
   ?>
<main>
   <div class="container-fluid">
    <h2 class="mt-30 page-title">Add Coupon</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'coupons'; ?>">Coupon</a></li>
         <li class="breadcrumb-item active"> Add Coupon</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <button class="save-btn hover-btn mb-3" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'coupons'; ?>'";> <i class="far fa-arrow-alt-circle-left"></i> Back</button>
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="shopowner-content-left text-center pd-20">
                     <div class="shopowner-dt-left mt-4 mb-30">
                        <h4 class="text-capitalize">coupon</h4>
                        <span>add Coupon Details</span>
                     </div>
                     <form method="post">
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Coupon Name</span>
                           <span class="right-dt"><input type="text" placeholder="Coupon Name" required="" name="code" class="form-control mb-2"></span>
                        </div>                             
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt">Status</span>
                           <span class="right-dt">
                           <select name="status" required="" class="form-control mb-2">
                              <option value="1" selected="">Active</option>
                              <option value="0">Deactive</option>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Type1</span>
                           <span class="right-dt">
                              <select name="type1" required="" onchange="changeCOuponType(value)" class="form-control mb-2 text-capitalize">
                                <option value="add money" selected="">Add Money</option>
                                <option value="prepaid recharge">Prepaid Recharge</option>
                                <option value="dth recharge">DTH Recharge</option>
                             </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Type2</span>
                           <span class="right-dt">
                              <select name="type2" required="" class="form-control mb-2 text-capitalize">
                                <option value="fixed price" selected="">fixed-price</option>
                                <option value="percentage">percentage</option>
                             </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2" id="HideBalUse">
                           <span class="left-dt">Can Balance Use?</span>
                           <span class="right-dt">
                           <select name="balance_use" required="" class="form-control mb-2">
                              <option value="0" selected="">No</option>
                              <option value="1">Yes</option>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Value</span>
                           <span class="right-dt"><input type="number" placeholder="Coupon Value" required="" name="value" class="form-control mb-2"></span>
                        </div>        
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Minimum Recharge Price</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">₹</span>
                                </div>
                                <input type="number" placeholder="Minimum Recharge Price" required="" name="min_order_value" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                           </span>
                        </div> 
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Maximum Discount Price</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">₹</span>
                                </div>
                                <input type="text" required="" name="max_discount" placeholder="Maximum Discount Price" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"
>                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                           </span>
                        </div>  
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Usage Per User</span>
                           <span class="right-dt"><input type="number" required="" name="usage_time" class="form-control mb-2"></span>
                        </div> 
                        <div class="shopowner-dt-list my-2" id="forOperator">
                           <span class="left-dt">Valid For Airtel/All?</span>
                           <span class="right-dt">
                           <select name="operator_for" required="" class="form-control mb-2 text-capitalize">
                              <option value="not-avaliable" selected="">not-avaliable</option>
                              <option value="all">All</option>
                              <option value="airtel">airtel</option>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Expired on</span>
                           <span class="right-dt"><input type="date" required="" value="<?php echo date('Y-m-d') ?>" name="expired_on" class="form-control mb-2"></span>
                        </div>
                        <button class="save-btn hover-btn" name="UpdateCouponBtn" type="submit">Add Coupon</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>
<script type="text/javascript">
function changeCOuponType(value) {
  if (value=='dth recharge' || value=='add money') {jQuery('#forOperator').hide();jQuery('#HideBalUse').hide();} else {jQuery('#forOperator').show();jQuery('#HideBalUse').show();}
}
</script>