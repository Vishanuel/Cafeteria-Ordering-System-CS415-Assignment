@extends('layouts.app_menu')

@section('content')
<section class="content-header text-center"><h1 >MENUS</h1></section>
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
  </section>
    <section class="content">
        @for($i=0;$i<count($cat);$i++)
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title">{{$cat[$i]->Category_Name}}</h3>
            </div>

            <div class="box-body text-center">
                    <table class="table table-bordered table-striped" id ="example1">
                    <tr>
                        <td> Date </td>
                        <td> Dishes </td>
                        <td> Dish Description </td>
                        <td> Price </td>
                         {{-- <td> Deliverability </td>  --}}
                    </tr> 
                    
                  @for($j=0;$j<count($menu);$j++) 
                  @if(count($item[$i][$j])>0)
                    <tr>  
                        <td>{{$menu[$j]->Menu_Date}}</td>
                        <td> 
                            @for($k=0;$k<count($item[$i][$j]);$k++)
                             <div>{{$item[$i][$j][$k]->Food_Name}}</div>
                             @endfor
                        </td>
                        <td> 
                            @for($k=0;$k<count($item[$i][$j]);$k++)
                            <div>{{$item[$i][$j][$k]->Food_Desc}}</div>
                             @endfor
                        </td>
                        <td> 
                             @for($k=0;$k<count($item[$i][$j]);$k++)
                             <div>{{$item[$i][$j][$k]->Price}}</div>
                             @endfor
                        </td>
                        {{-- <td>
                            @if($menu[$j]->Deliverable==0)
                               Not Deliverable @else Deliverable @endif
                          </td>
                        --}}
                        </td>  
                        </tr>
                        @endif
                  @endfor 
                     
                    </table>
                </div>
            </div> 
            @endfor
           
    </section>


  @endsection