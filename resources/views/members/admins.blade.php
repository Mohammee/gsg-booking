@extends('master')
@section('title', 'Admins List')
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Admins</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Admins</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <x-alert :type="$type" :msg="$msg" />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All admins information</h3>

                    <div class="card-tools">
                        <x-search />

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">

                        @if ($adminsCount)
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Added At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('members.edit', $admin->id) }}"
                                                class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn-delete btn btn-outline-danger"><i
                                                    class="fas fa-trash"></i></button>
                                            <form action="{{ route('members.destroy', $admin->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <div class="m-2 alert alert-warning "><i class="fas fa-exclamation-circle"></i> No Admins yet
                            </div>
                        @endif
                    </table>
                    <div class="px-2">
                        {{ $admins->withQueryString()->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <x-delete-btn />
@endpush
