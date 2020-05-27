<?php $__env->startSection('content'); ?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>The edit your</small>
        Order
        <small>form ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Place Order</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
			  <div class="callout callout-warning">
                <h4>Attention!</h4>

                <p>Some meals will not be orderable when the "Get meal delivered" option is selected.<br> The selected food option may also change when a non-orderable food is already selected.</p>
              </div>
              <form id="orderform" role="form" method="POST" action="<?php echo e(action('OrderController@store')); ?>" enctype="multipart/form-data">
			   <?php echo csrf_field(); ?>
				<div id="2" class="col-md-12" ><p class="text-red"><?php echo e($error ?? ''); ?></p></div>
                <!-- text input -->
				<?php $i = $food_count;?>
				<?php $__currentLoopData = $food_selecteds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food_select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<div id="food_itemd<?php echo e($i); ?>" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item<?php echo e($i); ?>" name="food_item<?php echo e($i); ?>" style="width: 100%;" Required placeholder="Select food">
						<!--option  disabled>Select food</option--> 
						<?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option  Required <?php if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID): ?> selected value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?> <?php echo e($food->Deliverable); ?>" <?php else: ?> value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?> <?php echo e($food->Deliverable); ?>" <?php endif; ?> >
									<?php echo e($food->Food_Name." - ".$food->Food_Desc); ?> 
							</option>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					
				</div>
					
					<div id="quantityd<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" id="quantity<?php echo e($i); ?>" name="quantity<?php echo e($i); ?>" max="" min="1" Required value="<?php echo e($food_select->Quantity); ?>">
					</div>
					<div id="qavailabled<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Max Quantity Available</label>
					  <input type="number" class="form-control" id="qavailable<?php echo e($i); ?>" name="qavailable<?php echo e($i); ?>" Required readonly value="">
					</div>
					<div id="priced<?php echo e($i); ?>" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" id="price<?php echo e($i); ?>" name="price<?php echo e($i); ?>" Required readonly value="">
					</div>
					<?php if($i > 1): ?> <div class="col-md-12"><a type="button" id="removefood<?php echo e($i); ?>" class="btn bg-maroon btn-flat margin">Remove item</a></div> <?php endif; ?>
					<?php $i= $i - 1; ?>
					
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<div class="col-md-10">
					<a type="button" id="addfood" class="btn bg-olive btn-flat margin">Add more food item</a>
				</div>
				<?php if(!empty($specialfoods)): ?>
				<div id="specialfoods123" class="form-group col-md-6">
					<label>Special</label>
					<select class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
						<option>No special selected</option>
							<?php $__currentLoopData = $specialfoods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($special_id != null): ?><?php if($food->Special_ID == $special_id->Special_ID): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($food->Special_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Special_Price); ?>">
									<?php echo e($food->Special_Desc); ?> 
								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div id="specialfoodsquantityd" class="form-group col-md-2">
				  <label>Quantity</label>
				  <input type="number" class="form-control" id="specialfoodsquantity" name="specialfoodsquantity" max="" min="1" <?php if($special_id != null): ?> value="<?php echo e($special_id->Quantity); ?>"<?php else: ?> value="1" <?php endif; ?>>
				</div>
				<div id="specialfoodsqavailabled" class="form-group col-md-2">
				  <label>Max Quantity Available</label>
				  <input type="number" class="form-control" id="specialfoodsqavailable" name="specialfoodsqavailable" readonly value="">
				</div>
				<div id="specialfoodspriced" class="form-group col-md-2">
				  <label>Price ($)</label>
				  <input readonly type="number" class="form-control" id="specialfoodsprice" name="specialfoodsprice"  value="">
				</div>
				<?php endif; ?>
				<div id="tcostd" class="form-group col-md-2 col-xs-12 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->
				<div class="form-group col-md-10">
				
					<div class="radio">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios1" value="delivery" <?php if($mealmethod == "delivery"): ?> checked <?php endif; ?> <?php if($deduction->Patron_Deduction_Status == 0): ?> disabled <?php endif; ?> >
						  Get meal delivered
						</label>
					  </div>
				
				
					  <div class="radio">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios2" value="pick-up" <?php if($mealmethod == "pick-up"): ?> checked <?php endif; ?>>
						  Pick-up meal from restaurant
						</label>
					 </div>
				
				 </div>
				<div class="has-error col-md-12" id="dwarn" name="dwarn" ><span class="help-block">No delivery time available. Either pick-up order from restaurant or change meal date.</span></div>
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select class="form-control select2" id="location_id" name="location_id" style="width: 100%;" Required placeholder="Select location">
							<option  disabled>Select location</option> 
							<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option  <?php if($mealmethod == "delivery"): ?>  <?php if($delivery_info->D_Location == $location->Location_ID): ?> selected="selected" <?php endif; ?>  <?php endif; ?> Required value="<?php echo e($location->Location_ID); ?>">
									<?php echo e($location->Location_Name); ?>

								</option>
								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select class="form-control select2" id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time" name="location_time"  disabled>Select delivery time </option> 
							<?php if($mealmethod == "delivery"): ?>
								<option id="location_time" name="location_time"  value="<?php echo e($delivery_info->D_Time_Window); ?>" ><?php echo e($delivery_info->D_Time_Window); ?> </option>
							<?php endif; ?> 
						</select>
						
					</div>
                </div>
				
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="<?php echo e($order_cutoff->Order_Cutoff_Time); ?>">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="meal_date" id="meal_date" value="<?php echo e($cos_order->Cos_Meal_Date_Time); ?>" required>
                </div>
				<div class="has-error" id="cwarning" name="cwarning"><span class="help-block">The current order time has exceeded the order cutoff time set for today, therefore you cannot order your meal(s) today. Sorry for the inconvience caused.</span></div>
                <!-- /.input group -->
              </div>
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="<?php echo e($food_count+1); ?>" class="form-group col-md-12" style="display: none"><?php echo e($food_count+1); ?></div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="<?php echo e($deduction->Patron_Deduction_Status); ?>"> 
			<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($orderid); ?>"> 
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="<?php echo e($menuid); ?>"> 
            </div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="<?php echo e(url('order_cancel')); ?>" class="btn btn-default btn-flat">Cancel</a>
                <button type="submit"  class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Order</button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/orderfinal.blade.php ENDPATH**/ ?>