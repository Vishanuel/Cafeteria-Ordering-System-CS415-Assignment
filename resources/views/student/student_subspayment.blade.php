@extends('layouts.app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	    <small>The</small>
        Payment 
        <small>option form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Payment Option</li>
		<li><a target="_blank" href="{{url('help/ChoosingthePaymentOption.html')}}">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Select payment method</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('StudentMealSubsController@payment')}}" enctype="multipart/form-data">
			   @csrf
                <!-- text input -->
				
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios3" value="card" @if($deduction->Student_CardRegister_Status == 0) disabled @endif>
						  Card payment
						</label>
				    </div>
				</div>
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios2" value="cash" @if($mealmethod=="Delivery") disabled @endif @if($deduction->Student_CardRegister_Status == 0) checked @endif>
						  Cash Payment at pickup
						</label>
				    </div>
				</div>
				 
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
				<input id="total_cost" name="total_cost" class="form-group col-md-12" style="display: none" value="{{$total_cost}}"> 
				<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction->Student_CardRegister_Status}}"> 
				<input id="mealmethod" name="mealmethod" class="form-group col-md-12" style="display: none" value="{{$mealmethod}}">
				<!--<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$mealsubs_id ?? ''}}">-->
				<input id="mealsubs_id" name="mealsubs_id" class="form-group col-md-12" style="display: none" value="{{$mealsubs_id}}">
				
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
				<div class="btn-toolbar">
					<a href="{{url('order_cancel')}}" class="btn btn-default btn-flat">Cancel</a>
					<button type="submit" data-barba-prevent="self" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Continue</button>
					<a href="{{URL::to('student_mealsub_edit_details/'.$mealsubs_id)}}"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
                </div>	
                
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