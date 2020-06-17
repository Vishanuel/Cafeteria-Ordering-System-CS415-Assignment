<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Subscription Info</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Subscription</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="subscriptionform" role="form" method="POST" action="<?php echo e(action('Cafe_MealSubsController@update',[$meal_subs->MealSubs_ID])); ?>" enctype="multipart/form-data">
			   <?php echo csrf_field(); ?>
			   <?php echo method_field('PUT'); ?>
				<div id="2" class="col-md-12" ><p class="text-red"><?php echo e($error ?? ''); ?></p></div>
                <!-- text input -->
				<?php $i = 1;?>
				<?php $__currentLoopData = $food_selecteds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food_select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<div id="food_itemd<?php echo e($i); ?>" class="form-group col-md-6">
					<label>Food Item</label>
					<select disabled class="form-control select2" id="food_item<?php echo e($i); ?>" name="food_item<?php echo e($i); ?>" style="width: 100%;" Required placeholder="Select food">
						<option  disabled>Select food</option> 
						<?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option Required <?php if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID): ?> selected value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php else: ?> value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php endif; ?> >
								<?php echo e($food->Food_Name); ?>

							</option>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
					
					
					
					<div id="quantityd<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity<?php echo e($i); ?>" name="quantity<?php echo e($i); ?>" max="" min="1" Required value="<?php echo e($food_select->Food_Item_Qty); ?>">
					</div>
			
					<div id="priced<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" readonly id="price<?php echo e($i); ?>" name="price<?php echo e($i); ?>" Required readonly value="">
					</div>

					
					
					<?php $i= $i + 1; ?>
					
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<div id="tcostd" class="form-group col-md-2">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->



			<div class="form-group col-md-12"> 
				<label>Meal Status</label>
				<select class="form-control select2" id="meal_status" name="meal_status" style="width: 100%;"  placeholder="Select location">
					<option id="meal_status" name="meal_status"  disabled value="" >Change meal status</option> 
					<option id="meal_status" name="meal_status" <?php if($meal_subs->Meal_Status == "Pending"): ?> selected <?php endif; ?> value="Pending">Pending</option>
					<option id="meal_status" name="meal_status" <?php if($meal_subs->Meal_Status == "Prepared"): ?> selected <?php endif; ?> value="Prepared">Prepared</option>
					<option id="meal_status" name="meal_status" <?php if($meal_subs->Meal_Status == "Cancelled"): ?> selected <?php endif; ?> value="Cancelled">Cancelled</option>
					<option id="meal_status" name="meal_status" <?php if($meal_subs->Meal_Status == "Completed"): ?> selected <?php endif; ?> value="Completed">Completed</option>
				</select>
				
			</div>
			
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="<?php echo e($i); ?>" class="form-group col-md-12" style="display: none"><?php echo e($i); ?></div>
			
            <input id="mealsubsid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($meal_subs->MealSubs_ID); ?>">
			 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""></div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value="">
			<input id="delivery" name="delivery" class="form-group col-md-12" style="display: none" value="">
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="<?php echo e(URL::to('cafe_subs')); ?>" class="btn btn-default btn-flat">Back</a>
				
				<button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> 
				Save Subscription
				</button>
				
              </div>
              <!-- /.box-footer -->
			 </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
	
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_cafeteria', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/cafeteria staff/Subsviewdetails.blade.php ENDPATH**/ ?>