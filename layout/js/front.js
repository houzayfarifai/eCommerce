$(function () {
	'use strict' ; 
	// Switch Between login and signup
	$(".login-page h1 span").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
		$(".login-page form").hide();
		$("." +$(this).data("class")).fadeIn(100);
	});
	// trigger the selectBoxLt
	$("select").selectBoxIt({autoWidth:false});
	//HIDE PLACEHOLDER ON FORM FOCUS 
	$('[placeholder]').focus(function(){
		$(this).attr('data-text' , $(this).attr('placeholder'));
		$(this).attr('placeholder' , '') ;
	}).blur (function(){
		$(this).attr('placeholder' , $(this).attr('data-text'));
	});
	 // ADD Asterisk On Required Field (required)
	 $('input').each( function() {
	 	if($(this).attr("required")){
	 		$(this).after('<span class="asterisk"> * </span>');
	 	}
	 });
	 // Confirm Message On Button
	 $(".confirm").click(function() {
	 	return confirm("Are You Sure?");
	 });
	 $('.live-name').keyup(function() {
	 	$(".live-preview .caption h3").text($(this).val());
	 });
	  $('.live-desc').keyup(function() {
	 	$(".live-preview .caption p").text($(this).val());
	 });
	   $('.live-price').keyup(function() {
	 	$(".live-preview .price-tag").text($(this).val());
	 });
});
