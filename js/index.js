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





/* -------------------------------------------------------- */


/* BookMark Jump to page Number */
function goToSlide(number) {
   $("#pageCarousel").carousel(number-1);
}
/* BookMark Jump to page Number */


/* -------------------------------------------------------- */


/* TextBox on Enter Button Jump to page Number */
var totalcounts = $('.item').length;
function goToSlider(x) {
		var x = $('#txtboxToFilter').val();
		if (x <= 0){
			$("#pageCarousel").carousel(0);
			$('#txtboxToFilter').val(1);
		} else if(x > totalcounts){
			$("#pageCarousel").carousel(totalcounts-1);
			$('#txtboxToFilter').val(totalcounts);
		}else{
			$("#pageCarousel").carousel(x-1);
		}
		return x;
}
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


/* Start Carousel Touch(only for Mobile Device) */
$("#pageCarousel").carousel({
	// percent-per-second
	// default is 50
	// false = disable touch swipe
	swipe: 3
});
/* End Carousel Touch(only for Mobile Device) */




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