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
              
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order Num</th>
				  <th>Customer Name</th>
                  <th>Cos Order Date Time</th>
                  <th>Cos Meal Date Time</th>
                  <th>Cos Order Meal Status</th>
                  <th>Cos Order Cost</th>
				  <th>Meal Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($orderall as $order)
                <tr>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Num }}</td>
				  <td style="text-overflow: ellipsis;">{{ $order->Patron_FName }} {{ $order->Patron_SName }}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Date_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Meal_Date_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Meal_Status}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Cost}}</td>
				  <td style="text-overflow: ellipsis;">@if(empty($order->D_Instruction_ID)) Pickup @else Delivery @endif</td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
					@if(!empty($order->D_Instruction_ID)) 
					<a class="btn btn-warning btn-block btn-flat" target="_blank" type="button" href="{{URL::to('cafeteria/'.$order->Cos_Order_Num)}}">
                        Print Delivery Info
					</a>
					@endif
					@if($order->Cos_Order_Meal_Status == "Prepared")
					<a class="btn btn-info btn-block btn-flat "  type="button" href="{{URL::to('delivery_request/'.$order->Cos_Order_Num)}}">
                        Send Delivery Request
					</a>
					@endif
					@if($order->Cos_Order_Meal_Status == "Pending Delivery")
					<a class="btn btn-danger btn-block btn-flat"  type="button" href="{{URL::to('delete_delivery_request/'.$order->D_Instruction_ID.'/'.$order->Cos_Order_Num)}}">
                        Delete Delivery Request
					</a>
					@endif
					<a class="btn btn-success btn-block btn-flat" type="button" href="{{URL::to('cafeteria/'.$order->Cos_Order_Num.'/edit')}}">
                        Change meal status
					</a>
							
                    </td>
                </tr>
				@endforeach
				
                </tbody>
                
              </table>
			  
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 
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