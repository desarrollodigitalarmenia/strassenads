<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Perfil Empresarial</h2>
          <ol class="breadcrumb">
            <li><a href="./">Principal /</a></li>
            <li class="current">Perfil Empresarial</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="content" class="section-padding">
  <div class="container">
    <?php //print_r($business) ?>
    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
        <aside>
          <div class="sidebar-box">
            <div class="user">
              <figure>
                <a href="#"><img src="<?= site_url() ?>app/FrontEnd/assets/img/author/img1.jpg" alt=""></a>
              </figure>
              <div class="usercontent">
                <h3>Hola!</h3>
                <h4><?= $data_context['user_name']." ".$data_context['user_lastname'] ?></h4>
              </div>
            </div>
            <nav class="navdashboard">
              <ul>
                <li>
                  <a class="active" href="account-profile-setting.html">
                    <i class="lni-cog"></i>
                    <span>Escritorio</span>
                  </a>
                </li>
                <li>
                  <a href="<?= site_url('account/logout') ?>">
                    <i class="lni-enter"></i>
                    <span>Salir</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="widget">
            <h4 class="widget-title">Advertisement</h4>
            <div class="add-box">
              <img class="img-fluid" src="assets/img/img1.jpg" alt="">
            </div>
          </div>
        </aside>
      </div>

      <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="row page-content">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
            <div class="inner-box">
              <div class="dashboard-box">
                <h2 class="dashbord-title">Información de la empresa</h2>
              </div>
              <form class="search-form" method="post" action="<?= site_url() ?><?= (count($business)>0)?"account/editBusiness":"account/createBusiness";  ?>" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?= (count($business)>0)?$business[0]['id']:""; ?>"/>
                <input type="hidden" id="userid" name="userid" value="<?= $data_context['user_id']; ?>"/>
                <div class="dashboard-wrapper">
                  <div class="form-group mb-3">
                    <label class="control-label">Nombre de la empresa</label>
                    <input class="form-control input-md" name="name" placeholder="Nombre de la empresa" type="text" value="<?= (count($business)>0)?$business[0]['name']:""; ?>">
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Email</label>
                    <input class="form-control input-md" name="email" placeholder="Correo" type="text" value="<?= (count($business)>0)?$business[0]['email']:""; ?>" <?= (count($business)>0)?"disabled":"";  ?>>
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Teléfono (+57 XXX XXX XXXX)</label>
                    <input class="form-control input-md" name="phone" placeholder="Teléfono" type="text" value="<?= (count($business)>0)?$business[0]['phone']:""; ?>">
                  </div>
                  <div class="form-group mb-3 tg-inputwithicon">
                    <label class="control-label">Región</label>
                    <div class="tg-select form-control">
                      <select onchange="getCities(this.value); return false;" id="region" name="region">
                        <option value="0">Seleccionar Región</option>
                        <?php if($regions): ?>
                        <?php
                          foreach($regions as $region):
                        ?>
                        <option value="<?= $region['id']; ?>" <?php if(count($business)>0){echo ($business[0]['region'] == $region['id'])? "selected": "";} ?>><?= $region['name']; ?></option>
                        <?php
                          endforeach;
                        ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group mb-3 tg-inputwithicon">
                    <label class="control-label">Ciudad</label>
                    <div class="tg-select form-control">
                      <select id="city" name="city">
                      </select>
                    </div>
                  </div>
                  <div class="form-group mb-3 tg-inputwithicon">
                    <label class="control-label">Categoría</label>
                    <div class="tg-select form-control">
                      <select id="category" name="category">
                        <?php if($categories): ?>
                        <?php
                          foreach($categories as $category):
                        ?>
                        <option value="<?= $category['id']; ?>" <?php if(count($business)>0){echo ($business[0]['category'] == $category['id'])? "selected": "";} ?>><?= $category['name']; ?></option>
                        <?php
                          endforeach;
                        ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Nombre de contacto</label>
                    <input class="form-control input-md" name="contact" placeholder="Nombre del contacto" type="text" value="<?= (count($business)>0)?$business[0]['contact']:""; ?>">
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Horario</label>
                    <input class="form-control input-md" name="schedule" placeholder="Horario" type="text" value="<?= (count($business)>0)?$business[0]['schedule']:""; ?>">
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Descripción</label>
                    <textarea class="form-control input-md" name="description" placeholder="Descripción" type="text"><?= (count($business)>0)?$business[0]['description']:""; ?></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label class="control-label">Imagen actual</label>
                    <img src="<?= site_url() ?><?php if(count($business)>0){echo (count($business)>0 && file_exists("business/".$business[0]['id']."/".$business[0]['id'].".png"))?"business/".$business[0]['id']."/".$business[0]['id'].".png":"business/0/0.png";}  ?>" style="width: 100%;"/>
                  </div>
                  <label class="control-label">Imagen</label>
                  <label class="tg-fileuploadlabel" for="image_business">
                    <span>Drop files anywhere to upload</span>
                    <span>Or</span>
                    <span class="btn btn-common">Select Files</span>
                    <span>Maximum upload file size: 500 KB</span>
                    <input id="file" class="tg-fileinput" type="file" name="file" accept="image/*">
                  </label>
                  <div style="margin-bottom: 15px;font-weight: bold;">
                    <?php
                      if(isset($_SESSION['msg_update_business'])) {
                        echo $_SESSION['msg_update_business'];
                      }
                    ?>
                  </div>
                  <div style="margin-bottom: 15px;font-weight: bold;">
                    <?php
                      if(isset($_SESSION['msg_create_account'])) {
                        echo $_SESSION['msg_create_account'];
                      }
                    ?>
                  </div>
                  <button class="btn btn-common" type="submit"><?= (count($business)>0)?"Actualizar Perfil":"Crear Empresa";  ?></button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
            <div class="inner-box">
              <div class="tg-contactdetail">
                <div class="dashboard-box">
                  <h2 class="dashbord-title">Información del contácto</h2>
                </div>
                <form class="search-form" method="post" action="<?= site_url() ?>account/editUser">
                  <input type="hidden" id="user_id" name="user_id" value="<?= $data_context['user_id']; ?>"/>
                  <div class="dashboard-wrapper">
                    <div class="form-group mb-3">
                      <label class="control-label">Correo*</label>
                      <input class="form-control input-md" name="user_email" type="text" value="<?= $data_context['user_email']; ?>" disabled>
                    </div>
                    <div class="form-group mb-3">
                      <label class="control-label">Nombres*</label>
                      <input class="form-control input-md" name="user_name" type="text" value="<?= $data_context['user_name']; ?>">
                    </div>
                    <div class="form-group mb-3">
                      <label class="control-label">Apellidos*</label>
                      <input class="form-control input-md" name="user_lastname" type="text" value="<?= $data_context['user_lastname']; ?>">
                    </div>
                    <div class="form-group mb-3">
                      <label class="control-label">Password</label>
                      <input class="form-control input-md" name="user_password" type="text" value="<?= (isset($data_context['user_password']))?$data_context['user_password']:""; ?>">
                    </div>
                    <div class="form-group mb-3">
                      <label class="control-label">Repeat Password</label>
                      <input class="form-control input-md" name="user_password_repeat" type="text" value="<?= (isset($data_context['user_password_repeat']))?$data_context['user_password_repeat']:""; ?>">
                    </div>
                    <div style="margin-bottom: 15px;font-weight: bold;">
                      <?php
                      if(isset($_SESSION['msg_update_account'])) {
                        echo $_SESSION['msg_update_account'];
                      }
                      ?>
                    </div>
                    <button class="btn btn-common" type="submit">Actualizar Contácto</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>      
</div>