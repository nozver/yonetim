$( document ).ready(function() {
	
	
	$("#header-left img").click(function(){
		$("#sidebar").toggle("");
		return false;
	})
	var w =  $(window).width();
	if(w <= 480){
		
		$('table#kucuktablo').show();
		$('table#buyuktablo').hide();
		
	}else{
		$('table#buyuktablo').show();
		$('table#kucuktablo').hide();
	}
	
	
	
	
	$(window).resize(function(){
		var w =  $(window).width();

		if(w <= 480){
			$('table#buyuktablo').hide();
			$('table#kucuktablo').show();
		}else{
			$('table#buyuktablo').show();
			$('table#kucuktablo').hide();
		
		}
		
	});
	
	$("#nav li:first").addClass("aktif");
	
				return false
	
	
		
	
	
});