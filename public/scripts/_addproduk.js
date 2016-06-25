/**
 * Created by TOSHIBA on 5/24/2016.
 */
$(function () {
    var autocomplete = $('#autocomplete');
    var harga = $('#harga');

    $('#tbl-produk').on('click', '#rmProduct', function () {
        $(this).closest('tr').remove();

        if($('tbody#tbl-produk tr').length == 0){
            $('tfoot#produk-submit').html('');
        }
    });

    function resetField () {
        autocomplete.val('');
        autocomplete.data('id', '');
        autocomplete.data('text', '');
        harga.val('');
    }

	var dataSource = [
        {value:"jq", label: "jquery"},
        {value:"bs", label: "bootstrap"},
        {value:"js", label: "javascript"},
        {value:"ax", label: "ajax"},
        {value:"lv", label: "laravel"},
        {value:"al", label: "adminlte"}
	];

	autocomplete.autocomplete({
        source: dataSource,
        minLength : 2,
        focus: function(event, ui) {
            autocomplete.val(ui.item.label);
            autocomplete.data('id', ui.item.value);
            autocomplete.data('text', ui.item.label);
            return false;
        },

        select: function (event, ui) {
            autocomplete.val(ui.item.label);
            autocomplete.data('id', ui.item.value);
            autocomplete.data('text', ui.item.label);
            return false;
        }
	});

    $('#btn-add-produk').click(function () {
        var id = $('#tbl-produk tr').length;

        if(autocomplete.data('id') == '' || harga.val() == ''){
            $('#error-block').html(
                    '<div class="text-danger text-center">Harap isi semua data dengan benar</div>'
            );
            $('#error-block').fadeIn(2000, function(){
                $(this).fadeOut(4000);
            });
            return false;
        }

        $('#tbl-produk').append(
                '<tr>' +
                    '<td data-name="kdbarang" data-value="' + autocomplete.data('id') + '">' + autocomplete.data('text') + '</td>' +
                    '<td data-name="harga" data-value="' + harga.val() + '">' + harga.val() + '</td>' +
                    '<td><a href="javascript:void(0);" id="rmProduct"><i class="fa fa-fw fa-trash"></i></a></td>' +
                '</tr>'
        );

        $('tfoot#produk-submit').html(
            '<tr>' +
                '<td colspan="4" class="text-right">' +
                    '<button id="submit-btn" class="btn btn-sm btn-info"><i class="fa fa-fw fa-floppy-o"></i> Simpan</button>' +
                '</td>' +
            '</tr>'
        );

        return resetField();
    });

    $('#produk-submit').on('click', '#submit-btn', function() {
        var data = {};
        $('#tbl-produk').find('tr').each(function(index){
            var subdata = {};
            $(this).find('td').each(function() {
                subdata[$(this).data('name')] = $(this).data('value');
            });
            data[index] = subdata;
        });

        data = JSON.stringify(data);

        $.ajax({
            type: 'post',
            url: $('#tbl-produk').data('url'),
            data: data,
            dataType: 'json'
        });
    });
});