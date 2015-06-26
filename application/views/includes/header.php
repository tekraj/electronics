
<?php 

  $menuModel=new menuModel;
  $category=$menuModel->getCategory();
  $brand=$menuModel->getBrands();
  $allbrand=$menuModel->getAllBrands();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Bonfire a Ecommerce Category Flat Bootstarp Responsive Website Template | Home :: w3layouts</title>
  <link href="<?php echo link_url; ?>assests/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
  <!-- Custom Theme files -->
  <!--theme-style-->
  <link href="<?php echo link_url; ?>assests/css/style.css" rel="stylesheet" type="text/css" media="all" />  
  <!--//theme-style-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Bonfire Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
  <script src="<?php echo link_url; ?>assests/js/jquery.min.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!--fonts-->
  <link href='http://fonts.googleapis.com/css?family=Exo:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
  <!--//fonts-->
 
          <script type="text/javascript">
            jQuery(document).ready(function($) {
              $(".scroll").click(function(event){   
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
              });
            });
          </script>
  <!--slider-script-->
      <script src="<?php echo link_url; ?>assests/js/responsiveslides.min.js"></script>
        <script>
          $(function () {
            $("#slider1").responsiveSlides({
            auto: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
            });
          });
        </script>
  <!--//slider-script-->
  <script>$(document).ready(function(c) {
    $('.alert-close').on('click', function(c){
      $('.message').fadeOut('slow', function(c){
          $('.message').remove();
      });
    });   
  });
  </script>
  <script>$(document).ready(function(c) {
    $('.alert-close1').on('click', function(c){
      $('.message1').fadeOut('slow', function(c){
          $('.message1').remove();
      });
    });   
  });
  </script>
</head>
<body>
  <!--header-->
  <div class="header">
    <div class="header-top">
      <div class="container"> 
      <div class="header-top-in">     
        <div class="logo">
          <a href="<?php echo link_url; ?>"><img src="<?php echo link_url; ?>assests/images/logo.png" alt=" " ></a>
        </div>
        <div class="header-in">
          <ul class="icon1 sub-icon1">
            <?php if(isset($_SESSION['member'])): ?>
              <li  ><a href="#">  <?php echo $_SESSION['member']->email;  ?></a></li>
              <li  ><a href="<?php echo link_url.'member/logout'; ?>"> LOG OUT</a></li>
            <?php else: ?>
              <li  ><a href="<?php echo link_url.'member/login'; ?>">  LOGIN</a></li>
              <li ><a href="<?php echo link_url.'member/signup'; ?>" > SIGN UP</a></li>
            <?php endif; ?>
              <li > <a href="<?php echo link_url.'cart'; ?>" >CHECKOUT</a> </li> 
              <li><div class="cart">
                  <a href="<?php echo link_url.'cart'; ?>" class="cart-in"> </a>
                  <?php if(isset($_SESSION['cartId'])): ?>
                  <span><?php echo count($_SESSION['cartId']); ?></span>
                <?php else: ?>
                  <span>0</span>
                <?php endif; ?>
                </div>
              </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
      </div>
      </div>
    </div>
    <div class="header-bottom">
    <div class="container">
      <div class="h_menu4">
        <a class="toggleMenu" href="#">Menu</a>
        <ul class="nav">
        <?php
          if(is_array($category) && count($category) >0 ):

            foreach($category as $cat):

            ?>

            <li>
                <a href="<?php echo link_url.'category/'.$cat->url; ?>">
                  <?php echo $cat->title ?>
                </a>
                <?php if(count($brand[$cat->id]) >0): ?>
                  <ul class="drop">
                    <?php foreach($brand[$cat->id] as $brands): ?>
                      <li class="odd"><a href="<?php echo link_url.'category/'.$cat->url.'/'.$brands->url; ?>"><?php echo $brands->name; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>


            </li>
            <?php

              endforeach;
            endif;
           ?>
          
        </ul>
        <script type="text/javascript" src="<?php echo link_url; ?>assests/js/nav.js"></script>
      </div>
    </div>
    </div>
    <div class="header-bottom-in">
      <div class="container">
      <div class="header-bottom-on">
      <p class="wel"><a href="#"></a></p>
      <div class="header-can">
        <ul class="social-in">
            <li><a href="#"><i> </i></a></li>
            <li><a href="#"><i class="facebook"> </i></a></li>
            <li><a href="#"><i class="twitter"> </i></a></li>         
            <li><a href="#"><i class="skype"> </i></a></li>
          </ul> 
          <div class="down-top">    
              <!-- <select class="in-drop">
                <option value="Dollars" class="in-of">Dollars</option>
                <option value="Euro" class="in-of">Euro</option>
                <option value="Yen" class="in-of">Yen</option>
              </select> -->
           </div>
          <div class="search">
            <form>
              <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
              <input type="submit" value="">
            </form>
          </div>

          <div class="clearfix"> </div>
      </div>
      <div class="clearfix"></div>
    </div>
    </div>
    </div>
  </div>