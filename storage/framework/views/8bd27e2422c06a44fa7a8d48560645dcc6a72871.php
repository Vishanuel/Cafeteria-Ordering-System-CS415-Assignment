<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	   <small>Your</small>
        Menu
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Menu</li>
		<li><a target="_blank" href="<?php echo e(url('help/PickingtheMenu.html')); ?>"><span class="glyphicon glyphicon-question-sign" style="font-size: 15px;"></span></a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		
		
		
		<?php $menuid = -1;
		function time_to_decimal($time) {
			$timeArr = explode(':', $time);
			$decTime = ($timeArr[0]*3600) + ($timeArr[1]*60) + ($timeArr[2]);
		 
			return $decTime;
		}
		?>
						
        <!-- left column --><div class="row">
		
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(time_to_decimal(date("H:i:s")) <= time_to_decimal($category->Order_Cutoff_Time)): ?>
		 <div class="row">
			<div class="col-md-12 col-xs-12">
			  <div class="box loading" style="background: rgba(255, 255, 255, 1); box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.1);z-index:999;">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo e($category->Category_Name); ?> Menu</h3>
				</div>
			  
				<div class="box-body">
					
				
				   <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($category->Category_ID == $food->Category_ID ): ?>
			
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
					
					<?php if($menuid != -1): ?>
					<div class="form-group col-md-12">
						<?php if(Auth::user()->usertype == "Patron"): ?>
						<a class=" btn btn-info btn-flat pull-right" type="button" href="<?php echo e(URL::to('order_create/'.$menuid )); ?>">
							Place order
						</a>
						<?php elseif(Auth::user()->usertype == "Student"): ?>
					    <a class=" btn btn-info btn-flat pull-right" type="button" href="<?php echo e(URL::to('student_order_create/'.$menuid )); ?>">
							Place order
					    </a>
						<?php endif; ?>
				    </div>
					 <?php endif; ?>
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
			<?php else: ?>
			<div class="box-header" style="background: rgba(255, 255, 255, 0); "> 
				
				<div class="col-md-12 col-xs-12">
					<div id="2" class="callout callout-danger" ><h3 class="box-title"><?php echo e($category->Category_Name); ?> Menu</h3><p>Unfortunately, there is no available <?php echo e($category->Category_Name); ?> menu for this date. Sorry for any inconvenience caused.</p></div>
				</div>
			</div>
			
			<?php endif; ?>
			
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!--/.col (right) -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
 </div>
 
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/restaurants/menu.blade.php ENDPATH**/ ?>