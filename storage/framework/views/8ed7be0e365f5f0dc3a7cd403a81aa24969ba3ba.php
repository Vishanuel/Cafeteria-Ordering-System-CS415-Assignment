<?php $__env->startSection('content'); ?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Pick a </small>
        Restaurant
        <small> to order from ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Restaurant Info</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
		<?php if(!empty($pending_order_id)): ?>
		<div class="col-md-12">
			<div style="z-index:9;" class="callout callout-warning">
				<h4>You have an pending order which was disrupted!</h4>
				<p>Placing new order will delete your pending order.</p>
				<a href="<?php echo e(URL::to('order_edit/'.$pending_order_id)); ?>">Go to pending order.</a>
			</div>
		</div>
		<?php endif; ?>
		<?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-lg-12 col-md-12 col-xs-12"  width="100%">
          
				
			<div class="box loading box-widget widget-user item"  >
            <!-- Add the bg color to the header using any of the bg-* classes --><a href="<?php echo e(URL::to('restaurant/'.$restaurant->Restaurant_ID)); ?>" class="small-box-footer">
            <div class="widget-user-header bg-black" style="height: 200px; background: url('../<?php echo e($restaurant->Restaurant_Pic); ?>') center center;  background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
              <h3 class="widget-user-username"><?php echo e($restaurant->Restaurant_Name); ?></h3>
              <h5 class="widget-user-desc"><?php echo e($restaurant->Restaurant_Location); ?></h5>
            </div>
              
			
          </div>	
		</div>
			   
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
			  
			
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
	
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/restaurants/indexx.blade.php ENDPATH**/ ?>