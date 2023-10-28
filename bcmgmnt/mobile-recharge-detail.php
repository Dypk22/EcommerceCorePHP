<?php
require '../connection.php';
   $OrdersActive="yes";
	echo "<base href='".ADMIN_SITE_PATH.'mobile-recharge-detail'."'></base>";
 require 'header.php';
	$orders_details=mysqli_fetch_assoc(mysqli_query($con,'select * from mobile_recharge_orders where transaction_id="'.$_GET['txn'].'"'));
	$customer_details=mysqli_fetch_assoc(mysqli_query($con,'select * from users where id="'.$orders_details['user_id'].'"'));
 ?>
            <main>
                <div class="container-fluid">
                    <h2 class="mt-30 page-title">Recharge Order Details</h2>
                    <ol class="breadcrumb mb-30">
                        <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH.'orders'; ?>">Orders</a></li>
                        <li class="breadcrumb-item active">Mobile Recharge Order Details</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card card-static-2 mb-30">
                                <div class="card-title-2">
                                    <span class="order-id">Order Id : <?php echo $orders_details['transaction_id']; ?></span>
                                </div>
                                <div class="invoice-content">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="ordr-date">
                                            	<b>Customer Details</b><br>
                                                User Id : <b><?php echo $customer_details['id']; ?></b><br>
                                                Name : <b class="text-capitalize"><a href="<?php echo ADMIN_SITE_PATH.'customer/'.$customer_details['id']; ?>"><?php echo $customer_details['name']; ?></a></b><br>
                                                Mobile : <b>+91<?php echo $customer_details['mobile']; ?></b><br>
                                                E-Mail : <b><?php echo ucfirst($customer_details['email']); ?></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="ordr-date right-text">
                                                <b>Order Details</b><br>
                                                Order Date : <b><?php echo date('d M, y', strtotime($orders_details['date'])); ?></b><br>
                                                Payment Method : <b><?php echo ucfirst($orders_details['payment_method']); ?></b><br>
                                                Operator Refernce Id : <b><?php echo ucfirst($orders_details['operator_reference_id']); ?></b>,<br>
                                                Recharge Status : <b><?php echo ucfirst($orders_details['status']); ?></b>,<br>
                                                Operator Status : <b><?php echo ucfirst($orders_details['operator_status']); ?></b>,<br>
                                                Recharge Validty : <b class="text-capitalize"><?php echo ($orders_details['validity']=='0 days')?'custom':$orders_details['validity']; ?></b>                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card card-static-2 mb-30 mt-30">
                                                <div class="card-title-2">
                                                    <h4>Order Description</h4>
                                                </div>
                                                <div class="card-body-table">
                                                    <div class="table-responsive">
                                                        <table class="table ucp-table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:130px">#</th>
                                                                    <th>Description</th>
                                                                    <th style="width:100px" class="text-center">Total
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Recharge For <b>+91<?php echo $orders_details['mobile']; ?></b></td>
                                                                    <td class="text-center">₹<?php echo $orders_details['amount']; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-5">
                                            <div class="order-total-dt">
                                                <div class="order-total-left-text">
                                                    Sub Total
                                                </div>
                                                <div class="order-total-right-text">
                                                    <small class="rupeeIcon">₹</small><?php echo $orders_details['amount']; ?>
                                                </div>
                                            </div>
                                            <div class="order-total-dt">
                                                <div class="order-total-left-text">
                                                    Coupon Use
                                                </div>
                                                <div class="text-uppercase order-total-right-text">
                                                    <?php echo ($orders_details['coupon']!='')?$orders_details['coupon']:'-'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
<?php 
 require 'footer.php';
 ?>