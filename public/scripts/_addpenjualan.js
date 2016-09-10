/**
 * Created by zillucks on 8/23/16.
 */
$(document).ready(function() {

    var autoproduk = $('#autoproduk');
    var hargajual = $('input[name="hargajual"]');
    var subtotal = 0;

    /**
     * automatically focus to kdpelanggan on document ready
     */
    // $('input[name="kdpelanggan"]').focus();

    /**
     * prevent submitting form on enter
     */
    /*$(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });*/

    $('#tglpenjualan').datepicker({
        dateFormat : 'dd-mm-yy'
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

        var id = $('#tbl-penjualan tr').length;
        var kdobat = autoproduk.data('id');
        var namaobat = autoproduk.data('text');
        var hargasatuan = hargajual.val();
        var qty = $('#qty').val();
        var hargatotal = hargasatuan * qty;
        subtotal = subtotal + hargatotal;

        if(kdobat == '' && qty == ''){
            var msg = 'Isi data penjualan dengan lengkap';
            $('#frm-action').addClass('has-error');
            $('#err-catcher').fadeIn(4000, function() {
                $('#err-catcher').html(msg);

                $('#err-catcher').fadeOut(4000, function () {
                    $('#frm-action').removeClass('has-error');
                    $('#err-catcher').html('');
                });
            });
            return false;
        }

        $('#tbl-penjualan').append(
            '<tr>' +
                '<td>' +
                    '<input type="hidden" name="kdbarang['+id+']" value="' + kdobat + '">' + kdobat +
                '</td>' +
                '<td>' +
                    '<input type="hidden" name="namabarang['+id+']" value="' + namaobat + '">' + namaobat +
                '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' +
                    '<input type="hidden" name="qty['+id+']" value="' + qty + '">' + qty +
                '</td>' +
                '<td class="text-right">' +
                    '<input type="hidden" name="total['+id+']" value="' + hargatotal + '">' + hargatotal +
                '</td>' +
                '<td class="text-center text-danger">' +
                    '<i class="fa fa-fw fa-trash dropitem" style="cursor: pointer;" title="Hapus Item"></i>' +
                '</td>' +
            '</tr>'
        );

        $('#tbl-penjualan-foot').html(
            '<tr>' +
                    '<td colspan="4" class="text-right"><label for="subtotal">Sub Total</label></td>' +
                    '<td class="text-right">' + subtotal +
                        '<input type="hidden" name="subtotal" value="' + subtotal + '">' +
                    '</td>' +
                    '<td></td>' +
            '</tr>'
        );
        return resetField();
    });

    $('#tbl-penjualan').on('click', '.dropitem', function () {
        var row = $(this).closest('tr');
        var total = row.find('input[name=total]').val();
        subtotal = subtotal = total;

        row.remove();

        if($('#tbl-penjualan tr').length == 0){
            $('#tbl-penjualan-foot').html('');
        }
        else{
            $('#tbl-penjualan-foot').html(
                '<tr>' +
                '<td colspan="4" class="text-right"><label for="subtotal">Sub Total</label></td>' +
                '<td class="text-right">' + subtotal +
                    '<input type="hidden" name="subtotal" value="' + subtotal + '">' +
                '</td>' +
                '<td></td>' +
                '</tr>'
            );
        }
    });

    function resetField() {
        autoproduk.val('');
        autoproduk.data('id', '');
        autoproduk.data('text', '');
        hargajual.val('');
        $('#qty').val('');
    }
});