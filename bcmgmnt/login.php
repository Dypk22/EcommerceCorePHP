<?php 
   require '../connection.php'; 
   require '../functions.php';
   if (isset($_SESSION['ADMIN_USER_LOGIN'])) {header('Location:'.ADMIN_SITE_PATH);} 
   if (isset($_POST['AdminLoginBtn'])) {
   $email=get_safe_value($con,$_POST['AdminLoginEmail']);
   $password=get_safe_value($con,$_POST['AdminLoginPassword']);
   $findEmail=mysqli_query($con, "select * from admins where email='$email'");
   $findPassword=mysqli_query($con, "select * from admins where email='$email' and password='$password'");
   $msg='';
   if (mysqli_num_rows($findEmail)>0) {
	   if (mysqli_num_rows($findPassword)>0) {
		   $res=mysqli_fetch_assoc($findPassword);
         $tmp_name=explode(' ', $res['name']);
		   $_SESSION['ADMIN_ID']=$res['id'];
		   $_SESSION['ADMIN_NAME']=$tmp_name[0];
		   $_SESSION['ADMIN_EMAIL']=$res['email'];
		   $_SESSION['ADMIN_LOGIN']='yes';	
		   header('Location:'.ADMIN_SITE_PATH);
	   }
	   else{
		   $msg="Incorrect Password";
	   }
    }else{
	   $msg="Invalid Account Credential";
	}
   	
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from gambolthemes.net/html-items/gambo_admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Nov 2021 12:54:01 GMT -->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description-gambolthemes" content="">
      <meta name="author-gambolthemes" content="">
      <title><?php echo SITE_NAME; ?> Admin</title>
      <link href="css/styles.css" rel="stylesheet">
      <link href="css/admin-style.css" rel="stylesheet">
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../vendor/sweetalert2/sweetalert2.min.css" />
   </head>
   <body class="bg-sign">
      <div id="layoutAuthentication">
         <div id="layoutAuthentication_content">
            <main>
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                           <div class="card-header card-sign-header">
                              <h3 class="text-center text-primary font-weight-light my-4"><?php echo SITE_NAME; ?> Login</h3>
                           </div>
                           <div class="card-body">
                              <form method="post">
                                 <div class="form-group">
                                    <label class="form-label" for="inputEmailAddress">Email*</label>
                                    <input class="form-control py-4"  required="" name="AdminLoginEmail" type="email" placeholder="Enter email address">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label" for="inputPassword">Password*</label>
                                    <input class="form-control py-4" required="" name="AdminLoginPassword" type="password" placeholder="Enter password">
                                 </div>
                                 <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <button class="py-2 btn btn-sign hover-btn" name="AdminLoginBtn" type="submit">Login</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </main>
         </div>
      </div>
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="js/scripts.js"></script>
	  <script src="../vendor/sweetalert2/sweetalert2.all.min.js"></script>
   </body>
   <?php 
   if ($msg!='') { ?>
	<script type="text/javascript">
		Swal.fire({
			position: "top-end",
			icon: "info",
			title: "<?php echo $msg; ?>!",
			showConfirmButton: false,
			timer: 3000
		});
	</script>
	<?php } ?>
   <!-- Mirrored from gambolthemes.net/html-items/gambo_admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Nov 2021 12:54:01 GMT -->
</html>