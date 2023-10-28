<?php 
   require '../functions.php'; 
   require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'airtel-plans-detail'."'></base>";
   $OffersActive="yes";
   require 'header.php'; 
   if (isset($_POST['SetOfferBtn'])) {

    $target_dir = "../images/offers/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        $msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $msg = "File is not an image.";
        $uploadOk = 0;
      }
    // Check if file already exists
    if (file_exists($target_file)) {
      $msg = "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      $msg = "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //   $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //   $uploadOk = 0;
    // }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $msg = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $msg = "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      } else {
        $msg = "Sorry, there was an error uploading your file.";
      }
    }
      date_default_timezone_set("Asia/Kolkata");
      $created_at=date('Y-m-d');
      $image=strtolower($_FILES["image"]["name"]);
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
      mysqli_query($con, "INSERT INTO `offers` (`img1`, `added_on`, `code`, `tagline`, `description`, `slug`, `status`, `show_home`, `step1`, `step2`, `step3`, `step4`, `terms1`, `terms2`, `terms3`, `terms4`, `terms5`, `terms6`) VALUES ('$image', '$created_at', '$code', '$tagline', '$description', '$slug', '$status', '$show_home', '$step1', '$step2', '$step3', '$step4', '$terms1', '$terms2', '$terms3', '$terms4', '$terms5', '$terms6')");
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
                     <div class="shopowner-dt-left mt-4 mb-30">
                        <h4 class="text-capitalize"><?php echo  SITE_NAME; ?></h4>
                        <span>Add an Offer</span>
                     </div>
                     <form method="post" enctype="multipart/form-data">
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">Image</span>
                           <span class="right-dt"><input type="file" required="" name="image" class="form-control text-uppercase mb-2"></span>
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
                           <span class="left-dt">show_home</span>
                           <span class="right-dt">
                           <select name="show_home" required="" class="form-control mb-2">
                              <option value="1" selected="">Active</option>
                              <option value="0">Deactive</option>
                           </select>
                           </span>
                        </div>  
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">code</span>
                           <span class="right-dt"><input type="text" required="" name="code" class="form-control text-uppercase mb-2"></span>
                        </div> 
                        <label class="form-control mt-4 mb-0">Description</label>
                        <textarea name="description" class="form-control" rows="10" required="" class=""></textarea>
                        <label class="form-control mt-4 mb-0">slug</label>
                        <textarea name="slug" class="form-control" rows="1" required="" class=""></textarea>
                        <div class="shopowner-dt-list my-2">
                           <span class="left-dt my-2">tagline</span>
                           <span class="right-dt"><input type="text" required="" name="tagline" class="form-control mb-2"></span>
                        </div>
                        <label class="form-control mt-4 mb-0 pl-0">Steps to follow</label>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">1</span>
                            </div>
                            <textarea name="step1" class="form-control" rows="1" required="" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">2</span>
                            </div>
                            <textarea name="step2" class="form-control" rows="1" required="" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">3</span>
                            </div>
                            <textarea name="step3" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">4</span>
                            </div>
                            <textarea name="step4" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>
                        <label class="form-control mt-4 mb-0 pl-0">Terms & Conditions</label>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">1</span>
                            </div>
                            <textarea name="terms1" class="form-control" rows="1" required="" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">2</span>
                            </div>
                            <textarea name="terms2" class="form-control" rows="1" required="" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">3</span>
                            </div>
                            <textarea name="terms3" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">4</span>
                            </div>
                            <textarea name="terms4" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">5</span>
                            </div>
                            <textarea name="terms5" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>
                        <span class="right-dt">
                          <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text bglight d-flex justify-content-center" style="width: 50px;" id="inputGroup-sizing-sm">6</span>
                            </div>
                            <textarea name="terms6" class="form-control" rows="1" class=""></textarea>
                          </div>
                        </span>

                        <button class="save-btn hover-btn" name="SetOfferBtn" type="submit">Add Offer</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>