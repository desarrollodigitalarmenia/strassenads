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
<section class="login section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-12 col-xs-12">
        <div class="login-form login-area">
          <h3>
            Ingresar Ahora
          </h3>
          <form action="<?= site_url() ?>account/login" role="form" class="login-form" method="post">
            <div class="form-group">
              <div class="input-icon">
                <i class="lni-user"></i>
                <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de usuario">
              </div>
            </div> 
            <div class="form-group">
              <div class="input-icon">
                <i class="lni-lock"></i>
                <input type="password" id="password" name="password" class="form-control" placeholder="Contaseña">
              </div>
            </div>                  
            <div class="form-group mb-3">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkedall">
                <label class="custom-control-label" for="checkedall">Recordarme</label>
              </div>
              <a class="forgetpassword" href="forgot-password.html">¿Olvidaste la contraseña?</a>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-common log-btn">Ingresar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
