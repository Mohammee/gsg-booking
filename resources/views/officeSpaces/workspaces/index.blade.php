@extends('master')
@section('title', 'Workspaces')
@push('styles')
    <style>
        .widget-user .card-footer {
            padding-top: 0 !important;
        }

        .widget-user .widget-user-header {
            position: relative;
        }

        .widget-user .widget-user-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
            height: 100%;
            z-index: 5;
        }

        .widget-user-desc {
            position: absolute;
            right: 25px;
            top: 12px;
            z-index: 10 !important;
            font-size: 22px
        }
    </style>
@endpush
@section('top-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Workspaces</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Workspaces</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <x-alert :type="$type" :msg="$msg" />
    <div class="d-flex justify-content-between my-3 mx-3">
        <div class=""></div>
        <x-search />
    </div>


    <div class="row mx-2">
        @foreach ($workspaces as $workspace)
            <div class="col-md-4">
                <div class="card card-widget widget-user">


                    @if ($workspace->image_path)
                        <div class="widget-user-header text-white"
                            style="background: url('{{ asset('storage/' . $workspace->image_path) }}') center center;">
                            <h2 class="widget-user-desc text-right">{{ $workspace->name }}</h2>
                        </div>
                    @else
                        <div class="widget-user-header text-white"
                            style="background: url('{{ asset('gsg.png') }}') center center;">
                            <h2 class="widget-user-desc text-right">{{ $workspace->name }}</h2>
                        </div>
                    @endif



                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <span class="description-text">Capacity</span>
                                    <h5 class="description-header">{{ $workspace->capacity }}</h5>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 ">
                                <div class="description-block">
                                    <span class="description-text">Location</span>
                                    <h5 class="description-header">{{ $workspace->location }}</h5>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <p>{{ $workspace->description }}</p>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class=""></div>
                            <div class="">
                                <div class="row">
                                    <a href="{{ route('workspaces.edit', $workspace->id) }}"
                                        class="btn text-secondary"><i class="fas fa-edit"></i></a>
                                    <div>

                                        <button type="submit" class="btn-delete btn text-danger"><i
                                                class="fas fa-trash"></i></button>
                                        <form action="{{ route('workspaces.destroy', $workspace->id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach
        @if (!$workspacesCount)
            <div class="alert alert-warning w-100"><i class="fas fa-exclamation-circle"></i> No Workspaces yet</div>
        @endif
    </div>
    <div class="px-2">
        {{ $workspaces->withQueryString()->links() }}
    </div>
@endsection
@push('scripts')
    <x-delete-btn />
@endpush


