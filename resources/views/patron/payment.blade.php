@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Option
        <small>form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Payment Option</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Select payment method</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('OrderController@payment')}}" enctype="multipart/form-data">
			   @csrf
                <!-- text input -->
				
				
				<div class="form-group">
					<div class="radio col-md-3">
						<label>
						  <input type="radio" name="mealmethod" id="optionsRadios1" value="payroll"  @if($deduction == 0) disabled @endif @if($mealmethod=="delivery") checked @endif @if($deduction == 0) disabled @endif @if($mealmethod!="delivery"&&$deduction != 0) checked @endif>
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group">
					  <div class="radio col-md-9 ">
						<label>
						  <input type="radio" name="mealmethod" id="optionsRadios2" value="cash" @if($mealmethod=="delivery") disabled @endif @if($deduction == 0) checked @endif>
						  Cash Payment at pickup
						</label>
					 </div>
				 </div>
				 <div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
				<input id="tcost" name="tcost" class="form-group col-md-12" style="display: none" value="{{$total_cost}}"> 
				<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value="{{$deduction}}"> 
				<input id="mealmethodn" name="mealmethodn" class="form-group col-md-12" style="display: none" value="{{$mealmethod}}">
				<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid ?? ''}}">
				<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}"> 
            </div>
            <!-- /.box-body -->
			 <div class="box-footer">
                <a href="{{url('home')}}" class="btn btn-default btn-flat">Cancel Order</a>
                <button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li>Continue</button>
				<a href="{{route('order_edit', $orderid ?? '')}}"  class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li>Edit Order</a>
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