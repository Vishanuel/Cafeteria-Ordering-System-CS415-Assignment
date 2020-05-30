@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>The edit your</small>
        Order
        <small>form ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
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
              <form id="orderform" role="form" method="POST" action="{{action('OrderStudentController@store')}}" enctype="multipart/form-data">
			   @csrf
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
                <!-- text input -->
				<?php $i = $food_count;?>
				@foreach($food_selecteds as $food_select)
				
				<div id="food_itemd{{$i}}" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item{{$i}}" name="food_item{{$i}}" style="width: 100%;" Required placeholder="Select food">
						
						@foreach ($foods as $food )
							<option  Required @if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID) selected value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @else value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @endif >
									{{ $food->Food_Name." - ".$food->Food_Desc }} 
							</option>
							
						@endforeach
					</select>
					<div id="items{{$i}}">
						<input id="item_total" value="{{count($items)}}"  type="hidden">
						@for($n=0;$n<count($items);$n++)
						@if($items[$n]->Menu_Food_Item_ID==$ordered_item[$i-1]->Menu_Food_Item_ID)
						<div class="check{{$i}} checkbox form-group" id="{{$i}}choice{{$items[$n]->Menu_Food_Item_ID}}"  style="display:none;">
								<input id="item_number{{$i}}" value="{{$items[$n]->Menu_Food_Item_ID}}"  type="hidden">
							@if(count($cus_ingredients[$n])>0)
							<label><b>Ingredients</b></label>
							@endif
							@for($j=0;$j<count($cus_ingredients[$n]);$j++)
							<div><label><input class="real" name="ingredient{{$i}}[]" type="checkbox" value="{{$cus_ingredients[$n][$j]->Ingredient_ID}}"
								@for($k=0;$k<count($ordered_ingredient[$i-1]);$k++)
								@if(($cus_ingredients[$n][$j]->Ingredient_ID)==($ordered_ingredient[$i-1][$k]->Ingredient_ID))  ? checked : 
								@endif @endfor>
								{{$cus_ingredients[$n][$j]->Ingredient_Name}}</label></div>
							@endfor
						</div>
						@endif
						@endfor
					</div>
				</div>
					
					<div id="quantityd{{$i}}" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="{{$food_select->Quantity}}">
					</div>
					<div id="qavailabled{{$i}}" class="form-group col-md-2">
					  <label>Max Quantity Available</label>
					  <input type="number" class="form-control" id="qavailable{{$i}}" name="qavailable{{$i}}" Required readonly value="">
					</div>
					<div id="priced{{$i}}" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" id="price{{$i}}" name="price{{$i}}" Required readonly value="">
					</div>
					@if($i > 1) <div class="col-md-12"><a type="button" id="removefood{{$i}}" class="btn bg-maroon btn-flat margin">Remove item</a></div> @endif
					<?php $i= $i - 1; ?>
					
				@endforeach
				
				<div class="col-md-10">
					<a type="button" id="addfood" class="btn bg-olive btn-flat margin">Add more food item</a>
				</div>
				@if(!empty($specialfoods))
				<div id="specialfoods123" class="form-group col-md-6">
					<label>Special</label>
					<select class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
						<option>No special selected</option>
							@foreach ($specialfoods as $food )
								<option @if($special_id != null)@if($food->Special_ID == $special_id->Special_ID) selected @endif @endif value="{{ $food->Special_ID}} {{$food->Quantity}} {{$food->Special_Price}}">
									{{ $food->Special_Desc }} 
								</option>
							@endforeach
					</select>
				</div>
				<div id="specialfoodsquantityd" class="form-group col-md-2">
				  <label>Quantity</label>
				  <input type="number" class="form-control" id="specialfoodsquantity" name="specialfoodsquantity" max="" min="1" @if($special_id != null) value="{{$special_id->Quantity}}"@else value="1" @endif>
				</div>
				<div id="specialfoodsqavailabled" class="form-group col-md-2">
				  <label>Max Quantity Available</label>
				  <input type="number" class="form-control" id="specialfoodsqavailable" name="specialfoodsqavailable" readonly value="">
				</div>
				<div id="specialfoodspriced" class="form-group col-md-2">
				  <label>Price ($)</label>
				  <input readonly type="number" class="form-control" id="specialfoodsprice" name="specialfoodsprice"  value="">
				</div>
				@endif
				<div id="tcostd" class="form-group col-md-2 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->
				<div class="form-group col-md-10">
				

				
					<div class="radio">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios1" value="delivery" @if($mealmethod == "delivery") checked @endif @if($deduction->Student_CardRegister_Status == 0) disabled @endif >
						  Get meal delivered
						</label>
					</div>
					
				
					<div class="radio">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios2" value="pick-up" @if($mealmethod == "pick-up") checked @endif>
						  Pick-up meal from restaurant
						</label>
					 </div>
				
				 </div>
				
				<div class="has-error col-md-12" id="dwarn" name="dwarn" ><span class="help-block">No delivery time available. Either pick-up order from restaurant or change meal date.</span></div>
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select class="form-control select2" id="location_id" name="location_id" style="width: 100%;" Required placeholder="Select location">
							<option disabled>Select location</option> 
							@foreach ($locations as $location )
								<option  @if($mealmethod == "delivery")  @if($delivery_info->D_Location == $location->Location_ID) selected="selected" @endif  @endif Required value="{{ $location->Location_ID}}">
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select class="form-control select2" id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time" name="location_time"  disabled>Select delivery time </option> 
							@if($mealmethod == "delivery")
								<option id="location_time" name="location_time"  value="{{$delivery_info->D_Time_Window}}" >{{$delivery_info->D_Time_Window}} </option>
							@endif 
						</select>
						
					</div>
                </div>
				
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="{{$order_cutoff->Order_Cutoff_Time }}">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="meal_date" id="meal_date" value="{{$cos_order->Cos_Meal_Date_Time}}" required>
                </div>
				<div class="has-error" id="cwarning" name="cwarning"><span class="help-block">The current order time has exceeded the order cutoff time set for today, therefore you cannot order your meal(s) today. Sorry for the inconvience caused.</span></div>
                <!-- /.input group -->
              </div>
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="{{$food_count+1}}" class="form-group col-md-12" style="display: none">{{$food_count+1}}</div>
			
			<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid}}"> 
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}"> 
            </div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{url('student_order_cancel')}}" class="btn btn-default btn-flat">Cancel</a>
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
@endsection