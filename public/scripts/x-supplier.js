/**
 * Created by TOSHIBA on 5/22/2016.
 */
$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.url = $('.editable-field').data('url');
// $.fn.editable.defaults.pk = $('.editable-field').data('pk');
$.fn.editable.defaults.emptytext = 'Not Set';
$.fn.editable.defaults.placement = 'right';

$.fn.editable.defaults.params = function(params) {
	params._token = $("meta[name=csrf-token]").attr("content");
	return params;
};

$(document).ready(function() {
	$('.alert').fadeOut(3000);

	$('.namasupplier').editable();
	$('.contactperson').editable();
	$('.notelp').editable();
	$('.nohp').editable();
	$('.email').editable();
	$('.alamat').editable({
		showbuttons : 'bottom',
		rows : 4
	});

});