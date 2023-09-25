@extends('site.master')

@section('title', 'Workspaces | ' . config('app.name'))
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
                        <h1 class="page-name">Workspaces</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">Workspaces</li>
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
            @foreach ($workspaces as $workspace)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="fs-3 accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-{{ $workspace->id }}" aria-expanded="false"
                            aria-controls="flush-{{ $workspace->id }}">
                            <i class="fs-5 fas fa-arrow-right"></i>&nbsp;{{ $workspace->name }}
                        </button>
                    </h2>
                    <div id="flush-{{ $workspace->id }}" class="accordion-collapse collapse p-2"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body d-flex justify-content-between">
                            <div class="d-flex align-items-center" style="max-width: 50%">
                                <img src="{{ $workspace->image_path ? asset('storage/' . $workspace->image_path) : asset('gsg.png') }}"
                                    style="max-width:100%;" alt="">
                            </div>
                            <div class="w-100 text-center">
                                <div>
                                    <h1 class="text-success">Book Now</h1>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Capacity: </th>
                                            <td>{{ $workspace->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description: </th>
                                            <td>{{ $workspace->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location: </th>
                                            <td>{{ $workspace->location }}</td>
                                        </tr>
                                        <form action="{{ route('site.workspaces.booking') }}"
                                            method="post">
                                            <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
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

            <div class="text-center">
                <button id="load" class="btn btn-secondary px-lg-5">Load More</button>
            </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        (function ($) {
            var page = 1;

            function load(page = 1) {
                $.get('{{ route('site.workspaces') }}'+ '?page=' + page, function (response) {
                    // Handle the server's response
                    let html = '';
                    let data = response.data;
                    if(data.length == 0){
                        $('#load').html('<span style="color: red;">No More Data </span>')
                        return ;
                    }
                    for ($workspace in data) {
                        html += `
                       <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="fs-3 accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-{{ $workspace->id }}" aria-expanded="false"
                            aria-controls="flush-{{ $workspace->id }}">
                            <i class="fs-5 fas fa-arrow-right"></i>&nbsp;{{ $workspace->name }}
                        </button>
                    </h2>
                    <div id="flush-{{ $workspace->id }}" class="accordion-collapse collapse p-2"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body d-flex justify-content-between">
                            <div class="d-flex align-items-center" style="max-width: 50%">
                                <img src="{{ $workspace->image_path ? asset('storage/' . $workspace->image_path) : asset('gsg.png') }}"
                                    style="max-width:100%;" alt="">
                            </div>
                            <div class="w-100 text-center">
                                <div>
                                    <h1 class="text-success">Book Now</h1>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Capacity: </th>
                                            <td>{{ $workspace->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description: </th>
                                            <td>{{ $workspace->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location: </th>
                                            <td>{{ $workspace->location }}</td>
                                        </tr>
                                        <form action="{{ route('site.trainingHalls.booking', $workspace->id) }}"
                                            method="post">
                                            <input type="hidden" name="training_hall_id" value="{{ $workspace->id }}">
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
 </div>`;
                    }

                    $('#accordionFlushExample').append(html);
                }, 'json');
            }

            $(document).ready(function () {
                $('#load').on('click', function () {
                    page++;
                    load(page);
                });
            })
        }(jQuery))
    </script>
    <x-alertscript />
@endpush
