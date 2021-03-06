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
            
            <!-- /.box-header -->
            <div  class="box-body">
			
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order Number</th>
                  <th>Date Order Placed</th>
                  <th>Meal Date</th>
                  <th>Meal Status</th>
                  <th>Cost</th>
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
                  <td style="text-overflow: ellipsis;">${{number_format((float)$order->Cos_Order_Cost, 2, '.', '')}}</td>
				  <td style="text-overflow: ellipsis;" class="text-center">
                        
						 
					<a class="btn btn-info btn-flat" type="button" href="{{URL::to('order_edit_details/'.$order->Cos_Order_Num)}}">
                              
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
		
		
		<div class="col-md-6">
				<div class="box box-primary loading">
					<div class="box-header with-border">
					  <h3 class="box-title">Payment Method Registration</h3>
					</div>
					<!-- /.box-header -->
					<div id="box" class="box-body">
					  <form role="form" method="POST" action="{{action('RegisterController@store')}}" enctype="multipart/form-data">
						@csrf
						<!-- text input -->
											
						
						<div class="col-md-12">
							<label class="col-md-12">
								Payroll deduction
							</label>
							<div class="form-group col-md-6">
								<div class="radio ">
									<label for="payrollmethod">
									  <input type="radio" class="minimal" name="payrollmethod" id="payrollmethod" value="1" @if($payrollstat == 0) disabled @else required @endif @if($reg_patron->Patron_Deduction_Status == 1) checked required @else disabled @endif > Registered						  						
									</label>
								</div>					
							</div>
							
							<div class="form-group col-md-6">
								<div class="radio ">
									<label for="payrollmethod2">
									  <input type="radio" class="minimal" name="payrollmethod" id="payrollmethod2" value="0" @if($payrollstat == 0) disabled @endif @if($reg_patron->Patron_Deduction_Status == 0) checked @else disabled @endif > Not-registered						
									</label>
								</div>
							</div>
						</div>
						
					
						
						<div class="col-md-12 ">
							<label class="col-md-12">
								Credit/Debit card
							</label>
							
							<div class="form-group col-md-6">
								<div class="radio">	
									<label for="cardmethod">
									  <input type="radio" class="minimal" name="cardmethod" id="cardmethod" value="1"  @if($reg_patron->Patron_CardRegister_Status == 1) checked @else disabled @endif > Registered		
									</label>
								</div>					
							</div>
							
							
							<div class="form-group col-md-6 ">
								<div class="radio">
									<label for="cardmethod2">
									  <input type="radio" class="minimal"  name="cardmethod" id="cardmethod2" value="0" required @if($reg_patron->Patron_CardRegister_Status == 0) checked @else disabled @endif > Not-registered						
									</label>
								</div>					
							</div>
						</div>
					</div>			 
				</div>
			  <!-- /.box -->
			  
			  
		</div>
		
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
	
  </script>
@endsection