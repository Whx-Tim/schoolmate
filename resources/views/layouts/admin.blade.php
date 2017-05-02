@extends('layouts.base')

@section('title')@yield('admin.title') - 后台管理@stop

@section('base.content')
    <div class="Admin">
        @if(Auth::check())
            @include('layouts.partials.admin-sidebar')
        @endif
        <main class="Container">
            @if(Auth::check())
                @include('layouts.partials.admin-breadcrumb')
            @endif
            @yield('admin.content')

        </main>

    </div>
@stop

@push('head')
<meta name="_token" content="{{ csrf_token() }}">
@endpush

@push('scripts.footer')
<script src="{{ url('js/plugins.js') }}"></script>
@stack('admin.scripts')
@endpush