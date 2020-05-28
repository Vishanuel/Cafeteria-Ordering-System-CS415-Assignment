@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription
        <small>form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
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
              <form id="orderform" role="form" method="POST" action="{{route('mealsub.update',$meal_subs->MealSubs_ID)}}" enctype="multipart/form-data">
			   @csrf
               @method('PUT')
                <!-- text input -->
				
				<div class="form-group col-md-12">
				<div id="food_itemd1" class="form-group col-md-6">
					<label>Food Item</label>
					<select class="food form-control select2" id="food_item1" name="food_item1" style="width: 100%;" Required placeholder="Select food">
						<option disabled>Select food</option> 
                        @foreach ($foods as $food )                       
                          <option  Required @if($meal_subs->Menu_Food_Item_ID == $food->Menu_Food_Item_ID) selected value="{{$food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @else value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @endif>
								            {{ $food->Food_Name." - ".$food->Food_Desc }} 
                          </option>                          
                        @endforeach						
					</select>
				</div>
           
					
					
					<div id="quantityd1" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" id="quantity1" name="quantity1" max="" min="1" Required value="{{$meal_subs->Food_Item_Qty}}">
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
                            <option  @if($meal_subs->Day == "Monday") selected @endif Required value="Monday">Monday</option>   
                            <option  @if($meal_subs->Day == "Tuesday") selected @endif Required value="Tuesday">Tuesday</option> 
                            <option  @if($meal_subs->Day == "Wednesday") selected @endif Required value="Wednesday">Wednesday</option> 
                            <option  @if($meal_subs->Day == "Thursday") selected @endif Required value="Thursday">Thursday</option> 
                            <option  @if($meal_subs->Day == "Friday") selected @endif Required value="Friday">Friday</option> 
                            <option  @if($meal_subs->Day == "Saturday") selected @endif Required value="Saturday">Saturday</option> 
                            <option  @if($meal_subs->Day == "Sunday") selected @endif Required value="Sunday">Sunday</option>                                                                           
                        </select>
                    </div>
              

              <!--div class="form-group col-md-12"-->
                <div id="dayd1" class="form-group col-md-6">
                    <label>Meal Type</label>
                    <select class="mealsub form-control select2" id="mealtype1" name="mealtype1" style="width: 100%;" Required placeholder="Select restaurant">
                        <option disabled>Select Meal Type</option>                             
                        <option @if($meal_subs->Meal_Type == "Breakfast") selected @endif Required value="Breakfast">Breakfast</option>
                        <option @if($meal_subs->Meal_Type == "Lunch") selected @endif Required value="Lunch">Lunch</option>
                        <option @if($meal_subs->Meal_Type == "Dinner") selected @endif Required value="Dinner">Dinner</option>   
                                                                                                
                    </select>
                </div>
				</div>
                <div class="form-group col-md-12">
                    <div id="timed1" class="form-group col-md-6">
                        <label>Meal Time</label>
                        <select class="mealsub form-control select2" id="mealtime1" name="mealtime1" style="width: 100%;" Required placeholder="Select restaurant">
                            <option disabled>Select Meal Time</option>                             
                            <option @if($meal_subs->Meal_Time == "8 am") selected @endif Required>8 am</option>
                            <option @if($meal_subs->Meal_Time == "10 am") selected @endif Required>10 am</option>
                            <option @if($meal_subs->Meal_Time == "1 pm") selected @endif Required>1 pm</option>
                            <option @if($meal_subs->Meal_Time == "3 pm") selected @endif Required>3 pm</option>
                            <option @if($meal_subs->Meal_Time == "5 pm") selected @endif Required>5 pm</option>
                            <option @if($meal_subs->Meal_Time == "7 pm") selected @endif Required>7 pm</option>   
                                                                                                    
                        </select>
                    </div>

                    <div id="freqd1" class="form-group col-md-6">
                      <label>Meal Frequency</label>
                      <select class="mealsub form-control select2" id="mealfreq1" name="mealfreq1" style="width: 100%;" Required placeholder="Select Frequency">
                          <option disabled>Frequency of Meals</option>                             
                          <option  @if($meal_subs->Meal_Subscription_Frequency == "Daily") selected @endif Required>Daily</option>
                          <option  @if($meal_subs->Meal_Subscription_Frequency == "Weekly") selected @endif Required>Weekly</option>
                          <option  @if($meal_subs->Meal_Subscription_Frequency == "Monthly") selected @endif Required>Monthly</option>                                                                                                                              
                      </select>
                    </div>

                    <div class="form-group col-md-12">
                      <div id="startd1" class="form-group col-md-6">
                        <div class="input-group-addon">
                          <label>Subscription Start Date</label>
                          <i class="fa fa-calendar"></i>
                        </div>                    
                        <input type="text" class="form-control" name="start_subs_date" id="start_subs_date" value="{{$meal_subs->Meal_Subscription_Start_Date}}" required>
                      </div>
                      <div id="endd1" class="form-group col-md-6">
                        <div class="input-group-addon">
                          <label>Subscription End Date</label>
                          <i class="fa fa-calendar"></i>
                        </div>                    
                        <input type="text" class="form-control" name="end_subs_date" id="end_subs_date" value="{{$meal_subs->Meal_Subscription_End_Date}}" required>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <div id="subscripmethd1" class="form-group col-md-6">
                          <label>Meal Method</label>
                          <select class="mealsub form-control select2" id="mealmethod1" name="mealmethod1" style="width: 100%;" Required placeholder="Select restaurant">
                              <option disabled>Select Meal Method</option>                             
                              <option @if($meal_subs->Meal_Subscription_Method == "Pickup") selected @endif Required>Pickup</option>
                              <option @if($meal_subs->Meal_Subscription_Method == "Delivery") selected @endif Required>Delivery</option>
                              
                          </select>
                      </div>
  
                      <div class="form-group col-md-6">
                        
					
                        
                      </div>
                    </div>
				
				<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="2" class="form-group col-md-12" style="display: none">2</div>
			<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction->Patron_Deduction_Status}}"> 
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid}}">
            
            <input id="mealsubstat" name="mealsubstat" class="form-group col-md-12" style="display: none" value="Active"> 
				<input id="mealstat" name="mealstat" class="form-group col-md-12" style="display: none" value="Pending"> 
				<!--input id="mealid" name="mealid" class="form-group col-md-12" style="display: none" value=""--> 
                <!-- /.input group -->
              </div>
			  
		
            </div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{url('home')}}" class="btn btn-default btn-flat">Cancel</a>
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
@endsection