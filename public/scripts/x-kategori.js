/**
 * Created by TOSHIBA on 5/22/2016.
 */

$.fn.editable.defaults.mode = 'popup';

$(document).ready(function() {
	$('input[name=kdkategori]').change(function () {
		if($(this).val() != ''){
			$('button[type=submit]').removeAttr('disabled');
		}
		else {
			$('button[type=submit]').attr('disabled', 'disabled');
		}
	});
	$('.alert').fadeOut(4000);


	$('.kategori').editable({
		params : function(params) {
			params._token = $("meta[name=csrf-token]").attr("content");
			return params;
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		}
	});


});