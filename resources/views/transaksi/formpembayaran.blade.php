@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Form Pembayaran PO</h3>
                    <div class="box-tools">
                        <span class="btn-box-tool pull-right">
                            <a href="{{ route('transaksi.pembayaranpembelian') }}"><i class="fa fa-fw fa-times"></i></a>
                        </span>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group">
                        <!-- Box Group 1 -->
                        <div class="box no-header no-border">
                            <div class="box-body form-horizontal">
                                <!-- Left Box -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('nofaktur', 'No Faktur', ['class' => 'control-label col-md-6']) !!}
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->nofaktur !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('tglpembelian', 'Tanggal PO', ['class' => 'control-label col-md-6']) !!}
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->tglpembelian !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('tgljatuhtempo', 'Tgl. Jatuh Tempo', ['class' => 'control-label col-md-6']) !!}
                                        <div class="input-group col-md-6">
                                            <p class="form-control-static">{!! $pembelian->tgljatuhtempo !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./left box -->

                                <!-- Right Box -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('supplier', 'Supplier', ['class' => 'control-label col-md-4']) !!}
                                        <div class="input-group col-md-8">
                                            <p class="form-control-static">{!! $pembelian->suppliers->namasupplier !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('diskontransaksi', 'Diskon', ['class' => 'control-label col-md-4']) !!}
                                        <div class="input-group col-md-8">
                                            <p class="form-control-static">{!! $pembelian->diskontransaksi !!}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('bayar', 'Jumlah Dibayar', ['class' => 'control-label col-md-4']) !!}
                                        <div class="input-group col-md-8">
                                            <p class="form-control-static">{!! formatMoney($pembelian->bayar) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./Right Box -->
                            </div>
                        </div>
                        <!-- ./Box Group 1 -->
                        <!-- Box Group 2 -->
                        <div class="box no-header no-border">
                            <div class="box-body no-padding table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Obat</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Diskon Item</th>
                                    <th class="text-center">Total</th>
                                    </thead>
                                    <tbody>
                                    @foreach($pembelian->detailpembelians as $index => $value)
                                        <tr>
                                            <td class="text-right">{!! ++$index.'.' !!}</td>
                                            <td>{!! $value->kdbarang . ' - ' .$value->barangs->namabarang !!}</td>
                                            <td class="text-right">{!! $value->qty !!}</td>
                                            <td class="text-center">{!! $value->diskonitem !!}</td>
                                            <td class="text-right">{!! formatMoney($value->total) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ./Box Group 2 -->
                        <!-- Box Group 3 -->
                        <div class="box box-info">
                            <div class="box-header">
                                <h1 class="box-title">PEMBAYARAN</h1>
                            </div>
                            <div class="box-body">
                                {!! Form::open(['method' => 'post', 'route' => ['transaksi.pembayaran', $pembelian->kdpembelian], 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('total', 'Jumlah Hutang', ['class' => 'control-label col-md-2']) !!}
                                    <div class="input-group col-md-6">
                                        <p class="form-control-static">{!! formatMoney($pembelian->getTotalhutang($pembelian->subtotal, $pembelian->bayar)) !!}</p>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('kdpembelian') ? 'has-error' : '' }}">
                                    {!! Form::label('jmlbayar', 'Bayar Hutang', ['class' => 'control-label col-md-2']) !!}
                                    <div class="input-group col-md-4">
                                        <span class="input-group-addon">Rp.</span>
                                        {!! Form::number('jmlbayar', $pembelian->subtotal-$pembelian->bayar, [
                                            'class' => 'form-control input-sm',
                                            'aria-descripbedby' => 'helpBlockJmlbayar',
                                            'min' => 0,
                                            'max' => $pembelian->getTotalhutang($pembelian->subtotal, $pembelian->bayar)]) !!}
                                        <div class="input-group-btn">
                                            {!! Form::submit('Bayar', ['class' => 'btn btn-sm btn-default']) !!}
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection