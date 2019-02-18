/* On Mobile device Close Nav Window */
$(document).ready(function(){ 
if ($(window).width() < 768) {
   
	$('#oneBookNav .navbar-right a').on('click', function(){
		$('.navbar-toggle').click();
	});

}
});
/* On Mobile device Close Nav Window */


/* -------------------------------------------------------- */


/* prevent a click on a '#' link from jumping to top of page */
$('.caroLR, .menuUpward>li>a').click(function(e)
{
    e.preventDefault();
});
/* prevent a click on a '#' link from jumping to top of page */


/* -------------------------------------------------------- */


/* Toggle Bars and Close icon on click */
$('.leftNavFixed .fa-bars').click(function(){
    $(this).toggleClass('fa-times fa-bars');

});
/* Toggle Bars and Close icon on click */


/* -------------------------------------------------------- */


/* Current Page Number, Total Page Number, ProgressBar */
	var totalSteps = $('.item').length;
	
	$('.totalPages').text(totalSteps);
	
	$(".progressbar1").attr("aria-valuemax", totalSteps);
	$( ".progressbar1" ).width((100/totalSteps)+'%');
	
	$("#pageCarousel .item").each(function(i) {
		$(this).attr("data-step", ++i);
	});
	
	$('#pageCarousel').carousel();
	$('#pageCarousel').on('slide.bs.carousel', function (e) {
  
	//update progress
	var step = $(e.relatedTarget).data('step');
	var percent = (parseInt(step) / totalSteps) * 100;
	
	$('.progressbar1').css({width: percent + '%'});
	$('#txtboxToFilter').val(step);
  
});
/* Current Page Number, Total Page Number, ProgressBar */


/* -------------------------------------------------------- */


/* BookMark Jump to page Number */
function goToSlide(number) {
   $("#pageCarousel").carousel(number-1);
}
/* BookMark Jump to page Number */


/* -------------------------------------------------------- */


/* TextBox on Enter Button Jump to page Number */
$("#txtboxToFilter").keypress(function(e) {
    if(e.which == 13) {
        var txtBxVal = $(this).val();
		$("#pageCarousel").carousel(txtBxVal-1);
	}
});
/* TextBox on Enter Button Jump to page Number */


/* -------------------------------------------------------- */


/* Allow only numeric (0-9) in HTML inputbox */
$(document).ready(function() {
    $("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	});
});
/* Allow only numeric (0-9) in HTML inputbox */


/* -------------------------------------------------------- */


/* -------------------------------------------------------- */


/* Start Carousel Touch */
$(document).ready(function(){ 
if ($(window).width() < 768) {
	$("#pageCarousel").swipe({
	swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
		if (direction == 'left') $(this).carousel('next');
		if (direction == 'right') $(this).carousel('prev');
	},
	allowPageScroll:"vertical"
	});
}
});
/* End Carousel Touch */




/* ACCORDION WITH TOGGLE ICONS */
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
/* ACCORDION WITH TOGGLE ICONS */



/* Check/uncheck Checkbox Start */
$(function() {
	$("#checkAll").change(function () {
		$(".toggleCheck").prop('checked', $(this).prop("checked"));
	});
});
/* End */