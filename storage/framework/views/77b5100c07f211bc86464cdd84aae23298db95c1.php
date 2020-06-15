<?php $__env->startSection('content'); ?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>The place your</small>
        Order
        <small>form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Place Order</li>
		<li><a target="_blank" href="<?php echo e(url('help/TheOrderingProcess.html')); ?>"><span class="glyphicon glyphicon-question-sign" style="font-size: 15px;"></span></a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-success">
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
                <!-- text input -->
				
				<div id="food_itemd1" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item1" name="food_item1" style="width: 100%;" Required placeholder="Select food" >
						<!--option disabled>Select food</option--> 
						<?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option name="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?> <?php echo e($food->Deliverable); ?>"   Required value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e(number_format((float)$food->Price, 2, '.', '')); ?> <?php echo e($food->Deliverable); ?>" >
							<?php echo e($food->Food_Name." - ".$food->Food_Desc." - $".number_format((float)$food->Price, 2, '.', '')); ?> 
						</option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
					</select>
					
					<div id="items1">
						<input id="item_total" value="<?php echo e(count($items)); ?>"  type="hidden">
						<?php for($i=0;$i<count($items);$i++): ?>
						<div class="check1 checkbox" id="1choice<?php echo e($items[$i]->Menu_Food_Item_ID); ?>" style="display:none;">
						
						
					
					
							<input id="item_number<?php echo e($i); ?>" value="<?php echo e($items[$i]->Menu_Food_Item_ID); ?>"  type="hidden">
							</br>
							<?php for($j=0;$j<count($cus_ingredients[$i]);$j++): ?>
							<div class="row">
								<input id="all_ingredient<?php echo e($items[$i]->Menu_Food_Item_ID); ?>" value="<?php echo e(count($cus_ingredients[$i])); ?>"  type="hidden">
								<div class="form-group col-md-4 col-xs-6">
								<label><label class="pull-left" style="font-weight:bold;">Ingredient</label></br><input class="real checkbox" name="ingredient1[]" id ="<?php echo e($items[$i]->Menu_Food_Item_ID); ?>check<?php echo e($j); ?>" type="checkbox" value="<?php echo e($cus_ingredients[$i][$j]->Ingredient_ID); ?>"
								<?php for($k=0;$k<count($ingredients[$i]);$k++): ?>
								<?php if(($cus_ingredients[$i][$j]->Ingredient_ID)==($ingredients[$i][$k]->Ingredient_ID)): ?>  ? checked : 
								<?php endif; ?> <?php endfor; ?>>
								<?php echo e($cus_ingredients[$i][$j]->Ingredient_Name); ?></label></div>
								<div class="form-group col-md-3 col-xs-6 price">
								<label style="font-weight:bold;">Price($)
										<input type="number" class="form-control" id="<?php echo e($items[$i]->Menu_Food_Item_ID); ?>ingredient_price<?php echo e($cus_ingredients[$i][$j]->Ingredient_ID); ?>" Required readonly value="<?php echo e($cus_ingredients[$i][$j]->Ingredient_Price); ?>" min="<?php echo e($cus_ingredients[$i][$j]->Ingredient_Price); ?>">
									</label>
									</div>
								</div>
							<?php endfor; ?>
						</div>
						<?php endfor; ?>
					</div>
				
				
				</div>

					<div id="quantityd1" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" id="quantity1" name="quantity1" max="" min="1" Required value="1">
					</div>
					<div id="qavailabled1" class="form-group col-md-2">
					  <label>Max Quantity Available</label>
					  <input type="number" class="form-control" id="qavailable1" name="qavailable1" Required readonly value="">
					</div>
					<div id="priced1" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" id="price1" name="price1" Required readonly value="">
					</div>
				
				<div id="hr<?php echo e($i); ?>" class="col-md-12">
						<hr class=""  width="95%" style="background:grey;">
					</div>
				
				<div class="col-md-10">
					<a type="button" id="addfood" class="btn bg-olive btn-flat margin">Add more food item</a>
				</div>
				
				<?php if(!empty($specialfoods)): ?>
				<div id="specialfoods123" class="form-group col-md-6">
				<label>Special</label>
				<select class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
					<option>No special selected</option>
						<?php $__currentLoopData = $specialfoods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($food->Special_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Special_Price); ?>">
								<?php echo e($food->Special_Desc); ?> 
							</option>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				</div>
				<div id="specialfoodsquantityd" class="form-group col-md-2">
				  <label>Quantity</label>
				  <input type="number" class="form-control" id="specialfoodsquantity" name="specialfoodsquantity" max="" min="1" value="1">
				</div>
				<div id="specialfoodsqavailabled" class="form-group col-md-2">
				  <label>Max Quantity Available</label>
				  <input type="number" class="form-control" id="specialfoodsqavailable" name="specialfoodsqavailable" readonly value="">
				</div>
				<div id="specialfoodspriced" class="form-group col-md-2">
				  <label>Price ($)</label>
				  <input type="number" class="form-control" id="specialfoodsprice" name="specialfoodsprice" readonly value="">
				</div>
				<?php endif; ?>

				<div id="tcostd" class="form-group col-md-2 col-xs-12 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control " id="tcost" name="tcost" Required readonly value="">
			   </div>
			   
				<!-- <div id="food" ></div>-->
				<div class="form-group col-md-10">
				<!--<label >Pick meal collection method</label>-->
					<div class="radio">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" style="clear: none; width: auto;" id="optionsRadios1" <?php if($deduction->Patron_Deduction_Status == 0 && $deduction->Patron_CardRegister_Status == 0): ?> value="disabled" <?php else: ?> value="delivery" <?php endif; ?> >
						  Get meal delivered 
						</label>
					  </div>
				
				
					  <div class="radio">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" style="clear: none; width: auto;" id="optionsRadios2" value="pick-up" checked>  
						  Pick-up meal from restaurant
						</label>
					 </div>
				 
				 </div>
				<div class="has-error col-md-12" id="dwarn" name="dwarn" ><span class="help-block">No delivery time available. Either pick-up order from restaurant or change meal date.</span></div>
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select class="form-control select2" id="location_id" name="location_id" style="width: 100%;" Required placeholder="Select location">
							<option id="location_id" name="location_id"  disabled>Select location</option> 
							<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option name="location_id" Required value="<?php echo e($location->Location_ID); ?>">
									<?php echo e($location->Location_Name); ?>

								</option>
								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select class="form-control select2" id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time1" name="location_time1"  disabled>Select delivery time </option> 
							
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
                  <input type="text" class="form-control" name="meal_date" id="meal_date" value="<?php echo e(date("Y-m-d")); ?>" required>
                </div>
				<div class="has-error" id="cwarning" name="cwarning"><span class="help-block">The current order time has exceeded the order cutoff time set for today, therefore you cannot order your meal(s) today. Sorry for the inconvience caused.</span></div>
                <!-- /.input group -->
              </div>
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="2" class="form-group col-md-12" style="display: none">2</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="<?php echo e($deduction->Patron_Deduction_Status); ?>"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($orderid); ?>"> 
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="<?php echo e($menuid); ?>">

			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="<?php echo e(url('order_cancel')); ?>" class="btn btn-default btn-flat">Cancel</a>
                <button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li>Order</button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/order.blade.php ENDPATH**/ ?>