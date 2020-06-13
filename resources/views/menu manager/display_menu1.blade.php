@extends('layouts.app_menu')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border text-center">MENUS
            </div>

            <div class="box-body">
                    <table class="table table-bordered table-striped" id ="example1">
                    <tr>
                        <td> Date </td>
                        @for($r=0;$r<count($cat);$r++)
                        <td>{{$cat[$r]->Category_Name}}</td>
                        @endfor
                        <td> Action </td>
                    </tr> 
                    @for($i=0;$i<count($dish_date);$i++) 
                    <tr>
                    <td> {{$dish_date[$i]->Menu_Date}}</td>
                    @for($r=0;$r<count($cat);$r++)
                    {{-- <td>{{$date[$i][$r]->Menu_Date}}</td> --}}
                    <td> 
                      @for($s=0;$s<count($date[$i][$r]);$s++)
                      @for($t=0;$t<count($date_item[$i][$r][$s]);$t++)
                      <div>{{$date_item[$i][$r][$s][$t]->Food_Name}} - {{$date_item[$i][$r][$s][$t]->Price}}</div>
                      @endfor
                      @endfor
                     
                    </td>

                    @endfor
                    <td>
                      <a data-toggle="modal" data-target="#">
                              <span class="glyphicon glyphicon-edit"></span>
                      </a> 
                      <a data-toggle="modal" data-target="#delete">
                              <span class="glyphicon glyphicon-trash"></span>
                      </a>
                      <a data-toggle="modal" data-target="#">
                        <span class="glyphicon glyphicon-plus"></span>
                      </a>
                    </td>
                     
                  </tr>  
                  @endfor    
                </table>
          </div>

        </div>

           
           

           
</section>
 
@endsection 