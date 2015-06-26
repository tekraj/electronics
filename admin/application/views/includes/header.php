<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo link_url; ?>assests/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo link_url; ?>assests/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?php echo link_url; ?>assests/css/plugins/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo link_url; ?>assests/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo link_url; ?>assests/css/plugins/morris.css" rel="stylesheet">

              <!-- Custom Fonts -->
        <link href="<?php echo link_url; ?>assests/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo link_url; ?>assests/js/jquery.js"></script>
        <script src="<?php echo link_url ?>/ckeditor/ckeditor.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=" ">ELECTROSHOP ADMIN </a>
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php echo$_SESSION['user']->fullname; ?> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/electronics/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search interface">
                                <div class="input-group custom-search-form">
                                    <a href="#"><i><b>System Interface</b></i></a>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>" class="<?php if($title=='index'){echo 'active';} ?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>user" class="<?php if($title=='user'){echo 'active';} ?>"><i class="glyphicon glyphicon-user"></i> Users</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>member" class="<?php if($title=='member'){echo 'active';} ?>"><i class="glyphicon glyphicon glyphicon-th-list"></i> Members</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>category" class="<?php if($title=='category'){echo 'active';} ?>"><i class="glyphicon glyphicon glyphicon-th"></i> Category</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>brand" class="<?php if($title=='brand'){echo 'active';} ?>"><i class="glyphicon glyphicon-phone"></i> Brands</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>product" class="<?php if($title=='product'){echo 'active';} ?>"><i class="glyphicon glyphicon-camera"></i> Products</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>order" class="<?php if($title=='order'){echo 'active';} ?>"><i class="glyphicon glyphicon-tag"></i>Orders</a>
                            </li>
                            <li>
                                <a  href="<?php echo link_url; ?>sold" class="<?php if($title=='sold'){echo 'active';} ?>"><i class="glyphicon glyphicon-saved"></i>Sold Products </a>
                            </li> 
                            <li class="sidebar-search interface"><div class="input-group custom-search-form">
                                    <a href="#"><i><b>System CMS</b></i></a>
                                </div>
                            </li>
                            <li><a href="<?php echo link_url; ?>cmspost/"> CMS Posts</a></li>
                            <li><a href="<?php echo link_url; ?>cmscategory/"> CMS Category</a></li>
                            
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>