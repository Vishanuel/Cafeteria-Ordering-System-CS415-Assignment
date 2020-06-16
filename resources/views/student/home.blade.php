@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	
    <section class="content-header" style="color:rgba(230,230,230,1);">
      <h1>
	  <small style="color:rgba(230,230,230,1);">Your </small>
        Home
        <small style="color:rgba(230,230,230,1);"> screen ....</small>
      </h1> 
     <ol class="breadcrumb">
        <li><a target="_blank" href="{{url('help/COS.html')}}"><span class="glyphicon glyphicon-question-sign" style="font-size: 15px;"></span></a></li>
      
      
      </ol>
    </section>
	
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
		<div class="col-lg-12 col-md-12" >
          
				
			<div class="box  box-widget widget-user item"  >
             
            <div class="widget-user-header bg-black" style="height: 150px; background: url('../dist/img/photo2.png') center center;  background-repeat: no-repeat;  background-size: cover;">
              <h3 class="widget-user-username">Dashboard</h3>
              <h5 class="widget-user-desc">Everything in one place.</h5>
            </div>
              
			
          </div>	
		</div>
		</div>
		<div class="row">
        <div class="col-md-6">
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
		<div class="col-md-6">
			<div class="box box-primary loading">
				<div class="box-header with-border">
				  <h3 class="box-title">Payment Method Registration</h3>
				</div>
				<!-- /.box-header -->
				<div id="box" class="box-body">
					
					<!-- text input -->
				
					<div class="col-md-12 ">
						<label class="col-md-12">
							Credit/Debit card
						</label>
							
						<div class="form-group col-md-6">
							<div class="radio">	
								<label for="cardmethod">
								  <input type="radio" class="minimal" name="cardmethod" id="cardmethod" value="1"  @if($reg_student->Student_CardRegister_Status == 1) checked @else disabled @endif > Registered		
								</label>
							</div>					
						</div>
							
							
						<div class="form-group col-md-6 ">
							<div class="radio">
								<label for="cardmethod2">
								  <input type="radio" class="minimal"  name="cardmethod" id="cardmethod2" value="0" required @if($reg_student->Student_CardRegister_Status == 0) checked @else disabled @endif > Not-registered						
								</label>
							</div>					
						</div>
					</div>
				</div>			 
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