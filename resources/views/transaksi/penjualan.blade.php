<?php
/**
 * Created by PhpStorm.
 * User: zillucks
 * Date: 7/17/16
 * Time: 10:19 PM
 */
?>
@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-users"></i>
    Transaksi <small>penjualan</small>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="box no-border">
            <div class="box-header">
                <h1 class="box-title">Form Transaksi Penjualan</h1>
            </div>
            <br>
            <div class="box-body no-border no-padding">
                {!! Form::open(['method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('tglpenjualan', 'Tanggal', ['class' => 'control-label col-md-4']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('tglpenjualan', date('d-m-Y'), ['class' => 'form-control', 'id' => 'tglpenjualan']) !!}
                            <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('kdpelanggan', 'Pelanggan', ['class' => 'control-label col-md-4']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('kdpelanggan', '', [
                                'class' => 'form-control',
                                'id'    => 'kdpelanggan',
                                'placeholder'   => 'Nama Pelanggan'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('nofaktur') ? 'has-error' : '' }}">
                        {!! Form::label('nofaktur', 'No. Faktur', ['class' => 'control-label col-md-4']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('nofaktur', '', ['class' => 'form-control']) !!}
                            @if($errors->has('nofaktur'))
                                <div class="help-block">{!! $errors->first('nofaktur') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('autoproduk', 'Cari Obat', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-8">
                            {!! Form::text('kdbarang', '', [
                            'class' => 'form-control',
                            'id' => 'autoproduk',
                            'data-source' => route('transaksi.autoproduk'),
                            'data-id' => '',
                            'placeholder' => 'Cari Obat'
                            ]) !!}
                            <div class="input-group-addon"><i class="fa fa-fw fa-search"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('hargajual', 'Harga', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-8">
                            {!! Form::number('hargajual', '', ['class' => 'form-control', 'min' => 0]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('qty', 'Qty', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-8">
                            {!! Form::number('qty', '', ['class' => 'form-control', 'min' => 0]) !!}
                        </div>
                    </div>
                    <div id="frm-action" class="form-group">
                        <div class="col-md-8 col-md-offset-3 input-group">
                            <button id="btn-add-penjualan" type="button" class="btn btn-default form-control">
                                <i class="fa fa-fw fa-plus"></i> Tambah Item
                            </button>
                            <div id="err-catcher" class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="box box-info no-header nopadding">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                    <th>KODE</th>
                                    <th>NAMA OBAT</th>
                                    <th>HARGA SATUAN</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                    <th class="text-center"><i class="fa fa-fw fa-cog"></i></th>
                                    </thead>
                                    <tbody id="tbl-penjualan"></tbody>
                                    <tfoot id="tbl-penjualan-foot"></tfoot>
                                </table>
                            </div>
                            <div class="box-footer">
                                <div class="btn-group btn-group-sm pull-right" role="group">
                                    {!! Form::submit('Simpan', ['class' => 'btn btn-success btn-flat', 'id' => 'btn-simpan-penjualan']) !!}
                                    {!! Form::reset('Batal', ['class' => 'btn btn-danger btn-flat']) !!}
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
    <script src="{{ asset('scripts/_addpenjualan.js') }}"></script>
@endsection