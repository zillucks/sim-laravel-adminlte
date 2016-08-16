/**
 * Created by zillucks on 7/26/16.
 */
$(document).ready(function () {

    $('select[name=jenispembelian]').change(function(){
        var jenispembelian = $(this).val();
        if(jenispembelian == 't'){
            $('#tgljatuhtempo').css('display', 'none');
        }
        else if (jenispembelian == 'k'){
            $('#tgljatuhtempo').css('display', 'block');
        }
    });

    $('#cal-tglpembelian').datepicker({
        dateFormat : 'dd-mm-yy'
    });

    $('#cal-tglpembelian').change(function () {
        var tglpo = $(this).val();
        var arrtgl = tglpo.split('-');
        var days = parseInt(arrtgl[0])+21;
        var tgljatuhtempo = days + '-' + arrtgl[1] + '-' + arrtgl[2];
        $('#cal-tgljatuhtempo').val(tgljatuhtempo);
    });

    $('#cal-tgljatuhtempo').datepicker({
        dateFormat : 'dd-mm-yy'
    });

    var kdsupplier      = $('#kdsupplier');
    var autosupplier    = $('#autosupplier');
    var sourceSupplier  = autosupplier.data('source');

    var autoproduk      = $('#autobarang');
    var sourceProduk    = autoproduk.data('source');
    var grandtotal      = 0;

    kdsupplier.autocomplete({
        type: 'GET',
        source: sourceSupplier,
        minLength: 2,
        focus: function (event, ui) {
            autosupplier.val(ui.item.label);
            autosupplier.data('id', ui.item.value);
            autosupplier.data('text', ui.item.label);

            kdsupplier.val(ui.item.value);
            kdsupplier.data('id', ui.item.value);
            kdsupplier.data('text', ui.item.value);
            return false;
        },
        select: function (event, ui) {
            autosupplier.val(ui.item.label);
            autosupplier.data('id', ui.item.value);
            autosupplier.data('text', ui.item.label);

            kdsupplier.val(ui.item.value);
            kdsupplier.data('id', ui.item.value);
            kdsupplier.data('text', ui.item.value);
            return false;
        }
    });

    autoproduk.autocomplete({
        source: function(request, response){
            $.ajax({
                url: sourceProduk,
                type: "GET",
                data: {'id':autosupplier.data('id'),'term':request.term},
                dataType: "json",
                success:function (data) {
                    response(data);
                }
            });
        },
        minLength : 2,
        focus: function(event, ui) {
            autoproduk.val(ui.item.label);
            autoproduk.data('id', ui.item.value);
            autoproduk.data('nama', ui.item.namabarang);
            autoproduk.data('text', ui.item.label);
            autoproduk.data('harga', ui.item.harga);
            $('#harga').val(ui.item.harga);
            return false;
        },

        select: function (event, ui) {
            autoproduk.val(ui.item.label);
            autoproduk.data('id', ui.item.value);
            autoproduk.data('nama', ui.item.namabarang);
            autoproduk.data('text', ui.item.label);
            autoproduk.data('harga', ui.item.harga);
            $('#harga').val(ui.item.harga);
            return false;
        }
    });
    
    $('#btn-add-po').click(function(){

        var id = $('#tbl-po tr').length + 1;
        var kodeobat = autoproduk.data('id');
        var namaobat = autoproduk.data('nama');
        var hargasatuan = $('#harga').val();
        var qty = $('#qty').val();
        var diskonitem = parseInt($('#diskonitem').val());
        var hargatotal = hargasatuan * qty;
        var subtotal = hargatotal - (hargatotal * (diskonitem / 100));

        $('#tbl-po').append(
            '<tr>' +
                '<td>'+
                    kodeobat +
                    '<input type="hidden" name="kdbarang['+id+']" value="'+ kodeobat +'">' +
                '</td>' +
                '<td>'+ namaobat +'</td>' +
                '<td>'+ hargasatuan +'</td>' +
                '<td>'+
                    qty +
                    '<input type="hidden" name="qty['+id+']" value="'+ qty +'">' +
                '</td>' +
                '<td>'+ hargatotal +'</td>' +
                '<td>'+
                    diskonitem + ' %' +
                    '<input type="hidden" name="diskonitem['+id+']" value="'+ diskonitem +'">' +
                '</td>' +
                '<td>'+
                    subtotal +
                    '<input type="hidden" class="subtotal" name="subtotal['+id+']" value="'+ subtotal +'">' +
                '</td>' +
                '<td class="text-center text-danger">' +
                    '<i class="fa fa-fw fa-trash dropitem" style="cursor: pointer;" title="Hapus Item"></i>' +
                '</td>' +
            '</tr>'
        );

        grandtotal = grandtotal + subtotal;

        $('#tbl-po-footer').html(
            '<tr>' +
                '<td colspan="6" class="text-right" style="padding-right: 5%"><strong>Grand Total</strong></td>' +
                '<td class="text-danger">' +
                    '<strong>' + grandtotal + '</strong>' +
                    '<input type="hidden" name="grandtotal" id="grandtotal" value="' + grandtotal + '">' +
                '</td>' +
            '</tr>'
        );

        return resetField();
    });

    function resetField() {
        autoproduk.val('');
        autoproduk.data('id', '');
        autoproduk.data('nama', '');
        autoproduk.data('text', '');
        autoproduk.data('harga', '');
        $('input[name=qty]').val('');
        $('input[name=diskonitem]').val(0);
        $('#harga').val('');
    }

    $('#tbl-po').on('click', '.dropitem', function() {
        var rows = $(this).closest('tr');
        var totalreduction = rows.find('.subtotal').val();
        grandtotal = grandtotal - totalreduction;
        
        rows.remove();

        $('#tbl-po-footer').html(
            '<tr>' +
            '<td colspan="6" class="text-right" style="padding-right: 5%"><strong>Grand Total</strong></td>' +
            '<td class="text-danger">' +
            '<strong>' + grandtotal + '</strong>' +
            '<input type="hidden" name="grandtotal" id="grandtotal" value="' + grandtotal + '">' +
            '</td>' +
            '</tr>'
        );

        if($('tbody#tbl-po tr').length == 0){
            $('tfoot#tbl-po-footer').html('');
        }

    });

    /**
     * bersihkan semua field setelah klik simpan
     */

    /*
    $('#btn-simpan-po').click(function() {
        return resetField();
    });
    */


});