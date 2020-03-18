@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
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
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Menu</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              
			</div>
            <!-- /.box-header -->
            <div  class="box-body">
			@if(count($foods) > 0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Food Name</th>
                  <th>Food Description</th>
                </tr>
                </thead>
                <tbody>
				
				   @foreach($foods as $food)
					<tr>
					  <td style="text-overflow: ellipsis;">{{ $food->Food_Name }}</td>
					  <td style="text-overflow: ellipsis;">{{ $food->Food_Desc}}</td>
					  <td style="text-overflow: ellipsis;" class="text-center">
							<?php ?>
						<?php $menuid = $food->Menu_ID ?? ""?>	 
						
								
						</td>
					</tr>
					@endforeach
				
				
                </tbody>
                
              </table>
			  
			 
			  <a class="btn btn-info btn-flat pull-right" type="button" href="{{URL::to('order_create/'.$menuid)}}">
                    Place order
				</a>
			  @else
					<div id="2" class="callout callout-danger col-md-6" ><p>No available menu for this date. Sorry for the inconvenience caused.</p></div>
					
			  @endif
				
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