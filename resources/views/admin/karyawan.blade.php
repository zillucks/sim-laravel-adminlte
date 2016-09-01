@extends('layouts.app')

@section('page-header')
    <i class="fa fa-users"></i>
    Karyawan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="fa fa-check"></i> {!! session('success') !!}</h4>
                </div>
            @endif
            @if(session('danger'))
                    <div class="alert alert-danger alert-dismissable">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="fa fa-times"></i> {!! session('danger') !!}</h4>
                    </div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Karyawan</h3>
                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{!! route('karyawan.tambahkaryawan') !!}" title="Tambah Karyawan">
                            <i class="fa fa-lg fa-plus text-info"></i>
                        </a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">No. Telp / HP</th>
                        <th class="text-center"><i class="fa fa-fw fa-wrench"></i></th>
                        </thead>
                        <tbody>
                        @if(count($karyawans) == 0)
                            <tr>
                                <td colspan="5" class="text-warning">No Data</td>
                            </tr>
                        @endif
                        @foreach($karyawans as $index => $karyawan)
                            <tr>
                                <td class="text-right" style="padding-right: 2%;">{!! ++$index . '.' !!}</td>
                                <td>{!! $karyawan->getNamalengkap() !!}</td>
                                <td>{!! $karyawan->jabatans->jabatan !!}</td>
                                <td>{!! $karyawan->notelepon . ' / ' . $karyawan->nohp !!}</td>
                                <td class="text-center">
                                    <a class="btn-sm" href="#" title="Lihat Detail"><i class="fa fa-lg fa-eye"></i></a>
                                    <a class="btn-sm" href="{{ route('karyawan.editkaryawan', $karyawan->kdkaryawan) }}" title="Edit Data"><i class="fa fa-lg fa-edit"></i></a>
                                    <a class="btn-sm text-danger" href="#" title="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data karyawan?')"><i class="fa fa-lg fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection