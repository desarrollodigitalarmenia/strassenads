<div class="page-header" style="background: url(<?= site_url() ?>app/FrontEnd/assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title"><?php echo $business->name; ?></h2>
          <ol class="breadcrumb">
            <li><a href="#"><?= $business->category_name; ?> en <?= $business->city_name; ?> (<?= $business->region_name; ?>)</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Header End -->  

<!-- Ads Details Start -->
<div class="section-padding">
  <div class="container">
    <!-- Product Info Start -->
    <div class="product-info row">
      <div class="col-lg-8 col-md-12 col-xs-12">
        <div class="ads-details-wrapper">
          <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item">
              <div class="product-img">
                <img class="img-fluid" src="<?= base_url().'/business/'.$business->id.'/'.$business->id.'.png' ?>" alt="">  
              </div>
              <?php if($business->is_verified==1): ?>
              <span class="price">Verficada</span>
              <?php endif; ?>
            </div>
            <!--
            <div class="item">
              <div class="product-img">
                <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/productinfo/img3.jpg" alt="">
              </div>
              <span class="price">$1,550</span>
            </div>
            <div class="item">
              <div class="product-img">
                <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/productinfo/img2.jpg" alt="">
              </div>
              <span class="price">$1,550</span>
            </div>
              -->
          </div>
        </div>

        <div class="details-box">
          <div class="ads-details-info">
            <h2><?php echo $business->name; ?></h2>
            <div class="details-meta">
              <span><a href="#"><i class="lni-alarm-clock"></i> <?php echo $business->schedule; ?></a></span>
              <span><a href="#"><i class="lni-map-marker"></i>  <?= $business->city_name; ?> (<?= $business->region_name; ?>)</a></span>
              <span><a href="#"><i class="lni-envelope"></i> <?php echo $business->email; ?></a></span>
            </div>
            <p class="mb-4">
              <?php echo $business->description; ?>
            </p>
          </div>
          <div class="tag-bottom">
            <div class="float-right">
              <!--
              <div class="share">
                <div class="social-link">  
                  <a class="facebook" data-toggle="tooltip" data-placement="top" title="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                  <a class="twitter" data-toggle="tooltip" data-placement="top" title="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                  <a class="linkedin" data-toggle="tooltip" data-placement="top" title="linkedin" href="#"><i class="lni-linkedin-fill"></i></a>
                  <a class="google" data-toggle="tooltip" data-placement="top" title="google plus" href="#"><i class="lni-google-plus"></i></a>
                </div>
              </div>
              -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <!--Sidebar-->
        <aside class="details-sidebar">
          <div class="widget">
            <h4 class="widget-title">¿Tienes dudas?</h4>
            <div class="agent-inner">
              <div class="agent-title">
                <div class="agent-photo">
                  <a href="#"><img src="<?= site_url() ?>app/FrontEnd/assets/img/productinfo/agent.jpg" alt=""></a>
                </div>
                <div class="agent-details">
                  <h3><a href="#"><?php echo $business->contact; ?></a></h3>
                  <span><i class="lni-phone-handset"></i><?php echo $business->phone; ?></span>
                </div>
              </div>
              <!--
              <input type="text" class="form-control" placeholder="Su correo">
              <input type="text" class="form-control" placeholder="Su celular">
              <p>Estoy interesado en esta empresa y quiero mas detalles como horarios, ubicación y/o catalogos de venta.</p>
              <button class="btn btn-common fullwidth mt-4">Enviar Mensaje</button>
              -->
            </div>
          </div>
          <!-- Popular Posts widget -->
          <div class="widget">
            <h4 class="widget-title">Empresas de esta categoría</h4>
            <ul class="posts-list">
              <?php 
              $i = 1;
              while ($i <= 10):
              ?>
              <li>
                <div class="widget-thumb">
                  <a href="#"><img src="<?= site_url() ?>app/FrontEnd/assets/img/details/img1.jpg" alt="" /></a>
                </div>
                <div class="widget-content">
                  <h4><a href="#">Esta puede ser su empresa</a></h4>
                  <div class="meta-tag">
                    <span>
                      <a href="#"><i class="lni-user"></i> Su información</a>
                    </span>
                    <!--
                    <span>
                      <a href="#"><i class="lni-map-marker"></i> New Your</a>
                    </span>
                    <span>
                      <a href="#"><i class="lni-tag"></i> Radio</a>
                    </span>
                    -->
                  </div>
                  <h4 class="price">Su teléfono</h4>
                </div>
                <div class="clearfix"></div>
              </li>
              <?php
              $i++;
              endwhile; 
              ?>
            </ul>
          </div>

        </aside>
        <!--End sidebar-->
      </div>
    </div>
    <!-- Product Info End -->

  </div>    
</div>