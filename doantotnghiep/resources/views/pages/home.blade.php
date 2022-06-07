@section('title')
    Trang chủ
@endsection
@extends('welcome')
@section('content')
    @include('layout.slide')
    @include('pages.search')
    @include('dangtin.trangdangtin')
@endsection

