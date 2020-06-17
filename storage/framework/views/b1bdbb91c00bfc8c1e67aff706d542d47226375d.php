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
              
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subs ID</th>
				          <th>Employee ID</th>                  
                  <th>Food Item Qty</th>
                  <th>Total Price</th>
                  <th>Meal Type</th>
                  <th>Day</th>
                  <th>Meal Time</th>
                  <th>Meal Status</th>                  
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Subscription Frequency</th>
                  <th>Meal Method</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php $__currentLoopData = $allmealsubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allmealsub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->MealSubs_ID); ?></td>
				          <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Employee_ID); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Food_Item_Qty); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Total_Price); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Type); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Day); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Time); ?></td>                  
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Status); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Subscription_Start_Date); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Subscription_End_Date); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Subscription_Frequency); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($allmealsub->Meal_Subscription_Method); ?></td>
				  				  <td style="text-overflow: ellipsis;" class="text-center">
                        
					<a class="btn btn-success btn-block btn-flat" type="button" href="<?php echo e(URL::to('cafe_subs/'.$allmealsub->MealSubs_ID.'/edit')); ?>">
                        Change meal status
          </a>
          <?php if($allmealsub->Meal_Subscription_Method == "Delivery"): ?>
            <?php if($allmealsub->Meal_Status == "Prepared"): ?>
					    <a class="btn btn-info btn-block btn-flat "  type="button" href="<?php echo e(URL::to('subs_delivery_request/'.$allmealsub->MealSubs_ID)); ?>">
                        Send Delivery Request
					    </a>
            <?php endif; ?>
          <?php endif; ?>
							
                    </td>
                </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
                </tbody>
                
              </table>
			  
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 
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
<?php echo $__env->make('layouts.app_cafeteria', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/cafeteria staff/Subsviewall.blade.php ENDPATH**/ ?>