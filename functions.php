<?php 
   function prx($arr){echo '<pre>';print_r($arr);die();}
   
   function get_safe_value($con,$str){if($str!=''){$str=trim($str);return strip_tags(mysqli_real_escape_string($con,$str));
      }
   }
   
   function send_mobile_sms($msg, $mobile_number)
   {
       //8882959139=jDM9oN2kwG476zqPutHYR5QyKeFALshCXJx8f0VIpiU3vOdWZTJOFCKL3ZVlw4byoNuse2zWtfMmApD6
       //8470083628=gijhTkwxu7zZBaR4HodQrEVebqm1JK23vc96NSnAWUlpC5FOLfiu2kMUgFsCh3EJWyrpjQoRxlPD64V5
       $curl = curl_init();
       curl_setopt_array($curl, array(
         CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=gijhTkwxu7zZBaR4HodQrEVebqm1JK23vc96NSnAWUlpC5FOLfiu2kMUgFsCh3EJWyrpjQoRxlPD64V5&message=".urlencode($msg)."&language=english&route=v3&numbers=".urlencode($mobile_number),
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
           "cache-control: no-cache"
         ),
       ));
       $response = curl_exec($curl);
       $err = curl_error($curl);
   
       curl_close($curl);
   
       if ($err) {
         echo "cURL Error #:" . $err;
       }
       else {
         echo "done";
       }
   }
   
   //using sendgrid
   function send_reset_password_email($Toemail, $Toname)
   {
      $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      $query=mysqli_fetch_assoc(mysqli_query($con,"select token from users where name='$Toname' and email='$Toemail'"));
      $token=$query['token'];
      $subject='Password Reset ';
      $html='
         <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
         <html data-editor-version="2" class="sg-campaigns" xmlns="http://www.w3.org/1999/xhtml">
            <head>
               <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
               <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
               <!--[if !mso]><!-->
               <meta http-equiv="X-UA-Compatible" content="IE=Edge">
               <!--<![endif]-->
               <!--[if (gte mso 9)|(IE)]>
               <xml>
                  <o:OfficeDocumentSettings>
                     <o:AllowPNG/>
                     <o:PixelsPerInch>96</o:PixelsPerInch>
                  </o:OfficeDocumentSettings>
               </xml>
               <![endif]-->
               <!--[if (gte mso 9)|(IE)]>
               <style type="text/css">
                  body {width: 600px;margin: 0 auto;}
                  table {border-collapse: collapse;}
                  table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
                  img {-ms-interpolation-mode: bicubic;}
               </style>
               <![endif]-->
               <style type="text/css">
                  body, p, div {
                  font-family: inherit;
                  font-size: 14px;
                  }
                  body {
                  color: #000000;
                  }
                  body a {
                  color: #1188E6;
                  text-decoration: none;
                  }
                  p { margin: 0; padding: 0; }
                  table.wrapper {
                  width:100% !important;
                  table-layout: fixed;
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: 100%;
                  -moz-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
                  }
                  img.max-width {
                  max-width: 100% !important;
                  }
                  .column.of-2 {
                  width: 50%;
                  }
                  .column.of-3 {
                  width: 33.333%;
                  }
                  .column.of-4 {
                  width: 25%;
                  }
                  @media screen and (max-width:480px) {
                  .preheader .rightColumnContent,
                  .footer .rightColumnContent {
                  text-align: left !important;
                  }
                  .preheader .rightColumnContent div,
                  .preheader .rightColumnContent span,
                  .footer .rightColumnContent div,
                  .footer .rightColumnContent span {
                  text-align: left !important;
                  }
                  .preheader .rightColumnContent,
                  .preheader .leftColumnContent {
                  font-size: 80% !important;
                  padding: 5px 0;
                  }
                  table.wrapper-mobile {
                  width: 100% !important;
                  table-layout: fixed;
                  }
                  img.max-width {
                  height: auto !important;
                  max-width: 100% !important;
                  }
                  a.bulletproof-button {
                  display: block !important;
                  width: auto !important;
                  font-size: 80%;
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                  }
                  .columns {
                  width: 100% !important;
                  }
                  .column {
                  display: block !important;
                  width: 100% !important;
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                  margin-left: 0 !important;
                  margin-right: 0 !important;
                  }
                  }
               </style>
               <!--user entered Head Start-->
               <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
               <style>
                  body {font-family: \'Muli\', sans-serif;}
               </style>
               <!--End Head user entered-->
            </head>
            <body>
               <center class="wrapper" data-link-color="#1188E6" data-body-style="font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;">
                  <div class="webkit">
                     <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#FFFFFF">
                        <tbody>
                           <tr>
                              <td valign="top" bgcolor="#FFFFFF" width="100%">
                                 <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                       <tr>
                                          <td width="100%">
                                             <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                   <tr>
                                                      <td>
                                                         <!--[if mso]>
                                                         <center>
                                                            <table>
                                                               <tr>
                                                                  <td width="600">
                                                                     <![endif]-->
                                                                     <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px;" align="center">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td role="modules-container" style="padding:0px 0px 0px 0px; color:#000000; text-align:left;" bgcolor="#FFFFFF" width="100%" align="left">
                                                                                 <table class="module preheader preheader-hide" role="module" data-type="preheader" border="0" cellpadding="0" cellspacing="0" width="100%" style="display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;">
                                                                                    <tbody>
                                                                                       <tr>
                                                                                          <td role="module-content">
                                                                                             <p></p>
                                                                                          </td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                                 <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" role="module" data-type="columns" style="padding:0px 20px 30px 20px;" bgcolor="#f6f6f6">
                                                                                    <tbody>
                                                                                       <tr role="module-content">
                                                                                          <td height="100%" valign="top">
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="27716fe9-ee64-4a64-94f9-a4f28bc172a0">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 30px 0px;" role="module-content" bgcolor="">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="948e3f3f-5214-4721-a90e-625a47b1c957" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:50px 30px 18px 30px; line-height:36px; text-align:inherit; background-color:#ffffff;" height="100%" valign="top" bgcolor="#ffffff" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="font-size: 43px">Account Verification&nbsp;
                                                                                                               </span>
                                                                                                            </div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="a10dcb57-ad22-4f4d-b765-1d427dfddb4e" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:18px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;" height="100%" valign="top" bgcolor="#ffffff" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="font-size: 18px">Hi <span style="text-transform: capitalize;">'.$Toname.'</span>, Please click the link given below to reset your password and</span><span style="color: #000000; font-size: 18px; font-family: arial,helvetica,sans-serif"> get exclusive offers & discounts</span><span style="font-size: 18px">.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffbe00; font-size: 18px"><strong>Thank you!&nbsp;</strong></span></div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="7770fdab-634a-4f62-a277-1c66b2646d8d">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 20px 0px;" role="module-content" bgcolor="#ffffff">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="d050540f-4672-4f31-80d9-b395dc08abe1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td align="center" bgcolor="#ffffff" class="outer-td" style="padding:0px 0px 0px 0px;">
                                                                                                         <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                                            <tbody>
                                                                                                               <tr>
                                                                                                                  <td align="center" bgcolor="#ffbe00" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;">
                                                                                                                     <a href="'.SITE_PATH.'reset/token/'.$token.'" style="background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:5px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;" target="_blank">Click Here</a>
                                                                                                                  </td>
                                                                                                               </tr>
                                                                                                            </tbody>
                                                                                                         </table>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="7770fdab-634a-4f62-a277-1c66b2646d8d.1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 50px 0px;" role="module-content" bgcolor="#ffffff">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="a265ebb9-ab9c-43e8-9009-54d6151b1600" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:50px 30px 50px 30px; line-height:22px; text-align:inherit; background-color:#6e6e6e;" height="100%" valign="top" bgcolor="#6e6e6e" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px"><strong>Here’s what happens next:</strong></span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px">1.Get information related to your orders and payments through SMS and email.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px">2.If you forget your password, we send a verification detail to your mobile number/email.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px">3. Get personalized offers and discounts.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffbe00; font-size: 18px"><strong>+ much more!</strong></span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px">Need support? Our support team is always</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 18px">ready to help!&nbsp;</span></div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="d050540f-4672-4f31-80d9-b395dc08abe1.1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td align="center" bgcolor="#6e6e6e" class="outer-td" style="padding:0px 0px 0px 0px;">
                                                                                                         <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                                            <tbody>
                                                                                                               <tr>
                                                                                                                  <td align="center" bgcolor="#ffbe00" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;">
                                                                                                                     <a href="mailto:care@grocy.com" style="background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;">Contact Support</a>
                                                                                                                  </td>
                                                                                                               </tr>
                                                                                                            </tbody>
                                                                                                         </table>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="c37cc5b7-79f4-4ac8-b825-9645974c984e">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 30px 0px;" role="module-content" bgcolor="6E6E6E">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                          </td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                              </td>
                                                                           </tr>
                                                                        </tbody>
                                                                     </table>
                                                                     <div data-role="module-unsubscribe" class="module" role="module" data-type="unsubscribe" style="color:#444444; font-size:14px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;" data-muid="4e838cf3-9892-4a6d-94d6-170e474d21e5">
                                                                        <div class="Unsubscribe--addressLine">
                                                                           <p class="Unsubscribe--senderName" style="font-size:14px; line-height:20px;">Grocy - Online Groccery Delivery Service</p>
                                                                           <p style="font-size:14px; line-height:20px;"><span class="Unsubscribe--senderAddress">Pathri</span>, <span class="Unsubscribe--senderCity">Haridwar</span>, <span class="Unsubscribe--senderState">Uttarakhand</span> <span class="Unsubscribe--senderZip">249405</span></p>
                                                                        </div>
                                                                        <p style="font-size:14px; line-height:20px;"><a class="Unsubscribe--unsubscribeLink" href="#" target="_blank" style="">Unsubscribe</a></p>
                                                                     </div>
                                                                     <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="550f60a9-c478-496c-b705-077cf7b1ba9a">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td align="center" bgcolor="" class="outer-td" style="padding:0px 0px 20px 0px;">
                                                                                 <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                    <tbody>
                                                                                       <tr>
                                                                                          <td align="center" bgcolor="#f5f8fd" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;"><a href="" style="background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;"></td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                              </td>
                                                                           </tr>
                                                                        </tbody>
                                                                     </table>
                                                                  </td>
                                                               </tr>
                                                               </tbody>
                                                            </table>
                                                            <!--[if mso]>
                                                      </td>
                                                   </tr>
                                             </table>
                                             </center>
                                             <![endif]-->
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     </td>
                     </tr>
                     </tbody></table>
                  </div>
               </center>
            </body>
         </html>
      ';
      // require composer autoload so we can use sendgrid
      require 'sendgrid/vendor/autoload.php';
      // create new sendgrid mail
      $email = new \SendGrid\Mail\Mail(); 
      // specify the email/name of where the email is coming from
      $email->setFrom( FROM_EMAIL, FROM_NAME );   
      // set the email subject line
      $email->setSubject( $subject );   
      // specify the email/name we are sending the email to
      $email->addTo( $Toemail, $Toname );   
      // add our email body content
      $email->addContent( "text/plain", "and easy to do anywhere, even with PHP" );
      $email->addContent(
          "text/html", $html
      );   
      // create new sendgrid
      $sendgrid = new \SendGrid( SENDGRID_API_KEY );
      try {
         // try and send the email
          $response = $sendgrid->send( $email );
          // echo "done";
          // print out response data
          // print $response->statusCode() . "\n";
          // print_r( $response->headers() );
          // print $response->body() . "\n";
      } catch ( Exception $e ) {
         // something went wrong so display the error message
          // echo 'Caught exception: '. $e->getMessage() ."\n";
      }
   }
   
   function contactUs($name, $email, $subject, $mobile, $message)
   {
      $RegisterName=(isset($_SESSION['USER_NAME']))? $_SESSION['USER_NAME'].' & User Id : '.$_SESSION['USER_ID'] : "If Any";
      $html='Name : '.$name.' ( Register Name : '.ucfirst($RegisterName).' )<br />Email : '.$email.' <br />Mobile Number : '.$mobile.'<br />Subject : '.ucfirst($subject).' <br />Message : '.$message;   
      // require composer autoload so we can use sendgrid
      require 'sendgrid/vendor/autoload.php';   
      // create new sendgrid mail
      $email = new \SendGrid\Mail\Mail();    
      // specify the email/name of where the email is coming from
      $email->setFrom( FROM_EMAIL, FROM_NAME );   
      // set the email subject line
      $email->setSubject( 'Mail from '.SITE_NAME.' contact form' );   
      // specify the email/name we are sending the email to
      $email->addTo( CUSTOMERCAREMAIL, $name );   
      // add our email body content
      $email->addContent( "text/plain", "and easy to do anywhere, even with PHP" );
      $email->addContent(
          "text/html", $html
      );   
      // create new sendgrid
      $sendgrid = new \SendGrid( SENDGRID_API_KEY );   
      try {
         // try and send the email
          $response = $sendgrid->send( $email );
          // echo "done";
          // print out response data
          // print $response->statusCode() . "\n";
          // print_r( $response->headers() );
          // print $response->body() . "\n";
      } catch ( Exception $e ) {
         // something went wrong so display the error message
          // echo 'Caught exception: '. $e->getMessage() ."\n";
      }
   }
   
   function secure_random_string($length) {
       $random_string = '';
       for($i = 0; $i < $length; $i++) {
           $number = random_int(0, 36);
           $character = base_convert($number, 10, 36);
           $random_string .= $character;
       }
    
       return $random_string;
   }
   
   function orderConfirmEmail($recharge_status,$recharge_amount,$recharge_number,$operator,$recharge_type,$transaction_id,$operator_reference_id,$order_date,$subject,$operatorStatus)
   {
      $addEmbeddedImageVar='';
      $to=$_SESSION['USER_EMAIL'];
      $subject=$subject.' - '.SITE_NAME;
      $html='
         <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" type="text/css">
         <html xmlns="http://www.w3.org/1999/xhtml">
         <style type="text/css">
         *{font-family: \'Poppins\', sans-serif;}
         @media only screen and (max-width: 600px) {
         table[class="contenttable"] {
            width: 320px !important;
            border-width: 3px!important;
         }
         table[class="tablefull"] {
            width: 100% !important;
         }
         table[class="tablefull"] + table[class="tablefull"] td {
            padding-top: 0px !important;
         }
         table td[class="tablepadding"] {
            padding: 15px !important;
         }
         }
         </style>
         </head>
         <body style="margin:0; border: none; background:#f5f7f8">
         <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
           <tr>
             <td align="center" valign="top"><table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#ffffff" style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family: \'Poppins\', sans-serif;">
                 <tr>
                   <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                       <tbody>
                         <tr>
                           <td width="100%" height="30" style="padding:25px 15px; line-height:14px; font-size:14px; color:#808080; text-align:center; display: none;">This transaction has been successfully processed. Below are the transaction details:</td>
                         </tr>
                       </tbody>
                     </table></td>
                 </tr>
                 <tr>
                   <td style="padding:25px 20px 0px 20px;"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                       <tbody>
                         <tr>
                           <td style="border:4px solid #eee; border-radius:4px; padding:25px 0px;"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                               <tbody>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; padding:0px 25px;"><img alt="" src="cid:mobile"></td>
                                   <td style="font-size:14px; font-weight:600; color:#777; line-height:26px; padding-right:20px;">The '.$operator.' '.$recharge_type.' recharge payment of <span style="color:#000;">₹'.$recharge_amount.'</span> for Mobile No. <span style="color:#000;">+91'.$recharge_number.'</span> is <span style="color:#28a745;">'.$operatorStatus.'!</span></td>
                                 </tr>
                               </tbody>
                             </table></td>
                         </tr>
                         <tr>
                           <td style="padding:25px 0px; line-height:28px; font-size:11px; color:#808080; text-align:center;">This transaction has been successfully processed. Below are the transaction details:</td>
                         </tr>
                         <tr>
                           <td><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                               <tbody>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-top: 1px solid #eaebed; border-bottom: 1px solid #eaebed; color:#808080">Mobile No.</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-top: 1px solid #eaebed; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">+91'.$recharge_number.'</td>
                                 </tr>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Operator</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold; text-transform: capitalize;" valign="top" align="right">'.$operator.'</td>
                                 </tr>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Category</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold; text-transform: capitalize;" valign="top" align="right">'.$recharge_type.'</td>
                                 </tr>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Transaction Date</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">'.date('M d, Y', strtotime($order_date)).'</td>
                                 </tr>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Reference ID</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold; text-transform: capitalize;" valign="top" align="right">'.$operator_reference_id.'</td>
                                 </tr>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Transaction ID</td>
                                   <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">'.$transaction_id.'</td>
                                 </tr>
                               </tbody>
                             </table></td>
                         </tr>
                       </tbody>
                     </table></td>
                 </tr>
                 <tr>
                   <td style="padding:20px 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0">
                       <tbody>
                         <tr>
                           <td style="background-color:#efefef; border-radius:4px; padding:25px 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                               <tbody>
                                 <tr>
                                   <td style="font-size:14px; line-height:20px; color:#404040; font-weight: bold;">Total Payment</td>
                                   <td style="font-size:16px; line-height:20px; color: #404040; font-weight: bold;" valign="top" align="right">&nbsp;&nbsp;₹'.$recharge_amount.'.00</td>
                                 </tr>
                               </tbody>
                             </table></td>
                         </tr>
                       </tbody>
                     </table></td>
                 </tr>
                 <tr>
                   <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:\'Poppins\', sans-serif;">
                       <tbody>
                         <tr>
                           <td class="tablepadding" align="center" style="font-size:10px; line-height:32px; padding:5px 20px 34px 20px;"> Any Questions? Get in touch with our 24x7 Customer Care team.<br />
                             <a href="#" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:10px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">Contact Us</a></td>
                         </tr>
                         <tr> </tr>
                       </tbody>
                     </table></td>
                 </tr>
               </table></td>
           </tr>
           <tr>
             <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#777777; font-family:\'Poppins\', sans-serif">
                 <tbody>
                   <tr>
                     <td class="tablepadding" style="padding:20px 0; border-collapse:collapse"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:10px;color:#777777; font-family:\'Poppins\', sans-serif">
                         <tbody>
                           <tr>
                             <td align="center" class="tablepadding" style="line-height:20px; padding:20px;"> Quickai Template, 2705 N. Enterprise St
                               Orange, CA 92865.</td>
                           </tr>
                         </tbody>
                       </table>
                       <table align="center">
                         <tr>
                           <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:facebook" width="32" height="32" alt=""></a></td>
                           <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:twitter" width="32" height="32" alt=""></a></td>
                           <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:google_plus" width="32" height="32" alt=""></a></td>
                           <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:pinterest" width="32" height="32" alt=""></a></td>
                         </tr>
                       </table>
                       <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:10px;color:#777777; font-family:\'Poppins\', sans-serif">
                         <tbody>
                           <tr>
                             <td class="tablepadding" align="center" style="line-height:20px; padding-top:10px; padding-bottom:20px;">Copyright &copy; 2019 Quickai. All Rights Reserved. </td>
                           </tr>
                         </tbody>
                       </table></td>
                   </tr>
                 </tbody>
               </table></td>
           </tr>
         </table>
         </body>
         </html>
      ';
      $addEmbeddedImageVar=array('images/facebook.png' => 'facebook', 'images/twitter.png' => 'twitter', 'images/pinterest.png' => 'pinterest', 'images/google_plus.png' => 'google_plus', 'images/mobile-successful.png' => 'mobile');
      echo phpmailer_send_mail($_SESSION['USER_EMAIL'], $subject, $html, $addEmbeddedImageVar);
   } 

   function send_otp_mail($otp,$useremail,$name)
   {  
      $subject='User E-Mail Verification';
      $html='
         <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
         <html data-editor-version="2" class="sg-campaigns" xmlns="http://www.w3.org/1999/xhtml">
            <head>
               <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
               <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
               <!--[if !mso]><!-->
               <meta http-equiv="X-UA-Compatible" content="IE=Edge">
               <!--<![endif]-->
               <!--[if (gte mso 9)|(IE)]>
               <xml>
                  <o:OfficeDocumentSettings>
                     <o:AllowPNG/>
                     <o:PixelsPerInch>96</o:PixelsPerInch>
                  </o:OfficeDocumentSettings>
               </xml>
               <![endif]-->
               <!--[if (gte mso 9)|(IE)]>
               <style type="text/css">
                  body {width: 600px;margin: 0 auto;}
                  table {border-collapse: collapse;}
                  table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
                  img {-ms-interpolation-mode: bicubic;}
               </style>
               <![endif]-->
               <style type="text/css">
                  body, p, div {
                  font-family: inherit;
                  font-size: 14px;
                  }
                  body {
                  color: #000000;
                  }
                  body a {
                  color: #1188E6;
                  text-decoration: none;
                  }
                  p { margin: 0; padding: 0; }
                  table.wrapper {
                  width:100% !important;
                  table-layout: fixed;
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: 100%;
                  -moz-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
                  }
                  img.max-width {
                  max-width: 100% !important;
                  }
                  .column.of-2 {
                  width: 50%;
                  }
                  .column.of-3 {
                  width: 33.333%;
                  }
                  .column.of-4 {
                  width: 25%;
                  }
                  @media screen and (max-width:480px) {
                  .preheader .rightColumnContent,
                  .footer .rightColumnContent {
                  text-align: left !important;
                  }
                  .preheader .rightColumnContent div,
                  .preheader .rightColumnContent span,
                  .footer .rightColumnContent div,
                  .footer .rightColumnContent span {
                  text-align: left !important;
                  }
                  .preheader .rightColumnContent,
                  .preheader .leftColumnContent {
                  font-size: 80% !important;
                  padding: 5px 0;
                  }
                  table.wrapper-mobile {
                  width: 100% !important;
                  table-layout: fixed;
                  }
                  img.max-width {
                  height: auto !important;
                  max-width: 100% !important;
                  }
                  a.bulletproof-button {
                  display: block !important;
                  width: auto !important;
                  font-size: 80%;
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                  }
                  .columns {
                  width: 100% !important;
                  }
                  .column {
                  display: block !important;
                  width: 100% !important;
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                  margin-left: 0 !important;
                  margin-right: 0 !important;
                  }
                  }
               </style>
               <!--user entered Head Start-->
               <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
               <style>
                  body {font-family: \'Muli\', sans-serif;}
               </style>
               <!--End Head user entered-->
            </head>
            <body>
               <center class="wrapper" data-link-color="#1188E6" data-body-style="font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;">
                  <div class="webkit">
                     <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#FFFFFF">
                        <tbody>
                           <tr>
                              <td valign="top" bgcolor="#FFFFFF" width="100%">
                                 <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                       <tr>
                                          <td width="100%">
                                             <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                   <tr>
                                                      <td>
                                                         <!--[if mso]>
                                                         <center>
                                                            <table>
                                                               <tr>
                                                                  <td width="600">
                                                                     <![endif]-->
                                                                     <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px;" align="center">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td role="modules-container" style="padding:0px 0px 0px 0px; color:#000000; text-align:left;" bgcolor="#FFFFFF" width="100%" align="left">
                                                                                 <table class="module preheader preheader-hide" role="module" data-type="preheader" border="0" cellpadding="0" cellspacing="0" width="100%" style="display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;">
                                                                                    <tbody>
                                                                                       <tr>
                                                                                          <td role="module-content">
                                                                                             <p></p>
                                                                                          </td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                                 <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" role="module" data-type="columns" style="padding:0px 20px 30px 20px;" bgcolor="#f6f6f6">
                                                                                    <tbody>
                                                                                       <tr role="module-content">
                                                                                          <td height="100%" valign="top">
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="27716fe9-ee64-4a64-94f9-a4f28bc172a0">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 30px 0px;" role="module-content" bgcolor="">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="948e3f3f-5214-4721-a90e-625a47b1c957" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:50px 30px 18px 20px; line-height:24px; text-align:inherit; background-color:#ffffff;" height="100%" valign="top" bgcolor="#ffffff" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center;"><span style="font-size: 30px">Account Verification&nbsp;
                                                                                                               </span>
                                                                                                            </div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="a10dcb57-ad22-4f4d-b765-1d427dfddb4e" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:18px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;" height="100%" valign="top" bgcolor="#ffffff" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="font-size: 16px">Hi <span style="text-transform: capitalize;">'.$name.'</span>, Please enter the OTP given below to verify your account and</span><span style="color: #000000; font-size: 16px; font-family: arial,helvetica,sans-serif"> get exclusive offers & discounts</span><span style="font-size: 16px">.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #0071cc; font-size: 16px"><strong>Thank you!&nbsp;</strong></span></div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="7770fdab-634a-4f62-a277-1c66b2646d8d">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 20px 0px;" role="module-content" bgcolor="#ffffff">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="d050540f-4672-4f31-80d9-b395dc08abe1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td align="center" bgcolor="#ffffff" class="outer-td" style="padding:0px 0px 0px 0px;">
                                                                                                         <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                                            <tbody>
                                                                                                               <tr>
                                                                                                                  <td align="center" bgcolor="#0071cc" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;">
                                                                                                                     <a style="background-color:#0071cc; border:1px solid #0071cc; border-color:#0071cc; border-radius:5px; border-width:1px; color:#fff; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:5px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;">'.$otp.'</a>
                                                                                                                  </td>
                                                                                                               </tr>
                                                                                                            </tbody>
                                                                                                         </table>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="7770fdab-634a-4f62-a277-1c66b2646d8d.1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 50px 0px;" role="module-content" bgcolor="#ffffff">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="a265ebb9-ab9c-43e8-9009-54d6151b1600" data-mc-module-version="2019-10-22">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:50px 30px 50px 30px; line-height:22px; text-align:inherit; background-color:#6e6e6e;" height="100%" valign="top" bgcolor="#6e6e6e" role="module-content">
                                                                                                         <div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px"><strong>Here’s what happens next:</strong></span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px">1.Get information related to your orders and payments through SMS and email.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px">2.If you forget your password, we send a verification detail to your mobile number/email.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px">3. Get personalized offers and discounts.</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #fff; font-size: 16px"><strong>+ much more!</strong></span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><br></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px">Need support? Our support team is always</span></div>
                                                                                                            <div style="font-family: inherit; text-align: center"><span style="color: #ffffff; font-size: 16px">ready to help!&nbsp;</span></div>
                                                                                                            <div></div>
                                                                                                         </div>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="d050540f-4672-4f31-80d9-b395dc08abe1.1">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td align="center" bgcolor="#6e6e6e" class="outer-td" style="padding:0px 0px 0px 0px;">
                                                                                                         <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                                            <tbody>
                                                                                                               <tr>
                                                                                                                  <td align="center" bgcolor="#0071cc" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;">
                                                                                                                     <a href="mailto:care@grocy.com" style="background-color:#0071cc; border:1px solid #0071cc; border-color:#0071cc; border-radius:5px; border-width:1px; color:#fff; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;">Contact Support</a>
                                                                                                                  </td>
                                                                                                               </tr>
                                                                                                            </tbody>
                                                                                                         </table>
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                             <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="c37cc5b7-79f4-4ac8-b825-9645974c984e">
                                                                                                <tbody>
                                                                                                   <tr>
                                                                                                      <td style="padding:0px 0px 30px 0px;" role="module-content" bgcolor="6E6E6E">
                                                                                                      </td>
                                                                                                   </tr>
                                                                                                </tbody>
                                                                                             </table>
                                                                                          </td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                              </td>
                                                                           </tr>
                                                                        </tbody>
                                                                     </table>
                                                                     <table style="margin-top:30px;" align="center">
                                                                      <tr>
                                                                        <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:facebook" width="32" height="32" alt=""></a></td>
                                                                        <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:twitter" width="32" height="32" alt=""></a></td>
                                                                        <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:google_plus" width="32" height="32" alt=""></a></td>
                                                                        <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="cid:pinterest" width="32" height="32" alt=""></a></td>
                                                                      </tr>
                                                                    </table>
                                                                     <div data-role="module-unsubscribe" class="module" role="module" data-type="unsubscribe" style="color:#444444; font-size:14px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;" data-muid="4e838cf3-9892-4a6d-94d6-170e474d21e5">
                                                                        <div class="Unsubscribe--addressLine">
                                                                           <p class="Unsubscribe--senderName" style="font-size:14px; line-height:20px;">Grocy - Online Groccery Delivery Service</p>
                                                                           <p style="font-size:14px; line-height:20px;"><span class="Unsubscribe--senderAddress">Pathri</span>, <span class="Unsubscribe--senderCity">Haridwar</span>, <span class="Unsubscribe--senderState">Uttarakhand</span> <span class="Unsubscribe--senderZip">249405</span></p>
                                                                        </div>
                                                                        <p style="font-size:14px; line-height:20px;"><a class="Unsubscribe--unsubscribeLink" href="#" target="_blank" style="">Unsubscribe</a></p>
                                                                     </div>
                                                                     <table border="0" cellpadding="0" cellspacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed;" width="100%" data-muid="550f60a9-c478-496c-b705-077cf7b1ba9a">
                                                                        <tbody>
                                                                           <tr>
                                                                              <td align="center" bgcolor="" class="outer-td" style="padding:0px 0px 20px 0px;">
                                                                                 <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" style="text-align:center;">
                                                                                    <tbody>
                                                                                       <tr>
                                                                                          <td align="center" bgcolor="#f5f8fd" class="inner-td" style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;"><a href="" style="background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;"></td>
                                                                                       </tr>
                                                                                    </tbody>
                                                                                 </table>
                                                                              </td>
                                                                           </tr>
                                                                        </tbody>
                                                                     </table>
                                                                  </td>
                                                               </tr>
                                                               </tbody>
                                                            </table>
                                                            <!--[if mso]>
                                                      </td>
                                                   </tr>
                                             </table>
                                             </center>
                                             <![endif]-->
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     </td>
                     </tr>
                     </tbody></table>
                  </div>
               </center>
            </body>
         </html>
      ';
      $addEmbeddedImageVar=array('images/facebook.png' => 'facebook', 'images/twitter.png' => 'twitter', 'images/pinterest.png' => 'pinterest', 'images/google_plus.png' => 'google_plus');
      phpmailer_send_mail($useremail, $subject, $html, $addEmbeddedImageVar);

   }
/*
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\STMP;
   use PHPMailer\PHPMailer\Exception;
   require 'mailer/vendor/autoload.php';

*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'smtp/src/Exception.php';
require 'smtp/src/PHPMailer.php';
require 'smtp/src/SMTP.php';

   function phpmailer_send_mail($to,$subject, $msg, $addEmbeddedImageVar){
      $mail = new PHPMailer(); 
      // $mail->SMTPDebug=3;
      $mail->IsSMTP(); 
      $mail->Host = "smtp.gmail.com";
      // $mail->Username = "nganesh101@gmail.com";
      // $mail->Password = 'Dypk@2020';

      $mail->Username = "nganesh101@gmail.com";
      $mail->Password = "lzpuqirrveajupwd";// 'Dypk@2020';
      $mail->SMTPSecure = 'ssl'; 
      $mail->Port = "465"; 

      $mail->SMTPAuth = true; 
      // $mail->Port = "587"; 
      // $mail->SMTPSecure = 'tls'; 
      $mail->IsHTML(true);
      $mail->setFrom("nganesh101@gmail.com");
      if (isset($addEmbeddedImageVar)) {
         foreach ($addEmbeddedImageVar as $key => $value) {
            $mail->addEmbeddedImage($key, $value);
         }
      }
      $mail->Subject = $subject;
      $mail->Body =$msg;
      $mail->AddAddress($to);
      $mail->Send();
      // if($mail->Send()){
      //    echo 'Sent';
      // }else{
      //    echo $mail->ErrorInfo;
      // }
   } 


   // function phpmailer_send_mail($to,$subject, $msg, $addEmbeddedImageVar){

      // $mail = new PHPMailer(true); 
      // $mail->IsSMTP(); 
      // $mail->Host = "smtp.gmail.com";
      // $mail->SMTPAuth = true; 
      // $mail->Username = "nganesh101@gmail.com";
      // $mail->Password = "lzpuqirrveajupwd";// 'Dypk@2020';
      // $mail->SMTPSecure = 'ssl'; 
      // $mail->Port = "465"; 
      // $mail->IsHTML(true);
      // $mail->setFrom("nganesh101@gmail.com");
      // $mail->Subject = $subject;
      // $mail->Body =$msg;
      // $mail->AddAddress($to);
      // $mail->Send();
      // if($mail->Send()){
      //  echo 1;
      // }

   // }
?>