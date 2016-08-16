@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-money"></i>
    Transaksi <small>pembayaran pembelian</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar PO</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                        <th>#</th>
                        <th>No. Faktur</th>
                        <th>Supplier</th>
                        <th>Tgl PO</th>
                        <th>Tgl Jatuh Tempo</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Sisa Hutang</th>
                        <th><i class="fa fa-fw fa-money"></i></th>
                        </thead>
                        <tbody>
                        @foreach($pembelian as $item => $value)
                            <tr>
                                <td>{!! ++$item !!}</td>
                                <td>{!! $value->nofaktur !!}</td>
                                <td>{!! $value->suppliers->namasupplier !!}</td>
                                <td>{!! $value->tglpembelian !!}</td>
                                <td>{!! $value->tgljatuhtempo !!}</td>
                                <td>{!! $value->subtotal !!}</td>
                                <td>{!! $value->bayar !!}</td>
                                <td>{!! formatMoney($value->getTotalhutang($value->subtotal, $value->bayar)) !!}</td>
                                <td>
                                    @if($value->getTotalhutang($value->subtotal, $value->bayar) == 0)
                                        <span class="text-success">Lunas</span>
                                    @else
                                        <a class="btn btn-link btn-sm"
                                           href="{{ route('transaksi.pembayaranpembelian', [$value->kdpembelian]) }}"
                                           title="Bayar">
                                            <i class="fa fa-fw fa-dollar"></i>
                                        </a>
                                    @endif
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
    </div>
@endsection