@extends('admin.layouts.app')

@section('title', 'Menu Edit')


@push('style')

@endpush

@section('content')

    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.menu-items.index') }}">Menu</a></li>
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
                    <div class="col-md-8">
                        <!-- jquery validation -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update <strong>{{ @$menu->name }} : {{ $menuItem->name }}</strong>  Menu</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.menu-items.update', @$menuItem->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    @include('admin.pages.menu.element')
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-danger"
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

{{--    <script>--}}
{{--        $(".addWidget").on('click', function (event) {--}}
{{--            event.preventDefault();--}}

{{--            $("#appendAnotherRow").append($(".coppyMe").html())--}}
{{--        })--}}
{{--    </script>--}}

@endpush
