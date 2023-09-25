

@extends('master')
@section('title', 'Show Booking')
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Booking</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Show Booking</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .color-info{
            color: blue;
        }
    </style>
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Information</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-alert :type="$type" :msg="$msg" />



                                <div class="card-body p-2">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label class="col-form-label d-block mb-1">
                                                Booking Id: <span class="color-info">{{ $booking->id }}</span>
                                            </label>

                                            <label class="col-form-label d-block mb-1">
                                                User Name: <span class="color-info">{{ $booking->user?->name }}</span>
                                            </label>

                                            <label class="col-form-label d-block mb-1">
                                                @if ($booking->training_hall_id)
                                                    Training Hall: <span class="color-info">{{ $booking->trainingHall?->name }}</span>
                                                @else
                                                    Workspace: <span class="color-info">{{ $booking->workspace?->name }}</span>
                                                @endif
                                            </label>

                                            <label class="col-form-label d-block mb-1">
                                                Status: <span class="badge badge-{{ $booking->status == 'denied' ? 'danger': 'primary' }}">{{ $booking->status }}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label d-block mb-1">
                                                Booking Date: <span class="color-info">{{ $booking->booking_datetime?->format('Y-m-d') }}</span>
                                            </label>

                                            <label class="col-form-label d-block mb-1">
                                                Start At: <span class="color-info">{{ $booking->startAt }}</span>
                                            </label>

                                            <label class="col-form-label d-block mb-1">
                                                End At: <span class="color-info">{{ $booking->endAt }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="m-3">
                                        <form action="{{ route('bookings.update', $booking->id) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                           <div class="form-group row">
                                               <label for="status" class="col-form-label">Booking Request</label>
                                               <select name="status" id="status" class="form-control">
                                                   <option value="denied">Reject</option>
                                                   <option value="accepted">Accept</option>
                                               </select>
                                           </div>

                                            <div class="text-center">
                                                <button class="btn btn-secondary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
