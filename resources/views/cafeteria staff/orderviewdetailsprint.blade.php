<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Select2 -->
 
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/pace/pace.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
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
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
</head>



    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delivery
        <small>information</small>
      </h1>
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div id="box" class="box-body">
              <form id="orderform" role="form" method="POST" action="{{action('CafeteriaController@update',[$cos_order->Cos_Order_Num])}}" enctype="multipart/form-data">
			   @csrf
			   @method('PUT')
				<div id="2" class="col-md-12" ><p class="text-red">{{$error ?? ''}}</p></div>
                <!-- text input -->
				<?php $i = 1;?>
				@foreach($food_selecteds as $food_select)
				
				<div id="food_itemd{{$i}}" class="form-group col-md-6">
					<label>Food Item</label>
					<select disabled class="form-control select2" id="food_item{{$i}}" name="food_item{{$i}}" style="width: 100%;" Required placeholder="Select food">
						<option  disabled>Select food</option> 
						@foreach ($foods as $food )
							<option Required @if($food_select->Menu_Food_Item_ID == $food->Menu_Food_Item_ID) selected value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @else value="{{ $food->Menu_Food_Item_ID}} {{$food->Quantity}} {{$food->Price}}" @endif >
								{{ $food->Food_Name }}
							</option>
							
						@endforeach
					</select>
				</div>
					
					
					
					<div id="quantityd{{$i}}" class="form-group col-md-2">
					  <label>Quantity</label>
					  <input type="number" class="form-control" readonly id="quantity{{$i}}" name="quantity{{$i}}" max="" min="1" Required value="{{$food_select->Quantity}}">
					</div>
			
					
					
					<?php $i= $i + 1; ?>
					
				@endforeach
				
				
				<!-- <div id="food" ></div>-->
				
				
				
				@if($mealmethod == "delivery")
				<div id="delivery" name="delivery">
				
					<div class="form-group col-md-6">
					
					  <label>Delivery Location</label>
					  <select disabled class="form-control select2" id="location_" name="location_" style="width: 100%;" Required placeholder="Select location">
							<option id="location_" name="location_"  disabled>Select location</option> 
							@foreach ($locations as $location )
								<option id="location_" name="location_" @if($mealmethod == "delivery")  @if($delivery_info->D_Location == $location->Location_ID) selected="selected" @endif  @endif Required value="{{ $location->Location_ID}}">
									{{ $location->Location_Name }}
								</option>
								
							@endforeach
						</select>
						
					</div>
					
					<div class="form-group col-md-6">
					
					  <label>Delivery Time</label>
					  <select disabled class="form-control select2" id="location_time" name="location_time" style="width: 100%;"  placeholder="Select location">
							<option id="location_ti" name="location_ti"  disabled>Select delivery time </option> 
							@if($mealmethod == "delivery")
								<option id="location_ti" name="location_ti"  value="{{$delivery_info->D_Time_Window}}" >{{$delivery_info->D_Time_Window}} </option>
							@endif 
						</select>
						 
					</div>
                </div>
				@endif
                <div class="form-group col-md-12">
                <label>Meal Date</label>
				
				<input id="cutoff" name="cutoff" type="hidden" value="{{$order_cutoff->Order_Cutoff_Time }}">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" disabled readonly name="meal_date" id="meal_date" value="{{$cos_order->Cos_Meal_Date_Time}}" required>
                </div>
				
                <!-- /.input group -->
              </div>
			 			
			<input id="ite" name="iteration" class="form-group col-md-12" style="display: none" value=""> 
			<div id="q" name="q" value="{{$i}}" class="form-group col-md-12" style="display: none">{{$i}}</div>
			
            <input id="orderid" name="orderid" class="form-group col-md-12" style="display: none" value="{{$cos_order->Cos_Order_Num}}">
			<input id="menuid" name="menuid" class="form-group col-md-12" style="display: none" value="{{$menuid}}"> 
			<div id="cwarning" name="cwarning" class="form-group col-md-12" style="display: none" value=""></div>
			<input id="dwarn" name="dwarn" class="form-group col-md-12" style="display: none" value="">
			<input id="delivery" name="delivery" class="form-group col-md-12" style="display: none" value="">
			</div>
            <!-- /.box-body -->
			 
              <!-- /.box-footer -->
			 </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> --}}
