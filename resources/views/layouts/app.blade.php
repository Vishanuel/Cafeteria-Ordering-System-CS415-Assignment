<!DOCTYPE html>
<html>
<head >
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COS</title>
  <!-- REQUIRED JS SCRIPTS -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- jQuery 3 -->
  <script src="https://unpkg.com/scrollreveal@4.0.6/dist/scrollreveal.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
  <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <!-- <script src="{{asset('bower_components/PACE/pace.min.js')}}"></script> -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  
  <!-- DataTables -->
  @if(session('cordova') == 'yes')
  <script src="{{asset('android/cordova.js')}}"></script>
  <script src="{{asset('android/app.js')}}"></script>
  @endif
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://unpkg.com/@barba/core"></script>
  <script src="https://unpkg.com/@barba/css"></script>
  <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
  <!-- Select2 -->
  <!--script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <!-- InputMask -->
  <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
  <!-- date-range-picker -->
  <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- bootstrap color picker -->
  <script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
  <!-- bootstrap time picker -->
  <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
  <!-- jvectormap  -->
 
  <!-- Tell the browser to be responsive to screen width -->
 <!-- <link rel="stylesheet" href="{{asset('glyphicon.css')}}"> -->
  <link rel="stylesheet" href="{{asset('glyphicon.css')}}"></link>
  <link rel="stylesheet" href="{{asset('plugins/pace/pace.min.css')}}">
  <!-- Select2 -->
  <!--link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}"-->
  
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- jvectormap -->
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/skin-transparent.css">
   
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

</head>

<body class="hold-transition skin-blue layout-top-nav "  >

<div class="wrapper">

  <header class="main-header" style="background: url('../dist/img/restaurant/login22.jpg') center center ;background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <nav class="navbar navbar-static-top" style="background: rgba(200, 200, 200, 0.6);">
      <div class="container" >
        <div class="navbar-header">
		  
          <a type="button" id="backbutton" class="backbutton navbar-brand" onclick="backbutton();" ><i class="glyphicon glyphicon-menu-left" style="width:1px;"></i></a><a href="#" id="bignav" class="navbar-brand"  ><b >Cafeteria </b>Ordering System</a><a href="#" id="smallnav" class="navbar-brand"><b >Cafeteria </b>OS</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
		 
	
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left"  id="navbar-collapse"  >
		  
          <ul class="nav navbar-nav"   >
		  @if(Auth::user()->usertype == "Patron")
			 <li><a href="{{URL::to('home')}}" >Home</a></li>
            <li ><a href="{{URL::to('restaurant')}}" >Place Order</a></li>
            <li><a href="{{URL::to('order')}}" >Order History</a></li>
			<li class="divider"></li>				
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Meal Subscriptions <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{URL::to('mealsub')}}">View Subscriptions</a></li>
                
                <li><a href="{{URL::to('mealsub_add')}}">New Subscription</a></li>
              </ul>
            </li>
			
			<li class="divider"></li>
			<li><a href="{{URL::to('register')}}" >Payment Registration</a></li>
		  @elseif(Auth::user()->usertype == "Student")
		    <li><a href="{{URL::to('student_home')}}" >Home</a></li>
		    <li ><a href="{{URL::to('restaurant')}}" >Place Order <span class="sr-only">(current)</span></a></li>

			<li><a href="{{URL::to('student_order')}}" >View Previous Orders</a></li>
			<li class="divider"></li>	
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Meal Subscriptions <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="{{URL::to('student_mealsub')}}">View Subscriptions</a></li>
				  
				  <li><a href="{{URL::to('student_mealsub_add')}}">New Subscription</a></li>
				</ul>
			  </li>
			<li><a href="{{URL::to('studentregister')}}" >Payment Option Registration</a></li>

		  @endif
           
          </ul>
        </div>
		
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu" >
          <ul class="nav navbar-nav" style="">
			  <li class="dropdown tasks-menu">
              <a href="{{ URL::to('tutorial_restaurant') }}" >
                <!--i class="fa fa-hand-pointer-o"></i-->
                Tutorial
              </a>
           
           
          </li>
		 
            <!-- User Account Menu -->
            <li class="dropdown user user-menu" >
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
			
				  <ul class="dropdown-menu " >
					<!-- The user image in the menu -->
					<li class="user-header" >
					  <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

					  <p>
						{{ Auth::user()->name }} - {{ Auth::user()->usertype }}
						<small>{{ Auth::user()->created_at}}</small>
					  </p>
					</li>
					<!-- Menu Body -->
					
					
					
					
					<!-- Menu Footer-->
					<li class="user-footer" >
					 
					  <div class="pull-right">
					  <form id="logout-form" action="{{ route('logout') }}" method="POST">
							   @csrf
						<button type="submit" class="btn btn-primary btn-flat">Sign out</button>
					  </form>
					  </div>
					</li>
				  </ul>
		
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
	  <hr class="customdivider" width="90%" style="">
    </nav>
  </header>
  <!-- Full Width Column -->
  
