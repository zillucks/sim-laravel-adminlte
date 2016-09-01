@extends('layouts.app')

@section('page-header')
    <i class="fa fa-fw fa-user"></i>
    Karyawan <small>tambah data karyawan</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box no-border">
                <div class="box-header">
                    <h3 class="box-title">Form Tambah Data Karyawan</h3>
                    <div class="box-tools pull-right">
                        <a class="btn" href="{{ route('karyawan') }}" title="Close"><i class="fa fa-fw fa-times"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(['method' => 'post', 'route' => ['karyawan.tambahkaryawan', $karyawan->kdkaryawan], 'class' => 'form form-horizontal', 'role' => 'form']) !!}
                    <div class="form-group">
                        {!! Form::label('namadepan', 'Nama', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-8">
                            <div class="form-group">
                                <div class="col-md-4 {{ $errors->has('namadepan') ? 'has-error' : '' }}">
                                    {!! Form::text('namadepan', $karyawan->namadepan, ['class' => 'form-control', 'placeholder' => 'Nama Depan']) !!}
                                    @if($errors->has('namadepan'))
                                        <div class="help-block">{{ $errors->first('namadepan') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('namabelakang') ? 'has-error' : '' }}">
                                    {!! Form::text('namabelakang', $karyawan->namabelakang, ['class' => 'form-control', 'placeholder' => 'Nama Belakang']) !!}
                                    @if($errors->has('namabelakang'))
                                        <div class="help-block">{{ $errors->first('namabelakang') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('noktp') ? 'has-error' : '' }}">
                        {!! Form::label('noktp', 'No. KTP', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('noktp', $karyawan->noktp, ['class' => 'form-control']) !!}
                        </div>
                        @if($errors->has('noktp'))
                            <div class="help-block">{{ $errors->first('noktop') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('notelepon', 'Telepon', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('notelepon', $karyawan->notelepon, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nohp', 'HP', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('nohp', $karyawan->nohp, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'E-Mail', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::email('email', $karyawan->email, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('alamat', 'Alamat', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::textarea('alamat', $karyawan->alamat, ['class' => 'form-control', 'rows' => 4]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('kota', 'Kota', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-8">
                            <div class="form-group">
                                <div class="col-md-6">
                                    {!! Form::text('kota', $karyawan->kota, ['class' => 'form-control', 'placeholder' => 'Kecamatan / Kota']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('propinsi', $karyawan->propinsi, ['class' => 'form-control', 'placeholder' => 'Provinsi']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('kdjabatan', 'Jabatan', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::select('kdjabatan', $jabatan, $karyawan->kdjabatan, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('jeniskelamin', 'Jenis Kelamin', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            <label class="radio-inline">
                                {!! Form::radio('jeniskelamin', 'L', $karyawan->jeniskelamin == 'L' ? true : false) !!} Laki-laki
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('jeniskelamin', 'P', $karyawan->jeniskelamin == 'P' ? true : false) !!} Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tempatlahir', 'Tempat Lahir', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('tempatlahir', $karyawan->tempatlahir, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tgllahir', 'Tanggal Lahir', ['class' => 'control-label col-md-3']) !!}
                        <div class="input-group col-md-6">
                            {!! Form::text('tgllahir', $karyawan->tgllahir, ['class' => 'form-control', 'id' => 'cal-tgllahir', 'readonly']) !!}
                            <div class="input-group-addon" onclick="$('#cal-tgllahir').focus();" style="cursor: pointer;">
                                <i class="fa fa-fw fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-6 col-md-offset-3">
                            {!! Form::submit('Simpan', ['class' => 'btn btn-flat btn-info form-control']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#cal-tgllahir').datepicker({
                changeMonth     : true,
                changeYear      : true,
                dateFormat      : 'dd-mm-yy'
            });
        });
    </script>
@endsection