<?php 
   require '../connection.php'; 
   require '../functions.php'; 
   $DashboardActive="yes";
   require 'header.php'; 
   $imgId=rand(1,6);
   $adminId=$_SESSION['ADMIN_ID'];
   $admin=mysqli_fetch_assoc(mysqli_query($con, "select * from admins where id='$adminId'"));
   $tmp_name=explode(' ', $admin['name']);
   if (isset($_POST['updProfile'])) {
      date_default_timezone_set("Asia/Kolkata");
      $added_on=date('Y-m-d H:i:s');
      $fname=strtolower(get_safe_value($con,$_POST['fname']));
      $lname=strtolower(get_safe_value($con,$_POST['lname']));
      $password=strtolower(get_safe_value($con,$_POST['password']));
      $new_name=$fname.' '.$lname;
      if (($fname!=$tmp_name[0] || $lname!=$tmp_name[1]) || $password!=$admin['password'] ) {
         mysqli_query($con,"UPDATE `admins` SET `name` = '$new_name', `password` = '$password', `updated_at` = '$added_on' WHERE `admins`.`id` = '$adminId'");
      }
      header('Location:'.ADMIN_SITE_PATH.'profile');
   }
   ?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Edit Profile</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item active">Edit Profile</li>
      </ol>
      <div class="row">
         <div class="col-lg-4 col-md-5">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="shopowner-content-left text-center pd-20">
                     <div class="shop_img mb-3">
                        <img src="../images/avatar/img-<?php echo $imgId; ?>.jpg" alt="">
                     </div>
                     <div class="shopowner-dt-left">
                        <h4><?php echo SITE_NAME; ?></h4>
                        <span>Role Admin</span>
                     </div>
                     <div class="shopowner-dts">
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Name</span>
                           <span class="right-dt text-capitalize"><?php echo $admin['name']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt w-auto">Email</span>
                           <span class="right-dt w-auto"><?php echo ucfirst($admin['email']); ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt w-auto">Joined On</span>
                           <span class="right-dt w-auto"><?php echo date('D, d M, Y (h:i:s A)', strtotime($admin['created_at'])); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-8 col-md-7">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Edit Profile</h4>
               </div>
               <div class="card-body-table">
                  <div class="news-content-right pd-20">
                     <form method="post" class="row">
                        <div class="col-lg-6">
                           <div class="form-group mb-3">
                              <label class="form-label">First Name*</label>
                              <input type="text" class="form-control" name="fname" value="<?php echo ucfirst($tmp_name[0]); ?>" placeholder="Enter First Name">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group mb-3">
                              <label class="form-label">Last Name*</label>
                              <input type="text" class="form-control" name="lname" value="<?php echo ucfirst($tmp_name[1]); ?>" placeholder="Enter Last Name">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group mb-3">
                              <label class="form-label">Email*</label>
                              <input type="email" class="form-control bglight" value="<?php echo ucfirst($admin['email']); ?>" readonly="" placeholder="Enter Email Address">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group mb-3">
                              <label class="form-label">Password*</label>
                              <input type="password" class="form-control" name="password" value="<?php echo $admin['password']; ?>" placeholder="Enter Last Name">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <button class="save-btn hover-btn" name="updProfile" type="submit">Save Changes</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>