<!--<div  width="90%" style="text-align: center;  height:1px; color: white; background: rgba(200, 200, 200, 1) center center;"></div>-->
  <div class="content-wrapper" >
    <div class="container" data-barba="container">
      <!-- Content Header (Page header) -->
      @if(session()->has('success'))
		<input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
	@endif
	@if(session()->has('error'))
		<input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
	@endif
	@if(session()->has('warning'))
		<input type="hidden" value="{{Session::get('warning')}}" id="hiddenwarningwcs">
	@endif
	<div width="100%" class="backgroundimg" style="z-index:0;position:absolute;padding: 100 auto;height:150px;bottom:100;left:0;right:0;background: url('../dist/img/restaurant/login22.jpg') center center ;background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
		<div width="100%" class="whiteoverlay" style="z-index:0;padding: 100 auto;height:150px;bottom:100;left:0;right:0;background: rgba(200, 200, 200, 0.6);">
		
		</div>
	</div>
	@yield('content')
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer" >
   
	<div class="container" >
      <div class="pull-right hidden-xs">
        <b>Version</b> 3
      </div>
     <!-- <strong>Copyright &copy; 2014-2019 AdminLTE.</strong> All rights
      reserved. -->
    </div>
	
    <!-- /.container -->
  </footer>
  
</div>
<!-- ./wrapper -->

<script >
	if($(window).width() < 991) {
		document.getElementById('bignav').style.display = 'none';
		document.getElementById('smallnav').style.display = 'block';
		$('.layout-top-nav').addClass('fixed');
	}
	else{
		document.getElementById('bignav').style.display = 'block';
		document.getElementById('smallnav').style.display = 'none';
		$('.layout-top-nav').removeClass('fixed');
	}

	$(window).on('resize', function() {
		if($(window).width() < 991) {
			document.getElementById('bignav').style.display = 'none';
			document.getElementById('smallnav').style.display = 'block';
			$('.layout-top-nav').addClass('fixed');
		}
		else{
			document.getElementById('bignav').style.display = 'block';
			document.getElementById('smallnav').style.display = 'none';
			$('.layout-top-nav').removeClass('fixed');
		}
	});
	
	function backbutton(){
		
		var url = window.location.href;
		var n = url.search("home");
		//alert(n);
		if(n == -1){
			history.back(-1);
		}
		else{
			document.getElementById('backbutton').style.display = 'none';
			//history.back(0);
		}
	}
	
	
