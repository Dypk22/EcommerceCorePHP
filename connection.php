<?php
   session_start();
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'recharge');
   $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
   define('SITE_PATH','http://localhost/recharge/');
   if(!isset($_COOKIE['v12i43s45i6566t'])){
   	setCookie('v12i43s45i6566t','yes',time()+(60*60*24*365));
   	mysqli_query($con,"update visitors set total_visits=total_visits+1");
   }
   define('SITE_NAME','BillIncharge');
   define('SITE_ADD1', 'Block C, Sushant Lok');
   define('SITE_ADD2', 'Sector 43, Near Super Mart I');
   define('SITE_ADD3', 'Gurugram, Haryana');
   define('SITE_ADD4', 'PIN : 122022');
   define('SITE_EMAIL', 'care@'.strtolower(SITE_NAME).'.com');
   define('SITE_MOBILE', '+919632587415');
   define('ADMIN_NAME', 'Mamta Nawani');
   // your sendgrid api key
   define( 'SENDGRID_API_KEY', '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' );
   // from email address
   define( 'FROM_EMAIL', 'nganesh101@gmail.com' );
   // from name
   define( 'FROM_NAME', SITE_NAME.' Inc' );
   if (isset($_SESSION['USER_LOGIN'])) {
   // to email address
   define( 'TO_EMAIL', $_SESSION['USER_EMAIL'] );
   // to name of user you are sending the email to
   // define( 'TO_NAME', $_SESSION['USER_NAME'] );
   }   
   define('CUSTOMERCAREMAIL', 'nganesh101@gmail.com');
   

   //adminn panel code
   define('ADMIN_SITE_PATH', SITE_PATH.'bcmgmnt/');
   define('RechargeApi', '2a60cd-fb0ce1-80e1eb-20264a-b4529a');
   $RechargeApi='2a60cd-fb0ce1-80e1eb-20264a-b4529a';
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.kwikapi.com/api/v2/balance.php?api_key='.$RechargeApi,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res=(array)json_decode($response);
    // $recharge_api_balance=$res['response']->balance;  
    $recharge_api_balance=10000;
    define('recharge_api_balance', $recharge_api_balance);
    define('per_row_records', '30');
    define('refer_code_discount', '10');
    
   ?>
   