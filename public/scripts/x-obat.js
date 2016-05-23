/**
 * Created by TOSHIBA on 5/22/2016.
 */
$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.url = $('#editable').data('url');
$.fn.editable.defaults.emptytext = 'Not Set';
$.fn.editable.defaults.params = function(params) {
	params._token = $("meta[name=csrf-token]").attr("content");
	return params;
};

$(document).ready(function() {
	$('.alert').fadeOut(4000);

	$('.namabarang').editable({
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		}
	});

	$('.satuan').editable();
	$('.kdkategori').editable();

});