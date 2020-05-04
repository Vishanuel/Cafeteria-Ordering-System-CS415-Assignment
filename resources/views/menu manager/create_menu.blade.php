@extends('layouts.app_menu')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">Add New Menu</div> --}}
                <h1>Add New Menu</h1>
                 <div class="card-body">
                  <form id ="createmenu" role="form" method="POST" action="{{route('menu.store')}}" 
                  enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label for="Menu_Date">Menu Date:</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name = "Menu_Date">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <h3>Menu Items</h3>
                      
                      @for($i=0;$i<count($val);$i++)
                            <div class="form-check" name="Food Item">
                            <input type="checkbox" value="{{$val[$i]->Menu_Food_Item_ID}}"  name="Food[{{$i}}]">
                                <label for="Food[{{$i}}]">{{$val[$i]->Food_Name}}</label>
                             </div>
                      @endfor    
                      <h3>Category</h3>
                      @for($i=0;$i<count($cat);$i++)
                            <div class="form-radio" name="category">
                            <input type="radio" value="{{$cat[$i]->Category_ID}}"  name="Cat[{{$i}}]">
                                <label for="Cat[{{$i}}]">{{$cat[$i]->Category_Name}}</label>
                             </div>
                      @endfor    
                   
                    <div class="box-footer">
                   <a href="{{url('/home')}}" class="btn btn-default btn-flat">Cancel</a>
                    <button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-plus"></li> Add</button>
                    </form>

                  </div>
                </div> 
            </div>
        </div>
    </div>
</div>

  @endsection