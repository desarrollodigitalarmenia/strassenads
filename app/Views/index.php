
    <div id="hero-area">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-9 col-xs-12 text-center">
            <div class="contents">
              <h1 class="head-title">Bienvenido al directorio más <span class="year">grande de Colombia</span></h1>
              <p>Busque y encuentre todas las empresas en cualquier categoría de su región o ciudad </p>
              <div class="search-bar">
                <div class="search-inner">
                  <form class="search-form" method="post" action="<?= site_url() ?>search">
                    <div class="form-group">
                      <input type="text" id="q" name="q" class="form-control" placeholder="Busca lo que necesites">
                    </div>
                    <div class="form-group inputwithicon">
                      <div class="select">
                        <select onchange="getCities(this.value); return false;" id="region" name="region">
                          <option value="0">Región</option>
                          <?php if($regions): ?>
                          <?php foreach($regions as $region): ?>
                            <option value="<?php echo $region['name_short']; ?>"><?php echo $region['name']; ?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <i class="lni-target"></i>
                    </div>
                    <div class="form-group inputwithicon">
                      <div class="select">
                        <select id="city" name="city">
                          <option value="0">Ciudad</option>
                        </select>
                      </div>
                      <i class="lni-target"></i>
                    </div>
                    <div class="form-group inputwithicon">
                      <div class="select">
                        <select id="category" name="category">
                          <option value="0">Categorías</option>
                          <?php if($categories): ?>
                          <?php foreach($categories as $category): ?>
                          <option value="<?php echo $category['name_short']; ?>"><?php echo $category['name']; ?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <i class="lni-menu"></i>
                    </div>
                    <a class="btn btn-common" href="#" onclick="searchR();">search</a>
                    <!--<button class="btn btn-common" type="submit"><i class="lni-search"></i> Buscar Ahora</button>-->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories item Start -->
    <section id="categories">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-md-12 col-xs-12">
            <div id="categories-icon-slider" class="categories-wrapper owl-carousel owl-theme">
              <?php if($regions): ?>
              <?php foreach($regions as $region): ?>
                <div class="item">
                  <a href="<?= site_url() ?><?= $region['name_short']; ?>">
                    <div class="category-icon-item">
                      <div class="icon-box">
                        <div class="icon">
                          <img src="<?= site_url() ?>app/FrontEnd/assets/img/regions/<?php echo $region['flag']; ?>" alt="">
                        </div>
                        <h4><?php echo $region['name']; ?></h4>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Categories item End -->

    <!-- Featured Section Start -->
    <section class="featured section-padding">
      <div class="container">
        <h1 class="section-title">Empresas Recomendadas</h1>
        <div class="row">
          <?php
            //print_r($business_main);
          ?>
        <?php if($business_main): ?>
        <?php foreach($business_main as $business): ?>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
            <div class="featured-box">
              <figure>
                <?php if($business->is_verified==1): ?>
                <span class="price-save">
                  Verficada
                </span>
                <?php endif; ?>
                <a href="<?= site_url() ?>business/<?php echo $business->business_nameshort; ?>">
                  <img class="img-fluid" src="<?= base_url().'/business/'.$business->business_id.'/'.$business->business_id.'.png' ?>" alt="">
                </a>
              </figure>
              <div class="feature-content">
                <div class="product">
                  <a href="<?= site_url() ?>category/<?php echo $business->category_nameshort; ?>">
                    <?php echo $business->category_name; ?>
                  </a>
                </div>
                <h4><a href="<?= site_url() ?>business/<?php echo $business->business_nameshort; ?>"><?= $business->business_name; ?> </a></h4>
                <div class="meta-tag">
                  <span>
                    <a href="#"><i class="lni-alarm-clock"></i> <?php echo $business->schedule; ?></a>
                  </span>
                  <span>
                    <i class="lni-map-marker"></i>
                    <a href="city/<?php echo $business->city_nameshort; ?>"><?php echo $business->city_name; ?></a>, 
                    <a href="region/<?php echo $business->region_nameshort; ?>"><?php echo $business->region_name; ?></a>
                  </span>
                  <span>
                    <a href="#"><i class="lni-envelope"></i> <?php echo $business->email; ?></a>
                  </span>
                </div>
                <p class="dsc"><?= substr($business->business_description, 0, 80) ?> ...</p>
                <div class="listing-bottom">
                  <a href="<?= site_url() ?>business/<?php echo $business->business_nameshort; ?>" class="btn btn-common float-right">Ver Detalles</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Featured Section End -->

    <section class="featured-lis section-padding" >
      <div class="container">
        <div class="row">
          <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
            <h3 class="section-title">Empresas Mas Visitadas</h3>
            <div id="new-products" class="owl-carousel owl-theme">
              <?php if($business_more_visited): ?>
              <?php foreach($business_more_visited as $business): ?>
              <div class="item">
                <div class="product-item">
                  <div class="carousel-thumb">
                    <img class="img-fluid" src="<?= base_url().'/business/'.$business->business_id.'/'.$business->business_id.'.png' ?>" alt=""> 
                    <div class="overlay">
                      <div>
                        <a class="btn btn-common" href="<?= site_url() ?>business/<?php echo $business->business_nameshort; ?>">Ver Detalle</a>
                      </div>
                    </div>
                    <?php if($business->is_verified==1): ?>
                    <div class="btn-product bg-sale">
                      <a href="#">Verficada</a>
                    </div>
                    <?php endif; ?>
                  </div>    
                  <div class="product-content">
                    <h3 class="product-title">
                      <a href="<?= site_url() ?>business/<?php echo $business->business_nameshort; ?>">
                        <?php echo $business->business_name; ?>
                      </a>
                    </h3>
                    <span>
                      <a href="city/<?php echo $business->city_nameshort; ?>">
                      <?php echo $business->category_name; ?>
                      </a>
                    </span>
                    <div class="card-text">
                      <div class="float-right">
                        <i class="lni-map-marker"></i>
                        <a href="city/<?php echo $business->city_nameshort; ?>"><?php echo $business->city_name; ?>, </a>
                        <a href="region/<?php echo $business->region_nameshort; ?>"><?php echo $business->region_name; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div> 
        </div>
      </div>
    </section>
    <!-- Featured Listings End -->

    <!-- Works Section Start -->
    <section class="works section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="section-title">¿Cómo funciona?</h3>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="works-item">
              <div class="icon-box">
                <i class="lni-users"></i>
              </div>
              <p>Contáctanos.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="works-item">
              <div class="icon-box">
                <i class="lni-bookmark-alt"></i>
              </div>
              <p>Creamos  o te asociamos tu empresa en nuestro sistema.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="works-item">
              <div class="icon-box">
                <i class="lni-thumbs-up"></i>
              </div>
              <p>Recibe visitas, llamadas y con ello mas ventas.</p>
            </div>
          </div>
          <hr class="works-line">
        </div>
      </div>
    </section>
    <!-- Works Section End -->

    <!--
    <section class="services bg-light section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="section-title">Ventajas</h3>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon">
                <i class="lni-leaf"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Creación o asociación</a></h3>
                <p>
                  Crea tu empresa o asocia si ya existe en nuestra base de datos.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.4s">
              <div class="icon">
                <i class="lni-display"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Historico</a></h3>
                <p>
                  Puedes ver el historico de visitas a tu espacio de empresa.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
              <div class="icon">
                <i class="lni-color-pallet"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Administración</a></h3>
                <p>
                  Edita tu información en cualquier momento y lugar.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.8s">
              <div class="icon">
                <i class="lni-emoji-smile"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Sistema de sellos</a></h3>
                <p>
                  Aumenta tu reputación con los sellos que ganaras en la plataforma.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="1s">
              <div class="icon">
                <i class="lni-pencil-alt"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Mercadeo</a></h3>
                <p>
                  Puedes incluir mecadeo y publicidad físico y virtual para tu empresa.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="1.2s">
              <div class="icon">
                <i class="lni-headphone-alt"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Reportes</a></h3>
                <p>
                  Genera reportes para saber que tanto te han visitado por medio de la plataforma.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    -->

    <!--
    <section id="pricing-table" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="section-title">Precios</h2>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table">
              <div class="icon">
                <i class="lni-gift"></i>
              </div>
              <div class="pricing-header">
                <p class="price-value">$0 / mes</p>
              </div>
              <div class="title">
                <h3>Gratis</h3>
              </div>
              <ul class="description">
                <li>Inscripción o asociación gratis</li>
                <li><del>Reportes de visitas</del></li>
                <li><del>Verificación de empresa</del></li>
                <li><del>Marketing virtual</del></li>
                <li><del>Marketing físico</del></li>
              </ul>
              <button class="btn btn-common">Adquirir</button>
            </div> 
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table" id="active-tb">
              <div class="icon">
                <i class="lni-leaf"></i>
              </div>
              <div class="pricing-header">
                  <p class="price-value">$50.000 mes</p>
               </div>
              <div class="title">
                <h3>Basico</h3>
              </div>
              <ul class="description">
                <li>Inscripción o asociación gratis</li>
                <li>Reportes de visitas</li>
                <li><del>Verificación de empresa</del></li>
                <li><del>Marketing virtual</del></li>
                <li><del>Marketing físico</del></li>
              </ul>
              <button class="btn btn-common">Adquirir</button>
           </div> 
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table">
              <div class="icon">
                <i class="lni-layers"></i>
              </div>
               <div class="pricing-header">
                  <p class="price-value">$200.000 /mes</p>
               </div>
              <div class="title">
                <h3>Profesional</h3>
              </div>
              <ul class="description">
                <li>Inscripción o asociación gratis</li>
                <li>Reportes de visitas</li>
                <li>Verificación de empresa</li>
                <li>Marketing virtual</li>
                <li>Marketing físico</li>
              </ul>
              <button class="btn btn-common">Adquirir</button>
            </div> 
          </div>
        </div>
      </div>
    </section>
    -->