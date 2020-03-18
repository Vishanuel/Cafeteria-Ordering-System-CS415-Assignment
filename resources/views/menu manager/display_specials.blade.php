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
                        @for($j=0;$j<count($val[$i]);$j++)
                        <div>{{$val[$i][$j]->Special_Desc}}</div>
                        @endfor
                    </td>
                    <td >
                        @for($j=0;$j<count($val[$i]);$j++)
                        <div>{{$val[$i][$j]->Special_Price}}</div>
                        @endfor
                    </td>
                @endfor
                    <td>
                        <button class="btn btn-info open-modal" value="{{$data[$i]->Special_ID}}" >
                            <a href="{{ route('specialmenu.edit',$data[$i]->Special_ID) }}">Edit</a>
                        </button>
                        <form method="post" action="{{ route('menu.destroy', $data[$i]->Special_ID) }}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                 @endfor
                </table>
   
            </div>
        </div>
    </div>
    
</div>
     



@endsection