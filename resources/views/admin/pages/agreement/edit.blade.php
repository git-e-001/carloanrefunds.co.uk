@extends('admin.layouts.app')

@section('title', 'Agreement Edit')


@push('style')

@endpush

@section('content')

    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agreement Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.agreements.index') }}">Agreement</a></li>
                            <li class="breadcrumb-item active">Update</li>
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
                                <h3 class="card-title">Update Agreement</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.agreements.update', $agreement) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    @include('admin.pages.agreement.element')
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <a href="{{ route('admin.agreements.index') }}" class="btn btn-danger"
                                           type="submit">Cancel</a>
                                        <button class="btn btn-success" type="submit">Save</button>
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
@endsection

@push('script')

    <script>
        $(".addWidget").on('click', function (event) {
            event.preventDefault();

            $("#appendAnotherRow").append($(".coppyMe").html())
        })
    </script>

@endpush
