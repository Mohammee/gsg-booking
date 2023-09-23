@extends('site.master')

@section('title', 'Training Halls | ' . config('app.name'))
@push('styles')
    <style>
        body {
            font-size: 16px !important
        }
    </style>
@endpush
@section('content')


    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Training Halls</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">Training Halls</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @if ($msg)
            <div class="fs-3 alert alert-{{ $type }}">{{ $msg }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style: circle; margin-left:20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($trainingHalls as $trainingHall)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="fs-3 accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-{{ $trainingHall->id }}" aria-expanded="false"
                            aria-controls="flush-{{ $trainingHall->id }}">
                            <i class="fs-5 fas fa-arrow-right"></i>&nbsp;{{ $trainingHall->name }}
                        </button>
                    </h2>
                    <div id="flush-{{ $trainingHall->id }}" class="accordion-collapse collapse p-2"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body d-flex justify-content-between">
                            <div class="d-flex align-items-center" style="max-width: 50%">
                                <img src="{{ $trainingHall->image_path ? asset('storage/' . $trainingHall->image_path) : asset('gsg.png') }}"
                                    style="max-width:100%;" alt="">
                            </div>
                            <div class="w-100 text-center">
                                <div>
                                    <h1 class="text-success">Book Now</h1>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Capacity: </th>
                                            <td>{{ $trainingHall->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description: </th>
                                            <td>{{ $trainingHall->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location: </th>
                                            <td>{{ $trainingHall->location }}</td>
                                        </tr>
                                        <form action="{{ route('site.trainingHalls.booking', $trainingHall->id) }}"
                                            method="post">
                                            <input type="hidden" name="training_hall_id" value="{{ $trainingHall->id }}">
                                            @csrf
                                            <tr>
                                                <th style="vertical-align: middle">Select Day</th>
                                                <td>
                                                    <input required type="date" name="booking_datetime"
                                                        class="fs-5 form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Start At</th>
                                                <td>
                                                    <input required type="time" name="startAt" class="form-control" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <th style="vertical-align: middle">End At</th>
                                                <td>
                                                    <input required type="time" name="endAt" class="form-control" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="fs-4 btn btn-success"
                                                        style="float:right">Book</button>
                                                </td>
                                            </tr>
                                        </form>

                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <x-alertscript />
@endpush
