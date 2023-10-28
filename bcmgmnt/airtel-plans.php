<?php 
   require '../connection.php'; 
   $AirtelActive="yes";
	require 'header.php'; 
	$all_orders=mysqli_query($con,'SELECT * FROM `airtel_plan`');
	?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">Airtel Plans</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item active">All Airtel Plans</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <button class="save-btn hover-btn mb-3" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'add-airtel-plans'; ?>'";> <i class="fas fa-plus-circle"></i> Add New Plan</button>
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>S No</th>
                              <th>Amount</th>
                              <th>Type</th>
                              <th>Data</th>
                              <th>Validity</th>
                              <th>Status</th>
                              <th>Detail</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td class="text-capitalize"><small class="rupeeIcon">₹</small><?php echo $row['amount']; ?></td>
                              <td class="text-capitalize"><?php echo $row['type']; ?></td>
                              <td class="text-capitalize"><?php echo $row['data']; ?></td>
                              <td><?php echo $row['validity']; ?> Days</td>
                              <?php if ($row['status']==1) { ?>
                              <td> <span class="badge-item badge-status text-capitalize">Active</span></td>
                              <?php }else{ ?>
                              <td> <span class="badge-item badge-status text-capitalize">Deactive</span></td>
                              <?php } ?>
                              <td class="">
                                 <a href="airtel/plans/<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete=<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
        </div>
      </div>
   	</div>
</main>
<?php require 'footer.php'; ?>