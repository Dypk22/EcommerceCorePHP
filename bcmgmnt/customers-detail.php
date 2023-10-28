<?php 
   require '../connection.php'; 
   $CustomersActive='yes';
   echo "<base href='".ADMIN_SITE_PATH.'customers-detail'."'></base>";
   require 'header.php'; 
   $customers_detail=mysqli_fetch_assoc(mysqli_query($con,'select * from users where id="'.$_GET['id'].'"'));
   $customers_order=mysqli_num_rows(mysqli_query($con,'select * from mobile_recharge_orders where user_id="'.$_GET['id'].'" and status="success"'));
   $customers_order_amount=mysqli_fetch_assoc(mysqli_query($con,'select sum(amount) from mobile_recharge_orders where user_id="'.$_GET['id'].'" and status="success"'));
   $customers_order_cashback=mysqli_fetch_assoc(mysqli_query($con,'select sum(amount) from wallet where type="cashback-credited" and status="success" and user_id="'.$_GET['id'].'"'));
   ?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title text-capitalize">Customer Details</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'Customers'; ?>">Customers</a></li>
         <li class="breadcrumb-item active">Customers Details</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <button class="save-btn hover-btn ml-3" onclick="window.location.href='customers';"><i class="far fa-arrow-alt-circle-left"></i> Back</button>
                  <div class="shopowner-content-left text-center pd-20">
                     <div class="customer_img">
                        <img src="../images/avatar/img-<?php echo rand(1,6); ?>.jpg" alt="">
                     </div>
                     <div class="shopowner-dt-left mt-4">
                        <h4 class="text-capitalize"><?php echo $customers_detail['name']; ?></h4>
                        <span>Customer</span>
                     </div>
                     <ul class="product-dt-purchases">
                        <li>
                           <div class="product-status">
                              <a href="customer/orders/<?php echo $_GET['id']; ?>" style="color: inherit;text-decoration: none;">Total Orders <span class="badge-item-2 badge-status"><?php echo $customers_order; ?> / <small class="rupeeIcon" style="margin-right: 1px;">₹</small><?php echo (isset($customers_order_amount['sum(amount)']))?$customers_order_amount['sum(amount)']:'0';; ?></span></a>
                           </div>
                        </li>
                        <li>
                           <div class="product-status">
                              <a href="customer/wallet/<?php echo $_GET['id']; ?>" style="color: inherit;text-decoration: none;">Cashback Amount <span class="badge-item-2 badge-status"><small class="rupeeIcon" style="margin-right: 1px;">₹</small><?php echo (isset($customers_order_cashback['sum(amount)']))?$customers_order_cashback['sum(amount)']:'0';?></span></a>
                           </div>
                        </li>
                     </ul>
                     <div class="shopowner-dts">
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Name</span>
                           <span class="right-dt text-capitalize"><?php echo $customers_detail['name']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Email</span>
                           <span class="right-dt"><?php echo ucfirst($customers_detail['email']); ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Password</span>
                           <span class="right-dt"><?php echo $customers_detail['password']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">User Status</span>
                           <span class="right-dt text-capitalize"><?php echo $customers_detail['status']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Refer Code</span>
                           <span class="right-dt"><?php echo ucfirst($customers_detail['refer_code']); ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Refer By</span>
                           <span class="right-dt"><?php echo ucfirst($customers_detail['refered_by']); ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Phone</span>
                           <span class="right-dt">+91<?php echo $customers_detail['mobile']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Wallet</span>
                           <span class="right-dt"><small class="rupeeIcon">₹</small><?php echo $customers_detail['wallet']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Member Since</span>
                           <span class="right-dt text-capitalize"><?php echo date('d M, Y - h:i a', strtotime($customers_detail['added_on'])); ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Email Verification Status</span>
                           <span class="right-dt text-capitalize"><?php echo $customers_detail['email_status']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Mobile Verification Status</span>
                           <span class="right-dt text-capitalize"><?php echo $customers_detail['mobile_status']; ?></span>
                        </div>
                        <div class="shopowner-dt-list">
                           <span class="left-dt">Token</span>
                           <span class="right-dt text-capitalize"><?php echo $customers_detail['token']; ?></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>