<!-- jQuery 3 -->
<script src="{{asset('bower_components/PACE/pace.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
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
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
	 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
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

	$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        var inputValue = $(this).attr("value");
        $("." + inputValue).toggle();
    });
	
		var count = $('#q').html();
	$('#ite').val(count);
	var k=1;
	for(k;k<count;k++){
		var str = $('#food_item'+k).val();
		var food = str.split(/(\s+)/);
	 
		$('#price'+k).val($('#quantity'+k).val()*food[4]);
		$('#quantity'+k).attr({'max':food[2]});
		$('#qavailable'+k).val(food[2]);
	}
	
	function tcost(){
		var e;
		$('#tcost').val(0);
		for(e = 1; e < $('#q').html(); e++){
			$('#tcost').val(parseInt($('#tcost').val())+parseInt($('#price'+e).val()));
			
		}
	}
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	var	todaydate = yyyy + '-' + mm + '-' + dd;
	//$('#meal_date').val(todaydate);
	
	function populate(selector) {
		var select = $(selector);
		var today = new Date();
		var time = (today.getHours()*60)+today.getMinutes();
		while((time % 5) != 0){
			time++;
		}
		time = time + 15;
		if(time < 600){
			time = 600;	
		}
		
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();

		var	todaydate = yyyy + '-' + mm + '-' + dd;
		//alert(1);
		if($('#meal_date').val() != todaydate){
			//alert(2);
			time = 600;	
		}
		
		var hours, minutes, ampm;
		for(var i = 600; i <= 1320; i += 15){
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
				select.append($('<option></option>')
					.attr('value', hours + ':' + minutes + ' ' + ampm)
					.text(hours + ':' + minutes + ' ' + ampm)); 
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
	$('#addfood').click(function(){
		$('<div class="col-md-12"><a type="button" id="removefood'+count+'" class="btn bg-maroon btn-flat margin">Remove item</a></div>').prependTo('#orderform');
		$('<div id="priced'+count+'" class="form-group col-md-2"><label>Price ($)</label><input type="number" class="form-control" id="price'+count+'" name="price'+count+'" Required readonly value=""></div>').prependTo('#orderform');
		$('<div id="qavailabled'+count+'" class="form-group col-md-2"><label>Max Quantity Available</label><input type="number" class="form-control" id="qavailable'+count+'" name="qavailable'+count+'" Required readonly value=""></div>').prependTo('#orderform');
		$('<div id="quantityd'+count+'" class="form-group col-md-2"><label>Quantity</label><input type="number" class="form-control" id="quantity'+count+'" name="quantity'+count+'" max="" min="1" Required value="1"></div>').prependTo('#orderform');
		$('<div id="food_itemd'+count+'" class="form-group col-md-6"><label>Food Item</label><select class="food form-control select2" id="food_item'+count+'" name="food_item'+count+'" style="width: 100%;" Required placeholder="Select food"></select>').prependTo('#orderform');
		
		$('#food_item'+(count-1)).find('option').clone().appendTo('#food_item'+count);
		
		
		var str = $('#food_item'+count).val();
		var food = str.split(/(\s+)/);
		//alert(food[2]);
		$('#price'+count).val($('#quantity'+count).val()*food[4]);
	///	$('#Quantity').val();
		$('#qavailable'+count).val(food[2]);
		$('#quantity'+count).attr({'max':food[2]});
		
		
			$("#quantity"+count).on("keyup change click paste mousewheel", function(){
				var id = $(this).attr('id');
				var change = id.replace( /^\D+/g, '');
				$('#price'+change).val($('#quantity'+change).val()*food[4]);
				tcost();
			})
			
			
				$('#food_item'+count).change(function(){
					//alert( $(this).find("option:selected").attr('value') );
					var id = $(this).attr('id');
					var change = id.replace( /^\D+/g, '');
					var str = $('#food_item'+change).val();
					var food = str.split(/(\s+)/);
					//alert(food[2]);
					$('#price'+change).val($('#quantity'+change).val()*food[4]);
				//	$('#Quantity').val();
					$('#qavailable'+change).val(food[2]);
					$('#quantity'+change).attr({'max':food[2]});				
					$("#quantity"+change).on("keyup change click paste mousewheel", function(){
						$('#price'+change).val($('#quantity'+change).val()*food[4]);
						tcost();
					})
					tcost();
				});
		    
		
		$('#removefood'+count).click(function(){
			var id = $(this).attr('id');
			var change = id.replace( /^\D+/g, '');
			$('#priced'+change).remove();
			$('#qavailabled'+change).remove();
			$('#quantityd'+change).remove();
			$('#food_itemd'+change).remove();
			$('#removefood'+change).remove();
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
				
			}
			count--;
			$('#q').html(count);
			$('#ite').val(count);
			//document.getElementById('ite').value = count;
			tcost();			
		});
		
		count++;
		$('#q').html(count);
		$('#ite').val(count);
		//document.getElementById('ite').value = count;
		$('.select2').select2()
		
		tcost();
			
		
	});
	
	function delivery_time(){
		var len = document.getElementById("location_time").length;
		//alert(len);
		if(len <= 1){
			//alert(len);
			document.getElementById('dwarn').style.display = 'block';
			document.getElementById('optionsRadios1').disabled = true;
		}
		else{
			document.getElementById('dwarn').style.display = 'none';
			document.getElementById('optionsRadios1').disabled = false;
		}
	}
	
	
	function meal_date(){
		
		var today = new Date();
		var time = today.getHours()+":00:00";
		var cutoff = $('#cutoff').val();
		
		var tomorrow = new Date(today)
		tomorrow.setDate(tomorrow.getDate() + 1)
		
		var dd1 = String(today.getDate()).padStart(2, '0');
		var mm1 = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy1 = today.getFullYear();

		var	todaydate = yyyy1 + '-' + mm1 + '-' + dd1;
		
		var dd = String(tomorrow.getDate()).padStart(2, '0');
		var mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = tomorrow.getFullYear();

		var	tomorrowdate = yyyy + '-' + mm + '-' + dd;
		
		if(time >= cutoff){
			$('#meal_date').datepicker({
			  autoclose: true,
			  startDate: tomorrow,
			  format: 'yyyy-mm-dd'
			})
			document.getElementById('cwarning').style.display = 'block';
			$('#meal_date').val(tomorrowdate);
		}
		
		else{
			$('#meal_date').datepicker({
			  autoclose: true,
			  startDate: today,
			  format: 'yyyy-mm-dd'
			})
			document.getElementById('cwarning').style.display = 'none';
			$('#meal_date').val(todaydate);
		}
		
		
	}
	
	
	$( document ).ready(function() {
		
		var reload = function() {
			$('#location_time').find('option').remove().end();
			meal_date();
			populate('#location_time');
			delivery_time();
			
			setTimeout(function() {
				 reload();
          }, 100);
		  
		};
		reload();
		
	
		
		//delivery_time();
		
		if(document.getElementById('optionsRadios1').checked) {
		  document.getElementById('delivery').style.display = 'block';
		}else if(document.getElementById('optionsRadios2').checked) {
		  document.getElementById('delivery').style.display = 'none';
		}
		
		$("#quantity1").on("keyup change click paste mousewheel", function(){
			$('#price1').val($('#quantity1').val()*food[4]);
			tcost();
		})
		
		$('input:radio[name=mealmethod]').change(function() {
			if (this.value == 'pick-up') {
				document.getElementById('delivery').style.display = 'none';
			}
			else if (this.value == 'delivery') {
				document.getElementById('delivery').style.display = 'block';
			}
		});
		
		$('#food_item1').change(function(){
			//alert( $(this).find("option:selected").attr('value') );
			var str = $('#food_item1').val();
			var food = str.split(/(\s+)/);
			//alert(food[2]);
			$('#price1').val($('#quantity1').val()*food[4]);
		///	$('#Quantity').val();
			$('#qavailable1').val(food[2]);		
			$('#quantity1').attr({'max':food[2]});
			$("#quantity1").on("keyup change click paste mousewheel", function(){
				$('#price1').val($('#quantity1').val()*food[4]);
				tcost();
			})
			tcost();
		});
		
	
		$('#meal_date').datepicker().on('changeDate', function (ev) {
			//alert(1);
			$('#location_time').find('option').remove().end();
			populate('#location_time');
		});

		$('#price').css('display','none'); // Hide the text input box in default
		function myFunction() {
   		if($('#Menu_Food_Item_ID').prop('checked')) {
         $('#price').css('display','block');
       } else {
         $('#price').css('display','none');
       }
		}
			

	});
	 
  window.addEventListener("load", window.print());
});

  </script>
