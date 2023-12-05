<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


    <title><?php echo $title ?? '' ?></title>


    <script>
        const base_url = '<?php echo base_url() ?>';
        window.showLoader = function() {
            $('#loader-container').show();
        };

        // Define the hideLoader function
        window.hideLoader = function() {
            $('#loader-container').hide();
        };
        $(document).ready(function() {
            // Hide the loader initially
            $('#loader-container').show();

            // Example: Simulate a delay and hide the loader after 3 seconds
            setTimeout(hideLoader, 1000);

            // You can call showLoader and hideLoader functions as needed in your application
        });
    </script>
</head>

<body>
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
            <h1 class="m-0"><?php echo $content; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $content; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
 


    <section class="content">
      <div class="container-fluid">
      <div class="wrapper">
