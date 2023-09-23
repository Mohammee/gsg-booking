@extends('master')
@section('title', 'Create New Office Space')
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Office Space</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create New Office Space</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .file-input-container {
            position: relative;
            display: inline-block;
        }

        .file-input {
            display: none;
        }

        .file-label {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.2s all ease
        }

        .file-input:focus+.file-label {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .file-label:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Office Space Information</h3>
                        </div>
                        <form method="POST" action="{{ route('officeSpaces.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <x-input name="name" placeholder="Name" label="Name" required />
                                <x-textarea name="description" placeholder="Description" label="Description" />
                                <x-input name="location" placeholder="Location" label="Location" required />
                                <x-input name="capacity" type="number" placeholder="Capacity" label="Capacity" requierd />
                                <div class="file-input-container">
                                    <label for="file-input" class="d-block">Cover Image</label>
                                    <input name="image_path" type="file" id="file-input"
                                        class="file-input @error('image_path') is-invalid @enderror" accept="image/*" />
                                    <label for="file-input" class="file-label">
                                        Choose a File
                                    </label>
                                    <span id="file-name" class="file-name"></span>
                                    <x-error name="image_path" />
                                </div>


                                <div class="form-group d-flex">
                                    <label class="mr-3">Type:</label>

                                    <div class="custom-control custom-radio mr-3">
                                        <input class="custom-control-input @error('type') is-invalid @enderror"
                                            type="radio" id="trainingHall" name="type" value="trainingHall">
                                        <label for="trainingHall" class="custom-control-label">Training Hall</label>

                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input @error('type') is-invalid @enderror"
                                            type="radio" id="workspace" name="type" value="workspace">
                                        <label for="workspace" class="custom-control-label">Workspace</label>
                                        <x-error name="type" />
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
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
@push('scripts')
    <script>
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = `Selected File: ${fileName}`;
            }
        });
    </script>
@endpush
