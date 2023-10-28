<?php 
   require '../functions.php'; 
   require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'airtel-plans-detail'."'></base>";
   $OffersActive="yes";
   require 'header.php'; 
   $operator_details=mysqli_fetch_assoc(mysqli_query($con,'select * from offers where id="'.$_GET['id'].'"'));
   if (isset($_POST['UpdateOfferBtn'])) {
      $status=strtolower(get_safe_value($con,$_POST['status']));
      $show_home=strtolower(get_safe_value($con,$_POST['show_home']));
      $code=strtolower(get_safe_value($con,$_POST['code']));
      $description=strtolower(get_safe_value($con,$_POST['description']));
      $slug=strtolower(get_safe_value($con,$_POST['slug']));
      $tagline=strtolower(get_safe_value($con,$_POST['tagline']));
      $step1=strtolower(get_safe_value($con,$_POST['step1']));
      $step2=strtolower(get_safe_value($con,$_POST['step2']));
      $step3=(isset($_POST['step3']) && $_POST['step3']!='')?strtolower(get_safe_value($con,$_POST['step3'])):'';
      $step4=(isset($_POST['step3']) && $_POST['step3']!='')?strtolower(get_safe_value($con,$_POST['step4'])):'';
      $terms1=strtolower(get_safe_value($con,$_POST['terms1']));
      $terms2=strtolower(get_safe_value($con,$_POST['terms2']));
      $terms3=(isset($_POST['step3']) && $_POST['step3']!='')?strtolower(get_safe_value($con,$_POST['terms3'])):'';
      $terms4=(isset($_POST['step4']) && $_POST['step4']!='')?strtolower(get_safe_value($con,$_POST['terms4'])):'';
      $terms5=(isset($_POST['step5']) && $_POST['step5']!='')?strtolower(get_safe_value($con,$_POST['terms5'])):'';
      $terms6=(isset($_POST['step6']) && $_POST['step6']!='')?strtolower(get_safe_value($con,$_POST['terms6'])):'';
      mysqli_query($con, "UPDATE `offers` SET `status` = '$status',`show_home` = '$show_home',`code` = '$code',`description` = '$description',`slug` = '$slug',`tagline` = '$tagline',`step1` = '$step1',`step2` = '$step2',`step3` = '$step3',`step4` = '$step4',`terms1` = '$terms1',`terms2` = '$terms2',`terms3` = '$terms3',`terms4` = '$terms4',`terms5` = '$terms5',`terms6` = '$terms6' WHERE `offers`.`id` = '".$_GET['id']."'");
      header('Location:'.ADMIN_SITE_PATH.'offer');
   }
   ?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">All Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item active">All Orders</li>
      </ol>
      <div class="row">
         <div class="col-lg-7 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="shopowner-content-left text-center pd-20">
                     <div class="customer_img">
                        <img src="../images/offers/<?php echo $operator_details['img1']; ?>" alt="">
                     </div>
                     <div class="shopowner-dt-left mt-4 mb-30">
                        <h4 class="text-capitalize"><?php echo SITE_NAME; ?> Offer Details</h4>
                        <span><?php echo $operator_details['tagline']; ?></span>
                     </div>
                     <form method="post">
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Added On</span>
                           <span class="right-dt"><input type="date" readonly="" value="<?php echo date('Y-m-d', strtotime($operator_details['added_on'])); ?>" class="form-control bglight mb-2"></span>
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
                           <span class="left-dt">show_home</span>
                           <span class="right-dt">
                           <select name="show_home" required="" class="form-control mb-2">
                              <?php if ($operator_details['show_home']==1) { ?>
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
                           <span class="left-dt my-2">code</span>
                           <span class="right-dt"><input type="text" required="" name="code" value="<?php echo $operator_details['code']; ?>" class="form-control text-uppercase mb-2"></span>
                        </div> 
                        <label class="form-control mt-4 mb-0">Description</label>
                        <textarea name="description" class="form-control" rows="10" required="" class=""><?php echo $operator_details['description']; ?></textarea>
                        <label class="form-control mt-4 mb-0">slug</label>
                        <textarea name="slug" class="form-control" rows="1" required="" class=""><?php echo $operator_details['slug']; ?></textarea>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">tagline</span>
                           <span class="right-dt"><input type="text" required="" name="tagline" value="<?php echo $operator_details['tagline']; ?>" class="form-control mb-2"></span>
                        </div>
                        <label class="form-control mt-4 mb-0 pl-0">Steps to follow</label>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">1</span>
                            </div>
                            <textarea name="step1" class="form-control" rows="1" required="" class=""><?php echo $operator_details['step1']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">2</span>
                            </div>
                            <textarea name="step2" class="form-control" rows="1" required="" class=""><?php echo $operator_details['step2']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">3</span>
                            </div>
                            <textarea name="step3" class="form-control" rows="1" class=""><?php echo $operator_details['step3']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">4</span>
                            </div>
                            <textarea name="step4" class="form-control" rows="1" class=""><?php echo $operator_details['step4']; ?></textarea>
                          </div>
                        </span>
                        <label class="form-control mt-4 mb-0 pl-0">Terms & Conditions</label>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">1</span>
                            </div>
                            <textarea name="terms1" class="form-control" rows="1" required="" class=""><?php echo $operator_details['terms1']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">2</span>
                            </div>
                            <textarea name="terms2" class="form-control" rows="1" required="" class=""><?php echo $operator_details['terms2']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">3</span>
                            </div>
                            <textarea name="terms3" class="form-control" rows="1" class=""><?php echo $operator_details['terms3']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">4</span>
                            </div>
                            <textarea name="terms4" class="form-control" rows="1" class=""><?php echo $operator_details['terms4']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">5</span>
                            </div>
                            <textarea name="terms5" class="form-control" rows="1" class=""><?php echo $operator_details['terms5']; ?></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">6</span>
                            </div>
                            <textarea name="terms6" class="form-control" rows="1" class=""><?php echo $operator_details['terms6']; ?></textarea>
                          </div>
                        </span>

                        <button class="save-btn hover-btn" name="UpdateOfferBtn" type="submit">Update Plan</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>