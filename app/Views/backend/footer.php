
      
<aside class="control-sidebar control-sidebar-dark">
   <div class="p-3">
    <h5><?php echo $data_context_admin['user_email']; ?></h5>
    <p><a href="<?= site_url('admin/logout') ?>">Logout</p></a>
   </div>
</aside>
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Base System Version 0.3
        </div>
        <strong>Copyright &copy; 2022-2023 <a href="https://desarrollodigital.com.co" target="_blank">Desarrollo Digital</a>.</strong> All rights reserved.
      </footer>
    </div>
  </div>
  <script src="<?= site_url() ?>app/Assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= site_url() ?>app/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= site_url() ?>app/Assets/dist/js/adminlte.min.js"></script>
</body>
</html>