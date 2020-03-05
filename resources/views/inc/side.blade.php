<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="background-color:#1a2226">
        
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" >
    
          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel">
            <div class="pull-left image">
              <img src="/storage/cover_images/{{ Auth::user()->cover_image }}"  class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p class="text-white">  {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div> --}}

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu tree" style="font-weight:bold;color:white" data-widget="tree">
                <li id="first" align="center"><span style="color:white" >Menu</span></i>

                <li id="first" ><a href="{{url('home')}}"><i style="color:white; margin-top:13px;" class="fa fa-newspaper-o"></i> <span style="color:white" >Site Dashboard</span></a></li>
                
                <li id="first" class="dropdown" role="button"><i style="color:white; margin-left:15px;" class="fa fa-newspaper-o"></i>
                  <span style="color:white; margin-left:3px;" class="dropdown-toggle" data-toggle="dropdown" >Audio Management</span>

                  <div class="dropdown-menu">  
                       <ul class="nav nav-pills nav-stacked" style="color:white;">
                          <li class="nav-item"><a href="{{url('featureone/#smp')}}">Manage SMP</a></li>
                          <li class="nav-item"><a href="{{url('featureone/#audiostate')}}">Device Status</a></li>
                          <li class="nav-item"><a href="{{url('featureone/#audio')}}">Audio Analysis</a></li>
                     </ul> 
                  </div>                  
                </li>

                <li id="first" class="dropdown" role="button" style="margin-top:15px;"><i style="color:white; margin-left:15px;" class="fa fa-newspaper-o"></i>
                  <span style="color:white; margin-left:3px;" class="dropdown-toggle" data-toggle="dropdown" >USP DB Records</span>

                  <div class="dropdown-menu">  
                       <ul class="nav nav-pills nav-stacked" style="color:white;">
                          <li class="nav-item"><a href="{{url('featuretwo/#timetable')}}">View Timetable</a></li>
                          <li class="nav-item"><a href="{{url('featuretwo/#camp')}}">Manage Campus Records</a></li>
                          <li class="nav-item"><a href="{{url('featuretwo/#date')}}">Manage University Date Records</a></li>
                          <li class="nav-item"><a href="{{url('featuretwo/#holi')}}">Manage Holiday Records</a></li>
                          <li class="nav-item"><a href="{{url('featuretwo/#course')}}">Manage Course Records</a></li>
                     </ul> 
                  </div>                  
                </li>

                <li id="first" class="dropdown" role="button" style="margin-top:15px;"><i style="color:white; margin-left:15px;" class="fa fa-newspaper-o"></i>
                  <span style="color:white; margin-left:3px;" class="dropdown-toggle" data-toggle="dropdown" >Lecture Video Transfer</span>

                  <div class="dropdown-menu">  
                       <ul class="nav nav-pills nav-stacked" style="color:white;">
                          <li class="nav-item"><a href="{{url('featurethree/')}}">Transfer page</a></li>
                     </ul> 
                  </div>                  
                </li>


                <li id="first" class="dropdown" role="button" style="margin-top:15px;"><i style="color:white; margin-left:15px;" class="fa fa-newspaper-o"></i>
                  <span style="color:white; margin-left:3px;" class="dropdown-toggle" data-toggle="dropdown" >System Info</span>

                  <div class="dropdown-menu">  
                       <ul class="nav nav-pills nav-stacked" style="color:white;">
                          <li class="nav-item"><a href="{{url('featurefour/#memory')}}">Memory Usage</a></li>
                          <li class="nav-item"><a href="{{url('featurefour/#cpu')}}">CPU Usage</a></li>
                          <li class="nav-item"><a href="{{url('featurefour/#network')}}">Network Usage</a></li>
                          <li class="nav-item"><a href="{{url('featurefour/#ping')}}">Ping Up or down
                          </a></li>
                     </ul> 
                  </div>                  
                </li>
              </ul>
                <!-- /.sidebar-menu -->
              </section>
              <!-- /.sidebar -->
              <script>

              </script>
            </aside>
          </li>
        </ul>
      </section>
    </aside>
  </head>
</html>