@extends('layouts.app_menu')

@section('content')
<!-- left column -->
<div class="row">

    @for($i=0;$i<count($cat);$i++)

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box loading"
                style="background: rgba(255, 255, 255, 1); box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.1);z-index:999;">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$cat[$i]->Category_Name}} Menu</h3>
                </div>

                <div class="box-body">


                @for($j=0;$j<count($menu[$i]);$j++)
                    <div class="col-md-3 col-xs-12">
                        <div class="box loading box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black"
                                style="height:175px; background: url('../{{$menu[$i][$j]->Food_Pic}}') center center;background-repeat: no-repeat;  background-size: cover;">
                            </div>
                            <div class="box-footer" style="text-align: center;">
                                <h4>{{ $menu[$i][$j]->Food_Name }}</h4>
                                <h4>{{ $menu[$i][$j]->Price }}</h4>
                            </div>
                        </div>
                    </div>
                @endfor

                </div>
               
            </div>
        </div>
    </div>
@endfor
</div>
@endsection
