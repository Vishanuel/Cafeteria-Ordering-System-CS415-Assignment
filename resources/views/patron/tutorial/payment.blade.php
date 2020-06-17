@extends('layouts.app_tutorial')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	    <small>The</small>
        Payment 
        <small>option form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Payment Option</li>
		<li><a target="_blank" href="{{url('help/ChoosingthePaymentOption.html')}}">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box loading box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Select payment method</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('TutorialController@payment')}}" enctype="multipart/form-data">
			   @csrf
                <!-- text input -->
				
				
				<div class="form-group">
					<div class="radio col-md-6">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios1" value="payroll" checked>
						  Payroll deduction payment
						</label>
					  </div>
				</div>
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios3" value="card" >
						  Card payment
						</label>
				    </div>
				</div>
				<div class="form-group">
					<div class="radio col-md-6 ">
						<label>
						  <input type="radio" class="minimal" name="mealmethod" id="optionsRadios2" value="cash" >
						  Cash Payment at pickup
						</label>
				    </div>
				</div>
				 
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
				<input id="tcost" name="tcost" class="form-group col-md-12" style="display: none" value="{{$total_cost}}"> 
				<input id="deduction" name="deduction" class="form-group col-md-12" style="display: none" value=""> 
				<input id="mealmethodn" name="mealmethodn" class="form-group col-md-12" style="display: none" value="{{$mealmethod}}">
				<input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$orderid ?? ''}}">
				<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}">
				
			</div>
            <!-- /.box-body -->
			 <div class="box-footer">
				<div class="btn-toolbar">
					<a id="cancel" class="btn btn-default btn-flat">Cancel</a>
					<button id="order" type="submit" data-barba-prevent="self" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-floppy-disk"></li> Continue</button>
					<a id="edit" class="btn btn-warning btn-flat pull-right"><li class="glyphicon glyphicon-pencil"></li> Edit</a>
				</div>	
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
	const tour = new Shepherd.Tour({
	  defaultStepOptions: {
		classes: 'class-1 class-2',
		scrollTo: true
	  },
	 
	
	 steps: [
        {
          id: 'paymentpage',
		 // title: 'Order',
		  text: 'You can select your meal payment method in this page.',
		  
		  scrollTo: {
			  behavior: 'smooth',
			  block: 'center'
		   },
          buttons: [
			{
			  text: 'Next',
			  action: function() {
                return this.next();
              }
			}
		  ]
        }
      ],
	  
	  modalOverlayOpeningRadius:'100',
      useModalOverlay:true
	 
    });
	tour.addStep({
          id: 'payment',
		 // title: 'Order',
		  text: 'You can select your meal payment method here. Try selecting it now.',
		  attachTo: {
			element: '#box',
			on: 'top'
		  },
		  scrollTo: {
			  behavior: 'smooth',
			  block: 'center'
		   },
          buttons: [
			{
			  text: 'Next',
			  action: function() {
                return this.next();
              }
			}
		  ]
        });
	tour.addStep({
     
      text: 'You can cancel the order by pressing this button.',
      attachTo: {
        element: '#cancel',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'cancel'
	 
    });
	tour.addStep({
     
      text: 'You can edit the order by pressing this button.',
      attachTo: {
        element: '#edit',
        on: 'top'
      },
      buttons: [
        {
          action: function() {
            return this.next();
          },
          text: 'next'
        }
      ],
      id: 'edit'
	 
    });
	tour.addStep({
     
      text: 'You can confirm your order by clicking on this button. Press continue to continue your tour.',
      attachTo: {
        element: '#order',
        on: 'top'
      },
      when: {
		  show: function (){
			  $("#order").click(function(){
				tour.complete();
			}); 
		  }
	  },
      id: 'order'
    });
	
	tour.start();
  </script>
@endsection