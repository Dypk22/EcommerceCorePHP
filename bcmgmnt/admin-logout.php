<?php 
require '../connection.php';
 unset($_SESSION['ADMIN_ID']);
 unset($_SESSION['ADMIN_NAME']);
 unset($_SESSION['ADMIN_EMAIL']);
 unset($_SESSION['ADMIN_LOGIN']);
 header('Location:'.ADMIN_SITE_PATH.'login');
 ?>