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
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>information</small>
      </h1>
     
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order Patron</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
             
                <!-- text input -->
				<div id="tcos" class="form-group col-md-2">
				  <label>Patron Name</label>
				  <input type="text" class="form-control" id="tco" name="tco" Required readonly value="<?php echo e($username); ?>">
			   </div>
				
				
				<?php for($i = 0; $i < $count; $i++): ?>
				
				<div id="food_ite<?php echo e($i); ?>" class="form-group col-md-6">
					<label>Food Item</label>
					<input type="text" class="form-control" readonly id="food_it<?php echo e($i); ?>" name="food_it<?php echo e($i); ?>" Required value="<?php echo e($Food_Name[$i]); ?>">
				</div>
					
					
					
					<div id="quantit<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quanti<?php echo e($i); ?>" name="quanti<?php echo e($i); ?>" max="" min="1" Required value="<?php echo e($Quantity[$i]); ?>">
					</div>
			
					<div id="pric<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" readonly id="pri<?php echo e($i); ?>" name="pri<?php echo e($i); ?>" Required readonly value="<?php echo e($Price[$i]); ?>">
					</div>
					
					
					
				<?php endfor; ?>
				
				<div id="tcos" class="form-group col-md-2">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tco" name="tco" Required readonly value="<?php echo e($Cos_Order_Cost); ?>">
			   </div>
				<!-- <div id="food" ></div>-->
				
				<div id="drp" class="form-group col-md-2">
				  <label>Deliver/Restuarant pickup </label>
				  <input type="text" class="form-control" id="dr" name="dr" Required readonly value="<?php echo e($delivery_pickup); ?>">
			   </div>
			   
			   <div id="pcp" class="form-group col-md-2">
				  <label>Payroll Deduction/Cash Payment</label>
				  <input type="text" class="form-control" id="pc" name="pc" Required readonly value="<?php echo e($Cos_Order_Payment_Method); ?>">
			   </div>
				
				<?php if($delivery_pickup == "delivery"): ?>
				<div id="locati_id" class="form-group col-md-6">
				  <label>Delivery Location</label>
				  <input type="text" class="form-control" id="locatio_id" name="locati_id" Required readonly value="<?php echo e($delivery_time); ?>">
			   </div>
			   
			   <div id="locati_time" class="form-group col-md-6">
				  <label>Delivery Time</label>
				  <input type="text" class="form-control" id="locatio_time" name="locati_time" Required readonly value="<?php echo e($delivery_location); ?>">
			   </div>
			   
			   <?php endif; ?>
			   
				<div id="meal_dat" class="form-group col-md-6">
				  <label>Meal Date</label>
				  <input type="text" class="form-control" id="meal_da" name="meal_da" Required readonly value="<?php echo e($Cos_Meal_Date_Time); ?>">
			   </div>
			   
			   <div id="order_dat" class="form-group col-md-6">
				  <label>Order Date</label>
				  <input type="text" class="form-control" id="order_da" name="order_da" Required readonly value="<?php echo e($Cos_Order_Date_Time); ?>">
			   </div>
			   
			   <div id="order_status" class="form-group col-md-6">
				  <label>Order Status</label>
				  <input type="text" class="form-control" id="order_statu" name="order_statu" Required readonly value="<?php echo e($Cos_Order_Meal_Status); ?>">
			   </div>
			   
                
				
                <!-- /.input group -->
              </div>
			  
			
			</div>
            <!-- /.box-body -->
			 
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 </div>
 </body>

  <script>
	
  </script>
<?php /**PATH C:\wamp64\www\COS\resources\views/patron/restaurantemail.blade.php ENDPATH**/ ?>