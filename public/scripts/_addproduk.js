/**
 * Created by TOSHIBA on 5/24/2016.
 */
$(function () {
	var dataSource = [
		"jquery",
		"bootstrap",
		"javascript",
		"ajax",
		"laravel",
		"adminlte",
	];

	$('#autocomplete').autocomplete({
		minLengeth : 2,
		source: dataSource
	});
});