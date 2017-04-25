@extends('layouts.app')

@section('title', '激活账号')

@section('content')
    <section class="container">
        <h4>请点击一下链接进行激活</h4>
        <a href="{{ url('api/user/fire/'.$code) }}">{{ url('api/user/fire/'.$code) }}</a>
    </section>
@endsection