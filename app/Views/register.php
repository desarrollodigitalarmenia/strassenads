<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Ingreso</h2>
          <ol class="breadcrumb">
            <li><a href="<?= site_url() ?>">Principal /</a></li>
            <li class="current">Ingreso al Sistema</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content section Start --> 
<section class="register section-padding">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-12 col-xs-12">
            <div class="register-form login-area">
              <h3>
                Registro
              </h3>
              <form action="<?= site_url() ?>account/register" role="form" class="login-form" method="post">
                <div class="form-group">
                  <div class="input-icon">
                    <i class="lni-envelope"></i>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo electrónico">
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                    <i class="lni-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                  </div>
                </div>  
                <div class="form-group">
                  <div class="input-icon">
                    <i class="lni-lock"></i>
                    <input type="password" id="password_repeat" name="password_repeat" class="form-control" placeholder="Repetir contraseña">
                  </div>
                </div>  
                <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkedall">
                    <label class="custom-control-label" for="checkedall">Acepto estos Terminos y Condiciones</label>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                    <div style="margin-bottom: 15px;font-weight: bold;">
                      <?php
                      if(isset($_SESSION['msg_register'])) {
                        echo $_SESSION['msg_register'];
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button class="btn btn-common log-btn" type="submit">Registrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
