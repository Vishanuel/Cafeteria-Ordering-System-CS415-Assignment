 <!DOCTYPE html>
<html>
  <head >
    <meta charset="utf-8">
    
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" style="min-height:100%" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/square/blue.css')); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
  </head>
  <body class="hold-transition" style="height:100px;">
    <section class="content">
      <div class="row">
    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-lg-12 col-md-12 col-xs-12"  width="100%">
          
				
			<div class="box loading box-widget widget-user item"  >
            <!-- Add the bg color to the header using any of the bg-* classes --><a href="#" class="small-box-footer">
            <div class="widget-user-header bg-black" style="height: 200px; background: url('../<?php echo e($restaurant->Restaurant_Pic); ?>') center center;  background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
              <h3 class="widget-user-username"><?php echo e($restaurant->Restaurant_Name); ?></h3>
              <h5 class="widget-user-desc"><?php echo e($restaurant->Restaurant_Location); ?></h5>
            </div>
              
			
          </div>	
		</div>
		
		<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		 
			<div class="col-md-6 col-xs-12">
			  <div class="box loading" style="background: rgba(255, 255, 255, 1); box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.1);z-index:999;">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo e($category->Category_Name); ?> Menu</h3>
				</div>
			  
				<div class="box-body">
					
				
				   <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($category->Category_ID == $food->Category_ID && $food->Restaurant_ID == $restaurant->Restaurant_ID): ?>
						
					<div class="col-md-3 col-xs-12">
						
						<div class="box loading box-widget widget-user">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-black" style="height:175px; background: url('../<?php echo e($food->Food_Pic); ?>') center center;background-repeat: no-repeat;  background-size: cover;">
						 <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3>
						  <h5 class="widget-user-desc">Web Designer</h5> -->
						  
						
						</div>
						<div class="box-footer" style="text-align: center;" ><h4><?php echo e($food->Food_Name); ?></h4></div>
						
						</div>
	
						  <?php $menuid = $food->Menu_ID;?>
					
						
					 
					</div>
					
						<?php endif; ?>
						
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					
						 </div>
					</div>
				</div>
					<?php if($menuid == -1 || !isset($menuid)): ?>
					
					<div class="box-header" style="background: rgba(255, 255, 255, 0); "> 
						<div class="col-md-12 col-xs-12">
							<div id="2" class="callout callout-danger" ><p>Unfortunately, there is no available <?php echo e($category->Category_Name); ?> menu for this date. Sorry for any inconvenience caused.</p></div>
						</div>
					</div>
					
						
					<?php endif; ?>
					
			 
				
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
	
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo e(asset('plugins/iCheck/icheck.min.js')); ?>"></script>
    <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});
    </script>
  </body>
</html><?php /**PATH C:\wamp64\www\COS\resources\views/login.blade.php ENDPATH**/ ?>