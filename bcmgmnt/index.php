<?php 
   require '../connection.php'; 
   $DashboardActive="yes";
 	require 'header.php'; 
	$total_order_amount=mysqli_fetch_assoc(mysqli_query($con, "select sum(amount) from mobile_recharge_orders where status='success'"));
	$total_failed_order_amount=mysqli_fetch_assoc(mysqli_query($con, "select sum(amount) from mobile_recharge_orders where status!='success'"));
	$total_no_order=mysqli_num_rows(mysqli_query($con, "select id from mobile_recharge_orders where status='success'"));
	$total_failed_order=mysqli_num_rows(mysqli_query($con, "select id from mobile_recharge_orders where status!='success'"));
	$total_no_customers=mysqli_num_rows(mysqli_query($con, "select id from users where status='1'"));
	$total_visitors=mysqli_fetch_assoc(mysqli_query($con, "select total_visits from visitors"));
	$cashback_given=mysqli_fetch_assoc(mysqli_query($con, "select sum(amount) from wallet where type='cashback-credited' and status='success'"));

	?>
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Dashboard</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <div class="row">
         <div class="col-xl-3 col-md-6" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'orders'; ?>';">
            <div class="dashboard-report-card pointer purple">
               <div class="card-content">
                  <span class="card-title">Total Recharge</span>
                  <span class="card-count"><small class="rupeeIcon">₹</small><?php echo ($total_order_amount['sum(amount)']=='')?0:$total_order_amount['sum(amount)'];?>.00</span>
               </div>
               <div class="card-media">
                  <i class="fas fa-box"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'orders'; ?>';">
            <div class="dashboard-report-card pointer red">
               <div class="card-content">
                  <span class="card-title">Failed Recharge</span>
                  <span class="card-count"><small class="rupeeIcon">₹</small><?php echo ($total_failed_order_amount['sum(amount)']=='')?0:$total_failed_order_amount['sum(amount)'];?>.00</span>
               </div>
               <div class="card-media">
                  <i class="far fa-times-circle"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'orders'; ?>';">
            <div class="dashboard-report-card pointer info">
               <div class="card-content">
                  <span class="card-title">Total Order</span>
                  <span class="card-count"><?php echo $total_no_order; ?></span>
               </div>
               <div class="card-media">
                  <i class="fas fa-sync-alt rpt_icon"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'orders'; ?>';">
            <div class="dashboard-report-card pointer success">
               <div class="card-content">
                  <span class="card-title">Failed Order</span>
                  <span class="card-count"><?php echo $total_failed_order; ?></span>
               </div>
               <div class="card-media">
                  <i class="fab fa-rev rpt_icon"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card pointer success">
               <div class="card-content">
                  <span class="card-title">API Balance</span>
                  <span class="card-count"><small class="rupeeIcon">₹</small><?php echo recharge_api_balance; ?></span>
               </div>
               <div class="card-media">
                  <i class="fas fa-money-bill rpt_icon"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'Customers'; ?>';">
            <div class="dashboard-report-card pointer info">
               <div class="card-content">
                  <span class="card-title">Customers</span>
                  <span class="card-count"><?php echo $total_no_customers; ?></span>
               </div>
               <div class="card-media">
                  <i class="fas fa-users rpt_icon"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card pointer red">
               <div class="card-content">
                  <span class="card-title">Visitors</span>
                  <span class="card-count"><?php echo $total_visitors['total_visits']; ?></span>
               </div>
               <div class="card-media">
                  <i class="far fa-eye rpt_icon"></i>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card pointer purple">
               <div class="card-content">
                  <span class="card-title">Cashback Given</span>
                  <span class="card-count"><small class="rupeeIcon">₹</small><?php echo $cashback_given['sum(amount)']; ?>.00</span>
               </div>
               <div class="card-media">
                  <i class="fas fa-coins rpt_icon"></i>
               </div>
            </div>
         </div>         
         <!-- <div class="col-xl-12 col-md-12">
            <div class="card card-static-1 mb-30">
               <div class="card-body">
                  <div id="earningGraph"></div>
               </div>
            </div>
         </div> -->
         <!-- <div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Recent Orders</h4>
                  <a href="orders.html" class="view-btn hover-btn">View All</a>
               </div>
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th style="width:130px">Order ID</th>
                              <th>Item</th>
                              <th style="width:200px">Date</th>
                              <th style="width:300px">Address</th>
                              <th style="width:130px">Status</th>
                              <th style="width:130px">Total</th>
                              <th style="width:100px">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>ORDER12345</td>
                              <td>
                                 <a href="#" target="_blank">Product Title Here</a>
                              </td>
                              <td>
                                 <span class="delivery-time">15/06/2020</span>
                                 <span class="delivery-time">4:00PM - 6.00PM</span>
                              </td>
                              <td>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road, Ludhiana, 141001</td>
                              <td>
                                 <span class="badge-item badge-status">Pending</span>
                              </td>
                              <td>$90</td>
                              <td class="action-btns">
                                 <a href="order_view.html" class="views-btn"><i class="fas fa-eye"></i></a>
                                 <a href="order_edit.html" class="edit-btn"><i class="fas fa-edit"></i></a>
                              </td>
                           </tr>
                           <tr>
                              <td>ORDER12346</td>
                              <td>
                                 <a href="#" target="_blank">Product Title Here</a>
                              </td>
                              <td>
                                 <span class="delivery-time">13/06/2020</span>
                                 <span class="delivery-time">2:00PM - 4.00PM</span>
                              </td>
                              <td>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road, Ludhiana, 141001</td>
                              <td>
                                 <span class="badge-item badge-status">Pending</span>
                              </td>
                              <td>$105</td>
                              <td class="action-btns">
                                 <a href="order_view.html" class="views-btn"><i class="fas fa-eye"></i></a>
                                 <a href="order_edit.html" class="edit-btn"><i class="fas fa-edit"></i></a>
                              </td>
                           </tr>
                           <tr>
                              <td>ORDER12347</td>
                              <td>
                                 <a href="#" target="_blank">Product Title Here</a>
                              </td>
                              <td>
                                 <span class="delivery-time">13/6/2020</span>
                                 <span class="delivery-time">5:00PM - 7.00PM</span>
                              </td>
                              <td>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road, Ludhiana, 141001</td>
                              <td>
                                 <span class="badge-item badge-status">Pending</span>
                              </td>
                              <td>$60</td>
                              <td class="action-btns">
                                 <a href="order_view.html" class="views-btn"><i class="fas fa-eye"></i></a>
                                 <a href="order_edit.html" class="edit-btn"><i class="fas fa-edit"></i></a>
                              </td>
                           </tr>
                           <tr>
                              <td>ORDER12348</td>
                              <td>
                                 <a href="#" target="_blank">Product Title Here</a>
                              </td>
                              <td>
                                 <span class="delivery-time">12/06/2020</span>
                                 <span class="delivery-time">01:00PM - 3.00PM</span>
                              </td>
                              <td>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road, Ludhiana, 141001</td>
                              <td>
                                 <span class="badge-item badge-status">Pending</span>
                              </td>
                              <td>$120</td>
                              <td class="action-btns">
                                 <a href="order_view.html" class="views-btn"><i class="fas fa-eye"></i></a>
                                 <a href="order_edit.html" class="edit-btn"><i class="fas fa-edit"></i></a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</main>
<?php require 'footer.php'; ?>
