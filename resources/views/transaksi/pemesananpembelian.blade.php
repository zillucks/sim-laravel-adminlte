<?php
/**
 * Created by PhpStorm.
 * User: zillucks
 * Date: 7/17/16
 * Time: 10:35 PM
 */
//setlocale(LC_MONETARY, 'id_ID');
//setlocale(LC_TIME, 'id_ID');
?>
@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-users"></i>
    Transaksi <small>Pemesanan Pembelian</small>
@endsection

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pemesanan Pembelian</h3>
                <div class="box-tools pull-right">
                    <a class="btn-box-tool" href="{!! route('transaksi.tambahpemesananpembelian') !!}" title="Tambah Pesanan Baru">
                        <i class="fa fa-2x fa-plus text-info"></i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="box-group">
                    <div class="box no-header no-border">
                        {!! Form::open(['method' => 'get', 'route' => 'transaksi.pemesananpembelian', 'class' => 'form-inline']) !!}
                        <div class="form-group">
                            <label for="startdate">Dari Tanggal &nbsp;</label>
                            <input type="text" name="startdate" id="startdate" class="form-control input-sm" value="{!! $startdate !!}">
                            <label for="enddate">&nbsp; Sampai &nbsp;</label>
                            <input type="text" name="enddate" id="enddate" class="form-control input-sm" value="{!! $enddate !!}">
                            <button type="submit" class="btn btn-sm btn-success form-control"><i class="fa fa-fw fa-check"></i></button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="box no-header no-border table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th>Tgl Pemesanan</th>
                            <th>No. Faktur</th>
                            <th>Supplier</th>
                            <th>Tgl Jatuh Tempo</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Detail</th>
                            </thead>
                            <tbody>
                            @if($pembelian->total() == 0)
                                <tr>
                                    <td class="text-danger" colspan="6"><strong><em>Data Pembelian Kosong</em></strong></td>
                                </tr>
                            @endif
                            @foreach($pembelian as $data)
                                <tr>
                                    <td>{!! $data->tglpembelian !!}</td>
                                    <td>{!! $data->nofaktur !!}</td>
                                    <td>{!! $data->suppliers->namasupplier !!}</td>
                                    <td>{!! $data->tgljatuhtempo !!}</td>
                                    <td>{!! $data->subtotal !!}</td>
                                    <td>{!! $data->bayar !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.detailpemesananpembelian', ['id' => $data->kdpembelian]) }}" title="Lihat Detail Pesanan"><i class="fa fa-fw fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            @if($pembelian->total() > $pembelian->perPage())
                                <ul class="pagination no-margin pull-right">
                                    <li>{!! $pembelian->links() !!}</li>
                                </ul>
                            @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm pull-right">
                    <li>{!! $pembelian->links() !!}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            $('#startdate').datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $('#enddate').datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
@endsection