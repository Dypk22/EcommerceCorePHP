<?php 
   require '../functions.php'; 
   require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'airtel-plans-detail'."'></base>";
   $JioActive="yes";
   require 'header.php'; 
   $operator_details=mysqli_fetch_assoc(mysqli_query($con,'select * from jio_plan where id="'.$_GET['id'].'"'));
   if (isset($_POST['UpdatePlanBtn'])) {
      $status=strtolower(get_safe_value($con,$_POST['status']));
      $type=strtolower(get_safe_value($con,$_POST['type']));
      $amount=strtolower(get_safe_value($con,$_POST['amount']));
      $data=strtolower(get_safe_value($con,$_POST['data']));
      $validity=strtolower(get_safe_value($con,$_POST['validity']));
      $description=strtolower(get_safe_value($con,$_POST['description']));
      mysqli_query($con, "UPDATE `jio_plan` SET `status` = '$status',`type` = '$type',`amount` = '$amount',`data` = '$data',`validity` = '$validity',`description` = '$description' WHERE `jio_plan`.`id` = '".$_GET['id']."'");
      header('Location:'.ADMIN_SITE_PATH.'jio-plans');
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
                     <div class="customer_img">
                        <img src="../images/brands/operator/operator-4.png" alt="">
                     </div>
                     <div class="shopowner-dt-left mt-4 mb-30">
                        <h4 class="text-capitalize">Jio</h4>
                        <span>Telecom Operator</span>
                     </div>
                     <form method="post">
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
                           <span class="left-dt my-2">Type</span>
                           <span class="right-dt text-capitalize">
                              <select name="type" required="" class="form-control mb-2 text-capitalize">
                                 <option value="<?php echo $operator_details['type']; ?>" selected=""><?php echo $operator_details['type']; ?></option>
                                 <option value="truly unlimited">Truly Unlimited</option>
                                 <option value="smart recharge">Smart Recharge</option>
                                 <option value="data">Data</option>
                                 <option value="talktime">Talktime</option>
                                 <option value="international roaming">International Roaming</option>
                              </select>
                           </span>
                        </div>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Amount</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">₹</span>
                                </div>
                                <input type="text" required="" name="amount" class="form-control" value="<?php echo $operator_details['amount']; ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                           </span>
                        </div>  
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Data</span>
                           <span class="right-dt"><input type="text" required="" name="data" value="<?php echo $operator_details['data']; ?>" class="form-control text-uppercase mb-2"></span>
                        </div>        
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Validity</span>
                           <span class="right-dt">
                              <div class="input-group input-group-sm mb-2">
                                <input type="text" required="" class="form-control" name="validity" value="<?php echo $operator_details['validity']; ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-append">
                                  <span class="input-group-text">Days</span>
                                </div>
                              </div>
                           </span>
                        </div>            
                        <label class="form-control mt-4 mb-0">Description</label>
                        <textarea name="description" class="form-control" rows="10" required="" class=""><?php echo $operator_details['description']; ?></textarea>
                        <button class="save-btn hover-btn" name="UpdatePlanBtn" type="submit">Update Plan</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>