@extends('layouts.app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>The place your</small>
        Order
        <small>form</small>
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
              <form id="orderform" role="form" method="POST" action="{{action('OrderController@store')}}" enctype="multipart/form-data">
			   @csrf
                <!-- text input -->
				
				<div id="food_itemd1" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item1" name="food_item1" style="width: 100%;" Required placeholder="Select food" >
						<option disabled>Select food</option> 
						@foreach ($foods as $food )
						<option name="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}} {{$food->Deliverable}}"   Required value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}} {{$food->Deliverable}}" >
							{{ $food->Food_Name." - ".$food->Food_Desc }} 
						</option>
						@endforeach
						
					</select>
					
					
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
				
				
				
				<div class="col-md-10">
					<a type="button" id="addfood" class="btn bg-olive btn-flat margin">Add more food item</a>
				</div>
				
				@if(!empty($specialfoods))
				<div id="specialfoods123" class="form-group col-md-6">
				<label>Special</label>
				<select class="food form-control select2" id="specialfoods" name="specialfoods" style="width: 100%;" placeholder="Select special">
					<option>No special selected</option>
						@foreach ($specialfoods as $food )
							<option value="{{ $food->Special_ID}} {{$food->Quantity}} {{$food->Special_Price}}">
								{{ $food->Special_Desc }} 
							</option>
							
						@endforeach
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
				@endif

				<div id="tcostd" class="form-group col-md-2 col-xs-12 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control " id="tcost" name="tcost" Required readonly value="">
			   </div>
			   
				<!-- <div id="food" ></div>-->
				<div class="form-group col-md-10">
				<!--<label >Pick meal collection method</label>-->
					<div class="radio">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" style="clear: none; width: auto;" id="optionsRadios1" value="delivery"  @if($deduction->Patron_Deduction_Status == 0) disabled @endif >
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
							<option id="location_id1" name="location_id1"  disabled>Select location</option> 
							@foreach ($locations as $location )
								<option id="location_id" name="location_id" Required value="{{ $location->Location_ID}}">
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
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
				
				<input id="cutoff" name="cutoff" type="hidden" value="{{$order_cutoff->Order_Cutoff_Time }}">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="meal_date" id="meal_date" value="{{date("Y-m-d")}}" required>
                </div>
				<div class="has-error" id="cwarning" name="cwarning"><span class="help-block">The current order time has exceeded the order cutoff time set for today, therefore you cannot order your meal(s) today. Sorry for the inconvience caused.</span></div>
                <!-- /.input group -->
              </div>
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="2" class="form-group col-md-12" style="display: none">2</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction->Patron_Deduction_Status}}"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid}}"> 
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}">

			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{url('order_cancel')}}" class="btn btn-default btn-flat">Cancel</a>
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
@endsection