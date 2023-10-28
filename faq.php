<?php require 'connection.php'; $faq_active='active'; $title='FAQs - '.SITE_NAME; require'header.php'; ?><style>#preloader{display: none;}#back-to-top{padding-top: 8px;}</style><section class="page-header page-header-text-light bg-secondary"> <div class="container"> <div class="row align-items-center"> <div class="col-md-8"> <h1>FAQ</h1> </div><div class="col-md-4"> <ul class="breadcrumb justify-content-start justify-content-md-end mb-0"> <li><a href="<?php echo SITE_PATH; ?>">Home</a></li><li class="active">FAQ</li></ul> </div></div></div></section><div id="content"> <div class="container"> <div class="bg-light shadow-md rounded p-4"> <h3 class="text-6">Get answers to your queries</h3> <hr> <div class="row"> <div class="col-md-3"> <h3 class="text-5 font-weight-400">Recharge & Bill</h3> </div><div class="col-md-9"> <div class="accordion accordion-alternate" id="accordion"> <div class="card"> <div class="card-header" id="heading1"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1">Recharge not done but my money deducted.</a> </h5> </div><div id="faq1" class="collapse" aria-labelledby="heading1" data-parent="#accordion"> <div class="card-body">Recharge is pretty easy & in most cases, benefits are updated in your recharged number almost instantaneously. However, in certain scenarios, your recharge may take longer than usual. This usually happens when we are not able to get a confirmation of payment from your bank OR not able to get the status of your recharge from the telecom operator. <br>For orders (processed from Bank via Cards, Net banking or UPI) where the payment confirmation from the bank is not received promptly, your order will reach the ‘Payment is Pending’ stage where we await the final payment confirmation from your bank. To further the process, we keep following up with the respective bank for the next 72 hours. <br><strong>Note:</strong> More that 99.9% of these transactions are cleared within 24 hours itself </div></div></div><div class="card"> <div class="card-header" id="heading2"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2">I was recharging and got this message: ‘Pending State’</a> </h5> </div><div id="faq2" class="collapse" aria-labelledby="heading2" data-parent="#accordion"> <div class="card-body">Once an order is forwarded to the operator, we awaits the final status from the operator to confirm the status of your order. In rare scenarios, your operator may not confirm the final status of the order to us immediately. In such cases, we continue to follow up with your operator for 24 hours. For cases where final confirmation of the order is not received even after 24 hours, we escalate the case to the operator in order to receive the final status. <br>Be rest assured that in each of the cases, your money is safe and will be rolled back to you if your recharge fails. </div></div></div><div class="card"> <div class="card-header" id="heading4"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4">I recharged on a wrong number.</a> </h5> </div><div id="faq4" class="collapse" aria-labelledby="heading4" data-parent="#accordion"> <div class="card-body">A recharge order once placed cannot be cancelled. We recommend checking the number once before the recharge.</div></div></div></div></div></div><hr> <div class="row"> <div class="col-md-3"> <h3 class="text-5 font-weight-400">Payments</h3> </div><div class="col-md-9"> <div class="accordion accordion-alternate" id="accordionPayments"> <div class="card"> <div class="card-header" id="heading9"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq9" aria-expanded="false" aria-controls="faq9">How do I pay?</a> </h5> </div><div id="faq9" class="collapse" aria-labelledby="heading9" data-parent="#accordionPayments"> <div class="card-body">Mobile phones are an intrinsic part of our lives and with association, so is online mobile recharge. You can now carry out your prepaid online recharge and bill payments for any number, for your friends and family using our platform. Online recharges can be done through Net Banking, Debit Card, Credit Card, Visa or Mastercard and wallet. HDFC, SBI, CITI & ICICI banks and a host of other banks support Net Banking online recharge with ease.</div></div></div><div class="card"> <div class="card-header" id="heading12"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq12" aria-expanded="false" aria-controls="faq12">Are there any hidden charges (Octroi or Tax)? </a> </h5> </div><div id="faq12" class="collapse" aria-labelledby="heading12" data-parent="#accordionPayments"> <div class="card-body">No Extra Charges on your Mobile Recharge. We enables free online recharge i.e there are no charges for any operator online recharge. We never charged our customers any extra fee for using the platform to recharge their mobile number.</div></div></div></div></div></div><hr> <div class="row"> <div class="col-md-3"> <h3 class="text-5 font-weight-400">My Account</h3> </div><div class="col-md-9"> <div class="accordion accordion-alternate" id="accordionAccount"> <div class="card"> <div class="card-header" id="heading13"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq13" aria-expanded="false" aria-controls="faq13">Is there any registration fee?</a> </h5> </div><div id="faq13" class="collapse" aria-labelledby="heading13" data-parent="#accordionAccount"> <div class="card-body">No, we don't charge for using our service to anybody at any given time.</div></div></div><div class="card"> <div class="card-header" id="heading14"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq14" aria-expanded="false" aria-controls="faq14">Is my account information safe?</a> </h5> </div><div id="faq14" class="collapse" aria-labelledby="heading14" data-parent="#accordionAccount"> <div class="card-body">As the discussion about user data privacy is heating up across the board, we want to take this opportunity to assure you that your data is absolutely safe. Your account details are 100% secure when you use our platform, and we’ll do everything it takes to ensure it stays that way.</div></div></div><div class="card"> <div class="card-header" id="heading16"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq16" aria-expanded="false" aria-controls="faq16">I did not receive the cashback</a> </h5> </div><div id="faq16" class="collapse" aria-labelledby="heading16" data-parent="#accordionAccount"> <div class="card-body">Generally, cashback gets credited in the wallet instantly. In rare cases, cashback might get delayed for one or more items due to multiple reasons including technical delay due to heavy load on the app etc. However, even in these cases, cashback gets processed into the customer's wallet within 24 hours. We advise our users to wait for atleast 24 hours for the cashback amount to reflect in your Wallet.</div></div></div><div class="card"> <div class="card-header" id="heading17"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq17" aria-expanded="false" aria-controls="faq17">Forgot my password! What next?</a> </h5> </div><div id="faq17" class="collapse" aria-labelledby="heading17" data-parent="#accordionAccount"> <div class="card-body"> If you’ve forgotten your Paytm password and you want to reset it, here’s what you should do: <ul> <li><a href="<?php echo SITE_PATH.'forget-password'; ?>" target="_blank()">Click Here</a> to proceed. </li><li>Enter your registered E-Mail or Mobile Number</li><li>You'll receive a password reset email to your registered E-Mail Id</li><li>Enter new password and Voila! Your password is reset.</li><li>Login to enjoy recharging and pay billing.</li></ul> If you've any query then you can <a href="<?php echo SITE_PATH.'support'; ?>">contact us</a>. We're love to hear you! </div></div></div><div class="card"> <div class="card-header" id="heading18"> <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#faq18" aria-expanded="false" aria-controls="faq18">Closing Your Account</a> </h5> </div><div id="faq18" class="collapse" aria-labelledby="heading18" data-parent="#accordionAccount"> <div class="card-body">Our intention is to serve you with the best. Having said that,it is disheartening to see you go. However, we are here to help you out with any of the concerns faced by you. If you want to close your account, be sure you do not have any balance. <br>In case, if you have balance, Use the balance by transacting on any service. <br>After that you can raise account closure request. We will verify the request and close your account. </div></div></div></div></div></div><hr> <div class="text-center my-3 my-md-5"> <p class="text-4 mb-3">Can't find what you're looking for? Our customer care team are here to help</p><a href="<?php echo SITE_PATH.'support'; ?>" class="btn btn-primary">Contact Customer Care</a> </div></div></div></div><?php require 'footer.php'; ?>