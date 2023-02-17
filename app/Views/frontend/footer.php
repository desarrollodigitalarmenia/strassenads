
    <!-- Content section End --> 
    
    <!-- Footer Section Start -->
    <footer>
      <!-- Footer Area Start -->
      <section class="footer-Content">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <div class="footer-logo"><img src="<?= site_url() ?>app/FrontEnd/assets/img/logofooter.png" alt=""></div>
                <div class="textwidget">
                  <p>
                  En Strassen Ads ofrecemos una base de datos de empresas en la que podrá consultar información relevante sobre miles de empresas en Colombia, consultando por sector categoría, departamento y ciudad.
                  Strassen Ads es líder en el mercado de suministro de información de empresas y publicidad.
                  </p>
                </div>
                <ul class="mt-3 footer-social">
                  <!--<li><a class="facebook" href="#" target="_blank"><i class="lni-facebook-filled"></i></a></li>-->
                  <li><a class="twitter" href="https://twitter.com/strassenads" target="_blank"><i class="lni-twitter-filled"></i></a></li>
                  <li><a class="instagram" href="https://www.instagram.com/strassenads" target="_blank"><i class="lni-instagram" target="_blank"></i></a></li>
                </ul> 
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Enlaces Rápidos</h3>
                <ul class="menu">
                  <li><a href="#">- Nosotros</a></li>
                  <li><a href="#">- Blog</a></li>
                  <li><a href="#">- PQR's</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Información de Contacto</h3>
                <ul class="contact-footer">
                  <li>
                    <strong><i class="lni-phone"></i></strong><span>+57 305 477 6593</span>
                  </li>
                  <li>
                    <strong><i class="lni-envelope"></i></strong><span>info@strassenads.com <br> support@strassenads.com</span>
                  </li>
                  <li>
                    <strong><i class="lni-map-marker"></i></strong><span><a href="#">Armenia, Quindío.</a></span>
                  </li>
                </ul>         
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer area End -->
      
      <!-- Copyright Start  -->
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="site-info text-center">
                <p>Plataforma creada por <a href="https://desarrollodigital.com.co" target="_blank" rel="nofollow">Desarrollo Digital</a></p>
              </div>     
            </div>
          </div>
        </div>
      </div>
      <!-- Copyright End -->
    </footer>
    <!-- Footer Section End -->  

    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery-min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/popper.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/bootstrap.min.js"></script>

    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery.counterup.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/waypoints.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/wow.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/owl.carousel.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery.slicknav.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/main.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/form-validator.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/contact-form-script.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/summernote.js"></script>

    
    <script>
      function getCities(){
        const $select = $("#city");
        
        $.ajax({
          url: "findcity",
          method: "post",
          dataType: 'json',
          data: $("form").serialize(),
          error: function (f){
            alert("Fail");
          },
          success: function (data){
            //alert(data);
            if(data!='[]'){
              $select.empty();
              $.each(data, function(i, item) {
                //alert(data[i].name_short);
                $select.append($("<option>", {
                  value: data[i].name_short,
                  text: data[i].name
                }));
              });
            }
          }
        });
      }

      function searchR() {
        
        let q         = $("#q").val();
        let region    = $("#region").val();
        let city      = $("#city").val();
        let category  = $("#category").val();

        if(region != 0 || q != ""){
          window.location.replace("./searchEngine?q=" + q
          + "&region=" + region
          + "&city=" + city 
          + "&category=" + category
          );
        }else{
          //alert("Seleccione una region o escriba lo que desea encontrar.")
        }
      }
    </script>     
  </body>
</html>