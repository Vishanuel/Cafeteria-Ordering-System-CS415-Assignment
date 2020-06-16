@extends('layouts.app_deliverer')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delivery
        <small>Requests</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Subscription Delivery Request</li>
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
				  <th>SDR ID</th>
                  <th>Meal Subs ID</th>
                  <th>Food Item</th>
				  <th>Employee_ID</th>
                  <th>Location</th>
                  <th>Meal Type</th>
                  <th>Meal Time</th>
                  <th>Meal Day</th>
                  <th>Subscription Frequency</th>
                  <th>Cost</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
			   
				@foreach($deliverers as $deliverer)
				   @if($deliverer->Meal_Status == "Pending Delivery")
					<tr>
					  <td style="text-overflow: ellipsis;">{{ $deliverer->Patron_Subscription_Delivery_Request_ID }}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->MealSubs_ID }}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->Food_Name }}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->Employee_ID }}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->Location_Name }}</td>
					  <td style="text-overflow: ellipsis;">{{ $deliverer->Meal_Type}}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->Meal_Time}}</td>
                      <td style="text-overflow: ellipsis;">{{ $deliverer->Day}}</td>
					  <td style="text-overflow: ellipsis;">{{ $deliverer->Meal_Subscription_Frequency}}</td>
					  <td style="text-overflow: ellipsis;">{{ $deliverer->Total_Price}}</td>
					  <td style="text-overflow: ellipsis;" class="text-center">
							
						@if(!empty($deliverer->Patron_Subscription_Delivery_Instruction_ID)) 
						<a class="btn btn-warning btn-flat btn-block" target="_blank" type="button" href="{{URL::to('cafeteria/'.$deliverer->MealSubs_ID)}}">
							Print Delivery Info
						</a>
						@endif
						@if($deliverer->Meal_Status == "Pending Delivery")
						<a class="btn btn-success btn-flat btn-block" type="button" href="{{URL::to('subs_deliv/'.$deliverer->MealSubs_ID.'/edit')}}">
							Meal Delivered
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