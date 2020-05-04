@extends('layouts.app_menu')

@section('content')
<section class="content-header"><h1 >Edit</h1></section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title">{{$cat[0]->Category_Name}}</h3>
            </div>

            <div class="box-body text-center">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id ="example1">
                    <tr>
                        <td> Date </td>
                        <td> Dishes </td>
                        <td> Dish Description </td>
                        <td> Price </td>
                        <td> Action </td>
                    </tr> 
                    
                  @for($j=0;$j<count($menu);$j++) 
                    <tr>  
                        <td>{{$menu[$j]->Menu_Date}}</td>
                        <td> 
                            @for($k=0;$k<count($item[$j]);$k++)
                             <div>{{$item[$j][$k]->Food_Name}}</div>
                             @endfor
                        </td>
                        <td> 
                            @for($k=0;$k<count($item[$j]);$k++)
                            <div>{{$item[$j][$k]->Food_Desc}}</div>
                             @endfor
                        </td>
                        <td> 
                             @for($k=0;$k<count($item[$j]);$k++)
                             <div>{{$item[$j][$k]->Price}}</div>
                             @endfor
                        </td>
                        <td>
                            <a  data-toggle="modal" data-target="#{{$menu[$j]->Menu_Date}}">
                              <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="#">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a> 
                       
                        {{-- this is the modal --}}
                        <div class="modal fade" id="{{$menu[$j]->Menu_Date}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Edit</h4>
                                </div>
                                <div class="modal-body" >
                                    <form method="post" action="#"
                                        enctype="multipart/form-data">
                                        @method('PATCH') 
                                         @csrf
                                          <div class="form-group">
                                              <label for="Menu_Date">Menu Date:</label>
                      
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker" value={{$menu[$j]->Menu_Date}}>
                                                  </div>
                                            </div>
                                            <h2>Menu Items</h2>
                                            
                                           @for($i=0;$i<count($item[$j]);$i++)
                                                  <div class="form-check text-center">
                                                  <input type="checkbox" value="{{$rest[$i]->Menu_Food_Item_ID}}"  name="Food[{{$i}}]" @if($rest[$i]->Menu_Food_Item_ID)  ? checked :  @endif>
                                                      <label>{{$item[$j][$i]->Food_Name}}</label>
                                                   </div>
                                            @endfor     
                                         
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                              </div>
                            </div>
                          </div> 
                        </td>  
                        </tr>
                  @endfor 
                     
                    </table>
                </div>
            </div>

           
    </section>


  @endsection