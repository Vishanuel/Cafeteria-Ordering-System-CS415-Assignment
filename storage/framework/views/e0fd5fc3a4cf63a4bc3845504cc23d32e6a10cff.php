<?php $__env->startSection('content'); ?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	    <small>The</small>
        Payment 
        <small>option form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Payment Option</li>
		<li><a target="_blank" href="<?php echo e(url('help/ChoosingthePaymentOption.html')); ?>"><span class="glyphicon glyphicon-question-sign" style="font-size: 15px;"></span></a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Select payment method</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="<?php echo e(action('OrderController@payment')); ?>" enctype="multipart/form-data">
			   <?php echo csrf_field(); ?>
                <!-- text input -->
				
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios1" value="payroll"  <?php if($deductions->Patron_Deduction_Status == 0): ?> disabled <?php endif; ?> <?php if($mealmethod=="delivery"): ?> checked <?php endif; ?> <?php if($deductions->Patron_Deduction_Status == 0): ?> disabled <?php endif; ?> <?php if($mealmethod!="delivery"&&$deductions->Patron_Deduction_Status != 0): ?> checked <?php endif; ?>>
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios3" value="card" <?php if($deductions->Patron_CardRegister_Status == 0): ?> disabled <?php endif; ?>>
						  Card payment
						</label>
				    </div>
				</div>
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios2" value="cash" <?php if($mealmethod=="delivery"): ?> disabled <?php endif; ?> <?php if($deductions->Patron_Deduction_Status == 0): ?> checked <?php endif; ?>>
						  Cash Payment at pickup
						</label>
				    </div>
				</div>
				 
				<div id="2" class="col-md-12" ><p class="text-red"><?php echo e($error ?? ''); ?></p></div>
				<input id="tcost" name="tcost" class="form-group col-md-12" style="display: none" value="<?php echo e($total_cost); ?>"> 
				<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="<?php echo e($deductions->Patron_Deduction_Status); ?>"> 
				<input id="mealmethodn" name="mealmethodn" class="form-group col-md-12" style="display: none" value="<?php echo e($mealmethod); ?>">
				<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($orderid ?? ''); ?>">
				<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="<?php echo e($menuid); ?>">
				<?php if($special_id == null): ?>
					<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="null"> 
				
				<?php else: ?>
					<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="<?php echo e($special_id->Special_ID); ?>"> 
				<?php endif; ?>
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
				<div class="btn-toolbar">
					<a href="<?php echo e(url('order_cancel')); ?>" class="btn btn-default btn-flat">Cancel</a>
					<button type="submit" data-barba-prevent="self" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Continue</button>
					<a href="<?php echo e(route('order_edit', $orderid ?? '')); ?>"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
				</div>	
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/payment.blade.php ENDPATH**/ ?>