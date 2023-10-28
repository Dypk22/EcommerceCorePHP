<?php 
   require '../connection.php'; 
   $DamActive='yes';
	require 'header.php'; 
   date_default_timezone_set("Asia/Kolkata");
   $added_on=date('Y-m-d H:i:s');
	$all_orders=mysqli_query($con,'SELECT * FROM `add_money_direct` order by id desc LIMIT '.per_row_records);
   if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['remarks'])) { 
      $remarks=($_GET['remarks']=='')?'verification pending':$_GET['remarks'];
      $status=($_GET['status']=='')?0:$_GET['status'];
      if($_GET['remarks']=='approved'){ $status=1;}
      if($status==1){ $remarks='approved';}
      mysqli_query($con,"UPDATE `add_money_direct` SET `status` = '".$status."', `remarks` = '".$remarks."' WHERE `add_money_direct`.`id` = ".$_GET['id']);
      if ($remarks=='approved' || $status==1) {
         $uid=$_GET['user'];
         $prevBal=mysqli_fetch_assoc(mysqli_query($con,"select * from wallet where user_id='$uid' order by `wallet`.`id` desc limit 1"));
         // print_r($prevBal);
          $prevUpdatedBal=$prevBal['updated_balance'];
          $prevUpdatedCashback=$prevBal['updated_cashback'];
          $payment_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
          $amount=$_GET['amount'];
          $newBal=$amount+$prevUpdatedBal;
          $reference_id=$_GET['reference_id'];
          $transaction_status='success';
          mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'add-money', '$amount', '$reference_id', '$payment_id', '$transaction_status', '$newBal', '0', '$prevUpdatedCashback', '', '$added_on')");
          
          $finBal=$newBal+$prevUpdatedCashback;
          mysqli_query($con, "UPDATE `users` SET `wallet` = '$finBal' WHERE `users`.`id` = '$uid'");
          $cbAmt=0;
          if ($amount>=500 && $amount<=999) {
          $cbAmt=25;
          }
          elseif ($amount>=1000) {
          $cbAmt=50;
          }
          else{
          }
          $newcb=$prevUpdatedCashback+$cbAmt;
          if ($cbAmt!=0) {
            mysqli_query($con, "INSERT INTO `wallet` (`user_id`, `type`, `amount`, `transaction_id`, `payment_id`, `status`, `updated_balance`, `cashback`, `updated_cashback`, `coupon_code`, `added_on`) VALUES ('$uid', 'cashback-credited', '$cbAmt', '$reference_id', '$payment_id', 'success', '$newBal', '$cbAmt', '$newcb', '', '$added_on')");
            $finBal+=$cbAmt;
          mysqli_query($con, "UPDATE `users` SET `wallet` = '$finBal' WHERE `users`.`id` = '$uid'");
          }

      }
      header('Location:'.ADMIN_SITE_PATH.'direct-add-money');
   }
   ?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">All Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item active">All Orders</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>S No</th>
                              <th>User Id</th>
                              <th>Amount</th>
                              <th>Reference Id</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Remarks</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td class="text-capitalize"><?php echo $row['user_id']; ?></td>
                              <td class="text-capitalize">₹<?php echo $row['amount']; ?></td>
                              <td class="text-capitalize"><?php echo $row['reference_id']; ?></td>
                              <td><?php echo date('d M, Y - h:i a', strtotime($row['added_on'])); ?></td>
                              <td> 
                                 <select id="<?php echo $row['id'] ?>status" <?php echo ($row['status']==1)?'disabled':''; ?> class="form-control bglight text-capitalize mb-2">
                                    <?php if ($row['status']==1) { ?>
                                    <option value="1" selected="">Approved</option>
                                    <option value="0">Pending</option>
                                    <option value="2">Declined</option>
                                    <?php }else if ($row['status']==0) { ?>
                                    <option value="0" selected="">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Declined</option>
                                    <?php }else{ ?>
                                    <option value="2" selected="">Declined</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <?php } ?>
                                 </select>
                              </td>
                              <td>
                                 <select id="<?php echo $row['id'] ?>remarks" <?php echo ($row['status']==1)?'disabled':''; ?> class="bglight form-control text-capitalize mb-2">
                                    <option value="" selected=""><?php echo $row['remarks']; ?></option>
                                    <option value="approved">approved</option>
                                    <option value="verification pending">verification pending</option>
                                    <option value="invalid details">invalid details</option>
                                 </select>
                              </td>
                              <?php if($row['status']!=1){ ?>
                              <td class="action-btns">
                                 <button class="badge-item border-0 badge-status text-capitalize px-3 py-2" onclick="updateAddMoneyStatus('<?php echo $row['id'] ?>','<?php echo $row['user_id']; ?>','<?php echo $row['amount']; ?>','<?php echo $row['reference_id']; ?>')">Update</button>
                              </td>
                              <?php } ?>
                              <script type="text/javascript">
                                 function updateAddMoneyStatus(id,user,amount,reference_id) {
                                    var status=jQuery('#'+id+'status').val();
                                    var remarks=jQuery('#'+id+'remarks').val();
                                    window.location.href='direct-add-money?id='+id+'&status='+status+'&remarks='+remarks+'&amount='+amount+'&user='+user+'&reference_id='+reference_id;
                                 }
                              </script>
                           </tr>
                           <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                               <td>
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="DirectAddMoneyLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
                              <td></td>
                            </tr>
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
   $(document).on('click', '#DirectAddMoneyLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#DirectAddMoneyLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"DirectAddMoneyLoadMore",  
             method:"POST",  
             data:{last_video_id:last_video_id},  
             dataType:"text",  
             success:function(data)  
             {  
                  $('#LoadMoreBtnRow').remove();  
                  if(data != '')  
                  {  
                       // $('#LoadMoreBtnRow').remove();  
                       $('#load_data_table').append(data);  
                  }  
                  else  
                  {  
                       $('#DirectAddMoneyLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>