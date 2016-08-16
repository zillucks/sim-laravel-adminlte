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
    <div class="col-md-10 col-md-offset-1">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Transaksi Penjualan</h3>
            </div>
            <div class="box-body table-responsive no-padding">

            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm pull-right">
                    {{--<li>{!! $users->links() !!}</li>--}}
                </ul>
            </div>
        </div>
    </div>
@endsection