@extends('admin.layouts.app')

@section('title', 'agreements')

@push('style')

@endpush

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Agreement</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agreement</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">


        <!-- Main Agreement -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="ibox-content mb-2">
                            <div class="row">
                                <div class="col-sm-10">
                                    <form action="{{ route('admin.agreements.index') }}" method="get" role="form">
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
                                                            <a href="{{ route('admin.agreements.index') }}"
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
                                        <a href="{{ route('admin.agreements.create') }}"
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
                                        <th>Name</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($agreements as $agreement)
                                        <tr>
                                            <td>{{ $agreement->name }}</td>
                                            <td>{!! $agreement->content !!}</td>
                                            <td>
                                                <a href="{{ route('admin.agreements.edit', @$agreement->id)  }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button onclick="deleteRow({{ @$agreement->id }})"
                                                        href="JavaScript:void(0)"
                                                        title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form id="row-delete-form{{ @$agreement->id }}" method="POST"
                                                      class="d-none"
                                                      action="{{ route('admin.agreements.destroy', @$agreement->id) }}">
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                            </td>
                                        </tr>
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
                    {{ $agreements->links() }}
                    <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


