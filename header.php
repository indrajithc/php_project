<?php 
session_start();
include_once( 'includes/connection.php' );
include_once( 'includes/functions.php' );
auth_login();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Ration shop management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/font-awesome/css/font-awesome.min.css">
    

    <link rel="stylesheet/less" type="text/css" href="<?php echo PATH; ?>/assets/select2/css/select2.min.css" />


    <link rel="stylesheet/less" type="text/css" href="<?php echo PATH; ?>/assets/datepicker/css/datepicker.css" />


    <link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/cropper.min.css">





    <link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/styles.css">


    <!-- JS Core -->
    <script type="text/javascript" src="<?php echo PATH; ?>/assets/js-core.js"></script>
</head>

<body class="fixed-sidebar">
    <div id="sb-site">
        <div class="page-wrapper">
            <!-- Header -->
            <div id="page-header" class="bg-black font-inverse" >
                <div id="header-logo" class="logo-bg bg-black font-inverse" style=" background: #2d2d2d; ">
                    <img  src="<?php echo PATH; ?>/assets/images/new-ration-logo-500x500.png" >
                </div>  
            </div>


            <style type="text/css">
            #header-logo img {
                max-width: 260px;

            }  
        </style>
        <!-- Sidebar -->
        <div id="page-sidebar" class="bg-black font-inverse">
            <div class="scroll-sidebar">

                <ul id="sidebar-menu">
                    <?php if( user_type() == 'admin' ) : ?>

                        <li class="header"><span>Dashboard</span></li>
                        <li>
                            <a href="<?php echo PATH_ADMIN; ?>" title="Admin Dashboard">
                                <i class="glyph-icon icon-linecons-tv"></i>
                                <span>DASHBOARD</span>
                            </a>
                        </li>


                        <li class="header"><span>Index</span></li>
                        <li>
                            <a href="index.html#" title="Elements">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>DISTRICT</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="<?php echo PATH_ADMIN . '/add_district.php' ?>" title="Buttons"><span>ADD DISTRICT</span></a></li>
                                    <li><a href="<?php echo PATH_ADMIN . '/view_district.php' ?>" title="Buttons"><span>VIEW DISTRICT</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>

                            <a href="index.html#" title="Elements">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>TALUK</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="<?php echo PATH_ADMIN . '/add_taluk.php' ?>" title="Buttons"><span>ADD TALUK</span></a></li>
                                    <li><a href="<?php echo PATH_ADMIN . '/view_taluk.php' ?>" title="Buttons"><span>VIEW TALUK</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="index.html#" title="Elements">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>SHOPS</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="<?php echo PATH_ADMIN . '/add_shop.php' ?>" title="Buttons"><span>ADD SHOP</span></a></li>
                                    <li><a href="<?php echo PATH_ADMIN . '/view_shop.php' ?>" title="Buttons"><span>VIEW SHOP</span></a></li>
                                </ul>
                            </div>
                        </li>
                        
                        
                        <li>
                            <a href="index.html#" title="Elements">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>CUSTOMER</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="<?php echo PATH_ADMIN . '/view_Pcustomer.php' ?>" title="Buttons">
                                        
                                        <span>PENDING</span></a></li>
                                        <li><a href="<?php echo PATH_ADMIN . '/view_customer.php' ?>" title="Buttons"><span>VIEW CUSTOMER</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="index.html#" title="Elements">
                                    <i class="glyph-icon icon-linecons-diamond"></i>
                                    <span>PRODUCT</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li><a href="<?php echo PATH_ADMIN . '/add_product.php'?>" title="Buttons"><span>ADD PRODUCT</span></a></li>
                                        <li><a href="<?php echo PATH_ADMIN . '/view_product.php'?>" title="Buttons"><span>VIEW PRODUCT</span></a></li> 
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="index.html#" title="Elements">
                                    <i class="glyph-icon icon-linecons-diamond"></i>
                                    <span>DISTRIBUTION</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li><a href="<?php echo PATH_ADMIN . '/stock.php'?>" title="Buttons"><span>STOCK</span></a></li>
                                        <li><a href="<?php echo PATH_ADMIN . '/distribution.php'?>" title="Buttons"><span>DISTRIBUTION</span></a></li> 
                                    </ul>
                                </div>
                            </li>



                            <li>
                                <a href="index.html#" title="Elements">
                                    <i class="glyph-icon icon-linecons-diamond"></i>
                                    <span>RATION SHOP</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                       <li><a href="<?php echo PATH_ADMIN . '/shopdistribution.php'?>" title="Buttons"><span>DISTRIBUTION</span></a></li>
                                       <li><a href="<?php echo PATH_ADMIN . '/distribution_history.php'?>" title="Buttons"><span>HISTORY</span></a></li> 
                                   </ul>
                               </div>
                           </li>



                           <li>
                            <a  href="<?php echo PATH_ADMIN . '/remark.php'?>"  title="Admin Dashboard">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>REMARK</span>
                            </a>
                        </li>


                        <li>
                            <a  href="<?php echo PATH_ADMIN . '/view_complaint.php'?>"  title="Admin Dashboard">
                                <i class="glyph-icon icon-linecons-diamond"></i>
                                <span>COMPLAINT</span>
                            </a>
                        </li>



                        <li><a href="<?php echo PATH_ADMIN . '/change_password.php' ?>" title="Buttons">
                            <i class="glyph-icon icon-linecons-diamond"></i><span>CHANGE PASSWORD</span></a></li>

                        <?php endif;?>
                        <?php if( user_type() == 'customer' ) : ?>
                           
                            <style type="text/css">
                            #page-sidebar {
                                width: 210px;
                                float: left;
                                position: relative;
                                margin-right: -100%;
                                z-index: 160;
                            }
                            #header-logo {
                                width: 210px;
                                text-align: center;
                                font-size: 16px;
                                float: left;
                                position: relative;
                            }

                            #header-logo, #page-header {
                                height: 55px;
                            }

                            #page-sidebar, .scroll-sidebar {
                                height: 100%;
                            }

                            #sidebar-menu {
                                margin: 0;
                                padding: 5px 8px;
                                list-style: none;
                            }


                            #page-content {
                                margin-left: 210px;
                            }


                            .badge-black,
                            .bg-black,
                            .btn-black,
                            .hover-black:hover,
                            .label-black {
                                color: #ccc;
                                border-color: #000;
                                background: #201212
                            }

                            .boxed-layout.bg-black {
                                background: #201212
                            }


                            #header-logo img {
                                max-width: 210px; 
                            } 


                        </style>





                        <li class="header"><span>DASHBOARD</span></li>
                        <li>
                            <a href="<?php echo PATH_CUSTOMER; ?>" title="members Dashboard">
                                <i class="glyph-icon icon-linecons-tv"></i>
                                <span>DASHBOARD</span>
                            </a>
                        </li>




                        <li class="header"><span>PROFILE</span></li>
                        <li>
                            <a href="customer_profile.php" title="members Dashboard">
                                <i class="glyph-icon icon-linecons-tv"></i>
                                <span>VIEW PROFILE</span>
                            </a>
                        </li>
                        <li>
                            <a href="member.php" title="members Dashboard">
                                <i class="glyph-icon icon-linecons-tv"></i>
                                <span>VIEW MEMBERS</span>
                            </a>
                        </li>

                        <li>
                            <a href="history.php" title="members History">
                                <i class="glyph-icon icon-linecons-tv"></i>
                                <span>VIEW HISTORY</span>
                            </a>
                        </li>



                        <li>
                          <a  href="<?php echo PATH_CUSTOMER . '/remark.php'?>"  title="Admin Dashboard">
                              <i class="glyph-icon icon-linecons-diamond"></i>
                              <span>REMARK</span>
                          </a>
                      </li>


                      <li>
                        <a  href="<?php echo PATH_CUSTOMER . '/complaint.php'?>"  title="Admin Dashboard">
                            <i class="glyph-icon icon-linecons-diamond"></i>
                            <span>COMPLAINT</span>
                        </a>
                    </li>




                    <li><a href="<?php echo PATH_CUSTOMER . '/changepassword_customer.php' ?>" title="Buttons">
                        <i class="glyph-icon icon-linecons-diamond"></i><span>CHANGE PASSWORD</span></a></li>

                    <?php endif;?>
                    <?php if( user_type() == 'shop' ) : ?>

                        <style type="text/css">
                        
                        .badge-black,
                        .bg-black,
                        .btn-black,
                        .hover-black:hover,
                        .label-black {
                            color: #ccc;
                            border-color: #000;
                            background: #092a2b
                        }

                        .boxed-layout.bg-black {
                            background: #092a2b
                        }



                    </style>





                    <li class="header"><span>DASHBOARD</span></li>
                    <li>
                        <a href="<?php echo PATH_SHOP; ?>" title="Admin Dashboard">
                            <i class="glyph-icon icon-linecons-tv"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>



                    <li>
                        <a href="index.html#" title="Elements">
                            <i class="glyph-icon icon-linecons-diamond"></i>
                            <span>STOCK</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                               <li><a href="<?php echo PATH_SHOP . '/stock.php'?>" title="Buttons"><span>STOCK</span></a></li>
                               <li><a href="<?php echo PATH_SHOP . '/stock_history.php'?>" title="Buttons"><span>HISTORY</span></a></li> 
                           </ul>
                       </div>
                   </li>


                   <li>
                    <a href="index.html#" title="Elements">
                        <i class="glyph-icon icon-linecons-diamond"></i>
                        <span>DISTRIBUTION</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                           <li><a href="<?php echo PATH_SHOP . '/distribution.php'?>" title="Buttons"><span>DISTRIBUTION</span></a></li>
                           <li><a href="<?php echo PATH_SHOP . '/distribution_history.php'?>" title="Buttons"><span>HISTORY</span></a></li> 
                       </ul>
                   </div>
               </li>


               <li>
                <a href="index.html#" title="Elements">
                    <i class="glyph-icon icon-linecons-diamond"></i>
                    <span>CUSTOMER</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                       <li><a href="<?php echo PATH_SHOP . '/customer.php'?>" title="Buttons"><span>CUSTOMERS</span></a></li>
                       <li><a href="<?php echo PATH_SHOP . '/verification.php'?>" title="Buttons"><span>VERIFICATION</span></a></li> 
                   </ul>
               </div>
           </li>


           



           <li><a href="<?php echo PATH_SHOP . '/changepassword_shop.php' ?>" title="Buttons">
            <i class="glyph-icon icon-linecons-diamond"></i><span>CHANGE PASSWORD</span></a></li>



        <?php endif; ?>
        <li>
            <a href=" <?php echo PATH . '/logout.php'; ?>" title="Admin Dashboard">
                <i class="glyph-icon icon-linecons-tv"></i>
                <span>LOGOUT</span>
            </a>
        </li>

    </ul>
</div>
</div>

<!-- main page -->
<div class="page-content-wrapper">
    <div id="page-content">
        <div class="container">





            <style type="text/css">
            
            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                margin: 0; 
            }

            
        </style>

        <?php
        $image_to = null;

        ?>