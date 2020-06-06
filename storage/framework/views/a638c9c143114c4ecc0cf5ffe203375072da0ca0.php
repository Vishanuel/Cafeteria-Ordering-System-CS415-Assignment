<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>Your </small>
        Order History
        <small> in one place ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Order History</li>
		<li><a target="_blank" href="<?php echo e(url('help/ViewingSummaryofOrderHistory.html')); ?>">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order History</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order Number</th>
                  <th>Date Order Placed</th>
                  <th>Meal Date</th>
                  <th>Meal Status</th>
                  <th>Cost</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php $__currentLoopData = $orderall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Num); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Date_Time); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Meal_Date_Time); ?></td>
                  <td style="text-overflow: ellipsis;"><?php echo e($order->Cos_Order_Meal_Status); ?></td>
                  <td style="text-overflow: ellipsis;">$<?php echo e($order->Cos_Order_Cost); ?>.00</td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
						 
					<a class="btn btn-info btn-flat" type="button" href="<?php echo e(URL::to('order_edit_details/'.$order->Cos_Order_Num)); ?>">
                              
                        Show details
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/orderviewall.blade.php ENDPATH**/ ?>