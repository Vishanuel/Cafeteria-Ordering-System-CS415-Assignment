@extends('layouts.app_menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">Add New Menu</div> --}}
                <h1>Add New Menu</h1>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'menu.store'
                    ]) !!}
                    
                    <div class="form-group">
                        <label>Menu Date:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name = "Menu_Date">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <h2>Menu Items</h2>
                      
                      @for($i=0;$i<count($val);$i++)
                            <div class="form-group">
                            <input type="checkbox" value="{{$val[$i]->Menu_Food_Item_ID}}"  name="Food[{{$i}}]">
                                <label>{{$val[$i]->Food_Name}}</label>
                             </div>
                      @endfor    
                    
                    {!! Form::submit('Create New Menu', ['class' => 'btn btn-primary']) !!}
                    
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

  @endsection