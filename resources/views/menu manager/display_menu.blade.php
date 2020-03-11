@extends('layouts.app_menu')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
   <h3 class="panel-title">Menu</h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
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
             @for($j=0;$j<count($val[$j]);$j++)
             <div>{{$val[$k][$j]->Food_Name}}</div>
             @endfor
         </td>
         <td >
             @for($j=0;$j<count($val[$j]);$j++)
             <div>{{$val[$k][$j]->Food_Desc}}</div>
             @endfor
         </td>
         <td >
             @for($j=0;$j<count($val[$j]);$j++)
             <div>{{$val[$k][$j]->Price}}</div>
             @endfor
         </td>
         @endfor
       <td>
           <button class="btn btn-info open-modal" value="{{$data[$i]->Menu_ID}}" >
               <a href="{{ route('menu.edit',$data[$i]->Menu_ID) }}">Edit</a>
           </button>
           <button class="btn btn-danger delete-link" value="">Delete
           </button>
       </td>
        </tr>
       @endfor
       </table>
   
   </div>
  </div>
     

@endsection