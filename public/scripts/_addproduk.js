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

	var dataSource = autocomplete.data('source');

	autocomplete.autocomplete({
        source: dataSource,
        type: 'GET',
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
        var postdata = [];
        $('#tbl-produk').find('tr').each(function(index){
            $td = $(this).find('td');
            postdata[index] = {}
            $td.each(function () {
                postdata[index][$(this).data('name')] = $(this).data('value');
            })
        });

        var sentData = {};
        sentData.sentdata = postdata;
        $.ajax({
            type: 'POST',
            url: $('#tbl-produk').data('url'),
            data: sentData,
            dataType: 'json',
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            success: function (data) {
                if(data.response == 'success'){
                    window.location = data.location;
                }
            }
        });
    });
});