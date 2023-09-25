

@extends('master')
@section('title', 'Bookings List')
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Booking List</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Booking List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('styles')

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
                                    <h3 class="card-title">Bookings</h3>
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

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->user?->name }}</td>
                                            <td>{{ $booking->booking_datetime?->format('Y-m-d') }}</td>
                                            <td><span class="badge badge-{{ $booking->status == 'denied'?'danger':'primary' }}">{{ $booking->status }}</span></td>
                                            <td>
                                                <a href="{{ route('bookings.show', $booking->id) }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">{{ __('No Bookings.') }}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{ $bookings->withQueryString()->links('pagination::bootstrap-5') }}

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
