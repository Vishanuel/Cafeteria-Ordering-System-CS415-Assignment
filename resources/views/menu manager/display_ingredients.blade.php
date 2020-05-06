@extends('layouts.app_menu')

@section('content')
<section class="content-header text-center"></section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Ingredients</h3>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Menu Item</th>
                        <th>Ingredient Name</th>
                        <th>Ingredient Type</th>
                        <th>Action</th>
                    </tr>
                        @for($i=0;$i<count($ingredients);$i++)
                        <tr>
                            <td >
                                {{$ingredients[$i]->Food_Name}}
                            </td>
                            <td >
                                {{$ingredients[$i]->Ingredient_Name}}
                            </td>
                            <td >
                                {{$ingredients[$i]->Ingredient_Type_Name}}
                            </td>
                           
                            <td >
                                <a data-toggle="modal" data-target="#{{$ingredients[$i]->Item_Ingredient_ID}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete{{$ingredients[$i]->Item_Ingredient_ID}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                                <div class="modal fade" id="{{$ingredients[$i]->Item_Ingredient_ID}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <form method="post" action="{{ route('ingredient.update', $ingredients[$i]->Item_Ingredient_ID) }}" enctype="multipart/form-data">
                                                @method('PATCH') 
                                                 @csrf
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span >&times;</span></button>
                                                    <h4 class="modal-title">Edit Ingredient</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="menus">Menu Item Name</label>
                                                        {{-- <input type="text" class="form-control" name="item_name" value="{{$ingredients[$i]->Food_Name}}"> --}}
                                                        <select id="menus" name="menu_item" class="form-control">
                                                            @for($j=0;$j<count($menu);$j++)
                                                            <option value={{$menu[$j]->Menu_Food_Item_ID}} @if($menu[$j]->Menu_Food_Item_ID == $ingredients[$i]->Item_ID) selected="selected"@endif>{{$menu[$j]->Food_Name}}</option>
                                                            @endfor
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name"value="{{$ingredients[$i]->Ingredient_Name}}" required>
                                                  </div>
                                                 
                                                        @for($k=0;$k<count($type);$k++)
                                                        <div>
                                                        <input type="radio" name="type"value="{{$type[$k]->Ingredient_Type_ID}}"
                                                        @if(($ingredients[$i]->Ingredient_Type_ID)==($type[$k]->Ingredient_Type_ID))  ? checked : @endif>
                                                        <label for="type">{{$type[$k]->Ingredient_Type_Name}}</label>
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
                                
                                <div class="modal fade" id="delete{{$ingredients[$i]->Item_Ingredient_ID}}" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                                <form method="post" action="{{ route('ingredient.destroy',$ingredients[$i]->Item_Ingredient_ID) }}" enctype="multipart/form-data">
                                                     @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span >&times;</span></button>
                                                        <h4 class="modal-title">Delete Ingredient</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> Do you really want to delete this Ingredient?</p>
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
                                        <form method="post" action="{{ route('ingredient.store') }}" enctype="multipart/form-data">
                                             @csrf
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span >&times;</span></button>
                                                <h4 class="modal-title">Create New Ingredient</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="menus">Menu Item </label>
                                                        {{-- <input type="text" class="form-control" name="item_name" value="{{$ingredients[$i]->Food_Name}}"> --}}
                                                        <select id="menus" name="menu_item" class="form-control">
                                                            <option value=""></option>
                                                            @for($j=0;$j<count($menu);$j++)
                                                            <option value="{{$menu[$j]->Menu_Food_Item_ID}}">{{$menu[$j]->Food_Name}}</option>
                                                            @endfor
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name" required>
                                                  </div>
                                                 
                                                        @for($k=0;$k<count($type);$k++)
                                                        <div>
                                                        <input type="radio" name="type"value="{{$type[$k]->Ingredient_Type_ID}}">
                                                        <label for="type">{{$type[$k]->Ingredient_Type_Name}}</label>
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
    </section>

@endsection
