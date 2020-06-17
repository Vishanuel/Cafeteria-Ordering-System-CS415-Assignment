
@extends('layouts.app_menu')

@section('content')
<section class="content-header text-center">

</section>
<section class="content">
<div class="box">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Menu Items</h3>
            <a  target="_blank" href="{{url('Mhelp/ViewingMenuItems.html')}}" class="pull-right" title="Get Help">
                <span class="glyphicon glyphicon-question-sign"></span>
            </a>
        </div>

        <div class="box-body ">
        <table class="table table-bordered table-striped text-center" id ="example1">
        <tr>
            <th>Food Name</th>
            <th>Recipe</th>
            <th>Action</th>
        </tr>
            @for($i=0;$i<count($dish);$i++)
            <tr>
                <td title=" Name of the Item">
                    {{$dish[$i]->Food_Name}}
                </td>
                <td title=" Recipe of the food">
                    {{$dish[$i]->Menu_Food_Item_Recipe}}
                </td>
                <td >
                    <a data-toggle="modal" data-target="#{{$dish[$i]->Menu_Food_Item_ID}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a> 
                   
                </td>

                <div class="modal fade" id="{{$dish[$i]->Menu_Food_Item_ID}}" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <form method="post" action="{{ route('recipe.update', $dish[$i]->Menu_Food_Item_ID) }}" enctype="multipart/form-data">
                                    @method('PATCH') 
                                     @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Menu Item Recipes</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-group ">
                                                    <label>Food Item</label>
                                                    <select class="form-control" name="food_item" required>
                                                    @for($j=0;$j<count($dish);$j++)
                                                         <option value="{{$dish[$j]->Menu_Food_Item_ID}}" @if($dish[$j]->Menu_Food_Item_ID == $dish[$i]->Menu_Food_Item_ID) selected="selected" @endif >
                                                            {{$dish[$j]->Food_Name}}
                                                            </option>
                                                            
                                                        @endfor
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                        <label>Recipe</label>
                                                        <textarea type="text" class="form-control" name="item_recipe" title="Recipe of the food" value="{{$dish[$i]->Menu_Food_Item_Recipe}}" Required>{{$dish[$i]->Menu_Food_Item_Recipe}}</textarea>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-flat pull-right">Update</button>
                                    </div>
                                </form>
                                
                         </div>
                       </div>
                    </div>
            </tr>
            @endfor
            </table>
            {{-- <a data-toggle="modal" data-target="#add">
                <span class="glyphicon glyphicon-plus pull-right"></span>
            </a>

            <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <form method="post" action="{{ route('recipe.store') }}" enctype="multipart/form-data">
                                 @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span >&times;</span></button>
                                    <h4 class="modal-title">Create New Recipe</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group ">
                                            <label>Food Item</label>
                                            <select class="form-control" name="food_item" required>
                                            @for($j=0;$j<count($dish);$j++)
                                                 <option value="{{$dish[$j]->Menu_Food_Item_ID}}">
                                                    {{$dish[$j]->Food_Name}}
                                                    </option>
                                                    
                                                @endfor
                                                
                                            </select>
                                        </div>
                                    <div class="form-group">
                                            <label>Recipe</label>
                                            <textarea type="text" class="form-control" name="item_recipe" title="Recipe of the food" Required></textarea>
                                              </div>
                                              
                                   
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-flat pull-right">Save</button>
                                </div>
                            </form>
                     </div>
                   </div>
                </div> --}}

        </div>
    </div>
</section>

@endsection
                           