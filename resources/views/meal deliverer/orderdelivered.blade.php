@extends('layouts.app_deliverer')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Meals
        <small>Delivered</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Meal Delivered</li>
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
				  <th>Delivery Request ID</th>
                  <th>Cos Order Num</th>
				  <th>Customer Name</th>
                  <th>Cos Order Date Time</th>
                  <th>Cos Meal Date Time</th>
                  <th>Cos Order Meal Status</th>
                  <th>Cos Order Cost</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
			   
				@foreach($orderall as $order)
				   @if($order->Cos_Order_Meal_Status == "Delivered")
					<tr>
					  <td style="text-overflow: ellipsis;">{{ $order->D_Request_ID }}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Num }}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Patron_FName }} {{ $order->Patron_SName }}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Date_Time}}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Cos_Meal_Date_Time}}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Meal_Status}}</td>
					  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Cost}}</td>
					  <td style="text-overflow: ellipsis;" class="text-center">
							
				
						@if($order->Cos_Order_Meal_Status == "Delivered")
						<a class="btn btn-danger btn-flat btn-block" type="button" href="{{URL::to('deliverer/'.$order->Cos_Order_Num)}}">
							Undo Meal Delivered
						</a>
						@endif		
						</td>
					</tr>
					@endif
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