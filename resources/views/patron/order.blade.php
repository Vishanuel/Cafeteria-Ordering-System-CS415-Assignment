@extends('layouts.app')

@section('content')
<section class="content-header" style="background-color:white; margin-top:114px">
     
        <h1>
            Add Course Info
        </h1>
        <ol class="breadcrumb" >
            <li><a href="{{url('home')}}"><span class="glyphicon glyphicon-home"></span><strong> Home</strong></a></li>
            <li><a href="{{url('featuretwo/#course')}}"><span class="glyphicon glyphicon-user"></span><strong> University Courses</strong></a></li>
            <li style="color:#283c78" class="active">Add Course Information</li>
        </ol>
      </section>
    
      <!-- Main content -->
      <section class="content container-fluid" style="background-color:white;">
        @if(session()->has('success'))
            <input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
        @endif
        @if(session()->has('error'))
            <input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
        @endif
        @if(session()->has('warning'))
          <input type="hidden" value="{{Session::get('warning')}}" id="hiddenwarningwcs">
        @endif
      <div class="row" >
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                            <form  method="POST" action="{{action('CourseController@store')}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                    <div class="container-fluid">
                                        <div class="row" style="background-color:white;">
                                            <div class="col-sm-12" style=" border-color:#e6e6e6; border-width:2px; border-style:solid; text-align:left;" >
                                                <div class="row" style="margin-top:3px; margin-bottom:5px;">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="coursecode" class="control-label">Course Code: </label>
                                                    </div>
                                                    <div class="col-sm-9" style="margin-top:8px;">
														<input type="text" id="coursecode" name="coursecode" Required placeholder="Enter course code">
                                                    </div>
                                                </div>


												<div class="row" style="margin-top:3px; margin-bottom:5px;">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="coursename" class="control-label">Course name: </label>
                                                    </div>
                                                    <div class="col-sm-9" style="margin-top:8px;">
														<input type="text" id="coursename" name="coursename" Required placeholder="Enter course name">
                                                    </div>
                                                </div>

                                               <div class="row" style="margin-top:3px; margin-bottom:5px;">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="coursemode" class="control-label">Course Mode: </label>
                                                    </div>
                                                    <div class="col-sm-9" style="margin-top:8px;">
                                                        <input type="text" id="coursemode" name="coursemode" Required placeholder="Enter course mode">
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:3px; margin-bottom:5px;">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="coursecampus" class="control-label">Course Campus: </label>
                                                    </div>
                                                    <div class="col-sm-9" style="margin-top:8px;">
                                                        <input type="text" id="coursecampus" name="coursecampus" Required placeholder="Enter course campus">
                                                    </div>
                                                </div>
                                                

                                                <div class="row" style="margin-top:3px; margin-bottom:5px;">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="schoolid" class="control-label">Course School ID: </label>
                                                    </div>
                                                    <div class="col-sm-9" style="margin-top:8px;">
                                                        <input type="number" id="schoolid" name="schoolid" Required placeholder="Enter school ID">
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:3px; margin-bottom:5px; margin-left:2px">
                                                    <div class="col-sm-3" style="margin-top:3px;">
                                                        <label for="user_id" class="control-label">Username:  </label>
                                                    </div>
                                                    <select class="col-sm-3" id="" name="user_id" style="margin-top:8px;">
                                                      <option id="user_id" Required name="user_id" Required value=""  disabled selected>Select Username</option>

                                                      @foreach ($user as $option )
                                                          <option id="user_id" name="user_id" Required value="{{ $option->user_id}}">
                                                          {{ $option->username}}
                                                          </option>
                                                     @endforeach
                                                    </select>
                                                </div> 
                                            </div>       
                                        </div>            
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <input class="btn btn-success" style="margin-left:20px;margin-top:10px; padding-left:25px; padding-right:25px;" type="submit" value="Submit" >
                                    <a type="button" style="margin-top:10px;margin-right:20px;margin-left:auto;padding-left:25px; padding-right:25px;padding-top:5px !important; padding-bottom:5px !important;" class="btn btn-danger" href="{{url('featuretwo/#course')}}">Back</a>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

        </div>
            <!-- /.col -->
      </section>
      <script>
           $( document ).ready(function() {
            hiddensuccess=$("#hiddensuccesswcs").val();
            swal("Successful", hiddensuccess, "success");
        });
        
        $( document ).ready(function() {
            hiddenerror=$("#hiddenerrorwcs").val();
            swal("Error Encounted", hiddenerror, "error");
        });

        $(document).ready(function() {
            hiddenwarning=$("#hiddenwarningwcs").val();
            swal("Access Denied", hiddenwarning, "error");
        });
       </script>
@endsection


