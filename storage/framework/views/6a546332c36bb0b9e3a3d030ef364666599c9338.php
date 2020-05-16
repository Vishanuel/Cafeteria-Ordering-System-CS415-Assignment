<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Order Info</li>
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
                  <th>Cos Order Num</th>
				  <th>Customer Name</th>
                  <th>Cos Order Date Time</th>
                  <th>Cos Meal Date Time</th>
                  <th>Cos Order Meal Status</th>
                  <th>Cos Order Cost</th>
				  <th>Meal Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php $__currentLoopData = $orderall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Num); ?></td>
				  <td style="text-overflow: ellipsis;"><?php echo e($order->Patron_FName); ?> <?php echo e($order->Patron_SName); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Date_Time); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Meal_Date_Time); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Meal_Status); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Cost); ?></td>
				  <td style="text-overflow: ellipsis;"><?php if(empty($order->D_Instruction_ID)): ?> Pickup <?php else: ?> Delivery <?php endif; ?></td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
					<?php if(!empty($order->D_Instruction_ID)): ?> 
					<a class="btn btn-warning btn-block btn-flat" target="_blank" type="button" href="<?php echo e(URL::to('cafeteria/'.$order->Cos_Order_Num)); ?>">
                        Print Delivery Info
					</a>
					<?php endif; ?>
					<?php if($order->Cos_Order_Meal_Status == "Prepared"): ?>
					<a class="btn btn-info btn-block btn-flat "  type="button" href="<?php echo e(URL::to('delivery_request/'.$order->Cos_Order_Num)); ?>">
                        Send Delivery Request
					</a>
					<?php endif; ?>
					<?php if($order->Cos_Order_Meal_Status == "Pending Delivery"): ?>
					<a class="btn btn-danger btn-block btn-flat"  type="button" href="<?php echo e(URL::to('delete_delivery_request/'.$order->D_Instruction_ID.'/'.$order->Cos_Order_Num)); ?>">
                        Delete Delivery Request
					</a>
					<?php endif; ?>
					<a class="btn btn-success btn-block btn-flat" type="button" href="<?php echo e(URL::to('cafeteria/'.$order->Cos_Order_Num.'/edit')); ?>">
                        Change delivery status
					</a>
							
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
<?php echo $__env->make('layouts.app_cafeteria', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/cafeteria staff/orderviewall.blade.php ENDPATH**/ ?>