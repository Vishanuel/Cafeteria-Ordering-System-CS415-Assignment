<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/select2/dist/css/select2.css')); ?>">
  
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/all.css')); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue sidebar-mini" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">

  <header class="main-header">
   
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#<?php echo e($Cos_Order_Num); ?></small>
      </h1>
    </section>

    <div class="pad margin no-print">
      
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Cafeteria Ordering System
            <small class="pull-right"><?php echo e($Cos_Order_Date_Time); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Cafeteria Ordering System</strong><br>
            Restaurant: <?php echo e($restaurant); ?><!--br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com-->
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo e($username); ?></strong></br></br><!--br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com-->
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo e($Cos_Order_Num); ?></b><br>
          <br>
          <b>Order ID:</b> <?php echo e($Cos_Order_Num); ?><br>
		  <b>Order Delivery/Pickup:</b> <?php echo e($delivery_pickup); ?><br>
		  <b>Meal Date:</b> <?php echo e($Cos_Meal_Date_Time); ?><br>
          <b>Payment Due:</b> $<?php echo e($Cos_Order_Cost); ?><br>
          <b>Payment Method:</b> <?php echo e($Cos_Order_Payment_Method); ?><br>
		  <br>
        </div>
		
		<?php if($delivery_time != "None"): ?>
		<div class="col-sm-4 invoice-col">
          <b>Delivery Info.</b>
          <b>Delivery Location:</b> <?php echo e($delivery_location); ?><br>
          <b>Delivery Time:</b> <?php echo e($delivery_time); ?><br>
		  <br>
        </div>
		<?php endif; ?>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <!--th>Serial #</th-->
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
			<?php for($i = 0; $i < $count; $i++): ?>
            <tr>
              <td><?php echo e($Quantity[$i]); ?></td>
              <td><?php echo e($Food_Name[$i]); ?></td>
              <!--td>455-981-221</td-->
              <td><?php echo e($Food_Desc[$i]); ?></td>
              <td>$<?php echo e($Price[$i]); ?></td>
            </tr>
			<?php endfor; ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
       
        <!-- /.col -->
        <div class="col-xs-6">
          <!--p class="lead">Amount Due 2/22/2014</p-->

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td>$<?php echo e($Cos_Order_Cost); ?></td>
              </tr>
              <tr>
                <th>Tax</th>
                <td>$0</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$<?php echo e($Cos_Order_Cost); ?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          
        </div>
      </div>
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->

    <!-- Create the tabs -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->



</body>
<?php /**PATH C:\wamp64\www\COS\resources\views/patron/orderemail.blade.php ENDPATH**/ ?>