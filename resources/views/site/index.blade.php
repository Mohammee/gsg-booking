@extends('site.master')

@section('title', 'Home | ' . config('app.name'))

@push('styles')
    <style>
        .category-box{
            box-shadow: 2px 2px 40px -20px #CCC;
            outline: 1px solid #EEE
        }
    </style>
@endpush
@section('content')
    <div class="hero-slider">
        @if (Auth::user()->role == 'user')
            @foreach ($workspaces as $workspace)
                <div class="slider-item th-fullpage hero-area"
                    style="background-image: url({{ $workspace->image_path ? asset('storage/' . $workspace->image_path) : asset('gsg.png') }});">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 text-center">
                                <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Workspaces</p>
                                <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">
                                    {{ $workspace->name }}
                                </h1>
                                <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                                    href="{{ route('site.workspaces') }}">See More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach ($trainingHalls as $trainingHall)
                <div class="slider-item th-fullpage hero-area"
                    style="background-image: url({{ $trainingHall->image_path ? asset('storage/' . $trainingHall->image_path) : asset('gsg.png') }});">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 text-center">
                                <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Training Halls</p>
                                <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">
                                    {{ $trainingHall->name }}
                                </h1>
                                <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                                    href="{{ route('site.trainingHalls') }}">See More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    @if (Auth::user()->role != 'user')

        <section class="product-category section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title text-center">
                            <h2>Workspaces</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @isset($workspaces[0])
                            <div class="category-box">
                                <a href="{{-- route('site.category',$workspaces[0]->id) --}}">
                                    <img src="{{ $workspaces[0]->image_path ? asset('storage/' . $workspaces[0]->image_path) : asset('gsg.png') }}"
                                        alt="" />
                                    <div class="content">
                                        <h3>{{ $workspaces[0]->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endisset

                        @if (isset($workspaces[1]))
                            <div class="category-box">
                                <a href="{{-- route('site.category',$categories[1]->id) --}}">
                                    <img src="{{ $workspaces[1]->image_path ? asset('storage/' . $workspaces[1]->image_path) : asset('gsg.png') }}"
                                        alt="" />
                                    <div class="content">
                                        <h3>{{ $workspaces[1]->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endif

                    </div>
                    <div class="col-md-6">
                        @isset($workspaces[2])
                            <div class="category-box">
                                <a href="{{-- route('site.category',$workspaces[2]->id) --}}">
                                    <img src="{{ $workspaces[2]->image_path ? asset('storage/' . $workspaces[2]->image_path) : asset('gsg.png') }}"
                                        alt="" />
                                    <div class="content">
                                        <h3>{{ $workspaces[2]->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section instagram-feed">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>View us on instagram</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="instagram-slider" id="instafeed"
                        data-accessToken="IGQVJYeUk4YWNIY1h4OWZANeS1wRHZARdjJ5QmdueXN2RFR6NF9iYUtfcGp1NmpxZA3RTbnU1MXpDNVBHTzZAMOFlxcGlkVHBKdjhqSnUybERhNWdQSE5hVmtXT013MEhOQVJJRGJBRURn">
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
