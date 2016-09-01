/**
 * Created by zillucks on 8/23/16.
 */
$(document).ready(function() {

    var autoproduk = $('#autoproduk');
    var hargajual = $('input[name="hargajual"]');

    /**
     * automatically focus to kdpelanggan on document ready
     */
    $('input[name="kdpelanggan"]').focus();

    /**
     * prevent submitting form on enter
     */
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#cal-tglpenjualan').datepicker({
        dateFormat : 'dd-mm-yy'
    });

    $('#btn-add-penjualan').click(function () {
        //add item to transaction table (#tbl-penjualan)
    });

    autoproduk.autocomplete({
        type : 'GET',
        source : autoproduk.data('source'),
        minLength : 2,
        focus: function (event, ui) {
            autoproduk.val(ui.item.label);
            autoproduk.data('id', ui.item.value);
            autoproduk.data('text', ui.item.label);
            hargajual.val(ui.item.hargajual);
            return false;
        },
        select: function (event, ui) {
            autoproduk.val(ui.item.label);
            autoproduk.data('id', ui.item.value);
            autoproduk.data('text', ui.item.label);
            hargajual.val(ui.item.hargajual);
            return false;
        }
    });

    $('#btn-add-penjualan').click(function() {
        var kdobat = autoproduk.data('id');
        var namaobat = autoproduk.data('text');
        var hargasatuan = hargajual.val();
        var qty = $('#qty').val();
        var hargatotal = hargasatuan * qty;

        $('#tbl-penjualan').append(
            '<tr>' +
                '<td>' +
                    '<input type="hidden" name="kdbarang" value="' + kdobat + '">' + kdobat +
                '</td>' +
                '<td>' +
                    '<input type="hidden" name="namabarang" value="' + namaobat + '">' + namaobat +
                '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' +
                    '<input type="hidden" name="qty" value="' + qty + '">' + qty +
                '</td>' +
                '<td>' +
                    '<input type="hidden" name="total" value="' + hargatotal + '">' + hargatotal +
                '</td>' +
                '<td class="text-center text-danger">' +
                    '<i class="fa fa-fw fa-trash dropitem" style="cursor: pointer;" title="Hapus Item"></i>' +
                '</td>' +
            '</tr>'
        );
        return resetField();
    });

    $('#tbl-penjualan').on('click', '.dropitem', function () {
        var row = $(this).closest('tr');

        row.remove();
    });

    function resetField() {
        autoproduk.val('');
        autoproduk.data('id', '');
        autoproduk.data('text', '');
        hargajual.val('');
        $('#qty').val('');
    }
});