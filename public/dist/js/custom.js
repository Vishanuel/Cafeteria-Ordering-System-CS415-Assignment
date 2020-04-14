
	var url = window.location.href;
	var n = url.search("home");
	if(n != -1){
		document.getElementById('backbutton').style.display = 'none';
	}
	
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
	 
	
	
	//ScrollReveal().reveal('.box'); 
		//ScrollReveal({ reset: true });
	
  $(function () {
	 
	  
    $('#example1').DataTable({
		rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
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
	 
		$('#price'+changes).val($('#quantity'+changes).val()*food[4]);
		$('#quantity'+changes).attr({'max':food[2]});
		$('#qavailable'+changes).val(food[2]);
	//	alert(food[4]);
		$('#quantity'+changes).on("keyup change click paste ", function(){
			
			
			var id = $(this).attr('id');
			var change = id.replace( /^\D+/g, '');
			var str = $('#food_item'+change).val();
			var food = str.split(/(\s+)/);
			//alert(change);
			$('#price'+change).val($('#quantity'+change).val()*food[4]);
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
			//alert(food[2]);
			$('#price'+change).val($('#quantity'+change).val()*food[4]);
		///	$('#Quantity').val();
			$('#qavailable'+change).val(food[2]);		
			$('#quantity'+change).attr({'max':food[2]});
			$("#quantity"+change).on("keyup change click paste ", function(){
				//alert(food[4]);
				$('#price'+change).val($('#quantity'+change).val()*food[4]);
				tcost();
			})
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
		
		
		var cutoff = $('#cutoff').val();
		//cutoff = cutoff.match(/\d+/);
		finaltime = cutoff.match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/);
		//alert(finaltime[3]);
		
		finaltime[3]=parseInt(finaltime[3]);
		finaltime = finaltime[1]*60 + finaltime[3];
		
		var hours, minutes, ampm;
		var hour, minute, amp;
		for(var i = 600; i <= finaltime; i += 15){
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
				if(i <= finaltime){
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
		
		$('#price'+count).val($('#quantity'+count).val()*food[4]);
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
					$('#price'+change).val($('#quantity'+change).val()*food[4]);
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

		if(deduction == 0){
			document.getElementById('optionsRadios1').disabled = true;
			document.getElementById('dwarn').style.display = 'none';
		}
		else{
			var len = document.getElementById("location_time").length;
			//alert(len);
			if(len <= 1){
				//alert(len);
				document.getElementById('dwarn').style.display = 'block';
				document.getElementById('optionsRadios1').disabled = true;
				$("#optionsRadios2").prop("checked", true);
				document.getElementById('delivery').style.display = 'none';
					
			}
			else{
				document.getElementById('dwarn').style.display = 'none';
				document.getElementById('optionsRadios1').disabled = false;
			}
		}
	}
	
	
	function meal_date(){
		var dateselect = $('#meal_date').val();
		
		var today = new Date();
		var time = today.getHours();
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
		
		cutoff = cutoff.match(/\d+/)[0];

		if(time >= cutoff){

			$('#meal_date').datepicker({
			  autoclose: true,
			  startDate: tomorrow,
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
		//if($('#example1'))
			
		//$('#payrollmethod').prop('disabled','false');
			
		
		if($('#cardmethod').val() && $('#payrollmethod').val()){
			
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
				
				if(document.getElementById('cardmethod').checked) {
				    document.getElementById('card').style.opacity = 100;
					document.querySelector("#typecard").required = true;
					document.querySelector('#cardname').required = true;
					document.querySelector('#cardnum').required = true;
					document.querySelector('#cvv').required = true;
					document.querySelector('#expdate').required = true;
					
				    $("#card").animate({
						height: 'show'
					});
					
					
				    $('html, body').animate({scrollTop : $('#card').offset().top}, 200);
				  
				}
				
				else if(!document.getElementById('cardmethod').checked){
				    $("#card").animate({
					    height: 'hide'
					} );
					
				    document.querySelector("#typecard").required = false;
				    document.querySelector('#cardname').required = false;
				    document.querySelector('#cardnum').required = false;
				    document.querySelector('#cvv').required = false;
				    document.querySelector('#expdate').required = false;
				  
				  
				  
				 // document.getElementById('card').style.opacity = 0;
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
		}else if(document.getElementById('optionsRadios2').checked) {
		  document.getElementById('delivery').style.display = 'none';
		}
		
		$('input:radio[name=mealmethod]').on('ifChanged', function(){
			if (this.value == 'pick-up') {
				document.getElementById('delivery').style.display = 'none';
			}
			else if (this.value == 'delivery') {
				document.getElementById('delivery').style.display = 'block';
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
