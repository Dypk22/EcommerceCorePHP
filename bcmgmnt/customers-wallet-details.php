<?php 
	require '../connection.php'; 
   echo "<base href='".ADMIN_SITE_PATH.'customers-wallet-details'."'></base>";
   $CustomersActive='yes';
	require 'header.php'; 
	$all_orders=mysqli_query($con,'select * from wallet where user_id="'.$_GET['id'].'" and type!="sign-up" order by id desc LIMIT '.per_row_records);
	?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">All Wallet Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'customer/'.$_GET['id']; ?>">Customers</a></li>
         <li class="breadcrumb-item active">Wallet Orders</li>
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
                              <th style="width: 150px;text-align: center;">Order ID</th>
                              <th style="width: 150px;text-align: center;">Txn Type</th>
                              <th style="text-align: center;">Date</th>
                              <th style="text-align: center;">Amount</th>
                              <th style="text-align: center;width: 200px;">Txn Id</th>
                              <th style="text-align: center;">Status</th>
                              <th style="text-align: center;">Balance</th>
                              <th style="text-align: center;">Cashback</th>
                              <th style="text-align: center;">Coupon</th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php if(mysqli_num_rows($all_orders)){
                            while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td class="text-center"><?php echo ($row['type']=='cashback-credited')? '<i class="fas fa-plus-circle mt-1"></i>' : '<a href="recharge-detail/'.$row['transaction_id'].'" style="color: inherit;text-decoration: underline;" target="_blank()">'.$row['transaction_id'].'</a>'; ?></td>
                              <td class="text-capitalize text-center"><?php echo ($row['type']=='cashback-credited')? 'cashback given' : 'payment' ; ?></td>
                              <td class="text-center"><?php echo date('d/M/Y', strtotime($row['added_on'])); ?></td>
                              <td class="text-center"><small class="rupeeIcon">₹</small><?php echo $row['amount']; ?>.00</td>
                              <td class="text-center"><?php echo $row['payment_id']; ?></td>
                              <td class="text-capitalize text-center"><?php echo $row['status']; ?></td>
                              <td class="text-center"><small class="rupeeIcon">₹</small><?php echo $row['updated_balance']; ?>.00</td>
                              <td class="text-center"><small class="ruppeeIcon">₹</small><?php echo $row['updated_cashback']; ?>.00</td>
                              <td class="text-uppercase text-center"><?php echo $row['coupon_code']; ?></td>
                           </tr>
                           <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                               <td class="text-center">
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="CustomerWalletDetailLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
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
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                              <td class="text-center">--</td>
                           </tr>
                           <tr>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center">No Orders Yet</td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
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
   $(document).on('click', '#CustomerWalletDetailLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#CustomerWalletDetailLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"CustomerWalletDetailLoadMore",  
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
                       $('#CustomerWalletDetailLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>