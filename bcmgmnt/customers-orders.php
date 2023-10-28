<?php 
	require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'customers-orders'."'></base>";
   $CustomesActive='yes';
	require 'header.php'; 
	$all_orders=mysqli_query($con,"select * from mobile_recharge_orders where user_id='".$_GET['id']."' order by id desc LIMIT ".per_row_records);
	?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">All Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'customer/'.$_GET['id']; ?>">Customers</a></li>
         <li class="breadcrumb-item active">Orders</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <button class="save-btn hover-btn ml-3 mb-3" onclick="window.location.href='customer/<?php echo $_GET['id']; ?>';"><i class="far fa-arrow-alt-circle-left"></i> Back</button>
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th class="text-center">Order ID</th>
                              <th class="text-center">Mobile</th>
                              <th class="text-center">Date</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php if(mysqli_num_rows($all_orders)){
                            while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td class="text-center"><small class="rupeeIcon">#</small><?php echo $row['transaction_id']; ?></td>
                              <td class="text-center">+91<?php echo $row['mobile']; ?></td>
                              <td class="text-center"><span class="delivery-time"><?php echo date('d/M/Y', strtotime($row['date'])); ?></span></td>
                              <td class="text-center"><small class="rupeeIcon">₹</small><?php echo $row['amount']; ?></td>
                              <td class="text-center">
                                 <span class="badge-item badge-status text-capitalize"><?php echo $row['status']; ?></span>
                              </td>
                              <td class="text-center">
                                 <a href="recharge-detail/<?php echo $row['transaction_id']; ?>" target="_blank()" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete=<?php echo $row['transaction_id']; ?>" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                           </tr>
                           <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                               <td class="text-center">
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="CustomerOrderDetailLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                           <?php }else{ ?>
                           <tr>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                           </tr>
                           <tr>
                              <td class="text-center"></td>
                              <td class="text-center">No Orders Yet</td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
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
<script type="text/javascript">
 $(document).ready(function(){  
   $(document).on('click', '#CustomerOrderDetailLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#CustomerOrderDetailLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"CustomerOrderDetailLoadMore",  
             method:"POST",  
             data:{last_video_id:last_video_id,user_id:'<?php echo $_GET['id']; ?>'},  
             dataType:"text",  
             success:function(data)  
             {  
                  $('#LoadMoreBtnRow').remove();  
                  if(data != '')  
                  {  
                       $('#load_data_table').append(data);  
                  }  
                  else  
                  {  
                       $('#CustomerOrderDetailLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>