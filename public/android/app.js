document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {
    var url = window.location.href;
    var n = url.search("home");
    if(n != -1){
	document.getElementById('backbutton').style.display = 'none';document.addEventListener("backbutton", onBackKeyDown, false); //Listen to the User clicking on the back button
    }
    
    var n = url.search("welcome");
    if(n != -1){
	document.getElementById('backbutton').style.display = 'none';document.addEventListener("backbutton", onBackKeyDown, false); //Listen to the User clicking on the back button
    }
	
	var n = url.search("deliverer");
	if(n != -1){
		document.getElementById('backbutton').style.display = 'none';document.addEventListener("backbutton", onBackKeyDown, false); //Listen to the User clicking on the back button
	}
	
	var n = url.search("cafeteria");
	if(n != -1){
		document.getElementById('backbutton').style.display = 'none';document.addEventListener("backbutton", onBackKeyDown, false); //Listen to the User clicking on the back button
	}
	
	var n = url.search("menu_manager");
	if(n != -1){
		document.getElementById('backbutton').style.display = 'none';document.addEventListener("backbutton", onBackKeyDown, false); //Listen to the User clicking on the back button
	}
  }  

function onBackKeyDown(e) {
    e.preventDefault();
    
    navigator.notification.confirm("Are you sure you want to exit ?", onConfirm, "Confirmation", "Yes,No"); 
    // Prompt the user with the choice
}

function onConfirm(button) {
    if(button==1){//If User selected No, then we just do nothing
        
        navigator.app.exitApp();
    }else{
        // Otherwise we quit the app.
        return;
    }
}