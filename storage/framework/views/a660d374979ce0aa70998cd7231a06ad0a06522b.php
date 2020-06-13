<?php $__env->startSection('content'); ?>
<div class="content-wrapper"  >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>Your detailed</small>
        Order
        <small>information .....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Order Info</li>
		<li><a target="_blank" href="<?php echo e(url('help/OrderConfirmationPage.html')); ?>">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
		  <div class="box loading box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="<?php echo e(action('OrderController@confirm')); ?>" enctype="multipart/form-data">
			   <?php echo csrf_field(); ?>
			   <?php echo method_field('PATCH'); ?>
				<div id="2" class="col-md-12" ><p class="text-red"><?php echo e($error ?? ''); ?></p></div>
                <!-- text input -->
				<?php $i = 1;?>
				<?php $__currentLoopData = $food_selecteds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food_select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<div id="food_itemd<?php echo e($i); ?>" class="form-group col-md-8">
					<label>Food Item</label>
					<select disabled class="form-control select2" id="food_item<?php echo e($i); ?>" name="food_item<?php echo e($i); ?>" style="width: 100%;" Required placeholder="Select food">
						<option  disabled>Select food</option> 
						<?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option Required <?php if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID): ?> selected value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php else: ?> value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php endif; ?> >
								<?php echo e($food->Food_Name." - $". $food->Price ." - ".$food->Food_Desc); ?>

							</option>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				
					

				
				</div>
				
					<div id="quantityd<?php echo e($i); ?>" class="form-group col-md-2 ">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity<?php echo e($i); ?>" name="quantity<?php echo e($i); ?>" max="" min="1" Required value="<?php echo e($food_select->Quantity); ?>">
					</div>
			
					<div id="priced<?php echo e($i); ?>" class="form-group col-md-2 ">
					  <label>Price($)</label>
					  <input type="number" class="form-control" readonly id="price<?php echo e($i); ?>" name="price<?php echo e($i); ?>" Required readonly value="">
					</div>
					
					<div id="items<?php echo e($i); ?>" class="col-md-12">
						<?php for($j=0;$j<count($items);$j++): ?>
							<div class="check<?php echo e($j); ?> checkbox" id="<?php echo e($i); ?>choice<?php echo e($items[$j]->Menu_Food_Item_ID); ?>" style="display:none;">
								<input id="item_number<?php echo e($i); ?>" value="<?php echo e($items[$i]->Menu_Food_Item_ID); ?>"  type="hidden">
							<?php if($items[$j]->Menu_Food_Item_ID==$ordered_item[$i-1]->Menu_Food_Item_ID): ?>
								<?php for($k=0;$k<count($cus_ingredients[$j]);$k++): ?>
									
								<div class="row" id="idrow<?php echo e($k); ?>"><input id="all_ingredient<?php echo e($items[$j]->Menu_Food_Item_ID); ?>" value="<?php echo e(count($cus_ingredients[$j])); ?>"  type="hidden">
								<div class=" form-group col-md-4 col-xs-6" id="idformgroup<?php echo e($k); ?>"><label><label class="pull-left" style="font-weight:bold;">Ingredient</label></br><input class="real" name="ingredient<?php echo e($i); ?>[]" id ="<?php echo e($items[$j]->Menu_Food_Item_ID); ?>check<?php echo e($k); ?>" type="checkbox" value="<?php echo e($cus_ingredients[$j][$k]->Ingredient_ID); ?>"
									<?php for($m=0;$m<count($ordered_ingredient[$i-1]);$m++): ?>
									<?php if(($cus_ingredients[$j][$k]->Ingredient_ID)==($ordered_ingredient[$i-1][$m]->Ingredient_ID)): ?>  ? checked : 
									 <?php endif; ?> <?php endfor; ?> disabled>
									<?php echo e($cus_ingredients[$j][$k]->Ingredient_Name); ?></label></div>
									<div class="form-group col-md-3 col-xs-6 price">
									<label style="font-weight:bold;">Price($)
									<input type="number" class="form-control" id="<?php echo e($items[$j]->Menu_Food_Item_ID); ?>ingredient_price<?php echo e($cus_ingredients[$j][$k]->Ingredient_ID); ?>" Required readonly value="<?php echo e($cus_ingredients[$j][$k]->Ingredient_Price); ?>" >
								</label>
								</div>
								  
							</div>
								<?php endfor; ?>
							<?php endif; ?>
						</div>
						<?php endfor; ?>
					</div>
					<div id="hr<?php echo e($i); ?>" class="col-md-12">
						<hr class=""  width="95%" style="color:grey;background:grey;">
					</div>
					<?php $i= $i + 1; ?>
				
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				
				
				<?php if($special_id != null && !empty($specialfoods)): ?>
				<div id="specialfoods123" class="form-group col-md-6">
				<label>Special</label>
				<select disabled class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
					<option>No special selected</option>
						<?php $__currentLoopData = $specialfoods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option <?php if($food->Special_ID == $special_id->Special_ID): ?> selected <?php endif; ?> value="<?php echo e($food->Special_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Special_Price); ?>">
								<?php echo e($food->Special_Desc); ?> 
							</option>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				
				</div>
				<div id="specialfoodsqavailabled" class="form-group" style="display: none"></div>
				<div id="specialfoodsquantityd" class="form-group col-md-2">
				  <label>Quantity</label>
				  <input readonly type="number" class="form-control" id="specialfoodsquantity" name="specialfoodsquantity" max="" min="1" value="<?php echo e($special_id->Quantity); ?>">
				</div>
				<div id="specialfoodspriced" class="form-group col-md-2">
				  <label>Price($)</label>
				  <input type="number" class="form-control" id="specialfoodsprice" name="specialfoodsprice" readonly value="">
				</div>
				<?php endif; ?>
				
				<div id="tcostd" class="form-group col-md-2">
				  <label>Total($)</label>
				
				<input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->
				
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" id="1optionsRadios1"  value="delivery" <?php if($mealmethod == "delivery"): ?> checked <?php else: ?> disabled <?php endif; ?> >
						  Get meal delivered
						</label>
					  </div>
				</div>
				
			
				<div class="form-group">
					  <div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="2optionsRadios2"  value="pick-up"  <?php if($mealmethod == "pick-up"): ?> checked <?php else: ?> disabled <?php endif; ?> >
						  Pick-up meal from restaurant
						</label>
					 </div>
				 </div>
				
				<!--input type="text" class="form-control" id="fse" name="tcosfset" Required readonly value="<?php echo e($mealmethod); ?>"-->
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="<?php echo e($order_cutoff->Order_Cutoff_Time); ?>">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" disabled readonly name="meal_date" id="meal_date" value="<?php echo e($cos_order->Cos_Meal_Date_Time); ?>" required>
                </div>
				
                <!-- /.input group -->
              </div>
			
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""> </div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="<?php echo e($i); ?>" class="form-group col-md-12" style="display: none"><?php echo e($i); ?></div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="<?php echo e($deduction->Patron_Deduction_Status); ?>"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($cos_order->Cos_Order_Num); ?>">
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="<?php echo e($menuid); ?>"> 
			
			
			<?php if($special_id == null): ?>
				<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="null"> 
				
			<?php else: ?>
				<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="<?php echo e($special_id->Special_ID); ?>"> 
			<?php endif; ?>
			
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 
          </div>
		  
          <!-- /.box -->
        </div>
		
        <!--/.col (right) -->
    
	  <?php if($mealmethod == "delivery"): ?>

		<div class="col-md-6">
		  <div class="box loading box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Delivery Info</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
			
				
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select disabled class="form-control " id="location_id" name="location_id" style="width: 100%;" Required placeholder="Select location">
							<option disabled>Select location</option> 
							<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($mealmethod == "delivery"): ?>  <?php if($delivery_info->D_Location == $location->Location_ID): ?> selected="selected" <?php endif; ?>  <?php endif; ?> Required value="<?php echo e($location->Location_ID); ?>">
									<?php echo e($location->Location_Name); ?>

								</option>
								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select disabled class="form-control " id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time" name="location_time"  disabled>Select delivery time </option> 
							<?php if($mealmethod == "delivery"): ?>
								<option id="location_time" name="location_time"  value="<?php echo e($delivery_info->D_Time_Window); ?>" ><?php echo e($delivery_info->D_Time_Window); ?> </option>
							<?php endif; ?> 
						</select>
						
					</div>
                </div>
				
				 
			</div>
			
			</div>
		  </div>
		
		<?php endif; ?>
	  
		<div class="col-md-6">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Method</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">

				<div class="form-group col-md-6">
					<div class="radio">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios1" value="payroll"  <?php if($deduction->Patron_Deduction_Status == 0): ?> disabled <?php endif; ?> <?php if($cos_order->Cos_Order_Payment_Method=="payroll"): ?> checked <?php else: ?> disabled <?php endif; ?>>
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group col-md-6">
					  <div class="radio">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios2" value="cash" <?php if($mealmethod=="delivery"): ?> disabled <?php endif; ?> <?php if($deduction->Patron_Deduction_Status == 0): ?> checked <?php endif; ?> <?php if($cos_order->Cos_Order_Payment_Method=="cash"): ?> checked <?php else: ?> disabled <?php endif; ?>>
						  Cash Payment at pickup
						</label>
					 </div>
				</div>  
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios3" value="card" <?php if($deduction->Patron_CardRegister_Status == 0): ?> disabled <?php endif; ?> <?php if($cos_order->Cos_Order_Payment_Method=="card"): ?> checked <?php else: ?> disabled <?php endif; ?>>
						  Card payment
						</label>
				    </div>
				</div>
				
			</div>
			
			</div>
		  </div>
		  
		  
		  
		<div class="col-md-6 col-xs-12 pull-left">
			<div class="box loading box-default">
				<div class="box-header with-border">
					<div class="btn-toolbar">
						<a href="<?php echo e(url('order_cancel')); ?>" class="btn btn-default btn-flat pull-left">Cancel</a>
						
						<button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Confirm</button>
						
						<a href="<?php echo e(route('order_edit', $cos_order->Cos_Order_Num)); ?>"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
					</div>
				</div>
			</div> 
		</div> 
		</form>
		</div>
		
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <script>
	
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/orderview.blade.php ENDPATH**/ ?>