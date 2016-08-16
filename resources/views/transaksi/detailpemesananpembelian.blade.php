@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-users"></i>
    Transaksi <small>Detail Pemesanan Pembelian</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Detail Pesanan</h3>
                    <div class="box-tools pull-right">
                        <a class="btn-box-tool" href="{{ route('transaksi.pemesananpembelian') }}" title="Close">
                            <i class="fa fa-lg fa-times text-info"></i>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group">
                        <div class="box no-border no-header">
                            <div class="box-body">
                                <div class="col-md-6 form-horizontal">
                                    <div class="form-group">
                                        <label for="nofaktur" class="control-label col-md-4">No Faktur</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->nofaktur !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tglpembelian" class="control-label col-md-4">Tanggal PO</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->tglpembelian !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgljatuhtempo" class="control-label col-md-4">Tgl. Jatuh Tempo</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->tgljatuhtempo !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-horizontal">
                                    <div class="form-group">
                                        <label for="nofaktur" class="control-label col-md-4">Supplier</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->suppliers->namasupplier !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgljatuhtempo" class="control-label col-md-4">Subtotal</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->subtotal !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgljatuhtempo" class="control-label col-md-4">Jml. Dibayar</label>
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->bayar !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box no-border no-header">
                            <div class="box-body no-padding table-responsive">
                                <table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">OBAT</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">DISKON</th>
                                    <th class="text-center">TOTAL</th>
                                    </thead>
                                    <tbody>
                                    @foreach($pembelian->detailpembelians as $index => $data)
                                        <tr>
                                            <td class="text-right" style="padding-right: 1%">{!! ++$index . '.' !!}</td>
                                            <td>{!! $data->kdbarang . ' - ' .$data->barangs->namabarang !!}</td>
                                            <td class="text-right">{!! $data->qty !!}</td>
                                            <td class="text-center">{!! $data->diskonitem !!}</td>
                                            <td class="text-right" style="padding-right: 2%">{!! formatMoney($data->total) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="tgljatuhtempo" class="control-label col-md-4">Diskon Pembelian</label>
                        <div class="input-group col-md-6">
                            <p class="form-control-static">{!! $pembelian->diskontransaksi !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection