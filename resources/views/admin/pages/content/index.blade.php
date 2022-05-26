@extends('admin.layouts.app')

@section('title', 'Content')

@push('style')
    <style>

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            float: right;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked + .slider {
            background-color: #8bc34a;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Content</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Content</li>
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
                    <div class="col-12">
                        <div class="ibox-content mb-2">
                            <div class="row">
                                <div class="col-sm-10">
                                    <form action="{{ route('admin.pages.index') }}" method="get" role="form">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="perPage" class="control-label">Records Per
                                                            Page</label>
                                                    </div>
                                                    <div class="col-md-4 col-sm-3 col-3">
                                                        <select name="perPage" id="perPage" onchange="submit()"
                                                                class="input-sm form-control custom_field_height">
                                                            <option value="10">
                                                                10
                                                            </option>
                                                            <option value="25">
                                                                25
                                                            </option>
                                                            <option value="50">
                                                                50
                                                            </option>
                                                            <option value="100">
                                                                100
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-7">
                                                        <div class="float-left input-group">
                                                            <input name="keyword" type="text" value=""
                                                                   class="input-sm form-control custom_field_height"
                                                                   placeholder="Search Here">
                                                            <span class="input-group-btn">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger custom_field_height"> Go!</button>
                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2 col-2 text-right">
                                                        <span>
                                                            <a href="{{ route('admin.pages.index') }}"
                                                               class="btn btn-danger btn-sm custom_field_height">Reset
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-2 d-flex align-items-center">
                                    <div>
                                        <a href="{{ route('admin.pages.create') }}"
                                           class="btn btn-sm btn-danger float-right">
                                            <i class="fa fa-plus"></i> <strong>Create</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="navbar-danger text-white">
                                    <tr>
                                        <th>Published</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Content Count</th>
                                        <th>Updated At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($pages as $page)
                                        @if($page->slug !== 'welcome-page')
                                            <tr>
                                                <td>{{ $page->created_at->diffForHumans() }}</td>
                                                <td>{{ $page->title }}</td>
                                                <td>{{ $page->slug }}</td>
                                                <td>{{ count($page->contents) }}</td>
                                                <td>{{ $page->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <label class="switch ">
                                                        <input type="checkbox" onclick="changeStatus(this)"
                                                               id="{{ $page->id }}"
                                                               data-route="{{ route('admin.pages.status.change', '') }}"
                                                               {{ $page->status ? 'checked' : '' }} class="success">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pages.edit', @$page->id)  }}" title="Edit"
                                                       class="btn btn-info btn-sm cus_btn">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="/{{$page->slug}}" title="View the page"
                                                       class="btn btn-info btn-sm cus_btn">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <button onclick="deleteRow({{ @$page->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$page->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.pages.destroy', @$page->id) }}">
                                                        @method('DELETE')
                                                        @csrf()
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="7">No Records</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->


                    {{ $pages->links() }}


                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