//	function initjs(){
	
	ScrollReveal().reveal('.box'); 
	//ScrollReveal().reveal('#card'); 
	//ScrollReveal({ reset: true });

	var url = window.location.href;
	var n = url.search("home");
	if(n != -1){
		document.getElementById('backbutton').style.display = 'none';
	}
	
	$(function () {
	/*
	 function backbutton(){
		
		var url = window.location.href;
		var n = url.search("home");
		//alert(n);
		if(n == -1){
			history.back(-1);
		}
		else{
			document.getElementById('backbutton').style.display = 'none';
			//history.back(0);
		}
	}
	*/
	
    $('#example1').DataTable({
		
		
		retrieve: true,
		rowReorder: {
            selector: 'td:nth-child(3)'
        },
        responsive: true,
		scrollCollapse: true
	});
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
	
	
    //Initialize Select2 Elements
    $('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
	$('#start_subs_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    })
	$('#end_subs_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
	$( document ).ready(function() {
       hiddensuccess=$("#hiddensuccesswcs").val();
       swal("Successful", hiddensuccess, "success");
    });
        
    $( document ).ready(function() {
       hiddenerror=$("#hiddenerrorwcs").val();
       swal("Error Encounted", hiddenerror, "error");
    });
    $(document).ready(function() {
       hiddenwarning=$("#hiddenwarningwcs").val();
       swal("Access Denied", hiddenwarning, "error");
    });
	
	function ingredientcost(food,value){
		
		var foodid = food;
		var food_item_number = value;
		var total_ingredient = $('div#items'+food_item_number).find('#all_ingredient'+foodid).val(); 	//get the number of ingredients if that item
		//alert(foodid);
		//alert("total_ingredient="+total_ingredient);
			var d;
			var ingredient_price = 0;
				for(d=0;d<total_ingredient;d++){	//iterate through all the ingredients to check if they are selected
					//alert($('#'+food[0]+'check'+d).val());
					//alert("startfid");
					if($('div#items'+food_item_number).find('#'+foodid+'check'+d).is(":checked")){	//if they are selected then add the ingredients price to that totol price
						//alert("found");
						var ing_price = $('div#items'+food_item_number).find('#'+foodid+'check'+d).val(); 	// this gets the id for the ingredient
						var price = $('div#items'+food_item_number).find('#'+foodid+'ingredient_price'+ing_price).val();	//this gets the price for the ingredient
						ingredient_price = parseInt(ingredient_price) + parseInt(price);
					}
				}
				//alert($('#tcost').val());

		//$('#tcost').val(parseInt($('#tcost').val())+parseInt(ingredient_price));
		return parseInt(ingredient_price);
		//$('#price'+changes).val($('#quantity'+changes).val()*food[4]+parseInt(ingredient_price));
	}
	
	function ingredientcheckupdate(food,value,unitprice){
		if($('div#items'+value).find('.real').val()){
			var id = $('div#items'+value).find('.real').parent().parent().parent().parent().attr('id');
			
			id = id.charAt(0);
		
			$('#price'+id).val($('#quantity'+id).val()*unitprice+ingredientcost(food,id));
			$('div#items'+value).find('.real').change(function()
			{
				var id = $(this).parent().parent().parent().parent().attr('id');
				
				id = id.charAt(0);

				
				$('#price'+id).val($('#quantity'+id).val()*unitprice+ingredientcost(food,id));
				tcost();
			})
			
			tcost();
		}
	}		
	
	function tcost(){
		var e;
		$('#tcost').val(0);
		for(e = 1; e < $('#q').html(); e++){
			$('#tcost').val(parseInt($('#tcost').val())+parseInt($('#price'+e).val()));		
		}
		if($('#specialfoodsprice').val()){
			$('#tcost').val(parseInt($('#tcost').val())+parseInt($('#specialfoodsprice').val()));
		}
		
	}
	
	var count = $('#q').html();
	//alert(count);
	$('#ite').val(count);
	//alert(count);
	var k=1;
	for(k;k<count;k++){
		
		var ids = $('#food_item'+k).attr('id');
		var changes = ids.replace( /^\D+/g, '');
		var str = $('#food_item'+changes).val();
		
		var food = str.split(/(\s+)/); 
		$('.check'+changes).hide();
		$('#'+changes+'choice'+food[0]).show();
		$('.recipe'+changes).hide();
		$('#'+changes+'recipe'+food[0]).show();
		
		//alert(ingredientcost(food[0],changes));
		
		$('#price'+changes).val($('#quantity'+changes).val()*food[4]+ingredientcost(food[0],changes));
		$('#quantity'+changes).attr({'max':food[2]});
		$('#qavailable'+changes).val(food[2]);
	  //	alert(food[4]);
		//alert(1);
		ingredientcheckupdate(food[0],changes,food[4]);
		$('#quantity'+changes).on("keyup change click paste ", function(){
			
			
			var id = $(this).attr('id');
			var change = id.replace( /^\D+/g, '');
			var str = $('#food_item'+change).val();
			var food = str.split(/(\s+)/);
			//alert(change);
			$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
			tcost();
		});
	
		$('#food_item'+changes).change(function(){
			//alert("helo");
			var id = $(this).attr('id');
			//alert(id);
			var change = id.replace( /^\D+/g, '');
			//alert( $(this).find("option:selected").attr('value') );
			var str = $('#food_item'+change).val();
			var food = str.split(/(\s+)/);

			$('.check'+change).hide();
			$('#'+change+'choice'+food[0]).show();
			$('.recipe'+change).hide();
		$('#'+change+'recipe'+food[0]).show();

			//alert(food[2]);
			$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
		  ///	$('#Quantity').val();
			$('#qavailable'+change).val(food[2]);		
			$('#quantity'+change).attr({'max':food[2]});
			$("#quantity"+change).on("keyup change click paste ", function(){
				//alert(food[4]);
				$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
				tcost();
			})

			ingredientcheckupdate(food[0],change,food[4]);
			
			tcost();
		});
		

	}
	
	
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	var	todaydate = yyyy + '-' + mm + '-' + dd;
	//$('#meal_date').val(todaydate);
	
	function populate(selector,value) {
		
		var select = $(selector);
		
		var today = new Date();
		var time = (today.getHours()*60)+today.getMinutes();
		while((time % 5) != 0){
			time++;
		}
		time = time + 15;
		if(time < 420){
			time = 420;	
		}
		
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();

		var	todaydate = yyyy + '-' + mm + '-' + dd;
		//alert(1);
		if($('#meal_date').val() != todaydate){
			//alert(2);
			time = 420;	
		}
		
		
		var cutoff = $('#cutoff').val();
		//cutoff = cutoff.match(/\d+/);
		finaltime = cutoff.match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/);
		//alert(finaltime[3]);
		
		finaltime[3]=parseInt(finaltime[3]);
		finaltime = finaltime[1]*60 + finaltime[3];
		
		var hours, minutes, ampm;
		var hour, minute, amp;
		var test;
		for(var i = 420; i <= finaltime; i += 15){
			test = i % 10;
			if(test != 0){i+=15;}
			
			hours = Math.floor(i / 60);
			minutes = i % 60;
			
			if (minutes < 10){
				minutes = '0' + minutes; // adding leading zero
			}
			ampm = hours % 24 < 12 ? 'AM' : 'PM';
			hours = hours % 12;
			if (hours === 0){
				hours = 12;
			}
			
			if(i >= time){
				if(i < finaltime){
					i += 15;
					hour = Math.floor(i / 60);
					minute = i % 60;
					if (minute < 10){
						minute = '0' + minute; // adding leading zero
					}
					amp = hour % 24 < 12 ? 'AM' : 'PM';
					hour = hour % 12;
					if (hour === 0){
						hour = 12;
					}
					
					select.append($('<option></option>')
						.attr('value', hours + ':' + minutes + ' ' + ampm + ' - ' + hour + ':' + minute + ' ' + amp  )
						.text(hours + ':' + minutes + ' ' + ampm + ' - ' + hour + ':' + minute + ' ' + amp)); 
						//alert($('#meal_date').val());
						if(value != null){
							$('#location_time').val(value);
						}

						if($('#location_time').val() == null){
							$('#location_time').val($('#location_time option:first').val())
						}
				}
			}
		}
		
		
	}
	
	var l = 0;
	for(l;l<count;l++){
		$('#removefood'+l).click(function(){
			var id = $(this).attr('id');
			var change = id.replace( /^\D+/g, '');
			$('#priced'+change).remove();
			$('#qavailabled'+change).remove();
			$('#quantityd'+change).remove();
			$('#food_itemd'+change).remove();
			$('#removefood'+change).remove();
			$('#hr'+change).remove();
			var k = $('#q').html();
			
			for(k;k >= (count-1); k-- ){
				$('#priced'+k).attr('id','priced'+(k-1));
				$('#qavailabled'+k).attr('id','qavailabled'+(k-1));
				$('#quantityd'+k).attr('id','quantityd'+(k-1));
				$('#food_itemd'+k).attr('id','food_itemd'+(k-1));
				$('#price'+k).attr('name','price'+(k-1));
				$('#qavailable'+k).attr('name','qavailable'+(k-1));
				$('#quantity'+k).attr('name','quantity'+(k-1));
				$('#food_item'+k).attr('name','food_item'+(k-1));
				$('#price'+k).attr('id','price'+(k-1));
				$('#qavailable'+k).attr('id','qavailable'+(k-1));
				$('#quantity'+k).attr('id','quantity'+(k-1));
				$('#food_item'+k).attr('id','food_item'+(k-1));
				$('#removefood'+k).attr('id','removefood'+(k-1));
				$('#hr'+k).attr('id','hr'+(k-1));
			}
			count--;
			$('#q').html(count);
			$('#ite').val(count);
			//document.getElementById('ite').value = count;
			tcost();			
		});
	}	
	 // use selector for your select
	
	tcost();
	//alert(count);
	
	//on clicking add food button fire this function to clone the food item row above add food button 
	$('#addfood').click(function(){
		$('<div class="col-md-12"><hr id="hr'+count+'" class=""  width="95%" style="color:grey;background:grey;"></div>').prependTo('#orderform');
		$('<div class="col-md-12"><a type="button" id="removefood'+count+'" class="btn bg-maroon btn-flat margin">Remove item</a></div>').prependTo('#orderform');
		$('<div id="priced'+count+'" class="form-group col-md-2"><label>Price ($)</label><input type="number" class="form-control" id="price'+count+'" name="price'+count+'" Required readonly value=""></div>').prependTo('#orderform');
		$('<div id="qavailabled'+count+'" class="form-group col-md-2"><label>Max Quantity Available</label><input type="number" class="form-control" id="qavailable'+count+'" name="qavailable'+count+'" Required readonly value=""></div>').prependTo('#orderform');
		$('<div id="quantityd'+count+'" class="form-group col-md-2"><label>Quantity</label><input type="number" class="form-control" id="quantity'+count+'" name="quantity'+count+'" max="" min="1" Required value="1"></div>').prependTo('#orderform');
		$('<div id="food_itemd'+count+'" class="form-group col-md-6"><label>Food Item</label><select class="food form-control select2" id="food_item'+count+'" name="food_item'+count+'" style="width: 100%;" Required placeholder="Select food"></select>').prependTo('#orderform');
		
		$('#food_item'+(count-1)).find('option').clone().appendTo('#food_item'+count);
		$('#items'+(count-1)).clone().prop('id','items'+count).appendTo('#food_itemd'+count);
		var tot = $('#items'+count).find('#item_total').val();
		//alert(tot);
		for(i=0;i<tot;i++){
			var num = $('#items'+count).find('#item_number'+i).val();
			$('#items'+count).find('#'+(count-1)+'choice'+num).prop('id',count+'choice'+num).attr("class","checkbox check"+count).hide();
			$('#items'+count).find('#'+(count-1)+'recipe'+num).prop('id',count+'recipe'+num).attr("class","recipe"+count).hide();
			$('#'+count+'choice'+num).find('.real').prop({'name':'ingredient'+count+'[]'});
		}
		
		var str = $('#food_item'+count).val();
		var food = str.split(/(\s+)/);
		$('.check'+count).hide();
		$('#'+count+'choice'+food[0]).show();
		$('.recipe'+count).hide();
		$('#'+count+'recipe'+food[0]).show();
		//$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
		$('#price'+count).val($('#quantity'+count).val()*food[4]+ingredientcost(food[0],count));
		$('#qavailable'+count).val(food[2]);
		$('#quantity'+count).attr({'max':food[2]});

		
		
			$("#quantity"+count).on("keyup change click paste mousewheel", function(){
				var id = $(this).attr('id');
				var change = id.replace( /^\D+/g, '');
				
				$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
				tcost();
			})

			$('.real').change(function()
							{
								//alert('changed');
								tcost();
									
							})
			
			ingredientcheckupdate(food[0],count,food[4]);
			
				$('#food_item'+count).change(function(){
					//alert( $(this).find("option:selected").attr('value') );
					var id = $(this).attr('id');
					var change = id.replace( /^\D+/g, '');
					var str = $('#food_item'+change).val();
					var food = str.split(/(\s+)/);
					$('.check'+change).hide();
					$('#'+change+'choice'+food[0]).show();
					$('.recipe'+change).hide();
							$('#'+change+'recipe'+food[0]).show();
					//$('#price'+change).val($('#quantity'+change).val()*food[4]);
					$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
					$('#qavailable'+change).val(food[2]);
					$('#quantity'+change).attr({'max':food[2]});				
					$("#quantity"+change).on("keyup change click paste mousewheel", function(){
						//$('#price'+change).val($('#quantity'+change).val()*food[4]);
						$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
						tcost();
					})
					ingredientcheckupdate(food[0],change,food[4]);
					
				});

				
		
		$('#removefood'+count).click(function(){
			var id = $(this).attr('id');
			var change = id.replace( /^\D+/g, '');
			$('#priced'+change).remove();
			$('#qavailabled'+change).remove();
			$('#quantityd'+change).remove();
			$('#food_itemd'+change).remove();
			$('#removefood'+change).remove();
			$('#hr'+change).remove();
			var k = $('#q').html();
			
			for(k;k >= (count-1); k-- ){
				$('#priced'+k).attr('id','priced'+(k-1));
				$('#qavailabled'+k).attr('id','qavailabled'+(k-1));
				$('#quantityd'+k).attr('id','quantityd'+(k-1));
				$('#food_itemd'+k).attr('id','food_itemd'+(k-1));
				$('#price'+k).attr('name','price'+(k-1));
				$('#qavailable'+k).attr('name','qavailable'+(k-1));
				$('#quantity'+k).attr('name','quantity'+(k-1));
				$('#food_item'+k).attr('name','food_item'+(k-1));
				$('#price'+k).attr('id','price'+(k-1));
				$('#qavailable'+k).attr('id','qavailable'+(k-1));
				$('#quantity'+k).attr('id','quantity'+(k-1));
				$('#food_item'+k).attr('id','food_item'+(k-1));
				$('#removefood'+k).attr('id','removefood'+(k-1));
				$('#hr'+k).attr('id','hr'+(k-1));
			}
			count--;
			$('#q').html(count);
			$('#ite').val(count);
			tcost();			
		});
		
		count++;
		$('#q').html(count);
		$('#ite').val(count);
		$('.select2').select2()
		
		tcost();
			
		
	});
	
	function delivery_time(){
		var deduction = $('#deduction').val();
		
		if($('#optionsRadios1').val() == true){
			$('#optionsRadios1').iCheck('disable');
			document.getElementById('dwarn').style.display = 'none';
		}
		//else{
			var len = document.getElementById("location_time").length;
			//alert(len);
			if(len <= 1){
				//alert(len);
				//$("#optionsRadios2").prop("checked", true);
				//$("#optionsRadios1").prop("checked", false);
				$('#optionsRadios2').iCheck('check');
			
				
				document.getElementById('dwarn').style.display = 'block';
				document.getElementById('optionsRadios1').disabled = true;
				$('#optionsRadios1').iCheck('disable');
				//document.getElementById('optionsRadios2').checked = true;
				//document.getElementById('optionsRadios1').checked = false;
				document.getElementById('delivery').style.display = 'none';
					
			}
			else{
				document.getElementById('dwarn').style.display = 'none';
				//document.getElementById('optionsRadios1').disabled = false;
				
				$('#optionsRadios1').iCheck('enable');
			}
		//}
	}
	
	
	function meal_date(){
		var dateselect = $('#meal_date').val();
		
		var today = new Date();
		var time = today.getHours();
		var cutoff = $('#cutoff').val();
		
		var tomorrow = new Date(today);
		tomorrow.setDate(tomorrow.getDate() + 1);
		
		var two_weeks = new Date();
		two_weeks.setDate(two_weeks.getDate() + 14);	
		
		var tmoro_two_weeks = new Date(today);
		tmoro_two_weeks.setDate(tmoro_two_weeks.getDate() + 15);
	
		
		var dd1 = String(today.getDate()).padStart(2, '0');
		var mm1 = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy1 = today.getFullYear();

		var	todaydate = yyyy1 + '-' + mm1 + '-' + dd1;
		
		var dd = String(tomorrow.getDate()).padStart(2, '0');
		var mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = tomorrow.getFullYear();

		var	tomorrowdate = yyyy + '-' + mm + '-' + dd;
		
		cutoff = cutoff.match(/\d+/)[0];

		if(time >= cutoff){

			$('#meal_date').datepicker({
			  autoclose: true,
			  startDate: tomorrow,
			  endDate: tmoro_two_weeks,
			  format: 'yyyy-mm-dd'
			})
			document.getElementById('cwarning').style.display = 'block';
			if(dateselect == todaydate){
				$('#meal_date').val(tomorrowdate);
			}
			else{
				$('#meal_date').val(dateselect);
			}
		}
		
		else{
			$('#meal_date').datepicker({
			  autoclose: true,
			  startDate: today,
			  endDate: two_weeks,
			  format: 'yyyy-mm-dd'
			})
			document.getElementById('cwarning').style.display = 'none';
			if(dateselect == todaydate){
				$('#meal_date').val(todaydate);
			}
			else{
				$('#meal_date').val(dateselect);
			}
			
		}
		
		
	}
	
	if($('#specialfoods').val()){
		if($('#specialfoods').val() == "No special selected"){
			$('#specialfoodsprice').val("0");
			document.getElementById('specialfoodspriced').style.display = "none";
			document.getElementById('specialfoodsqavailabled').style.display = "none";
			document.getElementById('specialfoodsquantityd').style.display = "none";
			tcost();
		}
		
		else{
			var str = $('#specialfoods').val();
			var food = str.split(/(\s+)/);
			$('#specialfoodsprice').val($('#specialfoodsquantity').val()*food[4]);
			$('#specialfoodsqavailable').val(food[2]);		
			$('#specialfoodsquantity').attr({'max':food[2]});
			document.getElementById('specialfoodspriced').style.display = "block";
			document.getElementById('specialfoodsqavailabled').style.display = "block";
			document.getElementById('specialfoodsquantityd').style.display = "block";
			tcost();
		}
	}
	
	
					
			
	
	$( document ).ready(function() {		
	
		
		if($('#cardmethod').val() ){
			ScrollReveal().destroy();
			$('#expdate').datepicker({
			  autoclose: true,
			  format: 'mm/yy',
			  startView: "months", 
			  minViewMode: "months"
			})
			
			if(document.getElementById('cardmethod').checked) {
			  document.getElementById('card').style.display = 'block';
			}
			else if(!document.getElementById('cardmethod').checked){
			  document.getElementById('card').style.display = 'none';
			  document.querySelector("#typecard").required = false;
			  document.querySelector('#cardname').required = false;
			  document.querySelector('#cardname').required = false;
			  document.querySelector('#cardnum').required = false;
			  document.querySelector('#cvv').required = false;
			  document.querySelector('#expdate').required = false;
			  
			}	
			
			var radioValue = $("input[name='typecards']:checked").val();
			$('#typecard3').val(radioValue);
			
			$("input[name='typecards']").on('ifChanged', function(){
				var radioValue = $("input[name='typecards']:checked").val();
				$('#typecard3').val(radioValue);
				//alert(radioValue);
			});
			
			
			
			$('#cardmethod').on('ifChanged', function(){
				ScrollReveal().destroy();
				
				if(document.getElementById('cardmethod').checked) {
				    document.getElementById('card').style.opacity = 100;
					document.querySelector("#typecard").required = true;
					document.querySelector('#cardname').required = true;
					document.querySelector('#cardnum').required = true;
					document.querySelector('#cvv').required = true;
					document.querySelector('#expdate').required = true;
					//document.getElementById('card').style.display = 'block';
				    $("#card").animate({
						height: 'show'
					});
					
					
				    $('html, body').animate({scrollTop : $('#card').offset().top}, 200);
				  
				}
				
				else if(!document.getElementById('cardmethod').checked){
				    
					$("#card").animate({
					    height: 'hide'
					} );
					//document.getElementById('card').style.display = 'none';
				    document.querySelector("#typecard").required = false;
				    document.querySelector('#cardname').required = false;
				    document.querySelector('#cardnum').required = false;
				    document.querySelector('#cvv').required = false;
				    document.querySelector('#expdate').required = false;
				}

			});
		
		}	
			
		$('form').on('focus', 'input[type=number]', function (e) {
		  $(this).on('wheel.disableScroll', function (e) {
			e.preventDefault()
		  })
		})
		$('form').on('blur', 'input[type=number]', function (e) {
		  $(this).off('wheel.disableScroll')
		})
		
		tcost();
		
		
		$valuetime=$('#location_time').val();
		var reload = function() {
			$('#location_time').find('option').remove().end();
			meal_date();
			
			populate('#location_time', $valuetime);
			delivery_time();
			
			
			
			setTimeout(function() {
				 reload();
          }, 300000);
		  
		};
		reload();
		
		
		$('#meal_date').datepicker().on('changeDate', function (ev) {
			//alert(1);
			$value=$('#location_time').val();
			$('#location_time').find('option').remove().end();
			populate('#location_time',$value);
			delivery_time();
				//$('#location_time').val($value);
		});
		
		
		if(document.getElementById('optionsRadios1').checked) {
			document.getElementById('delivery').style.display = 'block';
			
			var count = $('#q').html();
			$('#ite').val(count);
			var k=1;
			for(k;k<count;k++){
				Array.from(document.querySelector("#food_item"+k).options).forEach(function(option_element) {
					
					let option_text = option_element.text;
					let option_value = option_element.value;
						
					var food = option_value.split(/(\s+)/);
						
					if(food[6] == 0){
						$('option[value="'+option_element.value+'"]').select2().prop("disabled", true);
					}
					
					while($("#food_item"+k+" option[value='"+option_element.value+"']:selected").select2().prop("disabled")){
							//$('#food_item1').val('').trigger("change");
						var select = document.getElementById("food_item"+k);
						var items = select.getElementsByTagName('option');
						var index = Math.floor(Math.random() * items.length);
						select.selectedIndex = index;
							
					}
				});
				
				var str = $('#food_item'+k).val();
						
				var food = str.split(/(\s+)/);
				$('.check'+k).hide();
				$('#'+k+'choice'+food[0]).show()	
				$('.recipe'+k).hide();
				$('#'+k+'recipe'+food[0]).show(); 
				//$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
				$('#price'+k).val($('#quantity'+k).val()*food[4]+ingredientcost(food[0],k));
				$('#quantity'+k).attr({'max':food[2]});
				$('#qavailable'+k).val(food[2]);
			//	alert(food[4]);
				$('#quantity'+k).on("keyup change click paste ", function(){
					
					
					var id = $(this).attr('id');
					var change = id.replace( /^\D+/g, '');
					var str = $('#food_item'+change).val();
					var food = str.split(/(\s+)/);
					//alert(change);
					$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
					//$('#price'+change).val($('#quantity'+change).val()*food[4]);
					tcost();
				});
				
				ingredientcheckupdate(food[0],k,food[4]);
				
				$('#food_item'+k).change(function(){
					//alert("helo");
					var id = $(this).attr('id');
					//alert(id);
					var change = id.replace( /^\D+/g, '');
					//alert( $(this).find("option:selected").attr('value') );
					var str = $('#food_item'+change).val();
					var food = str.split(/(\s+)/);
					//alert(food[2]);
					$('.check'+change).hide();
					$('#'+change+'choice'+food[0]).show();
					$('.recipe'+change).hide();
					$('#'+change+'recipe'+food[0]).show();
					//$('#price'+change).val($('#quantity'+change).val()*food[4]);
					$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
				///	$('#Quantity').val();
					$('#qavailable'+change).val(food[2]);		
					$('#quantity'+change).attr({'max':food[2]});
					$("#quantity"+change).on("keyup change click paste ", function(){
						//alert(food[4]);
						$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
					//$('#price'+change).val($('#quantity'+change).val()*food[4]);
						tcost();
					})
					ingredientcheckupdate(food[0],change,food[4]);
					tcost();
				});
			}
			
		}else if(document.getElementById('optionsRadios2').checked) {
			document.getElementById('delivery').style.display = 'none';
			var count = $('#q').html();
			$('#ite').val(count);
			var k=1;
			for(k;k<count;k++){
				Array.from(document.querySelector("#food_item"+k).options).forEach(function(option_element) {	
					let option_text = option_element.text;
					let option_value = option_element.value;

					var food = option_value.split(/(\s+)/);

					$("option[value='"+option_element.value+"']").select2().prop("disabled", false);
					if(food[6] == 0){
						$('option[value="'+option_element.value+'"]').select2().prop("disabled", false);
					}
				});	
			}
		}
		
		

		$('input:radio[name=mealmethod]').on('ifChanged', function(){

			if ($('input:radio[name=mealmethod]:checked').val() == "pick-up") {
				//$("#delivery").animate({
				//	height: 'hide'
				//});
				document.getElementById('delivery').style.display = 'none';
				var count = $('#q').html();
				$('#ite').val(count);
				var k=1;
				for(k;k<count;k++){
					Array.from(document.querySelector("#food_item"+k).options).forEach(function(option_element) {	
						let option_text = option_element.text;
						let option_value = option_element.value;

						var food = option_value.split(/(\s+)/);

						$("option[value='"+option_element.value+"']").select2().prop("disabled", false);
						
						if(food[6] == 0){
							$('option[value="'+option_element.value+'"]').select2().prop("disabled", false);
						}
						
						
		
					});	
					
					
				}
			}
			else if ($('input:radio[name=mealmethod]:checked').val() == "delivery") {
				document.getElementById('delivery').style.display = 'block';	
				//$("#delivery").animate({
				//	height: 'show'
				//});
				var count = $('#q').html();
				$('#ite').val(count);
				var k=1;
				for(k;k<count;k++){
					Array.from(document.querySelector("#food_item"+k).options).forEach(function(option_element) {
					
						let option_text = option_element.text;
						let option_value = option_element.value;
						
						var foods = option_value.split(/(\s+)/);
						
						if(foods[6] == 0){
							$('option[value="'+option_element.value+'"]').select2().prop("disabled", true);
						}
						
						while($("#food_item"+k+" option[value='"+option_element.value+"']:selected").select2().prop("disabled")){
							//$('#food_item1').val('').trigger("change");
							var select = document.getElementById("food_item"+k);
							var items = select.getElementsByTagName('option');
							var index = Math.floor(Math.random() * items.length);
							select.selectedIndex = index;
							
						}				
					});
					
						var str = $('#food_item'+k).val();
						
						var food = str.split(/(\s+)/);
						$('.check'+k).hide();
						$('#'+k+'choice'+food[0]).show()
						$('.recipe'+k).hide();
							$('#'+k+'recipe'+food[0]).show();
						//$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
						$('#price'+k).val($('#quantity'+k).val()*food[4]+ingredientcost(food[0],k));
						$('#quantity'+k).attr({'max':food[2]});
						$('#qavailable'+k).val(food[2]);
					//	alert(food[4]);
						$('#quantity'+k).on("keyup change click paste ", function(){
							
							
							var id = $(this).attr('id');
							var change = id.replace( /^\D+/g, '');
							var str = $('#food_item'+change).val();
							var food = str.split(/(\s+)/);
							//alert(change);
							$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
							//$('#price'+change).val($('#quantity'+change).val()*food[4]);
							tcost();
						});
						ingredientcheckupdate(food[0],k,food[4]);
						$('#food_item'+k).change(function(){
							//alert("helo");
							var id = $(this).attr('id');
							//alert(id);
							var change = id.replace( /^\D+/g, '');
							//alert( $(this).find("option:selected").attr('value') );
							var str = $('#food_item'+change).val();
							var food = str.split(/(\s+)/);
							$('.check'+change).hide();
							$('#'+change+'choice'+food[0]).show();
							$('.recipe'+change).hide();
							$('#'+change+'recipe'+food[0]).show();
							//alert(food[2]);
							//$('#price'+change).val($('#quantity'+change).val()*food[4]);
							$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
						///	$('#Quantity').val();
							$('#qavailable'+change).val(food[2]);		
							$('#quantity'+change).attr({'max':food[2]});
							$("#quantity"+change).on("keyup change click paste ", function(){
								//alert(food[4]);
								$('#price'+change).val($('#quantity'+change).val()*food[4]+ingredientcost(food[0],change));
							//$('#price'+change).val($('#quantity'+change).val()*food[4]);
									tcost();
							})
							ingredientcheckupdate(food[0],change,food[4]);
							tcost();
						});
				}
				
			}
		});
		/*
		$('input:radio[name=mealmethod]').change(function() {
			if (this.value == 'pick-up') {
				document.getElementById('delivery').style.display = 'none';
			}
			else if (this.value == 'delivery') {
				document.getElementById('delivery').style.display = 'block';
			}
		});
			*/	
		if($('#specialfoods').val()){
			$("#specialfoodsquantity").on("keyup change click paste mousewheel", function(){
				$('#specialfoodsprice').val($('#specialfoodsquantity').val()*food[4]);
				tcost();
			})
			
			$('#specialfoods').change(function(){

				var str = $('#specialfoods').val();
				var food = str.split(/(\s+)/);
				$('#specialfoodsprice').val($('#specialfoodsquantity').val()*food[4]);
				$('#specialfoodsqavailable').val(food[2]);		
				$('#specialfoodsquantity').attr({'max':food[2]});
				document.getElementById('specialfoodspriced').style.display = "block";
				document.getElementById('specialfoodsqavailabled').style.display = "block";
				document.getElementById('specialfoodsquantityd').style.display = "block";
				$("#specialfoodsquantity").on("keyup change click paste mousewheel", function(){
					$('#specialfoodsprice').val($('#specialfoodsquantity').val()*food[4]);
					tcost();
				})
				if($('#specialfoods').val() == "No special selected"){
					$('#specialfoodsprice').val("0");
					document.getElementById('specialfoodspriced').style.display = "none";
					document.getElementById('specialfoodsqavailabled').style.display = "none";
					document.getElementById('specialfoodsquantityd').style.display = "none";
				}
				
				tcost();
				
				
				
			});
		}
	});
	//initjs();
	//}
	//initjs();


$('#menus').change(function(){
	var str = $(this).val();
	$('.items').hide();
	$('#item'+str).show();
});



</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
	 
</body>


</html>