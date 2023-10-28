      <footer id="footer">
         <div class="container">
            <div class="footer-copyright">
               <ul class="nav justify-content-center">
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($about_active))? $about_active:''; ?>" href="about">About</a> </li>
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($faq_active))? $faq_active:''; ?>" href="faq">Faq</a> </li>
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($contact_active))? $contact_active:''; ?>" href="contact">Contact</a> </li>
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($support_active))? $support_active:''; ?>" href="support">Support</a> </li>
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($term_active))? $term_active:''; ?>" href="terms">Terms of Use</a> </li>
                  <li class="nav-item"> <a class="nav-link <?php echo (isset($privacy_active))? $privacy_active:''; ?>" href="privacy">Privacy Policy</a> </li>
               </ul>
               <p class="copyright-text">Copyright © 2020-<?php echo date('Y'); ?> <a href="<?php echo SITE_PATH; ?>"><?php echo SITE_NAME; ?></a>. All Rights Reserved.</p>
            </div>
         </div>
      </footer>
      </div><a id="back-to-top" title="Back to Top" class="pointer"><i class="fa fa-chevron-up"></i></a> 
      <div id="view-plans" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Browse Plans</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
               </div>
               <div class="modal-body">
                  <form class="form-row mb-4 mb-sm-2" id="set_recharge_modal" method="post">
                     <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-group">
                           <select class="custom-select bg-light-1" disabled="" name="recharge_plan_operator" id="recharge_plan_operator">
                              <option value="">Operator</option>
                              <option value="bharti airtel ltd">Airtel</option>
                              <option value="reliance jio infocomm ltd (rjil)">Reliance Jio</option>
                              <option value="vodafone idea ltd (formerly idea cellular ltd)">Vodafone Idea</option>
                              <option value="bharat sanchar nigam ltd (bsnl)">BSNL</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-group">
                           <select class="custom-select" name="recharge_plan_type" id="recharge_plan_type">
                              <option value="">All Plans</option>
                              <option value="truly unlimited">Truly Unlimited</option>
                              <option value="1.5gb/day">1.5GB</option>
                              <option value="2gb/day">2GB</option>
                              <option value="3gb/day">3GB</option>
                              <option value="smart recharge">Smart Recharge</option>
                              <option value="data">Data</option>
                              <option value="talktime">Talktime</option>
                              <option value="international roaming">International Roaming</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-lg-3"> <button class="btn btn-primary btn-block" type="button" onclick="submit_recharge_plan()">View Plans</button> </div>
                  </form>
                  <div class="plans">
                     <div class="table-responsive-md">
                        <table class="table table-hover border">
                           <tbody id="show_recharge_plan"> </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="coming-soon" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-sm-3">
               <div class="modal-body">
                  <div class="tab-content pt-4">
                     <div class="tab-pane fade show active">
                        <div class="form-group"> <img src="https://images-eu.ssl-images-amazon.com/images/I/41Y25S2JlYL._SY300_SX300_QL70_FMwebp_.jpg" class="d-flex mx-auto"> </div>
                        <button class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close" type="button">Coming Soon</button> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="no-service" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Attention Users!</h3>
                        <p class="text-center text-3 text-muted">Currently we're only accepting Prepaid Mobile & DTH Recharges and expanding our network. <br>You'll be notified when this service are once started ASAP... </p>
                        <button class="btn btn-primary btn-block my-4" data-dismiss="modal" aria-label="Close" type="button">Continue</button> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="login-modal" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 active">Login</a> </li>
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 pointer" data-toggle="modal" data-target="#signup-modal" data-dismiss="modal">Sign Up</a> </li>
                        </ul>
                        <p class="text-4 font-weight-300 text-muted text-center mb-4">We are glad to see you again!</p>
                        <form id="loginForm" method="post">
                           <div class="form-group"> <input type="email" class="form-control" id="loginemail" value="<?php echo (isset($_COOKIE['u32323s3223e54442rtrtr'])) ? base64_decode($_COOKIE['u32323s3223e54442rtrtr']) : '' ; ?>" required placeholder="Mobile or Email"> <label id="login_name_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="loginemail"></label> </div>
                           <div class="form-group"> <input type="password" class="form-control" id="loginpassword" required value="<?php echo (isset($_COOKIE['p323s7934w0340343df043'])) ? base64_decode($_COOKIE['p323s7934w0340343df043']) : '' ; ?>" placeholder="Password"> <label id="login_password_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="loginpassword"></label> </div>
                           <div class="row my-4">
                              <div class="col">
                                 <div class="form-check text-2 custom-control custom-checkbox"> <input id="rememberme" <?php echo (isset($_COOKIE['u32323s3223e54442rtrtr'])) ? 'checked=""' : '' ; ?> name="remember" value="yes" class="custom-control-input" type="checkbox"> <label class="custom-control-label" for="rememberme">Remember Me</label> </div>
                              </div>
                              <div class="col text-2 text-right"><a class="btn-link pointer" data-toggle="modal" data-dismiss="modal" data-target="#forgot-password-modal">Forgot Password ?</a></div>
                           </div>
                           <?php if (isset($_SESSION["msg"])){?> 
                           <div id="login_error_msg" class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert"> <strong>Alert!</strong> <?php echo $_SESSION["msg"]; ?> </div>
                           <?php } ?> <button class="btn btn-primary btn-block mb-4" id="loginBtn" type="button" onclick="siginin('login')">Login</button> 
                        </form>
                        <p class="text-2 text-center mb-0">New to <?php echo SITE_NAME; ?>? <a class="btn-link" href="" data-toggle="modal" data-target="#signup-modal" data-dismiss="modal">Sign Up</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="signup-modal" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 pointer" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">Log In</a> </li>
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 active">Sign Up</a> </li>
                        </ul>
                        <p class="text-4 font-weight-300 text-muted text-center mb-4">Looks like you're new here!</p>
                        <form id="signupForm" method="post">
                           <div class="form-group"> <input type="text" class="form-control border-2" id="reg_name" placeholder="Your Name"> <label id="reg_name_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_name"></label> </div>
                           <div class="form-group"> <input type="email" class="form-control border-2" id="reg_email" placeholder="Email Id"> <label id="reg_email_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_email"></label> </div>
                           <div class="form-group"> <input type="number" class="form-control border-2" id="reg_mobile" placeholder="mobile"> <label id="reg_mobile_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_mobile"></label> </div>
                           <div class="form-group"> <input type="password" class="form-control border-2" id="reg_password" placeholder="Password"> <label id="reg_password_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_password"></label> </div>
                           <div class="form-group my-4">
                              <div class="form-check text-2 custom-control custom-checkbox"> <input id="agree" name="agree" value="agree" class="custom-control-input" type="checkbox"> <label class="custom-control-label" for="agree">I agree to the <a href="terms">Terms</a> and <a href="privacy">Privacy Policy</a>.</label> </div>
                              <label id="tnc_error" style="display: none;" class="error text-primary mx-1" for="tnc">Please accept our Terms & Conditions*</label> 
                           </div>
                           <input type="hidden" id="refered_by" value=""> 
                           <button class="btn btn-primary btn-block my-4" type="button" id="RegisterUserBtn" onclick="submitRegisterForm()">Sign Up</button> 
                        </form>
                        <p class="text-2 text-center mb-0">Already have an account? <a class="btn-link" href="" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">Log In</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="forgot-password-modal" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Forgot your password?</h3>
                        <p class="text-center text-3 text-muted">Enter your Email or Mobile <br>we’ll help you reset your password.</p>
                        <form id="forgotForm" class="form-border" method="post">
                           <div class="form-group"> <input type="text" class="form-control border-2" id="forgetEmail" required placeholder="Enter Email or Mobile Number"> </div>
                           <label id="forget_msg" class="error text-danger m-1 text-capitalize" style="position: relative; bottom: 7px; display: none;"></label> <button class="btn btn-primary btn-block mb-4" type="button" onclick="forget_password()">Continue</button> 
                        </form>
                        <p class="text-center mb-0"><a class="btn-link" href="" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">Return to Log In</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="otp-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Two-Step Verification</h3>
                        <p class="text-center"><img class="img-fluid" src="images/otp-icon.png" alt="verification - <?php echo SITE_NAME; ?>"></p>
                        <p class="text-muted text-3 text-center">Please enter the OTP (one time password) to verify your account. A Code has been sent to <span class="text-dark text-4 d-block"><span id="mbn" class="text-lowercase"><?php echo $_SESSION['USER_EMAIL']; ?></span> <span></p>
                        <form id="otp-screen" class="form-border" method="post">
                           <div class="form-row">
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_1" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_2" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_3" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_4" maxlength="1" required autocomplete="off"> </div>
                           </div>
                           <button class="btn btn-primary btn-block shadow-none my-4" id="VerifyUserBtn" onclick="verifyuser()" type="button">Verify</button> 
                        </form>
                        <p class="text-2 text-center">Not received your code? <a class="btn-link" href="javascript:void(0);" onclick="resendOtp()">Resend code</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="not-sufficient-amount-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Attention Dear Customer</h3>
                        <p class="text-center"><img class="img-fluid" src="images/otp-icon.png" alt="verification - <?php echo SITE_NAME; ?>"></p>
                        <p class="text-muted text-3 text-center">We can't accept any order right now since we're under quick ungradation. Please bear with us.</p>
                        <p class="text-2 text-center"><a class="btn-link" href="<?php echo SITE_PATH; ?>">Click here</a> to go back to home</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="not-sufficient-amount-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Attention Dear Customer</h3>
                        <p class="text-center"><img class="img-fluid" src="images/otp-icon.png" alt="verification - <?php echo SITE_NAME; ?>"></p>
                        <p class="text-muted text-3 text-center">We can't accept any pospaid order right now. Please bear with us.</p>
                        <p class="text-2 text-center"><a class="btn-link" href="<?php echo SITE_PATH; ?>">Click here</a> to go back to home</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="no-postpaid-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Attention Dear Customer</h3>
                        <p class="text-center"><img class="img-fluid" src="images/otp-icon.png" alt="verification - <?php echo SITE_NAME; ?>"></p>
                        <p class="text-muted text-3 text-center">We can't accept any pospaid order right now. Please bear with us.</p>
                        <p class="text-2 text-center"><a class="btn-link" href="<?php echo SITE_PATH; ?>">Click here</a> to go back to home</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div><?php if(isset($_SESSION["msg"])){if(time()-$_SESSION["msg_timer"]>1){unset($_SESSION['msg']);unset($_SESSION['msg_timer']);}}?> 
      <script src="vendor/jquery/jquery.validate.js"></script> 
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
      <script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
      <script src="js/theme.js"></script> 
      <script src="js/custom.js"></script> 
      <script src="vendor/easy-responsive-tabs/easy-responsive-tabs.js"></script> 
      <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script> 
      <script>$(document).ready(function (){$('#verticalTab').easyResponsiveTabs({type: 'vertical', /*Types: default, vertical, accordion*/});});</script> 
   </body>
</html>