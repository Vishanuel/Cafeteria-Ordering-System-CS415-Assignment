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
              
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Meal Subscription ID</th>
				  <th>Employee ID</th>
                  <th>Menu Food Item ID</th>
                  <th>Food Item Qty</th>
                  <th>Total Price</th>
                  <th>Meal Type</th>
                  <th>Day</th>
                  <th>Meal Time</th>
                  <th>Meal Status</th>
                  <th>Meal Subscription Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($allmealsubs as $allmealsub)
                <tr>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->MealSubs_ID }}</td>
				  <td style="text-overflow: ellipsis;">{{ $allmealsub->Employee_ID }}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Menu_Food_Item_ID}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Food_Item_Qty}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Total_Price}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Type}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Day}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Time}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Status}}</td>
                  <td style="text-overflow: ellipsis;">{{ $allmealsub->Meal_Subscription_Status}}</td>
				  				  <td style="text-overflow: ellipsis;" class="text-center">
                        
					<a class="btn btn-success btn-block btn-flat" type="button" href="{{URL::to('cafe_subs/'.$allmealsub->MealSubs_ID.'/edit')}}">
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