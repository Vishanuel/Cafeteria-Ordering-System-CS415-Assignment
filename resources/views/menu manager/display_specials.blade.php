@extends('layouts.app_menu')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Special Menu</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id ="example1">
                <tr>
                    <th>Menu Date</th>
                    <th>Menu Item</th>
                    <th>Item Description</th>
                    <th>Item Price</th>
                    <th>Action</th>
                </tr>
                @for($i=0;$i<count($data);$i++)
                <tr>
                    <td >
                    {{$data[$i]->Menu_Date}}
                    </td>
                @for($k=0;$k<1;$k++)
                    <td >
                        @for($j=0;$j<count($val[$i]);$j++)
                        <div>{{$val[$i][$j]->Food_Name}}</div>
                        @endfor
                    </td>
                    <td >
                        <div>{{$data[$i]->Special_Desc}}</div>
                    </td>
                    <td >
                        <div>{{$data[$i]->Special_Price}}</div>
                    </td>
                @endfor
                    <td>
                        <a data-toggle="modal" data-target="#edit{{$data[$i]->Special_ID}}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a> 
                        <a data-toggle="modal" data-target="#delete{{$data[$i]->Special_ID}}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>

                    <div class="modal fade" id="edit{{$data[$i]->Special_ID}}" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <form method="post" action="{{ route('specialmenu.update', $data[$i]->Special_ID) }}" enctype="multipart/form-data">
                                    @method('PATCH') 
                                     @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Edit Special Menu</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-group">
                                                    <label for="menus">Menu </label>
                                                    
                                                    <select id="menus" name="menu" class="form-control">
                                                        <option value=""></option>
                                                        @for($j=0;$j<count($menu);$j++)
                                                        <option value="{{$menu[$j]->Menu_ID}}"  @if($menu[$j]->Menu_ID == $data[$i]->Menu_ID) selected="selected"@endif>
                                                            {{$menu[$j]->Menu_Date}} 
                                                            @for($k=0;$k<count($menuitem[$j]);$k++)
                                                             - {{$menuitem[$j][$k]->Food_Name}}
                                                            @endfor
                                                            - {{$menu[$j]->Category_Name}}
                                                        </option>
                                                        @endfor
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Menu Description</label>
                                                <input type="text" class="form-control" name="menu_desc" value="{{ $data[$i]->Special_Desc}}">
                                              </div>
                                              <div class="form-group">
                                                    <label>Special Menu Price</label>
                                                    <input type="text" class="form-control" name="menu_price" value="{{ $data[$i]->Special_Price}}">
                                              </div>
                                             
                                              <label>Select Menu Items for Special Menu </label>
                                              @for($k=0;$k<count($items);$k++)
                                              <div>
                                              <input type="checkbox" name="items[]" value="{{$items[$k]->Menu_Food_Item_ID}}" 
                                              @for($n=0;$n<count($val[$i]);$n++)
                                                      @if(($val[$i][$n]->Menu_Food_Item_ID)==($items[$k]->Menu_Food_Item_ID))  ? checked : 
                                                      @endif @endfor>
                                              <label for="type">{{$items[$k]->Food_Name}}</label>
                                              </div>
                                              @endfor    
                                             
                                            </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-flat pull-right">Update</button>
                                    </div>
                                </form>
                                
                         </div>
                       </div>
                    </div>

                    <div class="modal fade" id="delete{{$data[$i]->Special_ID}}" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <form method="post" action="{{ route('specialmenu.destroy', $data[$i]->Special_ID) }}" enctype="multipart/form-data">
                                     @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Delete Special Menu</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p> Do you really want to delete this special menu?</p>
                                        <input name="_method" type="hidden" value="DELETE">     
                                      
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-flat pull-right">delete</button>
                                    </div>
                                </form>
                                
                         </div>
                       </div>
                    </div>
                    
                </tr>
                 @endfor
                </table>
                <a data-toggle="modal" data-target="#add">
                        <span class="glyphicon glyphicon-plus pull-right"></span>
                    </a>

                    <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <form method="post" action="{{ route('specialmenu.store') }}" enctype="multipart/form-data">
                                         @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span >&times;</span></button>
                                            <h4 class="modal-title">Create New Special Menu</h4>
                                        </div>
                                        <div class="modal-body">
                                                 <div class="form-group">
                                                    <label for="menus">Menu </label>
                                                    
                                                    <select id="menus" name="menu" class="form-control">
                                                        <option value=""></option>
                                                        @for($j=0;$j<count($menu);$j++)
                                                        <option value="{{$menu[$j]->Menu_ID}}"><div>{{$menu[$j]->Menu_Date}} 
                                                            @for($k=0;$k<count($menuitem[$j]);$k++)
                                                             - {{$menuitem[$j][$k]->Food_Name}}
                                                            @endfor
                                                            - {{$menu[$j]->Category_Name}}</div>
                                                        </option>
                                                        @endfor
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Menu Description</label>
                                                    <input type="text" class="form-control" name="menu_desc">
                                              </div>
                                              <div class="form-group">
                                                    <label>Special Menu Price</label>
                                                    <input type="text" class="form-control" name="menu_price">
                                              </div>
                                             
                                              <label>Select Menu Items for Special Menu </label>
                                              @for($k=0;$k<count($items);$k++)
                                              <div>
                                              <input type="checkbox" name="items[]" value="{{$items[$k]->Menu_Food_Item_ID}}">
                                              <label for="type">{{$items[$k]->Food_Name}}</label>
                                              </div>
                                              @endfor    
                                             
                                            </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-flat pull-right">Save</button>
                                        </div>
                                    </form>
                             </div>
                           </div>
                        </div>
                        
            </div>
        </div>
    </div>
    
</div>
     



@endsection