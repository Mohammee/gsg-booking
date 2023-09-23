@extends('master')
@section('title', "Edit $member->name information")
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit {{ $member->name }} information </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('members.update', $member->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <x-input value="{{ $member->name }}" name="name" placeholder="Enter name"
                                    label="User Name" required />
                                <x-input value="{{ $member->email }}" name="email" type="email"
                                    placeholder="Enter email" label="Email address" required />
                                <x-input name="password" type="password" placeholder="Password" label="Password" requierd />

                                <div class="form-group d-flex">
                                    <label class="mr-3">Role</label>
                                    <div class="custom-control custom-radio mr-3">
                                        <input class="custom-control-input @error('role') is-invalid @enderror"
                                            type="radio" id="user" name="role" value="user"
                                            @checked($member->role == 'user')>
                                        <label for="user" class="custom-control-label">User</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input @error('role') is-invalid @enderror "
                                            type="radio" id="admin" name="role" value="admin"
                                            @checked($member->role == 'admin')>
                                        <label for="admin" class="custom-control-label">Admin</label>
                                        <x-error name="role" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
