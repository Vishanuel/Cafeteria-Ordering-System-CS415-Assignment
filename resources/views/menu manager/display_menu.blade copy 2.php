@extends('layouts.app_menu')

@section('content')

{{-- <div class="date-picker">
                <div class="date-picker-header">
                    <p>
                        <a href="#" class="theme-selector active"><i class="fa fa-calendar fa-inverse"></i><span>BY DAY</span></a>
                        <a href="#" class="theme-selector "><i class="fa fa-film fa-inverse"></i><span>BY MEAL</span></a>
                    </p>

                    </div>
</div> --}}
{{-- <div class="dates" id="datePicker">
    <a id="prev" class="disabled" disabled><img src="https://yc.cldmlk.com/template_1/img/CarouselArrowLeft@2x.png"></a>

    <div id="date-scroller" class="frame ">
        <ul class="slidee">
            <!-- adding dates -->
        </ul>
    </div>

    <a id="next"><img src="https://yc.cldmlk.com/template_1/img/CarouselArrowRight@2x.png"></a>


</div> --}}
    <section class="content-header text-center"><h1 >Menu</h1></section>
    <section class="content">
        @for($i=0;$i<count($cat);$i++)
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title">{{$cat[$i]->Category_Name}}</h3>
                <a href="{{ route('menu.edit',$cat[$i]->Category_ID) }}">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
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
                        <td>
                                <a href="#">
                                        <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a href="#">
                                        <span class="glyphicon glyphicon-trash"></span>
                                </a> 
                               
                        </td>  
                           
                            
                    </tr>
                        @endfor 
                     
                    </table>
                </div>
            </div>
        </div>
        @endfor
    </section>
        
    
            {{-- <div class="table-responsive">
                <table class="table table-bordered table-striped" id ="example1">
                <tr>
                    <th>Menu Date</th>
                    <th>Menu Item</th>
                    <th>Item Description</th>
                    <th>Item Price</th>
                    <th>Action</th>
                </tr> --}}
                {{-- @for($i=0;$i<count($data);$i++)
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
                        @for($j=0;$j<count($val[$i]);$j++)
                        <div>{{$val[$i][$j]->Food_Desc}}</div>
                        @endfor
                    </td>
                    <td >
                        @for($j=0;$j<count($val[$i]);$j++)
                        <div>{{$val[$i][$j]->Price}}</div>
                        @endfor
                    </td>
                @endfor
                    <td>
                        <button class="btn btn-info open-modal" value="{{$data[$i]->Menu_ID}}" >
                            <a href="{{ route('menu.edit',$data[$i]->Menu_ID) }}">Edit</a>
                        </button>
                        <form method="post" action="{{ route('menu.destroy', $data[$i]->Menu_ID) }}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                            <button class="btn btn-info open-modal" value="{{$data[$i]->Menu_ID}}" >
                                <a href="{{ route('specialmenu.show',$data[$i]->Menu_ID)}}">Create Special menu</a>
                            </button>
                            
                        </td>
                </tr> 
                 @endfor--}}
                {{-- </table>
   
            </div>
        </div>
    </div> --}}
    

     



@endsection