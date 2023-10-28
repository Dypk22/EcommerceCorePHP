<?php 
   require '../functions.php'; 
   require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'manage-coupon'."'></base>";
   $CouponActive="yes";
   require 'header.php'; 
   $operator_details=mysqli_fetch_assoc(mysqli_query($con,'select * from coupons where id="'.$_GET['id'].'"'));
   if (isset($_POST['UpdateCouponBtn'])) {
      $status=strtolower(get_safe_value($con,$_POST['status']));
      $type1=strtolower(get_safe_value($con,$_POST['type1']));
      $type2=strtolower(get_safe_value($con,$_POST['type2']));
      $balance_use=strtolower(get_safe_value($con,$_POST['balance_use']));
      $value=strtolower(get_safe_value($con,$_POST['value']));
      $min_order_value=strtolower(get_safe_value($con,$_POST['min_order_value']));
      $operator_for=strtolower(get_safe_value($con,$_POST['operator_for']));
      $max_discount=strtolower(get_safe_value($con,$_POST['max_discount']));
      $usage_time=strtolower(get_safe_value($con,$_POST['usage_time']));
      $created_at=date('Y-m-d',strtotime(get_safe_value($con,$_POST['created_at'])));
      date_default_timezone_set("Asia/Kolkata");
      $updated_at=date('Y-m-d');
      $expired_on=date('Y-m-d',strtotime(get_safe_value($con,$_POST['expired_on'])));
      mysqli_query($con, "UPDATE `coupons` SET `status` = '$status', `type1` = '$type1', `type2` = '$type2', `balance_use` = '$balance_use', `value` = '$value', `min_order_value` = '$min_order_value', `max_discount` = '$max_discount', `usage_time` = '$usage_time', `updated_at` = '$updated_at', `created_at` = '$created_at', `operator_for`='$operator_for', `expired_on`='$expired_on' WHERE `coupons`.`id` = '".$_GET['id']."'");
      header('Location:'.ADMIN_SITE_PATH.'coupons');
   }
   ?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">All Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item active">All Orders</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="shopowner-content-left text-center pd-20">
                     <div class="shopowner-dt-left mt-4 mb-30">
                        <h4 class="text-capitalize">coupon : <?php echo $operator_details['code']; ?></h4>
                        <span>Manage Coupon Details</span>
                     </div>
                     <form method="post">
                      <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Id</span>
                           <span class="right-dt"><input type="number" readonly="" value="<?php echo $operator_details['id']; ?>" class="form-control bglight mb-2"></span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt">Status</span>
                           <span class="right-dt">
                           <select name="status" required="" class="form-control mb-2">
                              <?php if ($operator_details['status']==1) { ?>
                              <option value="1" selected="">Active</option>
                              <option value="0">Deactive</option>
                              <?php }else{ ?>
                              <option value="0" selected="">Deactive</option>
                              <option value="1">Active</option>
                              <?php } ?>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Type1</span>
                           <span class="right-dt">
                              <select name="type1" required="" class="form-control mb-2 text-capitalize">
                                <?php if ($operator_details['type1']=='add-money') { ?>
                                <option value="add-money" selected="">add-money</option>
                                <option value="recharge">recharge</option>
                                <?php }else{ ?>
                                <option value="recharge" selected="">recharge</option>
                                <option value="add-money">add-money</option>
                                <?php } ?>
                             </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Type2</span>
                           <span class="right-dt">
                              <select name="type2" required="" class="form-control mb-2 text-capitalize">
                                <?php if ($operator_details['type2']=='percentage') { ?>
                                <option value="percentage" selected="">percentage</option>
                                <option value="fixed-price">fixed-price</option>
                                <?php }else{ ?>
                                <option value="fixed-price" selected="">fixed-price</option>
                                <option value="percentage">percentage</option>
                                <?php } ?>
                             </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt">Can Balance Use?</span>
                           <span class="right-dt">
                           <select name="balance_use" required="" class="form-control mb-2">
                              <?php if ($operator_details['balance_use']==1) { ?>
                              <option value="1" selected="">Yes</option>
                              <option value="0">No</option>
                              <?php }else{ ?>
                              <option value="0" selected="">No</option>
                              <option value="1">Yes</option>
                              <?php } ?>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Value</span>
                           <span class="right-dt"><input type="number" required="" name="value" value="<?php echo $operator_details['value']; ?>" class="form-control text-uppercase mb-2"></span>
                        </div>        
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Minimum Recharge Price</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">₹</span>
                                </div>
                                <input type="text" required="" name="min_order_value" class="form-control" value="<?php echo $operator_details['min_order_value']; ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                           </span>
                        </div> 
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Maximum Discounted Price</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">₹</span>
                                </div>
                                <input type="text" required="" name="max_discount" class="form-control" value="<?php echo $operator_details['max_discount']; ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                           </span>
                        </div>  
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Usage Per User</span>
                           <span class="right-dt"><input type="number" required="" name="usage_time" value="<?php echo $operator_details['usage_time']; ?>" class="form-control text-uppercase mb-2"></span>
                        </div> 
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt">Valid For Airtel/All?</span>
                           <span class="right-dt">
                           <select name="operator_for" required="" class="form-control mb-2 text-capitalize">
                              <?php if ($operator_details['operator_for']=='all') { ?>
                              <option value="all" selected="">All</option>
                              <option value="airtel">airtel</option>
                              <?php }else{ ?>
                              <option value="airtel" selected="">airtel</option>
                              <option value="all">All</option>
                              <?php } ?>
                           </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Created on</span>
                           <span class="right-dt"><input type="text" readonly=""name="created_at" value="<?php echo date('d M, y', strtotime($operator_details['created_at'])); ?>" class="form-control mb-2 bglight"></span>
                        </div> 
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Last Modified</span>
                           <span class="right-dt"><input type="text" readonly="" name="updated_at" value="<?php echo date('d M, y', strtotime($operator_details['updated_at'])); ?>" class="form-control mb-2 bglight"></span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Expired on</span>
                           <span class="right-dt"><input type="date" required="" name="expired_on" value="<?php echo date('Y-m-d', strtotime($operator_details['expired_on'])); ?>" class="form-control mb-2"></span>
                        </div>
                        <button class="save-btn hover-btn" name="UpdateCouponBtn" type="submit">Update Plan</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>