@extends('layouts.app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>New</small>
        Subscription
        <small>form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Place Subscription</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Meal Subscription</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="subscriptionform" role="form" method="POST" action="{{action('MealSubsController@store')}}" enctype="multipart/form-data">
			   @csrf
                <!-- text input -->
				<div id="food_itemd1" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item1" name="food_item1" style="width: 100%;" Required placeholder="Select food">
						<option disabled>Select food</option> 
                        @foreach ($foods as $food )
                        
                        
                        

			 			<option  Required value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}">
								{{ $food->Food_Name." - ".$food->Food_Desc }} 
                            </option>
                            
                            
							
						@endforeach
						
					</select>
				</div>
           
					
					<div class="row">
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
                
												
				<div id="tcostd" class="form-group col-md-2 col-xs-12 pull-right">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control " id="tcost" name="tcost" Required readonly value="">
			   </div>
			   
				
                <div class="form-group col-md-12">
                    <div id=dayd1" class="form-group col-md-6">
                        <label>Meal Days</label>
                        <select class="mealsub form-control select2" id="day1" name="day1" style="width: 100%;" Required placeholder="Select restaurant">
                            <option disabled>Select Meal Day</option>                             
                            <option  Required value="Monday">Monday</option>   
                            <option  Required value="Tuesday">Tuesday</option> 
                            <option  Required value="Wednesday">Wednesday</option> 
                            <option  Required value="Thursday">Thursday</option> 
                            <option  Required value="Friday">Friday</option> 
                            <option  Required value="Saturday">Saturday</option> 
                            <option  Required value="Sunday">Sunday</option>                                                                           
                        </select>
                    </div>
              </div>

              <div class="form-group col-md-12">
                <div id=dayd1" class="form-group col-md-6">
                    <label>Meal Type</label>
                    <select class="mealsub form-control select2" id="mealtype1" name="mealtype1" style="width: 100%;" Required placeholder="Select restaurant">
                        <option disabled>Select Meal Type</option>                             
                        <option  Required value="Breakfast">Breakfast</option>
                        <option  Required value="Lunch">Lunch</option>
                        <option  Required value="Dinner">Dinner</option>   
                                                                                                
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <div id=timed1" class="form-group col-md-6">
                        <label>Meal Time</label>
                        <select class="mealsub form-control select2" id="mealtime1" name="mealtime1" style="width: 100%;" Required placeholder="Select restaurant">
                            <option disabled>Select Meal Time</option>                             
                            <option  Required>8 am</option>
                            <option  Required>10 am</option>
                            <option  Required>1 pm</option>
                            <option  Required>3 pm</option>
                            <option  Required>5 pm</option>
                            <option  Required>7 pm</option>   
                                                                                                    
                        </select>
                    </div>
                </div>
          </div>
			  
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="2" class="form-group col-md-12" style="display: none">2</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction->Patron_Deduction_Status}}"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid}}">
            
            <input id="mealstat" name="mealstat" class="form-group col-md-12" style="display: none" value="Pending"> 
			

			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{url('mealsub_cancel')}}" class="btn btn-default btn-flat">Cancel</a>
                <button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li>Save Subscription</button>
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