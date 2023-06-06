<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 May 2023 07:36:52 GMT -->
<head>
        <meta charset="utf-8" />
        <title><?= isset($title)? $title.' - ' : 'Title -' ?> <?= $this->general_settings['application_name']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/adminto/images/favicon.ico">
        <link rel="stylesheet" href="<?= base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <link href="<?= base_url() ?>assets/adminto/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/adminto/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/adminto/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/adminto/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/adminto/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->

		<link href="<?= base_url() ?>assets/adminto/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

		<!-- icons -->
		<link href="<?= base_url() ?>assets/adminto/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- <script src="<?= base_url(); ?>assets/adminto/libs/jquery/jquery.min.js"></script> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Sweet alert -->
        <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/sweetalert2.min.css">

    </head>

    <!-- body start -->
    <body class="loading" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" 
    data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="dark" 
    data-leftbar-size='default' data-sidebar-user='true'>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                    <ul class="list-unstyled topnav-menu float-end mb-0">

    
                        <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
            
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <?php if($this->session->userdata('username') == 'superadmin' || $this->session->userdata('username')=='kasubid3' ){ ?>
                                    <img src="<?= base_url('assets/dist/img/avatar-laki.png') ?>" class="rounded-circle" alt="user-img">
                                <?php }else{?>
                                    <img src="<?= base_url('assets/dist/img/avatar-hijab.png') ?>" class="rounded-circle" alt="user-img">
                                <?php } ?>
                                <span class="pro-user-name ms-1">
                                <?= ucwords($this->session->userdata('name_user')); ?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <a href="<?= base_url('admin/auth/logout') ?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index-2.html" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="<?= base_url('assets/img/BKAD_Logo SP2D Online putih.png'); ?>" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('assets/img/BKAD_Logo SP2D Online putih.png'); ?>" alt="" height="50">
                            </span>
                        </a>
                        <a href="index-2.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <!-- <img src="<?= base_url() ?>assets/adminto/images/logo-sm.png" alt="" height="22"> -->
                                <img src="<?= base_url($this->general_settings['favicon']); ?>"alt="Logo" height="50">
                            </span>
                            <span class="logo-lg">
                                <!-- <img src="<?= base_url() ?>assets/adminto/images/logo-dark.png" alt="" height="16"> -->
                                <img src="<?= base_url($this->general_settings['favicon']); ?>"alt="Logo" height="50">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                        <li>
                            <button class="button-menu-mobile disable-btn waves-effect">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
    
                        <li>
                            <h4 class="page-title-main"><?= isset($title)? $title: '' ?></h4>
                        </li>
            
                    </ul>

                    <div class="clearfix"></div> 
               
            </div>
            <!-- end Topbar -->
            <?php if(!isset($sidebar)): ?>

<?php $this->load->view('includes/_sidebar'); ?>

<?php endif; ?>