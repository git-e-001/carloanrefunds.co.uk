@extends('admin.layouts.app')
@section('title', 'Social')

@section('content')

    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Social Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.socials.index') }}">Socials</a></li>
                            <li class="breadcrumb-item active">Create</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Social</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.socials.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @include('admin.pages.socials.element')
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <a href="{{ route('admin.socials.index') }}" class="btn btn-danger" type="submit">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



{{--    <div class="row wrapper border-bottom white-bg py-3">--}}
{{--        <div class="col-lg-12">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item active">--}}
{{--                    <strong>Social Create</strong>--}}
{{--                </li>--}}
{{--            </ol>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="wrapper wrapper-content animated">--}}
{{--        @include('admin.components.messages')--}}
{{--        <form action="{{ route('admin.socials.store') }}" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="ibox ">--}}
{{--                        <div class="ibox-title">--}}
{{--                            <h5>Create a new social for your company</h5>--}}
{{--                        </div>--}}
{{--                        <div class="ibox-content">--}}
{{--                            <div class="row">--}}
{{--                                @include('admin.pages.socials.element')--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <a href="{{ route('admin.socials.index') }}" class="btn btn-danger" type="submit">Chancel</a>--}}
{{--                                        <button class="btn btn-primary" type="submit">Save</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

@endsection
