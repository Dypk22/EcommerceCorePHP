<?php 
   require '../connection.php'; 
   require '../functions.php'; 
   $AirtelActive="yes";
   require 'header.php'; 
   if (isset($_POST['AddPlanBtn'])) {
      $amount=strtolower(get_safe_value($con,$_POST['PlanAmount']));
      $data=strtolower(get_safe_value($con,$_POST['PlanData']));
      $validity=strtolower(get_safe_value($con,$_POST['PlanValidity']));
      $type=strtolower(get_safe_value($con,$_POST['PlanType']));
      $description=strtolower(get_safe_value($con,$_POST['PlanDescription']));
      $tmp_description=explode('. ', $description);
      $tmp_string='';
      foreach ($tmp_description as $value) {
         $tmp_string.=ucfirst($value).'. ';
      }
      mysqli_query($con, "INSERT INTO `airtel_plan` (`amount`, `data`, `validity`, `type`, `description`) VALUES ('$amount', '$data', '$validity', '$type', '$tmp_string');");
      header('Location:'.ADMIN_SITE_PATH.'airtel-plans');
   }
   ?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Add Airtel Plan</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'airtel-plans'; ?>">Airtel</a></li>
         <li class="breadcrumb-item active">Add Airtel Plan</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <button class="save-btn hover-btn mb-3" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'airtel-plans'; ?>'";> <i class="far fa-arrow-alt-circle-left"></i> Back</button>
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Add New Airtel Plan</h4>
               </div>
               <div class="card-body-table">
                  <form method="post" class="news-content-right pd-20">
                     <div class="form-group">
                        <label class="form-label">Amount*</label>
                        <input type="text" class="form-control" name="PlanAmount" required="" placeholder="Enter Amount">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Data*</label>
                        <input type="text" class="form-control" name="PlanData" required="" placeholder="Enter Data">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Validity*</label>
                        <input type="text" class="form-control" name="PlanValidity" required="" placeholder="Enter Validity">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Type*</label>
                        <select name="PlanType" class="form-control" required="">
                           <option value="">All Plans</option>
                           <option value="truly unlimited">Truly Unlimited</option>
                           <option value="smart recharge">Smart Recharge</option>
                           <option value="data">Data</option>
                           <option value="talktime">Talktime</option>
                           <option value="international roaming">International Roaming</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Descritption*</label>
                        <textarea class="form-control" required="" name="PlanDescription" placeholder="Enter Descritption" rows="5"></textarea>
                     </div>
                     <button class="save-btn hover-btn" name="AddPlanBtn" type="submit">Add Plan</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>