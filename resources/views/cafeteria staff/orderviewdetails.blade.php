@extends('layouts.app_cafeteria')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
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
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('CafeteriaController@update',[$cos_order->Cos_Order_Num])}}" enctype="multipart/form-data">
			   @csrf
			   @method('PUT')
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
                <!-- text input -->
				<?php $i = 1;?>
				@foreach($food_selecteds as $food_select)
				
				<div id="food_itemd{{$i}}" class="form-group col-md-6">
					<label>Food Item</label>
					<select disabled class="form-control select2" id="food_item{{$i}}" name="food_item{{$i}}" style="width: 100%;" Required placeholder="Select food">
						<option  disabled>Select food</option> 
						@foreach ($foods as $food )
							<option Required @if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID) selected value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @else value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @endif >
								{{ $food->Food_Name }} - ${{$food->Price}} - {{$food->Food_Desc}}
							</option>
							
						@endforeach
					</select>
				</div>
					
					
					
					<div id="quantityd{{$i}}" class="form-group col-md-3">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="{{$food_select->Quantity}}">
					</div>
			
					<div id="priced{{$i}}" class="form-group col-md-3">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" readonly id="price{{$i}}" name="price{{$i}}" Required readonly value="">
					</div>
					
					<div id="items{{$i}}" class="col-md-12">
						@for($j=0;$j<count($items);$j++)
							<div class="check{{$j}} checkbox" id="{{$i}}choice{{$items[$j]->Menu_Food_Item_ID}}" style="display:none;">
								<input id="item_number{{$i}}" value="{{$items[$i]->Menu_Food_Item_ID}}"  type="hidden">
							@if($items[$j]->Menu_Food_Item_ID==$ordered_item[$i-1]->Menu_Food_Item_ID)
								@for($k=0;$k<count($cus_ingredients[$j]);$k++)
									
								<div class="row" id="idrow{{$k}}"><input id="all_ingredient{{$items[$j]->Menu_Food_Item_ID}}" value="{{count($cus_ingredients[$j])}}"  type="hidden">
								<div class=" form-group col-md-4 col-xs-6" id="idformgroup{{$k}}"><label><label class="pull-left" style="font-weight:bold;">Ingredient</label></br><input class="real" name="ingredient{{$i}}[]" id ="{{$items[$j]->Menu_Food_Item_ID}}check{{$k}}" type="checkbox" value="{{$cus_ingredients[$j][$k]->Ingredient_ID}}"
									@for($m=0;$m<count($ordered_ingredient[$i-1]);$m++)
									@if(($cus_ingredients[$j][$k]->Ingredient_ID)==($ordered_ingredient[$i-1][$m]->Ingredient_ID))  ? checked : 
									 @endif @endfor disabled>
									{{$cus_ingredients[$j][$k]->Ingredient_Name}}</label></div>
									<div class="form-group col-md-3 col-xs-6 price">
									<label style="font-weight:bold;">Price($)
									<input type="number" class="form-control" id="{{$items[$j]->Menu_Food_Item_ID}}ingredient_price{{$cus_ingredients[$j][$k]->Ingredient_ID}}" Required readonly value="{{$cus_ingredients[$j][$k]->Ingredient_Price}}" >
								</label>
								</div>
								  
							</div>
								@endfor
							@endif
						</div>
						@endfor
					</div>
					<div id="hr{{$i}}" class="col-md-12">
						<hr class=""  width="95%" style="background:grey;">
					</div>
					
					<?php $i= $i + 1; ?>
					
				@endforeach
				
				<div id="tcostd" class="form-group col-md-4">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label id="del">
						  <input type="radio" disabled name="mealmethod" readonly id="optionsRadios1" value="delivery" @if($mealmethod == "delivery") checked @endif>
						  Get meal delivered
						</label>
					  </div>
				</div>
				<div class="form-group">
					  <div class="radio col-md-6 ">
						<label>
						  <input type="radio"  disabled name="mealmethod" readonly id="optionsRadios2" value="pick-up" @if($mealmethod == "pick-up") checked @endif>
						  Pick-up meal from restaurant
						</label>
					 </div>
				 </div>
				
				
				
				@if($mealmethod == "delivery")
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select disabled class="form-control select2" id="location_" name="location_" style="width: 100%;" Required placeholder="Select location">
							<option id="location_" name="location_"  disabled>Select location</option> 
							@foreach ($locations as $location )
								<option id="location_" name="location_" @if($mealmethod == "delivery")  @if($delivery_info->D_Location == $location->Location_ID) selected="selected" @endif  @endif Required value="{{ $location->Location_ID}}">
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select disabled class="form-control select2" id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_ti" name="location_ti"  disabled>Select delivery time </option> 
							@if($mealmethod == "delivery")
								<option id="location_ti" name="location_ti"  value="{{$delivery_info->D_Time_Window}}" >{{$delivery_info->D_Time_Window}} </option>
							@endif 
						</select>
						 
					</div>
                </div>
				@endif
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="{{$order_cutoff->Order_Cutoff_Time }}">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" disabled readonly name="meal_date" id="meal_date" value="{{$cos_order->Cos_Meal_Date_Time}}" required>
                </div>
				
                <!-- /.input group -->
              </div>
			 
			<div class="form-group col-md-12"> 
				<label>Meal Status</label>
				<select class="form-control select2" id="meal_status" name="meal_status" style="width: 100%;"  placeholder="Select location">
					<option id="meal_status" name="meal_status"  disabled value="" >Change meal status</option> 
					<option id="meal_status" name="meal_status" @if($cos_order->Cos_Order_Meal_Status == "Approved") selected @endif value="Approved">Approved</option>
					<option id="meal_status" name="meal_status" @if($cos_order->Cos_Order_Meal_Status == "Prepared") selected @endif value="Prepared">Prepared</option>
					<option id="meal_status" name="meal_status" @if($cos_order->Cos_Order_Meal_Status == "Cancelled") selected @endif value="Cancelled">Cancelled</option>
					<option id="meal_status" name="meal_status" @if($cos_order->Cos_Order_Meal_Status == "Completed") selected @endif value="Completed">Completed</option>
				</select>
				
			</div>
			
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="{{$i}}" class="form-group col-md-12" style="display: none">{{$i}}</div>
			
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$cos_order->Cos_Order_Num}}">
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}"> 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""></div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value="">
			<input id="delivery" name="delivery" class="form-group col-md-12" style="display: none" value="">
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{URL::to('cafeteria')}}" class="btn btn-default btn-flat">Back</a>
				
				<button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> 
				Save
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
@endsection