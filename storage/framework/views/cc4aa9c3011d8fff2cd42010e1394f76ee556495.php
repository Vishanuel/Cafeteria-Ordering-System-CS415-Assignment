<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription
        <small>form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="<?php echo e(url('smpdevice')); ?>">Device</a></li> -->
        <li class="active">Edit Subscription</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Subscription</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="<?php echo e(route('mealsub.update',$meal_subs->MealSubs_ID)); ?>" enctype="multipart/form-data">
			   <?php echo csrf_field(); ?>
               <?php echo method_field('PUT'); ?>
                <!-- text input -->
				
				<div class="form-group col-md-12">
				<div id="food_itemd1" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item1" name="food_item1" style="width: 100%;" Required placeholder="Select food">
						<option disabled>Select food</option> 
                        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        

			 			<option  Required <?php if($meal_subs->Menu_Food_Item_ID == $food->Menu_Food_Item_ID): ?> selected value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php else: ?> value="<?php echo e($food->Menu_Food_Item_ID); ?> <?php echo e($food->Quantity); ?> <?php echo e($food->Price); ?>" <?php endif; ?>>
								<?php echo e($food->Food_Name." - ".$food->Food_Desc); ?> 
                            </option>
                            
                            
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
					</select>
				</div>
           
					
					
					<div id="quantityd1" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" id="quantity1" name="quantity1" max="" min="1" Required value="<?php echo e($meal_subs->Food_Item_Qty); ?>">
					</div>
					<div id="qavailabled1" class="form-group col-md-2">
					  <label>Max Quantity Available</label>
					  <input type="number" class="form-control" id="qavailable1" name="qavailable1" Required readonly value="">
					</div>
					<div id="priced1" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" id="price1" name="price1" Required readonly value="">
					</div>
                
												
				<div id="tcostd" class="form-group col-md-2 col-xs-12 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control " id="tcost" name="tcost" Required readonly value="">
			   </div>
			   </div>
			   
				
				<!-- <div id="food" ></div>-->
					
				
                 <div class="form-group col-md-12">
                    <div id=dayd1" class="form-group col-md-6">
                        <label>Meal Days</label>
                        <select class="mealsub form-control select2" id="day1" name="day1" style="width: 100%;" Required placeholder="Select restaurant">
                            <option disabled>Select Meal Day</option>                             
                            <option  <?php if($meal_subs->Day == "Monday"): ?> selected <?php endif; ?> Required value="Monday">Monday</option>   
                            <option  <?php if($meal_subs->Day == "Tuesday"): ?> selected <?php endif; ?> Required value="Tuesday">Tuesday</option> 
                            <option  <?php if($meal_subs->Day == "Wednesday"): ?> selected <?php endif; ?> Required value="Wednesday">Wednesday</option> 
                            <option  <?php if($meal_subs->Day == "Thursday"): ?> selected <?php endif; ?> Required value="Thursday">Thursday</option> 
                            <option  <?php if($meal_subs->Day == "Friday"): ?> selected <?php endif; ?> Required value="Friday">Friday</option> 
                            <option  <?php if($meal_subs->Day == "Saturday"): ?> selected <?php endif; ?> Required value="Saturday">Saturday</option> 
                            <option  <?php if($meal_subs->Day == "Sunday"): ?> selected <?php endif; ?> Required value="Sunday">Sunday</option>                                                                           
                        </select>
                    </div>
              

              <!--div class="form-group col-md-12"-->
                <div id=dayd1" class="form-group col-md-6">
                    <label>Meal Type</label>
                    <select class="mealsub form-control select2" id="mealtype1" name="mealtype1" style="width: 100%;" Required placeholder="Select restaurant">
                        <option disabled>Select Meal Type</option>                             
                        <option <?php if($meal_subs->Meal_Type == "Breakfast"): ?> selected <?php endif; ?> Required value="Breakfast">Breakfast</option>
                        <option <?php if($meal_subs->Meal_Type == "Lunch"): ?> selected <?php endif; ?> Required value="Lunch">Lunch</option>
                        <option <?php if($meal_subs->Meal_Type == "Dinner"): ?> selected <?php endif; ?> Required value="Dinner">Dinner</option>   
                                                                                                
                    </select>
                </div>
				</div>
                <div class="form-group col-md-12">
                    <div id=timed1" class="form-group col-md-6">
                        <label>Meal Time</label>
                        <select class="mealsub form-control select2" id="mealtime1" name="mealtime1" style="width: 100%;" Required placeholder="Select restaurant">
                            <option disabled>Select Meal Time</option>                             
                            <option <?php if($meal_subs->Meal_Time == "8 am"): ?> selected <?php endif; ?> Required>8 am</option>
                            <option <?php if($meal_subs->Meal_Time == "10 am"): ?> selected <?php endif; ?> Required>10 am</option>
                            <option <?php if($meal_subs->Meal_Time == "1 pm"): ?> selected <?php endif; ?> Required>1 pm</option>
                            <option <?php if($meal_subs->Meal_Time == "3 pm"): ?> selected <?php endif; ?> Required>3 pm</option>
                            <option <?php if($meal_subs->Meal_Time == "5 pm"): ?> selected <?php endif; ?> Required>5 pm</option>
                            <option <?php if($meal_subs->Meal_Time == "7 pm"): ?> selected <?php endif; ?> Required>7 pm</option>   
                                                                                                    
                        </select>
                    </div>
                </div>
				
				<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="2" class="form-group col-md-12" style="display: none">2</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="<?php echo e($deduction->Patron_Deduction_Status); ?>"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="<?php echo e($orderid); ?>">
            
				
				<input id="mealstat" name="mealstat" class="form-group col-md-12" style="display: none" value="Pending"> 
				<!--input id="mealid" name="mealid" class="form-group col-md-12" style="display: none" value=""--> 
                <!-- /.input group -->
              </div>
			  
		
            </div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="<?php echo e(url('home')); ?>" class="btn btn-default btn-flat">Cancel</a>
                <button type="submit" data-barba-prevent="self" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li>Save Subscription</button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/patronmealsub_editdetails.blade.php ENDPATH**/ ?>