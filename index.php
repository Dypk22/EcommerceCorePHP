<?php require 'connection.php'; 
   $home_active='active'; 
   $title='Online Mobile Recharge &amp; Bill Payments - '.SITE_NAME; 
   require 'header.php'; 
   if (isset($_SESSION['rechOperator'])){
      unset($_SESSION['rechOperator']);
   }
   if (isset($_SESSION['rechOperatorType'])){
   unset($_SESSION['rechOperatorType']);
   } 
    ?>
      <div id="content">
         <section class="container" id="makeRecharge">
            <div class="row mt-4">
               <div class="col-md-12 col-lg-10">
                  <div id="verticalTab">
                     <div class="row no-gutters">
                        <div class="col-md-3 my-0 my-md-4">
                           <ul class="resp-tabs-list">
                              <li><span><i class="fas fa-mobile-alt"></i></span> <label class="pointer">Mobile</label></li>
                              <li><span><i class="fas fa-tv"></i></span> <label class="pointer">DTH</label></li>
                              <li onclick="noService()"><span><i class="fas fa-credit-card"></i></span><label class="pointer" onclick="noService()"> DataCard</label></li>
                              <li onclick="noService()"><span><i class="fas fa-wifi"></i></span><label class="pointer" onclick="noService()"> Broadband</label></li>
                              <li onclick="noService()"><span><i class="fas fa-phone"></i></span><label class="pointer" onclick="noService()"> Landline</label></li>
                              <li onclick="noService()"><span><i class="fas fa-lightbulb"></i></span><label class="pointer" onclick="noService()"> Electricity</label></li>
                              <li onclick="noService()"><span><i class="fas fa-subway"></i></span><label class="pointer" onclick="noService()"> Metro</label></li>
                              <li onclick="noService()"><span><i class="fas fa-flask"></i></span><label class="pointer" onclick="noService()"> Gas</label></li>
                              <li onclick="noService()"><span><i class="fas fa-tint"></i></span><label class="pointer" onclick="noService()"> Water</label></li>
                           </ul>
                        </div>
                        <div class="col-md-9 BorderCol">
                           <div class="resp-tabs-container bg-white shadow-md rounded h-100 p-3">
                              <div>
                                 <h2 class="text-6 mb-4">Mobile Recharge or Bill Payment</h2>
                                 <form id="proceedRecharge" method="post" action="proceed/recharge">
                                    <div class="mb-3">
                                       <div class="custom-control custom-radio custom-control-inline"> <input id="prepaid" name="operator_type" class="custom-control-input" value="prepaid" checked="" type="radio"> <label class="custom-control-label" for="prepaid">Prepaid</label> </div>
                                       <div class="custom-control custom-radio custom-control-inline"> <input id="postpaid" name="operator_type" class="custom-control-input" value="postpaid" type="radio"> <label class="custom-control-label" for="postpaid">Postpaid</label> </div>
                                    </div>
                                    <div class="form-group"> <label for="mobile">Mobile Number</label> <input class="form-control" type="number" data-bv-field="number" onchange="fetchOPerator(value)" min="0" name="mobile" id="mobile" placeholder="Enter Mobile Number"> </div>
                                    <div class="row">
                                       <div class="form-group col-lg-7 pr-auto pr-lg-0">
                                          <label for="operator">Mobile Operator</label> 
                                          <select class="custom-select" id="operator" style="min-height: 50px !important;" onchange="resetOperatorValue(value)" name="operator" title="Mobile Operator">
                                             <option value="">Operator</option>
                                             <option value="bharti airtel ltd">Airtel</option>
                                             <option value="reliance jio infocomm ltd (rjil)">Reliance Jio</option>
                                             <option value="vodafone idea ltd (formerly idea cellular ltd)">Vodafone Idea</option>
                                             <option value="mahanagar telephone nigam ltd (mtnl)">MTNL</option>
                                             <option value="bharat sanchar nigam ltd (bsnl)">BSNL</option>
                                          </select>
                                       </div>
                                       <div class="form-group col-lg-5">
                                          <label for="circle">Mobile Circle</label> 
                                          <select class="custom-select" id="circle" style="min-height: 50px !important;" name="circle" title="Mobile Operator Circle">
                                             <option value="">Circle</option>
                                             <option value="delhi">Delhi</option>
                                             <option value="uttar pradesh (east)">Uttar Pradesh (East)</option>
                                             <option value="uttar pradesh (west)">Uttar Pradesh (West)</option>
                                             <option value="andhra pradesh">Andhra Pradesh</option>
                                             <option value="assam">Assam</option>
                                             <option value="bihar">Bihar</option>
                                             <option value="gujarat">Gujarat</option>
                                             <option value="haryana">Haryana</option>
                                             <option value="himachal pradesh">Himachal Pradesh</option>
                                             <option value="jammu and kashmir">Jammu & Kashmir</option>
                                             <option value="karnataka">Karnataka</option>
                                             <option value="kerala">Kerala</option>
                                             <option value="kolkata">Kolkata</option>
                                             <option value="madhya pradesh">Madhya Pradesh</option>
                                             <option value="maharashtra">Maharashtra</option>
                                             <option value="odisha">Odisha</option>
                                             <option value="rajasthan">Rajasthan</option>
                                             <option value="tamil nadu">Tamil Nadu</option>
                                             <option value="west bengal">West Bengal</option>
                                             <option value="punjab">Punjab</option>
                                             <option value="jharkhand">Jharkhand</option>
                                             <option value="chhattisgarh">Chhattisgarh</option>
                                             <option value="goa">Goa</option>
                                             <option value="mizoram">Mizoram</option>
                                             <option value="meghalaya">Meghalaya</option>
                                             <option value="sikkim">Sikkim</option>
                                             <option value="tripura">Tripura</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="amount">Mobile Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <a href="javascript:void(0)" data-target="#view-plans" style="display: none;" id="show_view_plans" onclick="recharge_plan()" data-toggle="modal" class="view-plans-link">View Plans</a> <input class="form-control" id="amount" title="Recharge Plan" name="amount" placeholder="Enter Amount" min="1" type="number"> 
                                       </div>
                                    </div>
                                    <input type="hidden" name="recharge_time" value="<?php echo time(); ?>"> <input type="hidden" name="billerType" value="prepaid_recharge"> <button class="btn btn-primary btn-block" id="rechargeBtn1" type="submit">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">DTH Recharge</h2>
                                 <form id="dthRechargeBill" method="post" action="proceed/recharge">
                                    <div class="form-group">
                                       <label for="DTHoperator">Your Operator</label> 
                                       <select class="custom-select" name="DTHoperator" id="DTHoperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="airtel">Airtel Dth</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="cardNumber">Your Card Number</label> <input type="text" class="form-control" data-bv-field="number" name="cardNumber" id="cardNumber" required placeholder="Enter Your Card Number"> </div>
                                    <div class="form-group">
                                       <label for="DTHamount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="DTHamount" name="DTHamount" placeholder="Enter Amount" required min="1" type="number"> 
                                       </div>
                                    </div>
                                    <input type="hidden" name="recharge_time" value="<?php echo time(); ?>"> <input type="hidden" name="billerType" value="dth_recharge"> <button class="btn btn-primary btn-block" id="btnSubmitdthRechargeBill" type="submit">Continue to Procced</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">DataCard Recharge or Bill Payment</h2>
                                 <form id="datacardRechargeBill" method="post">
                                    <div class="mb-3">
                                       <div class="custom-control custom-radio custom-control-inline"> <input id="datacardPrepaid" name="datacardPayment" class="custom-control-input" checked="" required type="radio"> <label class="custom-control-label" for="datacardPrepaid">Prepaid</label> </div>
                                       <div class="custom-control custom-radio custom-control-inline"> <input id="datacardPostpaid" name="datacardPayment" class="custom-control-input" required type="radio"> <label class="custom-control-label" for="datacardPostpaid">Postpaid</label> </div>
                                    </div>
                                    <div class="form-group"> <label for="dataCardNumber">DataCard Number</label> <input type="text" class="form-control" data-bv-field="number" id="dataCardNumber" required placeholder="Enter DataCard Number"> </div>
                                    <div class="form-group">
                                       <label for="dataCardOperator">Your Operator</label> 
                                       <select id="dataCardOperator" class="custom-select" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="dataCardamount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="dataCardamount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitdatacardRechargeBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">Pay your Broadbanad Bill</h2>
                                 <form id="broadbanadBill" method="post">
                                    <div class="form-group">
                                       <label for="broadbanadOperator">Your Operator</label> 
                                       <select class="custom-select" id="broadbanadOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="broadbanadID">Broadbanad Id</label> <input type="text" class="form-control" data-bv-field="number" id="broadbanadID" required placeholder="Enter Your Broadbanad Id"> </div>
                                    <div class="form-group">
                                       <label for="broadbanadamount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="broadbanadamount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitbroadbanadBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">Pay your Landline Bill</h2>
                                 <form id="landlineBill" method="post">
                                    <div class="form-group">
                                       <label for="landlineOperator">Your Operator</label> 
                                       <select class="custom-select" id="landlineOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="telephoneNumber">Telephone Number</label> <input type="text" class="form-control" data-bv-field="number" id="telephoneNumber" required placeholder="Enter Telephone Number"> </div>
                                    <div class="form-group">
                                       <label for="landlineAmount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="landlineAmount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitlandlineBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <!-- <div> <h2 class="text-6 mb-4">CableTv Recharge or Bill Payment</h2> <form id="cableTvRechargeBill" method="post"> <div class="form-group"> <label for="cableTvoperator">Your Operator</label> <select class="custom-select" id="cableTvoperator" required=""> <option value="">Select Your Operator</option> <option value="">Not Available</option> </select> </div><div class="form-group"> <label for="accountNumber">Your Operator</label> <input type="text" class="form-control" data-bv-field="number" id="accountNumber" required placeholder="Enter Account Number"> </div><div class="form-group"> <label for="cableTvamount">Amount</label> <div class="input-group"> <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div><input class="form-control" id="cableTvamount" placeholder="Enter Amount" required type="text"> </div></div><button class="btn btn-primary btn-block" id="btnSubmitcableTvRechargeBill" type="button">Continue to Recharge</button> </form> </div>--> 
                              <div>
                                 <h2 class="text-6 mb-4">Pay your Electricity Bill</h2>
                                 <form id="electricityBill" method="post">
                                    <div class="form-group">
                                       <label for="electricityOperator">Your Operator</label> 
                                       <select class="custom-select" id="electricityOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="electricityyourState">Your State</label> 
                                       <select class="custom-select" id="electricityyourState" required="">
                                          <option value="">Select Your State</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="serviceNumber">Your Service Number</label> <input type="text" class="form-control" data-bv-field="number" id="serviceNumber" required placeholder="Enter Service Number"> </div>
                                    <div class="form-group">
                                       <label for="electricityAmount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="electricityAmount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitelectricityBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">Metro Card Recharge</h2>
                                 <form id="metroCardRecharge" method="post">
                                    <div class="form-group">
                                       <label for="metroOperator">Your Operator</label> 
                                       <select class="custom-select" id="metroOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="metroCardNumber">Your Card Number</label> <input type="text" class="form-control" data-bv-field="number" id="metroCardNumber" required placeholder="Enter Card Number"> </div>
                                    <div class="form-group">
                                       <label for="metroAmount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="metroAmount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitmetroCardRecharge" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">Pay Your Gas Bill</h2>
                                 <form id="gasBill" method="post">
                                    <div class="form-group">
                                       <label for="gasOperator">Your Operator</label> 
                                       <select class="custom-select" id="gasOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="gasConsumerNumber">Consumer Number</label> <input type="text" class="form-control" data-bv-field="number" id="gasConsumerNumber" required placeholder="Enter Consumer Number"> </div>
                                    <div class="form-group">
                                       <label for="gasAmount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="gasAmount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitgasBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                              <div>
                                 <h2 class="text-6 mb-4">Pay Your Water Bill</h2>
                                 <form id="waterBill" method="post">
                                    <div class="form-group">
                                       <label for="waterOperator">Your Operator</label> 
                                       <select class="custom-select" id="waterOperator" required="">
                                          <option value="">Select Your Operator</option>
                                          <option value="">Not Available</option>
                                       </select>
                                    </div>
                                    <div class="form-group"> <label for="waterConsumerNumber">Consumer Number</label> <input type="text" class="form-control" data-bv-field="number" id="waterConsumerNumber" required placeholder="Enter Consumer Number"> </div>
                                    <div class="form-group">
                                       <label for="waterAmount">Amount</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend"> <span class="input-group-text">₹</span> </div>
                                          <input class="form-control" id="waterAmount" placeholder="Enter Amount" required type="text"> 
                                       </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="btnSubmitwaterBill" type="button">Continue to Recharge</button> 
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="px-md-0 col-lg-2 mt-4 mt-lg-0">
                  <div class="row mx-1 mx-md-auto">
                     <div class="col-6 col-lg-12 text-center"> <a href="refer-n-earn"><img src="images/slider/small-banner-9.jpg" alt="Refer And Earn - <?php echo SITE_NAME; ?>" title="Refer And Earn - <?php echo SITE_NAME; ?>" class="img-fluid rounded shadow-md"></a> </div>
                     <div class="col-6 col-lg-12 mt-lg-3 text-center"> <a href="offer/detail/get-upto-50-rupee-cashback-on-recharge"><img src="images/slider/small-banner-8.jpg" alt="Get upto ₹50 Off - <?php echo SITE_NAME; ?>" title="Get upto ₹50 Off - <?php echo SITE_NAME; ?>" class="img-fluid rounded shadow-md"></a> </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
<?php require 'footer.php'; ?>