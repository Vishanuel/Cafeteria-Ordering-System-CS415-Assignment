@extends('layouts.app_menu')

@section('content')
<section class="content-header text-center"></section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Items</h3>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Default Ingredients</th>
                        <th>Other Ingredients</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                        @for($i=0;$i<count($dish);$i++)
                        <tr>
                            <td title=" Name of the Item">
                                {{$dish[$i]->Food_Name}}
                            </td>
                            <td><div class="widget-user-header bg-black"
                                style="height:90px; background: url('../{{$dish[$i]->Food_Pic}}') center center;background-repeat: no-repeat;  background-size: cover;">
                            </div>
                                </td>
                            <td title=" default ingredients that goes with the item">
                                @for($j=0;$j<count($ingredient[$i]);$j++)
                                <div>{{$ingredient[$i][$j]->Ingredient_Name}}</div>
                                @endfor
                            </td>
                            <td title="ingredients that is used for customization">
                                @for($j=0;$j<count($other_ingredient[$i]);$j++)
                                <div>{{$other_ingredient[$i][$j]->Ingredient_Name}}</div>
                                @endfor
                            </td>
                            <td title=" Description of the Item">
                                {{$dish[$i]->Food_Desc}}
                            </td>
                            <td title=" Price of the Item">
                                {{$dish[$i]->Price}}
                            </td>
                            <td title=" Quantity of the Item">
                                {{$dish[$i]->Quantity}}
                            </td>
                           
                            <td >
                                <a data-toggle="modal" data-target="#{{$dish[$i]->Menu_Food_Item_ID}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete{{$dish[$i]->Menu_Food_Item_ID}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                                {{-- below modal is for updating the information of the item --}}
                                <div class="modal fade" id="{{$dish[$i]->Menu_Food_Item_ID}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <form method="post" action="{{ route('item.update', $dish[$i]->Menu_Food_Item_ID) }}" enctype="multipart/form-data">
                                                @method('PATCH') 
                                                 @csrf
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span >&times;</span></button>
                                                    <h4 class="modal-title">Edit Menu Item</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Item Name</label>
                                                        <input type="text" class="form-control" name="item_name" title="Name of the Item" value="{{$dish[$i]->Food_Name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc" title="Description of the Item" value="{{$dish[$i]->Food_Desc}}" required>
                                                  </div>
                                                  <div class="form-group">
                                                          <label>Item Price</label>
                                                          <input type="number" class="form-control" name="item_price" title="Price of the Item" value="{{$dish[$i]->Price}}" min="0" placeholder="0.00" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input type="number" class="form-control" name="item_quantity" title="Quantity of the Item" value="{{$dish[$i]->Quantity}}" min="0"  placeholder="0" required>
                                                 </div>
                                                  <div class="row form-group checkbox">
                                                        <div class="col-md-6">
                                                                <label title="Ingredient that default with the Item"><b>Default Ingredients</b></label>
                                                                @for($k=0;$k<count($all_ingredient);$k++)
                                                                <div> <label>
                                                                        <input type="checkbox"  name="default[]" value="{{$all_ingredient[$k]->Ingredient_ID}}" @for($j=0;$j<count($ingredient[$i]);$j++)
                                                                        @if ($all_ingredient[$k]->Ingredient_ID==$ingredient[$i][$j]->Ingredient_ID)
                                                                        ? checked : 
                                                                        @endif
                                                                        @endfor>
                                                                        {{$all_ingredient[$k]->Ingredient_Name}}
                                                                    </label></div>
                                                                @endfor
                                                        </div>
                                                        <div class="col-md-6">
                                                                <label title="other Ingredients of Item used for meal customization "><b>Other Ingredients</b></label>
                                                                @for($k=0;$k<count($all_ingredient);$k++)
                                                                <div> <label>
                                                                        <input type="checkbox"  name="other[]" value="{{$all_ingredient[$k]->Ingredient_ID}}" @for($j=0;$j<count($other_ingredient[$i]);$j++)
                                                                        @if ($all_ingredient[$k]->Ingredient_ID==$other_ingredient[$i][$j]->Ingredient_ID)
                                                                        ? checked : 
                                                                        @endif
                                                                        @endfor>
                                                                        {{$all_ingredient[$k]->Ingredient_Name}}
                                                                    </label></div>
                                                                @endfor
                                                        </div>
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

                                {{-- below modal is for deleting for the restaurant --}}
                                <div class="modal fade" id="delete{{$dish[$i]->Menu_Food_Item_ID}}" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                                <form method="post" action="{{ route('item.destroy',$dish[$i]->Menu_Food_Item_ID) }}" enctype="multipart/form-data">
                                                     @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span >&times;</span></button>
                                                        <h4 class="modal-title">Delete Item</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> Do you really want to delete this Item?</p>
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

                         {{-- below modal is for creating and adding new item for the restaurant --}}
                        <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                        <form method="post" action="{{ route('item.store') }}" enctype="multipart/form-data">
                                             @csrf
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span >&times;</span></button>
                                                <h4 class="modal-title">Create New Menu Item</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control" name="item_name" title="Name of the Item" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc" title="Description of the Item" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Price</label>
                                                        <input type="number" class="form-control" name="item_price" title="Price of the Item" min="0.00" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input type="number" class="form-control" name="item_quantity" title="Quantity of the Item" min="0"  placeholder="0" required>
                                                 </div>
                                                <div class="row form-group checkbox">
                                                    <div class="col-md-6">
                                                            <label title="Ingredient that default with the Item"><b>Default Ingredients</b></label>
                                                            @for($k=0;$k<count($all_ingredient);$k++)
                                                            <div> <label>
                                                                    <input type="checkbox"  name="default[]" value="{{$all_ingredient[$k]->Ingredient_ID}}">
                                                                    {{$all_ingredient[$k]->Ingredient_Name}}
                                                                </label></div>
                                                            @endfor
                                                    </div>
                                                    <div class="col-md-6">
                                                            <label title="other Ingredients of Item used for meal customization "><b>Other Ingredients</b></label>
                                                            @for($k=0;$k<count($all_ingredient);$k++)
                                                            <div> <label>
                                                                    <input type="checkbox"  name="other[]" value="{{$all_ingredient[$k]->Ingredient_ID}}">
                                                                    {{$all_ingredient[$k]->Ingredient_Name}}
                                                                </label></div>
                                                            @endfor
                                                    </div>
                                                </div>
                                                <div> 
                                                    <label for="exampleInputFile">File input</label>
                                                    <input type="file" id="exampleInputFile" name="image">
                                                    <p class="help-block">Select Image of your Menu Item</p>
                                                </div>
                                                
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




