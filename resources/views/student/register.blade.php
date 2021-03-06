@extends('layouts.app')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  <small>Select </small>
        Payment Method
        <small>to</small>
		Register
		<small>for ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Register</li>
		<li><a target="_blank" href="{{url('help/RegistrationProcess.html')}}"><span class="glyphicon glyphicon-question-sign" style="font-size: 15px;"></span></a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
	
        <!-- left column -->
		
		
        <div class="col-md-6">
		  <div class="box box-primary loading">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Method Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form role="form" method="POST" action="{{action('RegisterStudentController@store')}}" enctype="multipart/form-data">
			    @csrf
                <!-- text input -->
				<div class="col-md-12 callout callout-info">
					<h4><i class="icon fa fa-info"></i> Attention!</h4>
					If you are unable to select "Payroll deduction" payment method buttons in this form, you may not be registered in the USP payroll system.					
				</div>
				
				<div class="col-md-12 ">
					<label class="col-md-12">
						Credit/Debit card
					</label>
					
					<div class="form-group col-md-6">
						<div class="radio">	
							<label for="cardmethod">
							  <input type="radio" class="minimal" name="cardmethod" id="cardmethod" value="1"  @if($reg_student->Student_CardRegister_Status == 1) checked @endif > Register		
							</label>
						</div>					
					</div>
					
					
					<div class="form-group col-md-6 ">
						<div class="radio">
							<label for="cardmethod2">
							  <input type="radio" class="minimal"  name="cardmethod" id="cardmethod2" value="0" required @if($reg_student->Student_CardRegister_Status == 0) checked @endif > Unregister						
							</label>
						</div>					
					</div>
				</div>
				
				
				
				
				</div>
				<!-- /.box-body -->
				
				  <!-- /.box-footer -->
				 
			  </div>
			  <!-- /.box -->
			  
			  
			</div>
        <!--/.col (right) -->
       
		  
			<!-- left column -->
			<div id="card" class="col-md-6" style="height:100%;display:none">
			  <div class="box box-info loading">
				<div class="box-header with-border">
				  <h3 class="box-title">Credit/Debit Card Information</h3>
				</div>
				<!-- /.box-header -->
				<div id="box" class="box-body">		
				
					
					
						<label class="col-md-12">
							Credit/Debit card
						</label>
						
						<div class="form-group col-md-6">
							<div class="radio">	
								<label for="typecard">
								  <input type="radio" class="minimal" name="typecards" id="typecard" value="Debit" checked > Debit		
								</label>
							</div>					
						</div>
						
						
						<div class="form-group col-md-6 ">
							<div class="radio">
								<label for="typecard2">
								  <input type="radio" class="minimal"  name="typecards" id="typecard2" value="Credit"  > Credit						
								</label>
							</div>					
						</div>
					
					
					
					<input type="text" class="form-control" name="typecard" id="typecard3" style="display:none;" value="" >
					
				
					<div class="form-group col-md-12">
						<label> Card Holder Name</label>
							<input type="text" class="form-control" name="cardname" id="cardname" required @if(isset($card_payment)) value="{{$card_payment->Card_Holder_Name}}" @else placeholder="Please enter first name." @endif >
					</div>
					
					<div class="form-group col-md-8">
						<label> Debit/Credit Card Number</label>
							<input type="number" class="form-control" name="cardnum" id="cardnum" min="100000000000000" max="9999999999999999" onKeyPress="if(this.value.length==16) return false;" required @if(isset($card_payment)) value="{{$card_payment->Card_Number}}" @else  placeholder="Please enter your card number." @endif />
					</div>
					
					<div class="form-group col-md-4">
						<label> CVV </label>
							<input type="number" class="form-control" name="cvv" id="cvv" min="100" max="999" required onKeyPress="if(this.value.length==3) return false;" @if(isset($card_payment)) value="{{$card_payment->CVV}}" @else placeholder="Please enter your CVV number." @endif />
					</div>
					
					<div class="form-group col-md-4">
						<label> Expiry Date </label>
							<input type="text" class="form-control" name="expdate" id="expdate" required @if(isset($card_payment)) value="{{$card_payment->Expiry_Date}}" @else placeholder="Please enter your cards expiry date." @endif/>
					</div>
					
					<div class="col-md-8">
						<label> Payment Methods: </label></br>
						<img src="../../dist/img/credit/visa.png" alt="Visa">
						<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
						<img src="../../dist/img/credit/american-express.png" alt="American Express">
						<img src="../../dist/img/credit/paypal2.png" alt="Paypal">

     				</div>
					
				  </div>
				<!-- /.box-body -->
				
				  <!-- /.box-footer -->
				
			  </div>
			  <!-- /.box -->
			
			  
			</div>
			<!--/.col (right) -->
			<div id="liner" class="col-md-7 col-xs-12 pull-right" ></div>
			<div class="col-md-6 col-xs-12 pull-left" >
				<div class="box box-default loading" >
					<div class="box-header with-border">
						<a href="{{URL::to('/student_home')}}" class="btn btn-default btn-flat">Home</a>
						<button type="submit"  value="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li>Submit</button>	
						</form>
					</div>	
				</div> 
			</div>
			
		  </div>
		
			
		
		
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
	
  </script>
@endsection