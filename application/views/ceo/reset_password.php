<link rel="stylesheet" href="<?php echo base_url('/asset/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('/asset/css/style.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/asset/datatable/css/jquery.dataTables.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/asset/datatable/css/responsive.bootstrap.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="<?php echo base_url('/asset/js/jquery.slim.min.js'); ?>" crossorigin="anonymous"></script>
<script src="<?php echo base_url('/asset/js/jquery-3.7.0.js'); ?>" crossorigin="anonymous"></script>
<script src="<?php echo base_url('/asset/js/jquery.validate.min.js'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo base_url('/asset/js/additional-methods.min.js'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="<?php echo base_url('/asset/toastr/css/toastr.min.css'); ?>">
<script src="<?php echo base_url('/asset/toastr/js/toastr.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('/asset/dropzone/css/dropzone.min.css'); ?>">
<script src="<?php echo base_url('/asset/dropzone/js/dropzone.min.js'); ?>"></script>
<script src="<?php echo base_url('/asset/select2/js/select2.min.js'); ?>"></script>

<link href="<?php echo base_url('/asset/select2/css/select2.min.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<!-- JQVMap -->
<link rel="stylesheet" href="<?php echo base_url('plugins/jqvmap/jqvmap.min.css'); ?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Summernote -->
<link rel="stylesheet" href="<?php echo base_url('plugins/summernote/summernote-bs4.min.css'); ?>">

<div style="display: flex;justify-content: center;width: 100%; margin-top: 200px;">
  <div class="login-box">
    <div class="login-logo">
      <a><b>Reset Password</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

        <form method="post" name="password_form" id="password_form" action="<?php echo base_url('ceo/user/reset_password/' . $reset_token) ?>">
          <input type="hidden" name="token" value="<?php echo $token ?>">
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="new_password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>

<script src="<?php echo base_url('/asset/bootstrap/js/bootstrap.bundle.min.js') ?>" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url('/asset/datatable/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/asset/datatable/js/dataTables.responsive.js') ?>"></script>


<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>

<!-- ChartJS -->
<script src="<?php echo base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('plugins/sparklines/sparkline.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.js'); ?>"></script>
<script>
  $(document).ready(function() {
    $('#password_form').validate({
      rules: {
        new_password: {
          required: true,
          minlength: 6
        },
        confirm_password: {
          required: true,
          equalTo: "#new_password"
        }
      },
      messages: {
        new_password: "Password is required",
        confirm_password: {
          required: "Confirm password is required",
          equalTo: "Passwords do not match"
        }
      },
      submitHandler: function(form) {
        var formData = new FormData(form);
        showLoader();
        $.ajax({
          url: "<?php echo base_url('ceo/user/add_user'); ?>",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == 1) {
              hideLoader();
              toastr.success(data.message);
              setTimeout(function() {
                window.location.href = "<?php echo base_url('/') ?>";
              }, 2000);
            } else {
              toastr.error(data.message);
              hideLoader();
            }
          },
          cache: false,
          contentType: false,
          processData: false
        });
      }
    });
  });
</script>