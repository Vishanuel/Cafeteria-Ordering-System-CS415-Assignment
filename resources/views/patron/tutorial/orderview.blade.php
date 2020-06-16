@extends('layouts.app_tutorial')

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
		<li><a target="_blank" href="{{url('help/OrderConfirmationPage.html')}}">Help</a></li>
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
              <form id="orderform" role="form" method="POST" action="{{action('TutorialController@confirm')}}" enctype="multipart/form-data">
			   @csrf
			   
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
                <!-- text input -->
				<?php $i = 1;?>
				
				
				<div id="food_itemd{{$i}}" class="form-group col-md-8">
					<label>Food Item</label>
					<select disabled class="form-control select2" id="food_item{{$i}}" name="food_item{{$i}}" style="width: 100%;" Required placeholder="Select food">
						<option  disabled>Select food</option> 
						@foreach ($foods as $food )
							<option Required @if($food->Menu_Food_Item_ID == 4) selected @endif value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" >
								{{ $food->Food_Name." - $". $food->Price ." - ".$food->Food_Desc }}
							</option>
							
						@endforeach
					</select>
				
					

				
				</div>
				
					<div id="quantityd{{$i}}" class="form-group col-md-2 ">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="1">
					</div>
			
					<div id="priced{{$i}}" class="form-group col-md-2 ">
					  <label>Price($)</label>
					  <input type="number" class="form-control" readonly id="price{{$i}}" name="price{{$i}}" Required readonly value="5">
					</div>
					
					<div id="items1">
						<input id="item_total" value="{{count($items)}}"  type="hidden">
						@for($i=0;$i<count($items);$i++)
						<div class="check1 checkbox" id="1choice{{$items[$i]->Menu_Food_Item_ID}}" style="display:none;">
							<input id="item_number{{$i}}" value="{{$items[$i]->Menu_Food_Item_ID}}"  type="hidden">
							</br>
							@for($j=0;$j<count($cus_ingredients[$i]);$j++)
							<div class="row">
								<input id="all_ingredient{{$items[$i]->Menu_Food_Item_ID}}" value="{{count($cus_ingredients[$i])}}"  type="hidden">
								<div class="form-group col-md-4 col-xs-6">
								<label><label class="pull-left" style="font-weight:bold;">Ingredient</label></br><input class="real checkbox" name="ingredient1[]" id ="{{$items[$i]->Menu_Food_Item_ID}}check{{$j}}" type="checkbox" value="{{$cus_ingredients[$i][$j]->Ingredient_ID}}"
								@for($k=0;$k<count($ingredients[$i]);$k++)
								@if(($cus_ingredients[$i][$j]->Ingredient_ID)==($ingredients[$i][$k]->Ingredient_ID))  ? checked : 
								@endif @endfor>
								{{$cus_ingredients[$i][$j]->Ingredient_Name}}</label></div>
								<div class="form-group col-md-3 col-xs-6 price">
								<label style="font-weight:bold;">Price($)
										<input type="number" class="form-control" id="{{$items[$i]->Menu_Food_Item_ID}}ingredient_price{{$cus_ingredients[$i][$j]->Ingredient_ID}}" Required readonly value="{{$cus_ingredients[$i][$j]->Ingredient_Price}}" min="{{$cus_ingredients[$i][$j]->Ingredient_Price}}">
									</label>
									</div>
								</div>
							@endfor
						</div>
						@endfor
					</div>
					<div id="hr{{$i}}" class="col-md-12">
						<hr class=""  width="95%" style="color:grey;background:grey;">
					</div>
					<?php $i= $i + 1; ?>
				
				
				
				
				
				
				
				<div id="tcostd" class="form-group col-md-2">
				  <label>Total($)</label>
				
				<input type="number" class="form-control" id="tcosts" name="tcosts" Required readonly value="5">
			   </div>
				<!-- <div id="food" ></div>-->
				
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label id="del">
						  <input type="radio" class="minimal" name="mealmethod" id="1optionsRadios1"  value="delivery" checked >
						  Get meal delivered
						</label>
					  </div>
				</div>
				
			
				<div class="form-group">
					  <div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="2optionsRadios2"  value="pick-up"   disabled >
						  Pick-up meal from restaurant
						</label>
					 </div>
				 </div>
				
			
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="22:00:00">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" disabled readonly name="meal_date" id="meal_date" value="2020-03-03" required>
                </div>
				
                <!-- /.input group -->
              </div>
			
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""> </div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="1" class="form-group col-md-12" style="display: none">1</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value=""> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="">
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value=""> 
			
			
			
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 
          </div>
		  
          <!-- /.box -->
        </div>
		
        <!--/.col (right) -->
    
	

		<div class="col-md-6">
		  <div class="box loading box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Delivery Info</h3>
            </div>
            <!-- /.box-header -->
            <div id="deliverybox" class="box-body">
			
				
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select disabled class="form-control " id="location_id" name="location_id" style="width: 100%;" Required placeholder="Select location">
							<option disabled>Select location</option> 
							@foreach ($locations as $location )
								<option  >
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select disabled class="form-control " id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_time" name="location_time"  disabled>Select delivery time </option> 
							
								<option id="location_time" name="location_time"  value="" ></option>
								<option selected>8:00 - 8:30</option>
						</select>
						
					</div>
                </div>
				
				 
			</div>
			
			</div>
		  </div>
		
		
	  
		<div class="col-md-6">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Method</h3>
            </div>
            <!-- /.box-header -->
            <div id="payment" class="box-body">

				<div class="form-group col-md-6">
					<div class="radio">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios1" value="payroll"   checked >
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group col-md-6">
					  <div class="radio">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios2" value="cash"  disabled >
						  Cash Payment at pickup
						</label>
					 </div>
				</div>  
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal"  name="mealmethod3" id="optionsRadios3" value="card" disabled >
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
						<a  id="cancel" class="btn btn-default btn-flat pull-left">Cancel</a>
						
						<button id="order" type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Confirm</button>
						
						<a id="edit"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
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
	const tour = new Shepherd.Tour({
	  defaultStepOptions: {
		classes: 'class-1 class-2',
		scrollTo: true
	  },
	 
	
	 steps: [
        {
          id: 'orderview',
		  text: 'This page gives you an overview of your order details.',
		  scrollTo: {
			  behavior: 'smooth',
			  block: 'center'
		   },
          buttons: [
			{
			  text: 'Next',
			  action: function() {
                return this.next();
              }
			}
		  ]
        }
      ],
	  
	  modalOverlayOpeningRadius:'100',
      useModalOverlay:true
	 
    });
	tour.addStep({
     
      text: 'This section contains your basic order information.',
      attachTo: {
        element: '#box',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'orderinfo'
	 
    });
	tour.addStep({
     
      text: 'This section contains the delivery information of your order.',
      attachTo: {
        element: '#deliverybox',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'delivery'
	 
    });
	tour.addStep({
     
      text: 'This section contains the payment method you chose for your order.',
      attachTo: {
        element: '#payment',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'payment'
	 
    });
	tour.addStep({
     
      text: 'You can cancel the order by pressing this button.',
      attachTo: {
        element: '#cancel',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'cancel'
	 
    });
	tour.addStep({
     
      text: 'You can edit the order by pressing this button.',
      attachTo: {
        element: '#edit',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'edit'
	 
    });
	tour.addStep({
     
      text: 'You can confirm your order by clicking on this button. Press confirm to continue your tour.',
      attachTo: {
        element: '#order',
        on: 'top'
      },
      when: {
		  show: function (){
			  $("#order").click(function(){
				tour.complete();
			}); 
		  }
	  },
      id: 'order'
    });
	
	tour.start();
  </script>
@endsection