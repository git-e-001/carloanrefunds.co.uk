@extends('admin.layouts.app')

@section('title', 'Slider Edit')

@section('content')

    <div class="content-wrapper">
        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Slider Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <div class="card-body">
                                    @include('admin.pages.slider.element')
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-danger" type="submit">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
