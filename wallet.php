<?php $dashboard_active='active'; 
  require 'connection.php';
  if (isset($_SESSION['add_money_coupon'])) {
    unset($_SESSION['add_money_coupon_discount']);
    unset($_SESSION['add_money_coupon']);
  } 
  $title='Online Recharge, Bill Payments , DTH, Prepaid &amp; 
  Postpaid Mobile Recharge - '.SITE_NAME; 
  require 'header.php'; 
  $uid=$_SESSION['USER_ID']; 
  $wallet_detail=mysqli_fetch_assoc(mysqli_query($con,"select updated_cashback, updated_balance from wallet where user_id='$uid' order by `wallet`.`id` desc limit 1")); 
  $query=mysqli_query($con, "select * from wallet where user_id='$uid' and type!='sign-up' order by id desc limit ".per_row_records);?>
<section class="page-header page-header-text-light bg-secondary">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-8">
            <h1>My Profile</h1>
         </div>
         <div class="col-md-4">
            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
               <li><a href="<?php echo SITE_PATH; ?>">Home</a></li>
               <li class="active">My Profile</li>
            </ul>
         </div>
      </div>
   </div>
</section>
<div id="content">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            <ul class="nav nav-pills alternate flex-lg-column sticky-top mb-3 mb-md-3 mb-lg-0 d-flex justify-content-center">
               <li class="nav-item"><a class="nav-link" href="dashboard"><i class="fas fa-user"></i>Personal Information</a></li>
               <li class="nav-item"><a class="nav-link" href="offers"><i class="fas fa-bookmark"></i>Offers</a></li>
               <li class="nav-item"><a class="nav-link" href="orders"><i class="fas fa-history"></i>My Orders</a></li>
               <li class="nav-item"><a class="nav-link active" href="wallet"><i class="fas fa-credit-card"></i>Wallet</a></li>
               <li class="nav-item"><a class="nav-link" href="password"><i class="fas fa-key"></i>Change Password</a></li>
               <li class="nav-item"><a class="nav-link" href="logout"><i class="fas fa-lock"></i>Logout</a></li>
            </ul>
         </div>
         <div class="col-lg-9">
            <div class="bg-white shadow-md rounded p-4">
               <h4 class="mb-4">My Wallet</h4>
               <hr class="mx-n4 mb-4">
               <div class="row">
                  <div class="col-12 col-sm-6 mx-lg-auto col-lg-5 mb-4">
                     <div class="account-card account-card-primary text-white rounded p-3 mb-4 mb-lg-0">
                        <p class="text-4">Main Wallet Balance</p>
                        <p class="d-flex align-items-center"> <span class="account-card-expire text-uppercase d-inline-block opacity-6 mr-2"> <br><br></span> <?php if($wallet_detail['updated_balance']<=0) { ?> <span class="text-4 opacity-9">₹00.00</span> <?php } else { ?> <span class="text-4 opacity-9">₹<?php echo $wallet_detail['updated_balance']; ?>.00</span> <?php } ?> <span class="bg-white text-0 text-body font-weight-500 rounded-pill d-inline-block px-2 line-height-4 opacity-8 ml-auto"> </span> </p>
                        <p class="d-flex align-items-center m-0"> <span class="text-uppercase mr-1 font-weight-500 pointer" style="text-decoration: underline;" data-target="#add-money" data-toggle="modal">Add Balance</span> <span class="text-uppercase ml-1 font-weight-500 pointer" style="text-decoration: underline;" onclick="DirectAddMoneyShow()">Direct Transfer</span> </p>
                     </div>
                  </div>
                  <div class="col-12 col-sm-6 mx-lg-auto col-lg-5 mb-1">
                     <div class="account-card text-white rounded p-3 mb-4 mb-lg-0">
                        <p class="text-4">Cashback Balance</p>
                        <p class="d-flex align-items-center"> <span class="account-card-expire text-uppercase d-inline-block opacity-6 mr-2"> <br><br></span> <span class="text-4 opacity-9">₹<?php echo $wallet_detail['updated_cashback']; ?>.00</span> </p>
                        <p class="d-flex align-items-center m-0"> <span class="text-uppercase font-weight-500">Cashback Money</span> </p>
                     </div>
                  </div>
               </div>
               <div id="add-money" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title font-weight-400">Add Money to Wallet</h5>
                           <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> 
                        </div>
                        <div class="modal-body p-4 pt-0">
                           <form>
                              <!-- <input type="hidden" name="type" value="add-money">  -->
                              <div class="form-group"> <label for="editcardHolderName">Enter Amount to Add</label> <input type="number" class="form-control" data-bv-field="editcardHolderName" name="amount" id="addamount" required placeholder="Enter Amount"> </div>
                                 <div id="AddAmtError" class="alert alert-warning my-2" role="alert" style="display: none;"></div>
                              <p class="text-center my-4"><a class="btn-link" data-toggle="collapse" href="#couponCode" aria-expanded="false" aria-controls="couponCode">Apply a Coupon Code</a></p>
                              <div id="couponCode" class="bg-light-3 p-4 rounded collapse mb-4">
                                 <h3 class="text-4">Coupon Code</h3>
                                 <div class="input-group form-group mb-0"> <input class="form-control" placeholder="Coupon Code" id="coupon_code" aria-label="Promo Code" type="text"> <span class="input-group-append"> <button class="btn btn-secondary" type="button" id="applyCouponBtn" onclick="applyAddMoneyCoupon()">APPLY</button> <button class="btn btn-secondary" type="button" id="removeCouponBtn" style="display: none;" onclick="removeCoupon()">REMOVE</button> </span> </div>
                              </div>
                              <button class="btn btn-primary btn-block" id="addamountsubmitBtn" onclick="addamountsubmit()" type="button">Proceed</button> 
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="direct-transfer-steps" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title font-weight-400">How To Add Money?</h5>
                           <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> 
                        </div>
                        <div class="modal-body">
                           <div class="form-group mb-4">
                              <ul>
                                 <li class="py-1">Send the desired amount using UPI</li>
                                 <li class="py-1">Validate payment by providing UPI Reference Number</li>
                                 <li class="py-1">We'll Verify & Update your wallet balance and cashback too</li>
                              </ul>
                           </div>
                           <div class="form-group mb-0">
                              <h6 class="text-2 ml-3">Why!</h6>
                              <ul>
                                 <li class="py-1">Get extra cashback since the payment gateway charges are nill here Everytime!</li>
                                 <li class="py-1">100% Safe, Secure & Easy Method</li>
                                 <li class="py-1">No hidden costs or complex terms and conditions</li>
                              </ul>
                           </div>
                           <div class="form-check mb-4 text-2 custom-control ml-2 custom-checkbox"> <input id="HideFirstPopupAddMoney" name="HideFirstPopupAddMoney" value="Yes" class="custom-control-input" type="checkbox"> <label class="custom-control-label" for="HideFirstPopupAddMoney"><a class="pointer">Don't Show Again</a></label> </div>
                           <button class="btn btn-primary btn-block" type="button" onclick="ShowDirectAddMoney()">Proceed</button> 
                        </div>
                     </div>
                  </div>
               </div>
               <div id="direct-transfer-source" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title font-weight-400">Send Money To</h5>
                           <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> 
                        </div>
                        <div class="modal-body p-4">
                           <div class="form-group mb-4 text-center"> <img src="images/upiQr.png" style="width: 200px;"><br><br><label>Or Use <strong>BILLINCHARGE@UPI</strong></label> </div>
                           <button class="btn btn-primary btn-block" onclick="ShowDirectAddMoneyVerifyBtn()" type="button">Next</button> 
                        </div>
                     </div>
                  </div>
               </div>
               <div id="direct-transfer" class="modal fade" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title font-weight-400">Validate Payment</h5>
                           <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> 
                        </div>
                        <div class="modal-body p-4">
                           <input type="hidden" name="type" value="add-money"> 
                           <div class="form-group mb-4">
                              <form id="AddMoneyDirectFrm">
                                 <label for="DirectAddMoneyAmt">Enter Amount Sent</label> <input type="number" class="form-control" id="DirectAddMoneyAmt" placeholder="Enter Amount"> 
                                 <div id="AmtError" class="alert alert-warning my-2" role="alert" style="display: none;">Enter the Amount Here!</div>
                                 <label for="DirectAddMoneyUPIId" class="mt-2">Enter UPI Refernce Id</label> <input type="number" class="form-control" id="DirectAddMoneyUPIId" placeholder="Enter Amount"> 
                                 <div id="UpiIdError" class="alert alert-warning my-2" role="alert" style="display: none;">Enter the UPI Reference Id Here!</div>
                           </div>
                           <button class="btn btn-primary btn-block" id="FinalDirectAddmoneyBtn" onclick="DirectAddMoneyDirectBtn()" type="button">Proceed</button> </form> 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bg-white rounded p-4">
               <h5 class="mb-4">Recent Wallet Transactions</h5>
               <hr class="mx-n4 mb-4">
               <div class="table-responsive-md">
                  <table class="table table-hover border">
                     <?php if(mysqli_num_rows($query)>0) { ?>
                     <thead class="thead-light">
                        <tr>
                           <th>Date</th>
                           <th class="text-center">Description</th>
                           <th class="text-center">Status</th>
                           <th class="text-right">Amount</th>
                        </tr>
                     </thead>
                     <tbody id="load_data_table">
                        <?php while ($row=mysqli_fetch_assoc($query)) { if($row['type']=='paid-from-wallet') { $type='<a target="_blank()" class="paid-wallet"><i class="fas fa-minus-circle mr-1 text-primary"></i>paid to order</a>'; } if($row['type']=='cashback-credited') { $type='<i class="fas fa-plus-circle text-danger mr-1" style="position:relative; top:6px;"></i> cashback credited'; } if($row['type']=='add-money') { $type='<i class="fas fa-plus-circle text-danger mr-1" style="position:relative; top:6px;"></i>add Money'; } if($row['status']=='success') { $status='<i class="fas fa-check-circle text-success mr-1" style="position:relative; top:1px;"></i>Success'; } if($row['status']=='failed') { $status='<i class="fas fa-times-circle text-danger mr-1" style="position:relative; top:1px;"></i>Failed'; } ?> 
                        <tr>
                           <td class="align-middle"><?php echo date('d M, Y', strtotime($row['added_on'])); ?></td>
                           <?php if($row['type']=='cashback-credited') { ?> 
                           <td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">Cashback Credited<span></td>
                           <?php } else if($row['type']=='add-money') { ?> 
                           <td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">Add Money</span></td>
                           <?php } else if($row['type']=='referal-bonus') { ?> 
                           <td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">Referal Bonus</span></td>
                           <?php } else { ?> 
                           <td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">Paid from wallet</span></td>
                           <?php } ?> 
                           <td class="align-middle text-1 text-center"><?php echo $row['status']; ?></td>
                           <td class="align-middle text-right">₹<?php echo $row['amount']; ?>.00</td>
                        </tr>
                        <?php $video_id=$row["id"]; } ?> 
                        <tr id="LoadMoreBtnRow">
                           <td></td>
                           <td class="text-center"> <button class="btn btn-primary mx-auto my-2 py-2 text-1 px-3" data-vid="<?php echo $video_id; ?>" id="CustomersWalletLoadMore" type="button">Load More</button> </td>
                           <td></td>
                           <td></td>
                        </tr>
                        <?php } else { ?> 
                        <div>No Transactions Yet</div>
                        <?php } ?> 
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript">
   $(document).ready(function(){  
     $(document).on('click', '#CustomersWalletLoadMore', function(){  
       var last_video_id = $(this).data("vid");  
       $('#CustomersWalletLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
       $.ajax({  
            url:"CustomersWalletLoadMore",  
            method:"POST",  
            data:{last_video_id:last_video_id,user_id:'<?php echo $uid; ?>'},  
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
                $('#CustomersWalletLoadMore').html("No Data");  
              }  
            }  
       });  
     });  
   });  
</script>