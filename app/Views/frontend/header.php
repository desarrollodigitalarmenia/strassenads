<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Strassen Ads</title>
    <link rel="icon" type="image/png" href="<?= site_url() ?>app/FrontEnd/assets/img/iconosa.png" />
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/fonts/line-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/slicknav.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>app/FrontEnd/assets/css/responsive.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-R2FHNDGXMQ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-R2FHNDGXMQ');
    </script>
  </head>
  <body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Start Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 col-md-5 col-xs-12">
              <!-- Start Contact Info -->
              <ul class="list-inline">
                <li><i class="lni-phone"></i> +57 305 477 6593</li>
                <li><i class="lni-envelope"></i> info@strassenads.com</li>
              </ul>
              <!-- End Contact Info -->
            </div>
            <div class="col-lg-5 col-md-7 col-xs-12">
              <div class="roof-social float-right">
                <a class="twitter" href="https://twitter.com/strassenads" target="_blank"><i class="lni-twitter-filled"></i></a>
                <a class="instagram" href="https://www.instagram.com/strassenads" target="_blank"><i class="lni-instagram-filled"></i></a>
              </div>
              <div class="header-top-right float-right">
                <?php
                if(isset($data_context)){
                ?>
                <a href="<?= site_url() ?>account" class="header-top-button"><i class="lni-lock"></i> Mi Cuenta</a>
                <a href="<?= site_url() ?>account/logout" class="header-top-button"><i class="lni-lock"></i> Salir</a> |
                
                <?php
                }else{
                  
                ?>
                <!--<a href="<?= site_url() ?>register" class="header-top-button"><i class="lni-pencil"></i> Registrar</a> |--><a href="<?= site_url() ?>login" class="header-top-button"><i class="lni-lock"></i> Ingresar</a> |
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Top Bar -->

      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              <span class="lni-menu"></span>
              <span class="lni-menu"></span>
              <span class="lni-menu"></span>
            </button>
            <a href="<?= site_url() ?>" class="navbar-brand">
              <img src="<?= site_url() ?>app/FrontEnd/assets/img/logo.png" alt="">
            </a>
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto w-100 justify-content-center">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categorías
                </a>
                <div class="dropdown-menu">
                  <?php
                  $categoryquantity = 0;
                  ?>
                  <?php if($categories): ?>
                  <?php
                    foreach($categories as $category): 
                      if($categoryquantity < 7):
                  ?>
                  <a class="dropdown-item" href="./searchEngine?q=&region=&city=&category=<?= $category['name_short']; ?>"><?= $category['name']; ?></a>
                  <?php 
                      $categoryquantity++;
                      endif;
                    endforeach;
                  ?>
                  <?php endif; ?>
                  <a class="dropdown-item" href="<?= site_url() ?>categories"><b>+ Mas categorías</b></a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Regiones
                </a>
                <div class="dropdown-menu">
                  <?php
                  $regionquantity = 0;
                  ?>
                  <?php if($regions): ?>
                  <?php
                    foreach($regions as $region): 
                      if($regionquantity < 7):
                  ?>
                  <a class="dropdown-item" href="./searchEngine?q=&region=<?= $region['name_short']; ?>&city=&category=0"><?= $region['name']; ?></a>
                  <?php 
                      $regionquantity++;
                      endif;
                    endforeach;
                  ?>
                  <?php endif; ?>
                  <a class="dropdown-item" href="<?= site_url() ?>states"><b>+ Mas regiones</b></a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="<?= site_url() ?>aboutus">
                  Nosotros
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="<?= site_url() ?>blog">
                  Blog
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url() ?>contactus">
                  Contáctenos
                </a>
              </li>
            </ul>
            <div class="post-btn">
              <a class="btn btn-common" href="<?= site_url() ?>contactus"><i class="lni-pencil-alt"></i> Ingresa al directorio</a>
            </div>
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="mobile-menu">
          <li>
            <a href="#">
            Categorías
            </a>
            <ul class="dropdown">
              <?php
              $categoryquantity = 0;
              ?>
              <?php if($categories): ?>
              <?php
                foreach($categories as $category): 
                  if($categoryquantity < 7):
              ?>
              <li><a href="<?= site_url() ?>category/<?= $category['name_short']; ?>"><?= $category['name']; ?></a></li>
              <?php 
                  $categoryquantity++;
                  endif;
                endforeach;
              ?>
              <?php endif; ?>
              <li><a href="<?= site_url() ?>categories">+ Mas categorías</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Regiones</a>
            <ul class="dropdown">
              <?php
              $regionquantity = 0;
              ?>
              <?php if($regions): ?>
              <?php
                foreach($regions as $region): 
                  if($regionquantity < 7):
              ?>
              <li><a href="<?= site_url() ?>category/<?= $region['name_short']; ?>"><?= $region['name']; ?></a></li>
              <?php 
                  $regionquantity++;
                  endif;
                endforeach;
              ?>
              <?php endif; ?>
              <li><a href="<?= site_url() ?>states">+ Mas regiones</a></li>
            </ul>
          </li>
          <li>
            <a href="<?= site_url() ?>aboutus">Nosotros</a>
          </li>
          <li>
            <a href="<?= site_url() ?>blog">Blog</a>
          </li>
          <li>
            <a href="<?= site_url() ?>contactus">Contáctenos</a>
          </li>
        </ul>
        <!-- Mobile Menu End -->
      </nav>
      <!-- Navbar End -->
    </header>
    <!-- Header Area wrapper End -->