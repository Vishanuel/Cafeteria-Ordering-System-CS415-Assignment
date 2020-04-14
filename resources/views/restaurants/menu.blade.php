@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	   <small>Your</small>
        Menu
        <small>information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
       <!-- <li><a href="{{url('smpdevice')}}">Device</a></li> -->
        <li class="active">Menu</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
     
		<?php $menuid = -1;?>
						
        <!-- left column -->
        @foreach($categories as $category)
		
		 <div class="row">
			 <div class="col-md-12">
			  <div class="box loading" style="background: rgba(255, 255, 255, 1); box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.1);z-index:999;">
				<div class="box-header">
					<h3 class="box-title">{{$category->Category_Name}} Menu</h3>
				</div>
			  </div>
			</div>
		
					
				
				   @foreach($foods as $food)
						@if($category->Category_ID == $food->Category_ID )
			
						<div class="col-md-6">
						
						<div class="box loading box-widget widget-user">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-black" style="height:175px; background: url('../{{$food->Food_Pic}}') center center;background-repeat: no-repeat;  background-size: cover;">
						 <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3>
						  <h5 class="widget-user-desc">Web Designer</h5> -->
						  <div class="box-footer" style="opacity: 0.5;">
						  <div class="row" style="">
							<div class="col-sm-12 border-bottom">
							  <div class="description-block ">
								<h5  style="color: black;">{{ $food->Food_Desc}}</h5>
								<span class="description-text" style="color: black;"></br>{{ $food->Food_Name }}</span>
							  </div>
							  <!-- /.description-block -->
							</div>
							<!-- /.col -->
							
							<!-- /.col -->
						  </div>
						  </div>
						</div>
						
						
						  <?php $menuid = $food->Menu_ID;?>
					
						
					  </div>
					</div>
					
						@endif
						
					@endforeach
					
					@if($menuid != -1)
					<div class="form-group col-md-12">
					    <a class=" btn btn-info btn-flat pull-right" type="button" href="{{URL::to('order_create/'.$menuid )}}">
							Place order
					    </a>
				    </div>
					 @endif
				
					@if($menuid == -1 || !isset($menuid))
					
					<div class="box-header" style="background: rgba(255, 255, 255, 0); "> 
						<div class="col-md-12">
							<div id="2" class="callout callout-danger" ><p>Unfortunately, there is no available {{$category->Category_Name}} menu for this date. Sorry for any inconvenience caused.</p></div>
						<div>
					</div>
					
						
					@endif
					
			 
				
			</div>
		@endforeach
        <!--/.col (right) -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
	
  </script>
@endsection