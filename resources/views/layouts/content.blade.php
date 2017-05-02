@extends('layouts.app')

@section('base.content')

    <div class="container">
        <div class="Left">
            <div class="panel panel--hanya">
                <div class="panel-heading">
                    <h4 class="panel-title">导航</h4>
                </div>
                <div class="panel-body">
                    <ul class="List List--big List--fancy">
                        <li>
                            <a href="{{ url('culture') }}">香道文化</a>
                        </li>
                        <li>
                            <a href="{{ url('course') }}">课程通知</a>
                        </li>
                        <li>
                            <a href="{{ url('teacher') }}">师资力量</a>
                        </li>
                        <li>
                            <a href="{{ url('train') }}">培训动态</a>
                        </li>
                        <li>
                            <a href="{{ url('about') }}">关于汉雅</a>
                        </li>
                        <li>
                            <a href="{{ url('job') }}">招贤纳士</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel--hanya">
                <div class="panel-heading">
                    <h4 class="panel-title">课程通知</h4>
                </div>
                <div class="panel-body">
                    <ul class="List List--filled">
                        @foreach($courses as $course)
                            <li>
                                <a href="{{ $course->showLink() }}">{{ str_limit($course->title,15) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @yield('left')
        </div>
        <div class="Right">
            <div class="Panel">
                <ol class="Breadcrumb">
                    <li><a href="{{ url('/') }}">汉雅</a></li>
                    @yield('breadcrumb')
                </ol>

                <div class="panel-body">
                    @yield('right')
                </div>

            </div>
        </div>
    </div>

@stop