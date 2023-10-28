<?php $dashboard_active='active';require 'connection.php';$title='My Orders | Online Recharge, Bill Payments , DTH, Prepaid &amp; Postpaid Mobile Recharge | '.SITE_NAME;require 'header.php';if (!isset($_SESSION['USER_LOGIN'])) { header('Location:signin'); }$uid=$_SESSION['USER_ID'];$getOrdersMobile=mysqli_query($con,"select id, date, transaction_id, mobile, amount from mobile_recharge_orders where user_id='$uid' and transaction_id!='0' and status!='' order by id desc limit ".per_row_records); $getOrdersDth=mysqli_query($con,"select id, date, transaction_id, dth_operator, amount from dth_recharge_orders where status!='' and transaction_id!='0' and user_id='$uid' order by id desc limit ".per_row_records); ?>
<section class="page-header page-header-text-light bg-secondary"> <div class="container"> <div class="row align-items-center"> <div class="col-md-8"> <h1>My Profile</h1> </div><div class="col-md-4"> <ul class="breadcrumb justify-content-start justify-content-md-end mb-0"> <li><a href="<?php echo SITE_PATH ?>">Home</a></li><li class="active">My Profile</li></ul> </div></div></div></section><div id="content"> <div class="container"> <div class="row"> <div class="col-lg-3"> <ul class="nav nav-pills alternate flex-lg-column sticky-top mb-3 mb-md-3 mb-lg-0 d-flex justify-content-center"> <li class="nav-item"><a class="nav-link" href="dashboard"><i class="fas fa-user"></i>Personal Information</a></li><li class="nav-item"><a class="nav-link" href="offers"><i class="fas fa-bookmark"></i>Offers</a></li><li class="nav-item"><a class="nav-link active" href="orders"><i class="fas fa-history"></i>My Orders</a></li><li class="nav-item"><a class="nav-link" href="wallet"><i class="fas fa-credit-card"></i>Wallet</a></li><li class="nav-item"><a class="nav-link" href="password"><i class="fas fa-key"></i>Change Password</a></li><li class="nav-item"><a class="nav-link" href="logout"><i class="fas fa-lock"></i>Logout</a></li></ul> </div><div class="col-lg-9"> <div class="bg-white shadow-md rounded p-4 mb-4 mb-md-5"> <h4 class="mb-4">Orders History</h4> <hr class="mx-n4"> <ul class="nav nav-tabs mb-4" id="myTab" role="tablist"> <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Recharge & Bill Payment</a></li><li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">DTH Recharge</a></li></ul> <div class="tab-content my-3" id="myTabContent"> <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab"> <div class="table-responsive-md"> <table class="table table-hover border"> <?php if(mysqli_num_rows($getOrdersMobile)>0) { ?> <thead class="thead-light"> <tr> <th style="width: 140px;">Date</th> <th class="text-center">Description</th> <th class="text-right">Amount</th> </tr></thead> <tbody id="load_data_table"> <?php while ($res=mysqli_fetch_assoc($getOrdersMobile)) { ?> <tr> <td class="align-middle"><?php echo date('d M, Y', strtotime($res['date'])); ?></td><td class="align-middle text-center"><img src="images/brands/operator/mobile.png" style="height: 40px;" class="img-thumbnail ordersImg d-inline-flex mr-1"> <span class="text-1 d-inline-flex"><span class="text-capitalize mx-1"><a href="receipt/mobile/<?php echo $res['transaction_id']; ?>" target="_blank()">Mobile Recharge for +91<?php echo $res['mobile']; ?></a></span></td><td class="align-middle text-right">₹<?php echo $res['amount']; ?>.00</td></tr><?php $video_id=$res["id"]; } ?> <tr id="LoadMoreBtnRow"> <td></td><td class="text-center"> <button class="btn btn-primary mx-auto my-2 py-2 text-1 px-3" data-vid="<?php echo $video_id; ?>" id="CustomersMobileOrdersLoadMore" type="button">Load More</button> </td><td></td></tr></tbody> <?php } else { ?> <div class="ml-md-3">No Transactions Yet</div><?php } ?> </table> </div></div><div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab"> <div class="table-responsive-md"> <table class="table table-hover border"> <?php if(mysqli_num_rows($getOrdersDth)>0) { ?> <thead class="thead-light"> <tr> <th style="width: 140px;">Date</th> <th class="text-center">Description</th> <th class="text-right">Amount</th> </tr></thead> <tbody id="dth_load_data_table"> <?php while ($row=mysqli_fetch_assoc($getOrdersDth)) { ?> <tr> <td class="align-middle"><?php echo date('d M, Y', strtotime($row['date'])); ?></td><td class="align-middle text-center"><img src="images/brands/operator/dth.png" style="height: 40px;" class="img-thumbnail ordersImg d-inline-flex mr-1"> <span class="text-1 d-inline-flex"><span class="text-capitalize mx-1"><a href="receipt/dth/<?php echo $row['transaction_id']; ?>" target="_blank()">DTH Recharge for <?php echo $row['dth_operator']; ?></a></span></td><td class="align-middle text-right">₹<?php echo $row['amount']; ?>.00</td></tr><?php $dth_video_id=$row["id"]; } ?> <tr id="DTHLoadMoreBtnRow"> <td></td><td class="text-center"> <button class="btn btn-primary mx-auto my-2 py-2 text-1 px-3" data-dth="<?php echo $dth_video_id; ?>" id="CustomersDthOrdersLoadMore" type="button">Load More</button> </td><td></td></tr></tbody> <?php } else { ?> <div class="ml-md-3">No Transactions Yet</div><?php } ?> </table> </div></div><div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab"> </div></div></div></div></div></div></div>
<?php require 'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){$(document).on("click","#CustomersMobileOrdersLoadMore",function(){var a=$(this).data("vid");$("#CustomersMobileOrdersLoadMore").html('<span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span> Loading');$.ajax({url:"CustomersMobileOrdersLoadMore",method:"POST",data:{last_video_id:a,user_id:"<?php echo $uid; ?>"},dataType:"text",success:function(b){$("#LoadMoreBtnRow").remove();if(b!=""){$("#load_data_table").append(b)}else{$("#CustomersMobileOrdersLoadMore").html("No Data")}}})});$(document).on("click","#CustomersDthOrdersLoadMore",function(){var a=$(this).data("dth");$("#CustomersDthOrdersLoadMore").html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');$.ajax({url:"CustomersDthOrdersLoadMore",method:"POST",data:{dth_last_video_id:a,user_id:"<?php echo $uid; ?>"},dataType:"text",success:function(b){$("#DTHLoadMoreBtnRow").remove();if(b!=""){$("#dth_load_data_table").append(b)}else{$("#CustomersDthOrdersLoadMore").html("No Data")}}})})});  
</script>