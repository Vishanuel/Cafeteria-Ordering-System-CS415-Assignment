@extends('layouts.app_menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">Add New Menu</div> --}}
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
                <h1>Edit Menu</h1>
                 <div class="card-body">
                  <form method="post" action="{{ route('menu.update', $menu->Menu_ID) }}"
                  enctype="multipart/form-data">
                  @method('PATCH') 
                   @csrf
                    <div class="form-group">
                        <label for="Menu_Date">Menu Date:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name = "Menu_Date" 
                          value={{$menu->Menu_Date}}>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <h2>Menu Items</h2>
                      
                      @for($i=0;$i<count($val);$i++)
                            <div class="form-check">
                            <input type="checkbox" value="{{$val[$i]->Menu_Food_Item_ID}}"  name="Food[{{$i}}]" @if($val[$i]->Menu_Food_Item_ID)  ? checked :  @endif>
                                <label>{{$val[$i]->Food_Name}}</label>
                             </div>
                      @endfor    
                   
                    <div class="box-footer">
                   <a href="{{url('/home')}}" class="btn btn-default btn-flat">Cancel</a>
                    <button type="submit" class="btn btn-success btn-flat pull-right"><li class="glyphicon glyphicon-ok"></li> Save</button>
                    </form>

                  </div>
                </div> 
            </div>
        </div>
    </div>
</div>

  @endsection