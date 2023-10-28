<?php 
   require '../connection.php'; 
   require '../functions.php'; 
   $JioActive="yes";
   require 'header.php'; 
   if (isset($_POST['AddPlanBtn'])) {
      $amount=strtolower(get_safe_value($con,$_POST['PlanAmount']));
      $data=strtolower(get_safe_value($con,$_POST['PlanData']));
      $status=strtolower(get_safe_value($con,$_POST['PlanStatus']));
      $validity=strtolower(get_safe_value($con,$_POST['PlanValidity']));
      $type=strtolower(get_safe_value($con,$_POST['PlanType']));
      $description=strtolower(get_safe_value($con,$_POST['PlanDescription']));
      mysqli_query($con, "INSERT INTO `jio_plan` (`status`, `amount`, `data`, `validity`, `type`, `description`) VALUES ('$status', '$amount', '$data', '$validity', '$type', '$description')");
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
                        <label class="form-label">Status*</label>
                        <select name="PlanStatus" required="" class="form-control mb-2">
                           <option value="1" selected="">Active</option>
                           <option value="0">Deactive</option>
                        </select>
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