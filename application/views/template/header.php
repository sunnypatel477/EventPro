<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('/asset/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/asset/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url('/asset/toastr/css/toastr.min.css'); ?>">
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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="<?php echo base_url('/asset/js/jquery-3.7.0.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('/plugins/select2/js/select2.full.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2/css/select2.min.css'); ?>">




    <title><?php echo $title ?? '' ?></title>


    <script>
        const base_url = '<?php echo base_url() ?>';
        window.showLoader = function() {
            $('#loader-container').show();
        };

        window.hideLoader = function() {
            $('#loader-container').hide();
        };
        $(document).ready(function() {
            $('#loader-container').show();
            setTimeout(hideLoader, 1000);
        });
    </script>
</head>

<body>
<div class="wrapper">
    <div id="loader-container">
        <div class="loader"></div>
    </div>

    <!-- include navbar -->
    <?php $this->load->view('template/navbar'); ?>

    <!-- include sidebar -->
    <?php $this->load->view('template/sidebar'); ?>


    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo isset($content) ? $content :'' ?></h1>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php 
    $this->load->view($content_view);
    ?>
    </div>
    <!-- include footer -->
    <footer class="main-footer">
    <strong>Copyright &copy; 2023.</strong>
    All rights reserved.

  </footer>
    
</div>
<?php $this->load->view('template/footer'); ?>


    
