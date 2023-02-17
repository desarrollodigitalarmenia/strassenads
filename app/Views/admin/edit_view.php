
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo site_url('./') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/users-list') ?>">Users</a></li>
            <li class="breadcrumb-item active">Add User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="container mt-5">
                <form method="post" id="update_user" name="update_user" action="<?= site_url('admin/update') ?>">
                  <input type="hidden" name="id" id="id" value="<?php echo $user_obj['id']; ?>">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $user_obj['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user_obj['email']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password1" class="form-control" >
                  </div>
                  <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" name="password2" class="form-control" >
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-block">Save Data</button>
                  </div>
                </form>
              </div>
              <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
              <script>
              if ($("#update_user").length > 0) {
                $("#update_user").validate({
                  rules: {
                    name: {
                      required: true,
                    },
                    email: {
                      required: true,
                      maxlength: 60,
                      email: true,
                    },
                  },
                  messages: {
                    name: {
                      required: "Name is required.",
                    },
                    email: {
                      required: "Email is required.",
                      email: "It does not seem to be a valid email.",
                      maxlength: "The email should be or equal to 60 chars.",
                    },
                  },
                })
              }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>












 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#users-list').DataTable();
  } );
</script>