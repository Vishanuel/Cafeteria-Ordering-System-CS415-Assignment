@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>Your </small>
        Order History
        <small> in one place ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Order History</li>
		<li><a target="_blank" href="{{url('help/ViewingSummaryofOrderHistory.html')}}">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order History</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Cos_Order_Num</th>
                  <th>Cos_Order_Date_Time</th>
                  <th>Cos_Meal_Date_Time</th>
                  <th>Cos_Order_Meal_Status</th>
                  <th>Cos_Order_Cost</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($orderall as $order)
                <tr>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Num }}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Date_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Meal_Date_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Meal_Status}}</td>
                  <td style="text-overflow: ellipsis;">{{ $order->Cos_Order_Cost}}</td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
						 
					<a class="btn btn-info btn-flat" type="button" href="{{URL::to('order_edit_details/'.$order->Cos_Order_Num)}}">
                              <span class="fa fa-pencil">
                              </span>
                        Show details
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