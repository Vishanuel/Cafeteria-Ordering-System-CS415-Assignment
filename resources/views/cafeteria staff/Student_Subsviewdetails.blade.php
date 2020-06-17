@extends('layouts.app_cafeteria')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Subscription Info</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Subscription</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="subscriptionform" role="form" method="POST" action="{{action('Cafe_MealSubs_StudentController@update',[$meal_subs->Student_MealSubs_ID])}}" enctype="multipart/form-data">
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
								{{ $food->Food_Name }}
							</option>
							
						@endforeach
					</select>
				</div>
					
					
					
					<div id="quantityd{{$i}}" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="{{$food_select->Food_Item_Qty}}">
					</div>
			
					<div id="priced{{$i}}" class="form-group col-md-2">
					  <label>Price ($)</label>
					  <input type="number" class="form-control" readonly id="price{{$i}}" name="price{{$i}}" Required readonly value="">
					</div>

					
					
					<?php $i= $i + 1; ?>
					
				@endforeach
				
				<div id="tcostd" class="form-group col-md-2">
				  <label>Total Cost ($)</label>
				  <input type="number" class="form-control" id="tcost" name="tcost" Required readonly value="">
			   </div>
				<!-- <div id="food" ></div>-->



			<div class="form-group col-md-12"> 
				<label>Meal Status</label>
				<select class="form-control select2" id="meal_status" name="meal_status" style="width: 100%;"  placeholder="Select location">
					<option id="meal_status" name="meal_status"  disabled value="" >Change meal status</option> 
					<option id="meal_status" name="meal_status" @if($meal_subs->Meal_Status == "Pending") selected @endif value="Pending">Pending</option>
					<option id="meal_status" name="meal_status" @if($meal_subs->Meal_Status == "Prepared") selected @endif value="Prepared">Prepared</option>
					<option id="meal_status" name="meal_status" @if($meal_subs->Meal_Status == "Cancelled") selected @endif value="Cancelled">Cancelled</option>
					<option id="meal_status" name="meal_status" @if($meal_subs->Meal_Status == "Completed") selected @endif value="Completed">Completed</option>
					
				</select>
				
			</div>
			
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="{{$i}}" class="form-group col-md-12" style="display: none">{{$i}}</div>
			
            <input id="mealsubsid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$meal_subs->Student_MealSubs_ID}}">
			 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""></div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value="">
			<input id="delivery" name="delivery" class="form-group col-md-12" style="display: none" value="">
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{URL::to('student_cafe_subs')}}" class="btn btn-default btn-flat">Back</a>
				
				<button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> 
				Save Subscription
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