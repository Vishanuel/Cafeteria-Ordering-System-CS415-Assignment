@extends('layouts.app')

@section('content')
<section class="content-header text-center"></section>
    <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Custom Meal</h3>
                </div>

                <div class="box-body ">
                    <div class="row">
                        {{-- <div class="thumbnail" style="border:none; background:white;"> --}}
                            <div class="col-sm-6">
                                <img class="img-responsive"src="../dist/img/restaurant/login22.jpg"/>
                            </div>
                            <div class=" form-group col-sm-6 ">
                                    <div class="row">
                                        
                                    <h4>Select Your Menu Item</h4>
                                    
                                    
                                    {{-- @for($i=0;$i<count($items);$i++) --}}
                                    <div class="row">
                                    <div class="col-sm-6">
                                    {{-- <label id="type" >{{$type[$i]->Ingredient_Type_Name}}</label> --}}
                                    <select id="menus" name="menu" class="form-control">
                                        <option value=""></option>
                                        @for($j=0;$j<count($items);$j++)
                                        <option value="{{$items[$j]->Menu_Food_Item_ID}}">{{$items[$j]->Food_Name}}</option>
                                        @endfor
                                     </select>
                                     
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <label for="{{$type[$i]->Ingredient_Type_ID}}">Price</label>
                                        <div><input readonly value="" id="ingredient_price{{$type[$i]->Ingredient_Type_ID}}" placeholder="0.00"/></div>
                                    </div> --}}
                                </div> 
                                    {{-- @endfor --}}
                                

                                    {{-- <div  class="form-group col-sm-6">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" max="10" min="1" Required value="1">
                                    </div> --}}
                                    <div  class="form-group col-sm-6">
                                    @for($k=0;$k<count($items);$k++)
                                    <div class="items" id="item{{$k}}" style="display:none;">
                                        @if(count($ingredients[$k])>0)
                                        <h4>Ingredients</h4>
                                        @for($j=0;$j<count($ingredients[$k]);$j++)
                                        <div class="checkbox">
                                        <input value="{{$ingredients[$k][$j]->Ingredient_ID}}" type="checkbox" class="minimal"/>
                                        <label>{{$ingredients[$k][$j]->Ingredient_Name}}</label>
                                        </div>
                                        @endfor
                                        @endif
                                     </div>
                                     @endfor
                                    </div>
                                
                            {{-- </div> --}}
                        </div> 
                    </div>
                </div>
                <div class="box-footer with-border">
                    <a class=" btn btn-info btn-flat pull-right" type="button" href="#">
                    Order Your Meal
                     </a>
                </div>

            </div>
    </section>

@endsection