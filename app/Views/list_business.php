<div id="carouselRegionsHeader" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/header01.png' ?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/header02.png' ?>" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/header03.png' ?>" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselRegionsHeader" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselRegionsHeader" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="main-container zone_list">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
        <aside>
          <!--
          <div class="widget_search">
            <form role="search" id="search-form">
              <input type="search" class="form-control" autocomplete="off" name="s" placeholder="Buscar..." id="search-input" value="">
              <button type="submit" id="search-submit" class="search-btn"><i class="lni-search"></i></button>
            </form>
          </div>-->
          <!--
          <?php if(isset($cities)): ?>
          <div class="widget categories">
            <h4 class="widget-title">Ciudades</h4>
            <ul class="categories-list">
              
              <?php foreach($cities as $city): ?>
                <li>
                  <a href="<?= site_url() ?>city/<?= $region_name; ?>/<?= $city['name_short']; ?>">
                    <i class="lni-map-marker"></i>
                    <?php echo $city['name']; ?> <span class="category-counter">(5)</span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
          -->
          <?php if($cities): ?>
          <div class="widget categories">
            <h4 class="widget-title">Ciudades</h4>
            <ul class="categories-list">
              <?php
              //print_r($categories);
              ?>
              
              <?php foreach($cities as $city): ?>
                <li>
                  <a href="<?= site_url() ?>city/<?= $region['name_short']; ?>/<?= $city['name_short']; ?>">
                    <i class="lni-map-marker"></i>
                    <?php echo $city['name']; ?>
                  </a>
                </li>
              <?php endforeach; ?>
              
            </ul>
          </div>
          <?php endif; ?>
          <!--
          <div class="widget categories">
            <h4 class="widget-title">Categorías</h4>
            <ul class="categories-list">
              <?php
              //print_r($categories);
              ?>
              <?php if($categories): ?>
              <?php foreach($categories as $category): ?>
                <li>
                  <a href="<?= site_url() ?>category/<?= $category['name_short']; ?>">
                    <i class="lni-dinner"></i>
                    <?php echo $category['name']; ?> <span class="category-counter">(5)</span>
                  </a>
                </li>
              <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
          -->
          <div class="widget">
            <h4 class="widget-title">Publicidad</h4>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/1.png" alt="">
            </div>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/2.png" alt="">
            </div>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/3.png" alt="">
            </div>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/4.png" alt="">
            </div>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/5.png" alt="">
            </div>
            <div class="add-box">
              <img class="img-fluid" src="<?= site_url() ?>app/FrontEnd/assets/img/n_left_ads/6.png" alt="">
            </div>
          </div>
        </aside>
      </div>
      <div class="col-lg-9 col-md-12 col-xs-12 page-content">
        <!-- Product filter Start -->
        <div class="product-filter">
          <div class="short-name">
            <span>Se encontraron <?= count($business); ?> producto (s)</span>
          </div>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#grid-view"><i class="lni-grid"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#list-view"><i class="lni-list"></i></a>
            </li>
          </ul>
        </div>
        <!-- Product filter End -->

        <!-- Adds wrapper Start -->
        <div class="adds-wrapper">
          <div class="tab-content">
            <div id="grid-view" class="tab-pane fade">
              <div class="row">
                <?php
                $i=1;
                ?>
                <?php if($business): ?>
                <?php foreach($business as $deal): ?>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="featured-box">
                      <figure>
                        <?php if($deal->is_verified==1): ?>
                        <span class="price-save">
                          Verficada
                        </span>
                        <?php endif; ?>
                        <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>">
                          <img class="img-fluid" src="<?= base_url().'/business/'.$deal->business_id.'/'.$deal->business_id.'.png' ?>" alt="">
                        </a>
                      </figure>
                      <div class="feature-content">
                        <div class="product">
                          <a href="<?= site_url() ?>category/<?= $deal->category_nameshort; ?>"><?php echo $deal->category_name; ?></a>
                        </div>
                        <h4>
                          <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>"><?php echo $deal->business_name; ?></a>
                        </h4>
                        <div class="meta-tag">
                          <div class="row">
                            <div class="col-lg-12">
                              <span>
                                <i class="lni-map-marker"></i>
                                <a href="<?= site_url() ?>city/<?php echo $deal->name_short; ?>/<?php echo $deal->city_nameshort; ?>"><?php echo $deal->city_name; ?></a>,
                                <a href="<?= site_url() ?>region/<?php echo $deal->name_short; ?>"><?php echo $deal->name; ?></a>
                              </span>
                            </div>
                            <div class="col-lg-12">
                              <span>
                                <a href="#"><i class="lni-tag"></i> <?php echo $deal->schedule; ?></a>
                              </span>
                            </div>
                            <div class="col-lg-12">
                              <span>
                                <?php echo substr($deal->description, 0, 100); ?> ...
                              </span>
                            </div>
                          </div>
                        </div>
                        <p class="dsc"></p>
                        <div class="listing-bottom">
                          <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>" class="btn btn-common float-right">Ver Detalles</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                $i++;
                ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
            <div id="list-view" class="tab-pane fade active show">
              <div class="row">
                <?php
                $i=1;
                ?>
                <?php if($business): ?>
                <?php foreach($business as $deal): ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="featured-box">
                    <figure>
                      <?php if($deal->is_verified==1): ?>
                      <span class="price-save">
                        Verficada
                      </span>
                      <?php endif; ?>
                      <?php
                        //print_r($deal);
                        //die();
                      ?>
                      <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>">
                        <img class="img-fluid" src="<?= base_url().'/business/'.$deal->business_id.'/'.$deal->business_id.'.png' ?>" alt="">
                      </a>
                    </figure>
                    <div class="feature-content">
                      <div class="product">
                        <a href="<?= site_url() ?>category/<?= $deal->category_nameshort; ?>"><?php echo $deal->category_name; ?></a>
                      </div>
                      <h4>
                        <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>"><?php echo $deal->business_name; ?></a>
                      </h4>
                      <div class="meta-tag">
                        <div class="row">
                          <div class="col-lg-12">
                            <span>
                              <i class="lni-map-marker"></i>
                              <a href="<?= site_url() ?>city/<?php echo $deal->name_short; ?>/<?php echo $deal->city_nameshort; ?>"><?php echo $deal->city_name; ?></a>,
                              <a href="<?= site_url() ?>region/<?php echo $deal->name_short; ?>"><?php echo $deal->name; ?></a>
                            </span>
                          </div>
                          <div class="col-lg-12">
                            <span>
                              <a href="#"><i class="lni-tag"></i> <?php echo $deal->schedule; ?></a>
                            </span>
                          </div>
                          <div class="col-lg-12">
                            <span>
                              <?php echo substr($deal->description, 0, 100); ?> ...
                            </span>
                          </div>
                        </div>
                      </div>
                      <p class="dsc"></p>
                      <div class="listing-bottom">
                        <a href="<?= site_url() ?>business/<?php echo $deal->business_nameshort; ?>" class="btn btn-common float-right">Ver Detalles</a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                $i++;
                ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="carouselRegionsFooter" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/footer01.png' ?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/footer02.png' ?>" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url().'/regions/quindio/footer03.png' ?>" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselRegionsFooter" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselRegionsFooter" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<style>
@media (min-width: 1200px) {
  #carouselRegionsHeader {
    padding: 75px 0px;
  }
}

@media (max-width: 800px) {
  .zone_list {
    padding-top: 40px;
  }
}


</style>