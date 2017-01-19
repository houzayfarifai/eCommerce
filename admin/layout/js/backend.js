$(function () {
	'use strict' ; 

	// trigger the selectBoxLt
	$("select").selectBoxIt();
	//HIDE PLACEHOLDER ON FORM FOCUS 
	$('[placeholder]').focus(function(){
		$(this).attr('data-text' , $(this).attr('placeholder'));
		$(this).attr('placeholder' , '') ;
	}).blur (function(){
		$(this).attr('placeholder' , $(this).attr('data-text'));
	});
	 // ADD Asterisk On Required Field 
	 $('input').each( function() {
	 	if($(this).attr("required")){
	 		$(this).after('<span class="asterisk"> * </span>');
	 	}
	 });
	 // convert password field to text field on hover
	 var passfield = $(".passwd");
	 $(".show-pass").hover(function() {
	 	passfield.attr("type" , "text");
	 }, function(){
	 	passfield.attr("type" , "password");
	 });
	 // Confirm Message On Button
	 $(".confirm").click(function() {
	 	return confirm("Are You Sure?");
	 });
	 // show delete button on child cats
	 // ERROR HERE 
	 // fadeout not working
	 // need apdate later !
	 $(".child-link").hover(function(){
	 	$(this).find(".show-delete").fadeIn(400);
	 } , function(){
	 	$(this).find(".show-delete").fadeOut(400);
	 });
});
