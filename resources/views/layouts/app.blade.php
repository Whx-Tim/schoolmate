@extends('layouts.base')

@unless(request()->is('manage*'))
    @section('header')
        <header class="Hero">
            {{--<div class="Hero__banner" style="background-image: url('http://xiuxiutea.cn/ximg/pic.jpg')"></div>--}}
            <div class="Hero__banner" style="background-image: url({{ url($image) }})"></div>
        </header>
    @stop
@endunless