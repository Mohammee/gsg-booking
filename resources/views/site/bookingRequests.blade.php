@extends('site.master')

@section('title', 'Booking Requests | ' . config('app.name'))

@push('styles')
    <style>
        table th {
            font-size: 17px
        }

        table td,
        table * {
            font-size: 15px
        }
    </style>
@endpush
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Booking Requests</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">Booking Requests</li>
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
        <table class="table table-hover">

            <thead>

                <th>Office space Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($userBookings as $userBooking)
                    <tr>
                        <td>
                            @if ($userBooking->training_hall_id)
                            {{ $userBooking->trainingHall->name }}
                            @else
                               {{ $userBooking->workspace->name }}
                            @endif
                        </td>
                        <td>
                            @if ($userBooking->training_hall_id)
                                Training Hall
                            @else
                                Seat in workspace
                            @endif
                        </td>
                        <td>{{ date('Y-m-d', strtotime($userBooking->booking_datetime)) }}</td>
                        <td>{{ $userBooking->startAt }}</td>
                        <td>{{ $userBooking->endAt }}</td>
                        @if ($userBooking->status == 'pending')
                            <td class="text-warning fw-bold">{{ $userBooking->status }}</td>
                        @elseif ($userBooking->status == 'accepted')
                            <td class="text-success fw-bold">{{ $userBooking->status }}</td>
                        @else
                            <td class="text-danger fw-bold">{{ $userBooking->status }}</td>
                        @endif
                        <td>
                            <button type="submit" class="btn-delete btn text-danger"><i class="fas fa-trash"></i></button>
                            <form action="{{ route('site.bookings.destroy', $userBooking->id) }}" method="post"
                                class="d-inline">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if (!$userBookingsCount)
                    <div class="fs-3 alert alert-warning w-100"><i class="fas fa-exclamation-circle"></i> No booking requests yet
                    </div>
                @endif
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
    <x-delete-btn />
@endpush
