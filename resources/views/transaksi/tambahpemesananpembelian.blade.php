<?php
/**
 * Created by PhpStorm.
 * User: zillucks
 * Date: 7/23/16
 * Time: 6:00 AM
 */
?>
@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-cart-plus"></i>
    Transaksi <small>Tambah Pemesanan Pembelian</small>
@endsection

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="box no-border">
            <div class="box-header no-border">
                <h3 class="box-title">Form Tambah Pemesanan Pembelian</h3>
                <div class="box-tools pull-right">
                    <a class="btn-box-tool" href="{{ route('transaksi.pemesananpembelian') }}">
                        <i class="fa fa-lg fa-close text-info"></i>
                    </a>
                </div>
            </div>
            <div class="box-body no-border">
                {!! Form::open(['method' => 'post', 'route' => 'transaksi.simpanpemesananpembelian', 'class' => 'form-horizontal']) !!}
                {{--Left Box--}}
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('tglpembelian') ? 'has-error' : '' }}">
                        {!! Form::label('tglpembelian', 'Tanggal PO', ['class' => 'control-label col-md-4']) !!}
                        <div class="col-md-6 input-group">
                            {!! Form::text('tglpembelian', old('tglpembelian'), ['class' => 'form-control input-sm', 'id' => 'cal-tglpembelian']) !!}
                            <span class="input-group-addon" onclick="$('#cal-tglpembelian').focus();" style="cursor: pointer;">
                                <i class="fa fa-fw fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('nofaktur') ? 'has-error' : '' }}">
                        {!! Form::label('nofaktur', 'No. Faktur', ['class' => 'control-label col-md-4']) !!}
                        <div class="col-md-6 input-group">
                            {!! Form::text('nofaktur', old('nofaktur'), ['class' => 'form-control input-sm']) !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('jenispembayaran') ? 'has-error' : '' }}">
                        {!! Form::label('jenispembelian', 'Pembayaran', ['class' => 'control-label col-md-4']) !!}
                        <div class="col-md-6 input-group">
                            {!! Form::select('jenispembelian', ['k' => 'Kredit', 't' => 'Tunai'], old('jenispembelian'), ['class' => 'form-control input-sm']) !!}
                        </div>
                    </div>
                    <div id="tgljatuhtempo" class="form-group {{ $errors->has('tgljatuhtempo') ? 'has-error' : '' }}">
                        {!! Form::label('tgljatuhtempo', 'Tgl Jatuh Tempo', ['class' => 'control-label col-md-4']) !!}
                        <div class="col-md-6 input-group">
                            {!! Form::text('tgljatuhtempo', old('tgljatuhtempo'), ['class' => 'form-control input-sm', 'id' => 'cal-tgljatuhtempo']) !!}
                            <span class="input-group-addon" onclick="$('#cal-tgljatuhtempo').focus();" style="cursor: pointer;">
                                <i class="fa fa-fw fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('kdsupplier') ? 'has-error' : '' }}">
                        {!! Form::label('kdsupplier', 'Supplier', ['class' => 'control-label col-md-4']) !!}
                        <div class="col-md-8 input-group">
                            <div class="form-inline">
                                <div class="col-md-4 no-padding">
                                    {!! Form::text('kdsupplier', old('kdsupplier'), [
                                    'class'         => 'form-control input-sm col-md-4',
                                    'id'            => 'kdsupplier',
                                    'data-source'   => route('transaksi.autosupplier'),
                                    'data-id'       => '',
                                    'placeholder'   => 'Kode Supplier'
                                ]) !!}
                                </div>
                                <div class="col-md-8 no-padding">
                                    {!! Form::text('autosupplier', old('namasupplier'), [
                                    'class'         => 'form-control input-sm col-md-8',
                                    'id'            => 'autosupplier',
                                    'data-source'   => route('transaksi.autosupplier'),
                                    'data-id'       => '',
                                    'placeholder'   => 'Nama Supplier'
                                ]) !!}
                                </div>
                            </div>
                            <div class="help-block"><small class="text-danger">* input kode / nama supplier di kolom Kode</small></div>
                        </div>
                    </div>
                </div>
                {{--Right Box--}}
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('autobarang', 'Cari Obat', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-6 input-group">
                            {!! Form::text('autobarang', '', [
                            'class' => 'form-control input-sm',
                            'id' => 'autobarang',
                            'data-source' => route('transaksi.autocplbarangsupplier'),
                            'data-id' => '',
                            'data-harga' => '',
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('harga', 'Harga', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-6 input-group">
                            <span class="input-group-addon">Rp.</span>
                            {!! Form::text('harga', '', ['id' => 'harga' ,'class' => 'form-control input-sm', 'default' => 0]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('qty', 'Quantity', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-2 input-group">
                            {!! Form::number('qty', old('qty'), ['class' => 'form-control input-sm', 'min' => 0]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('diskonitem', 'Diskon Produk', ['class' => 'control-label col-md-3']) !!}
                        <div class="col-md-3 input-group">
                            {!! Form::number('diskonitem', old('diskonitem') == '' ? 0 : old('diskonitem'), ['class' => 'form-control input-sm', 'min' => 0]) !!}
                            <span class="input-group-addon"><i class="fa fa-fw fa-percent"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 input-group">
                            <button id="btn-add-po" type="button" class="btn btn-default form-control">
                                <i class="fa fa-fw fa-plus"></i> Tambah Item
                            </button>
                        </div>
                    </div>
                </div>
                {{--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--}}
                <div class="form-group">
                    <div class="table-responsive col-md-10 col-md-offset-1">
                        <div class="box box-info no-header no-padding">
                            <div class="box-body with-border table-responsive">
                                <table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Kode</th>
                                    <th>Nama Obat</th>
                                    <th>Harga Satuan</th>
                                    <th>QTY</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th class="text-center"><i class="fa fa-fw fa-trash text-danger"></i></th>
                                    </thead>
                                    <tbody id="tbl-po"></tbody>
                                    <tfoot id="tbl-po-footer"></tfoot>
                                </table>
                            </div>
                            <div id="tbl-po-footer" class="box-footer with-border">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('diskontransaksi', 'Diskon Pembelian', ['class' => 'control-label col-md-6']) !!}
                                        <div class="input-group has-feedback col-md-3">
                                            {!! Form::number('diskontransaksi', 0, ['class' => 'form-control input-sm']) !!}
                                            <span class="form-control-feedback">
                                                <i class="fa fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group btn-group-sm pull-right" role="group">
                                            {!! Form::submit('Simpan', ['class' => 'btn btn-success btn-flat', 'id' => 'btn-simpan-po']) !!}
                                            {!! Form::reset('Batal', ['class' => 'btn btn-danger btn-flat']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('scripts/_addpo.js') }}"></script>
@endsection