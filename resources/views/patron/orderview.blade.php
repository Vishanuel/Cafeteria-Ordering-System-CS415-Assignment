@extends('layouts.app')

@section('content')
<div class="content-wrapper"  >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>Your detailed</small>
        Order
        <small>information .....</small>
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
        <div class="col-md-6">
		  <div class="box loading box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('OrderController@confirm')}}" enctype="multipart/form-data">
			   @csrf
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
								{{ $food->Food_Name." - ".$food->Food_Desc }}
							</option>
							
						@endforeach
					</select>
				</div>

				
					
					
					<div id="quantityd{{$i}}" class="form-group col-md-2 ">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="{{$food_select->Quantity}}">
					</div>
			
					<div id="priced{{$i}}" class="form-group col-md-2 ">
					  <label>Price($)</label>
					  <input type="number" class="form-control" readonly id="price{{$i}}" name="price{{$i}}" Required readonly value="">
					</div>
					
					<?php $i= $i + 1; ?>
					
				@endforeach
				
				
				@if($special_id != null && !empty($specialfoods))
				<div id="specialfoods123" class="form-group col-md-6">
				<label>Special</label>
				<select disabled class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
					<option>No special selected</option>
						@foreach ($specialfoods as $food )
							<option @if($food->Special_ID == $special_id->Special_ID) selected @endif value="{{ $food->Special_ID}} {{$food->Quantity}} {{$food->Special_Price}}">
								{{ $food->Special_Desc }} 
							</option>
							
						@endforeach
				</select>
				
				</div>
				<div id="specialfoodsqavailabled" class="form-group" style="display: none"></div>
				<div id="specialfoodsquantityd" class="form-group col-md-2">
				  <label>Quantity</label>
				  <input readonly type="number" class="form-control" id="specialfoodsquantity" name="specialfoodsquantity" max="" min="1" value="{{$special_id->Quantity}}">
				</div>
				<div id="specialfoodspriced" class="form-group col-md-2">
				  <label>Price($)</label>
				  <input type="number" class="form-control" id="specialfoodsprice" name="specialfoodsprice" readonly value="">
				</div>
				@endif
				
				<div id="tcostd" class="form-group col-md-2">
				  <label>Total($)</label>
				
				<input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->
				
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" id="1optionsRadios1"  value="delivery" @if($mealmethod == "delivery") checked @else disabled @endif >
						  Get meal delivered
						</label>
					  </div>
				</div>
				
			
				<div class="form-group">
					  <div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="2optionsRadios2"  value="pick-up"  @if($mealmethod == "pick-up") checked @else disabled @endif >
						  Pick-up meal from restaurant
						</label>
					 </div>
				 </div>
				
				<!--input type="text" class="form-control" id="fse" name="tcosfset" Required readonly value="{{$mealmethod}}"-->
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
			
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""> </div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="{{$i}}" class="form-group col-md-12" style="display: none">{{$i}}</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction->Patron_Deduction_Status}}"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$cos_order->Cos_Order_Num}}">
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}"> 
			
			
			@if($special_id == null)
				<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="null"> 
				
			@else
				<input id="special_id" name="special_id" class="form-group col-md-12" style="display: none" value="{{$special_id->Special_ID}}"> 
			@endif
			
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 
          </div>
		  
          <!-- /.box -->
        </div>
		
        <!--/.col (right) -->
    
	  @if($mealmethod == "delivery")

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
							@foreach ($locations as $location )
								<option @if($mealmethod == "delivery")  @if($delivery_info->D_Location == $location->Location_ID) selected="selected" @endif  @endif Required value="{{ $location->Location_ID}}">
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select disabled class="form-control " id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time" name="location_time"  disabled>Select delivery time </option> 
							@if($mealmethod == "delivery")
								<option id="location_time" name="location_time"  value="{{$delivery_info->D_Time_Window}}" >{{$delivery_info->D_Time_Window}} </option>
							@endif 
						</select>
						
					</div>
                </div>
				
				 
			</div>
			
			</div>
		  </div>
		
		@endif
	  
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
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios1" value="payroll"  @if($deduction->Patron_Deduction_Status == 0) disabled @endif @if($cos_order->Cos_Order_Payment_Method=="payroll") checked @else disabled @endif>
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group col-md-6">
					  <div class="radio">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios2" value="cash" @if($mealmethod=="delivery") disabled @endif @if($deduction->Patron_Deduction_Status == 0) checked @endif @if($cos_order->Cos_Order_Payment_Method=="cash") checked @else disabled @endif>
						  Cash Payment at pickup
						</label>
					 </div>
				</div>  
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios3" value="card" @if($deduction->Patron_CardRegister_Status == 0) disabled @endif @if($cos_order->Cos_Order_Payment_Method=="card") checked @else disabled @endif>
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
						<a href="{{url('order_cancel')}}" class="btn btn-default btn-flat pull-left">Cancel</a>
						
						<button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Confirm</button>
						
						<a href="{{route('order_edit', $cos_order->Cos_Order_Num)}}"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
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
@endsection