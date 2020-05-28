@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>Your </small>
        Meal Subscriptions
        <small> in one place ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Meal Subscriptions</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Active Meal Subscriptions</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subscription ID</th>
                  <th>Food Name</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Meal Type</th>
                  <th>Day</th>
                  <th>Meal Time</th>
                  <th>Meal Status</th>
                  <th>Subscription Status</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Frequency</th>
                  <th>Meal Method</th>                  
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
               @foreach($allmealsubs as $allmealsub)
                <tr>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->MealSubs_ID }}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Food_Name}}</td>                  
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Food_Item_Qty}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Total_Price}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Type}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Day}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Status}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_Status}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_Start_Date}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_End_Date}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_Frequency}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_Method}}</td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
              <a class="btn btn-info btn-flat" type="button" href="{{URL::to('mealsub_edit_details/'.$allmealsub->MealSubs_ID)}}">
                <span class="fa fa-pencil">
                </span>
                  Edit Subscription
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