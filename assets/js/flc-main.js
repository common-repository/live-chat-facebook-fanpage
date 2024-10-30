jQuery(document).ready(function($) {
    // fare cose jQuery quando DOM è pronto
	$(function(){
	$("#addClass").click(function () {
    	    $('#qnimate').removeClass('popup-box-on fadeOutDown faster');
			$('#qnimate').addClass('popup-box-on fadeInUp faster');
		});
		
			$("#removeClass").click(function () {
			$('#qnimate').removeClass('popup-box-on fadeInUp faster');
			$('#qnimate').addClass('popup-box-on fadeOutDown faster');
		});
	  })
	  
    new WOW().init();
	  
});