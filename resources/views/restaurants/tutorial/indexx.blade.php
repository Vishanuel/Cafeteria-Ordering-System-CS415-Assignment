@extends('layouts.app_tutorial')

@section('content')
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Pick a </small>
        Restaurant
        <small> to order from ....</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Restaurant Info</li>
		<li><a target="_blank" href="{{url('help/PickingtheRestaurant.html')}}">Help</a></li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
		@if(!empty($pending_order_id))
		<div class="col-md-12">
			<div style="z-index:9;" class="callout callout-warning">
				<h4>You have an pending order which was disrupted!</h4>
				<p>Placing new order will delete your pending order.</p>
				@if(empty($student_id))
				<!--a href="{{URL::to('order_edit/'.$pending_order_id)}}">Go to pending order.</a>
				@else
				<a href="{{URL::to('student_order_edit/'.$pending_order_id)}}">Go to pending order.</a-->
				@endif
			</div>
		</div>
		@endif
		@foreach($restaurants as $restaurant)
		<div class="col-lg-12 col-md-12 col-xs-12"  width="100%">
          
				
			<div  class="box loading box-widget widget-user item"  >
            <!-- Add the bg color to the header using any of the bg-* classes --><a href="{{URL::to('tutorial_restaurant/'.$restaurant->Restaurant_ID)}}" class="small-box-footer">
            <div id="res{{$restaurant->Restaurant_ID}}" class="widget-user-header bg-black" style="height: 200px; background: url('../{{$restaurant->Restaurant_Pic}}') center center;  background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
              <h3 class="widget-user-username">{{ $restaurant->Restaurant_Name }}</h3>
              <h5 class="widget-user-desc">{{ $restaurant->Restaurant_Location }}</h5>
            </div>
              
			
          </div>	
		</div>
			   
		@endforeach
       
			  
			
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
          id: 'start',
		 // title: 'Order',
		  text: 'Hi!..it seems like you have logged into this app for the first time. We have created a special tutorial for you to guide you through our ordering process. If you wish to take this tutorial click on next button, otherwise click on exit button. You won\'t be able to skip the tutorial after clicking on next. ',
		  
		  scrollTo: {
			  behavior: 'smooth',
			  block: 'center'
		   },
          buttons: [
			{
			  text: 'Exit',
			  action: function() {
				  
                window.location = $('#usertype').val();
              }
			},
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
          id: 'restpage',
		 // title: 'Order',
		  text: 'To start ordering your food, you first have to select the restaurant of that you would want to order from.',
		  
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
          id: 'restaurant',
		 // title: 'Order',
		  text: 'Select this restaurant to continue the ordering your food.',
		  attachTo: {
			element: '#res1',
			on: 'top'
		  },
		  scrollTo: {
			  behavior: 'smooth',
			  block: 'center'
		   },
         when: {
		  show: function (){
				$("#res1").click(function(){
					tour.complete();
				}); 
			  }
		  },
        });
	
	tour.start();
  </script>
@endsection