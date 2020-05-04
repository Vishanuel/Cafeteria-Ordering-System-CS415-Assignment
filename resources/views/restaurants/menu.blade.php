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
						
        <!-- left column --><div class="row">
		
        @foreach($categories as $category)
		<select id="change">
  <option value="">Select One</option>
  <option value="this">This</option>
  <option value="that">That</option>
</select>

<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		 <div class="row">
			<div class="col-md-12 col-xs-12">
			  <div class="box loading" style="background: rgba(255, 255, 255, 1); box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.1);z-index:999;">
				<div class="box-header with-border">
					<h3 class="box-title">{{$category->Category_Name}} Menu</h3>
				</div>
			  
				<div class="box-body">
					
				
				   @foreach($foods as $food)
						@if($category->Category_ID == $food->Category_ID )
			
					<div class="col-md-3 col-xs-12">
						
						<div class="box loading box-widget widget-user">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-black" style="height:175px; background: url('../{{$food->Food_Pic}}') center center;background-repeat: no-repeat;  background-size: cover;">
						 <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3>
						  <h5 class="widget-user-desc">Web Designer</h5> -->
						  
						
						</div>
						<div class="box-footer" style="text-align: center;" ><h4>{{ $food->Food_Name }}</h4></div>
						
						</div>
	
						  <?php $menuid = $food->Menu_ID;?>
					
						
					 
					</div>
					
						@endif
						
					@endforeach
					
					@if($menuid != -1)
					<div class="form-group col-md-12">
						@if(Auth::user()->usertype == "Patron")
						<a class=" btn btn-info btn-flat pull-right" type="button" href="{{URL::to('order_create/'.$menuid )}}">
							Place order
					    </a>
						@elseif(Auth::user()->usertype == "Student")
					    <a class=" btn btn-info btn-flat pull-right" type="button" href="{{URL::to('student_order_create/'.$menuid )}}">
							Place order
					    </a>
						@endif
				    </div>
					 @endif
						 </div>
					</div>
				</div>
					@if($menuid == -1 || !isset($menuid))
					
					<div class="box-header" style="background: rgba(255, 255, 255, 0); "> 
						<div class="col-md-12 col-xs-12">
							<div id="2" class="callout callout-danger" ><p>Unfortunately, there is no available {{$category->Category_Name}} menu for this date. Sorry for any inconvenience caused.</p></div>
						</div>
					</div>
					
						
					@endif
					
			 
				
			</div>
		@endforeach
        <!--/.col (right) -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
 </div>
 
 
@endsection