@extends('layouts.app_menu')

@section('content')

<section class="content-header text-center"><h3>MENUS</h3>
 
</section>
    <section class="content-header">
    <div>
      <form method="post" action="filter_menu" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="Menu_Date">Menu Date: </label>
                <div class="input-group date col-md-4">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker" name="Menu_Date" required>
                  </div>
              

          </div>
          <div>
         
          <button type="submit" class="btn btn-default">Filter</button>
          </div>
          
           </form>
           <button type="button" class="btn btn-default " ><a href="{{URL::to('menu')}}">Reset</a></button>
    </div>
    <a  target="_blank" href="{{url('Mhelp/ViewingMenus.html')}}" class="pull-right" title="Get Help">
      <span class="glyphicon glyphicon-question-sign"></span>
  </a> 
    </section>
    <section class="content">
        @for($i=0;$i<count($cat);$i++)
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title">{{$cat[$i]->Category_Name}}</h3>
                {{-- <a href="{{ route('menu.edit',$cat[$i]->Category_ID) }}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a> --}}
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id ="example1">
                    <tr>
                        <td> Date </td>
                        <td> Dishes </td>
                        <td> Dish Description </td>
                        <td> Price </td>
                        <td> Action </td>
                    </tr> 
                    
                    @for($j=0;$j<count($val[$i]);$j++) 
                    <tr>  
                        <td>{{$menu[$i][$j]->Menu_Date}}</td>
                        <td> 
                            @for($k=0;$k<count($val[$i][$j]);$k++)
                             <div>{{$val[$i][$j][$k]->Food_Name}}</div>
                             @endfor
                        </td>
                        <td> 
                            @for($k=0;$k<count($val[$i][$j]);$k++)
                            <div>{{$val[$i][$j][$k]->Food_Desc}}</div>
                             @endfor
                        </td>
                        <td> 
                             @for($k=0;$k<count($val[$i][$j]);$k++)
                             <div>{{$val[$i][$j][$k]->Price}}</div>
                             @endfor
                         </td>
                         {{-- <td>
                           @if($menu[$i][$j]->Deliverable==0)
                              Not Deliverable @else Deliverable @endif
                         </td> --}}
                        <td>
                                <a data-toggle="modal" data-target="#{{$menu[$i][$j]->Menu_ID}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete{{$menu[$i][$j]->Menu_ID}}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                </a>

                                
                                 
                                 {{-- <form method="post" action="{{ route('menu.destroy', $data[$i]->Menu_ID) }}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form> --}}
                        </td>  

                           <div class="modal fade" id="{{$menu[$i][$j]->Menu_ID}}" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post" action="{{ route('menu.update', $menu[$i][$j]->Menu_ID) }}" enctype="multipart/form-data">
                                        @method('PATCH') 
                                         @csrf
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span >&times;</span></button>
                                  <h4 class="modal-title">Edit </h4>
                                </div>
                                
                                <div class="modal-body" >
                                          <div class="form-group">
                                            <label for="Menu_Date">Menu Date:</label>
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="date" class="form-control pull-right" id="datepicker" name="Menu_Date" value={{$menu[$i][$j]->Menu_Date}} required>
                                                    </div>

                                            </div>
                                            
                                            <label>Menu Items</label>
                                            @for($n=0;$n<count($rest);$n++)
                                                <div class="checkbox" >
                                                  <label><input  
                                                       type="checkbox"  value="{{$rest[$n]->Menu_Food_Item_ID}}"  name="Food[]" 
                                                       @for($k=0;$k<count($val[$i][$j]);$k++)
                                                      @if(($val[$i][$j][$k]->Menu_Food_Item_ID)==($rest[$n]->Menu_Food_Item_ID))  ? checked : 
                                                      @endif @endfor>{{$rest[$n]->Food_Name}}</label>
                                                </div> 
                                            {{-- @endfor   --}}
                                            @endfor 
                                            {{-- <label>Is this Menu Deliverable? </label>
                                            <div class="radio">
                                              <label><input type="radio" id="deliverable" name="deliverable" value="1" 
                                                @if(($menu[$i][$j]->Deliverable)==1)  ? checked : 
                                                @endif>Deliverable</label>
                                              <label><input type="radio" id="mon-deliverable" name="deliverable" value="0" 
                                                @if(($menu[$i][$j]->Deliverable)==0)  ? checked : 
                                                @endif>Non-Deliverable</label>
                                           
                                            </div> --}}

                                          </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-flat pull-right">Save changes</button>
                                      </div>
                                      </form>
                                    </div>
                                 </div>
                             </div>

                             <div class="modal fade" id="delete{{$menu[$i][$j]->Menu_ID}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form method="post" action="{{ route('menu.destroy', $menu[$i][$j]->Menu_ID) }}" enctype="multipart/form-data">
                                         @csrf
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Delete</h4>
                                      </div>
                                      
                                      <div class="modal-body">
                                        <p>Do you sure that you want to delete this menu?</p>  
                                        <input name="_method" type="hidden" value="DELETE">     
                                      </div>
                                      <div class="modal-footer">
                                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">NO</button>
                                              <button type="submit" class="btn btn-success btn-flat pull-right">YES</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            </tr>
                   @endfor 
                </table>
            </div>
           
            <div>
                <a data-toggle="modal" data-target="#{{$cat[$i]->Category_Name}}">
                  <span class="glyphicon glyphicon-plus pull-right"></span>
                </a>
            </div>

            <div class="modal fade" id="{{$cat[$i]->Category_Name}}" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                     @csrf
                     <input class="hidden" name="Category" value="{{$cat[$i]->Category_ID}}">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span >&times;</span></button>
                    <h3 class="modal-title" >Add Menu </h3>
                    
                  </div>
                  
                  <div class="modal-body" >
                            <div class="form-group">
                              <label for="Menu_Date">Menu Date:</label>
                                <div class="input-group date">
                                 <div class="input-group-addon">
                                     <i class="fa fa-calendar"></i>
                                  </div>
                                    <input type="date" min="{{ date('mm-dd-yyyy') }}" class="form-control pull-right" id="datepicker" name="Menu_Date" required >
                                </div>
                              <label>Menu Items</label>
                             @for($j=0;$j<count($rest);$j++)
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="{{$rest[$j]->Menu_Food_Item_ID}}"  name="Food[]">
                                    {{$rest[$j]->Food_Name}}
                                  </label>
                                  </div>
                            @endfor 
                            {{-- <label>Is this Menu Deliverable? </label>
                            <div class="radio">
                              <label><input type="radio" id="deliverable" name="deliverable" value="1">Deliverable</label>
                              <label><input type="radio" id="mon-deliverable" name="deliverable" value="0">Non-Deliverable</label>
                                           
                            </div> --}}
                            </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-flat pull-right">Add New Menu</button>
                        </div>
                        </form>
                        
                       
                      </div>
                   </div>
               </div>


        </div>
    </div>
    
@endfor
</section>
 
@endsection 