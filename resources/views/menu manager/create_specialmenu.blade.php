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
                <h1>Add New Special Menu</h1>
                 <div class="card-body">
                  <form id ="createmenu" role="form" method="POST" action="{{route('specialmenu.store')}}" 
                 enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">    
                      <label for="Special_Desc">Special Menu Description:</label>
                      <input type="text" class="form-control" name="Special_Desc"/>
                  </div>
                      <h2>Menu Items</h2>
                <input type="text" class="form-control" name="menu" value="{{$id}}" style="display: none"/>
                      @for($i=0;$i<count($val);$i++)
                            <div class="form-check" name="Food Item">
                                <label><input type="checkbox" value="{{$val[$i]->Menu_Food_Item_ID}}"  name="Food[{{$i}}]">{{$val[$i]->Food_Name}}</label>
                             </div>

                            <div class="{{$val[$i]->Menu_Food_Item_ID}}" style="display: none">
                                <label>Enter Amount: <input type="text" name="price[{{$i}}]" data-type="currency" placeholder="$1,000.00"></label>
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