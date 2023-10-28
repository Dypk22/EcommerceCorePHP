<?php 
   if(!isset($_SESSION['ADMIN_LOGIN'])){header('Location:'.ADMIN_SITE_PATH.'login');}
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="../images/favicon.png" rel="icon" />
      <title><?php echo SITE_NAME; ?> Admin</title>
      <link href="css/styles.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/admin-style.css" rel="stylesheet">
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
      <meta name="robots" content="noindex">
      <meta name="googlebot" content="noindex">
      <?php if (isset($extra_meta_tags) && $extra_meta_tags!=''){echo $extra_meta_tags;} ?>
   </head>
   <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
         <a class="navbar-brand logo-brand" href="<?php echo ADMIN_SITE_PATH; ?>"><?php echo SITE_NAME; ?></a>
         <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
         <a href="<?php echo SITE_PATH; ?>" class="frnt-link" target="_blank()"><i class="fas fa-home"></i>Home</a>
         <ul class="navbar-nav ml-auto mr-md-0">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <span class="d-none d-md-block">Hey <?php echo ucfirst($_SESSION['ADMIN_NAME']); ?></span></a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item admin-dropdown-item" href="<?php echo ADMIN_SITE_PATH.'profile'; ?>">Edit Profile</a>
                  <a class="dropdown-item admin-dropdown-item" href="<?php echo ADMIN_SITE_PATH.'admin-logout'; ?>">Logout</a>
               </div>
            </li>
         </ul>
      </nav>
      <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
               <div class="nav">
                  <a class="nav-link <?php echo (isset($DashboardActive))?'active':''; ?>" href="<?php echo ADMIN_SITE_PATH.'profile'; ?>">
                     <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Dashboard
                  </a>
                  <a class="nav-link <?php echo (isset($OrdersActive))?'active':''; ?>" href="orders">
                     <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                     Orders
                  </a>
                  <a class="nav-link <?php echo (isset($CustomersActive))?'active':''; ?>" href="customers">
                     <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                     Customers
                  </a>
                  <a class="nav-link <?php echo (isset($DamActive))?'active':''; ?>" href="direct-add-money">
                     <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                     Direct Add Money
                  </a>
                  <a class="nav-link collapsed pointer <?php echo (isset($AirtelActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                     <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                     Airtel
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="airtel-plans">All Plans</a>
                        <a class="nav-link sub_nav_link" href="add-airtel-plans">Add New Plans</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed pointer <?php echo (isset($JioActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
                     <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                     Jio
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseLocations" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="jio-plans">All Plans</a>
                        <a class="nav-link sub_nav_link" href="add-jio-plans">Add New Plan</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed pointer <?php echo (isset($ViActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseAreas" aria-expanded="false" aria-controls="collapseAreas">
                     <div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div>
                     VI
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseAreas" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="vi-plans">All Plans</a>
                        <a class="nav-link sub_nav_link" href="add-vi-plans">Add New Plans</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed pointer <?php echo (isset($BsnlActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                     <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                     BSNL
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseCategories" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="bsnl-plans">All Plans</a>
                        <a class="nav-link sub_nav_link" href="add-bsnl-plans">Add New Plans</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed pointer <?php echo (isset($CouponActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseCoupon" aria-expanded="false" aria-controls="collapseCoupon">
                     <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                     Coupon
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseCoupon" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="coupons">All Coupon</a>
                        <a class="nav-link sub_nav_link" href="add-coupons">Add New Coupon</a>
                     </nav>
                  </div>
                  <a class="nav-link collapsed pointer <?php echo (isset($OffersActive))?'active':''; ?>" data-toggle="collapse" data-target="#collapseOffers" aria-expanded="false" aria-controls="collapseOffers">
                     <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                     Offers
                     <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseOffers" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                     <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link sub_nav_link" href="offer">All Offers</a>
                        <a class="nav-link sub_nav_link" href="add-offer">Add New Offers</a>
                     </nav>
                  </div>
               </div>
            </div>
         </nav>
      </div>
      <div id="layoutSidenav_content">