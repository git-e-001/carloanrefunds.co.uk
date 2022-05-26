@extends('admin.layouts.app')

@section('title', 'Customer')

@push('style')

@endpush

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                                    <form action="{{ route('admin.customers.index') }}" method="get" role="form">
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
                                                            <a href="{{ route('admin.customers.index') }}"
                                                               class="btn btn-danger btn-sm custom_field_height">Reset
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-2 d-flex align-items-center text-right">
                                        <a href="{{ route('admin.customers.create') }}"
                                           class="btn btn-sm btn-danger float-right">
                                            <i class="fa fa-plus"></i> <strong>Create</strong>
                                        </a>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped table-bordered text-center table-hover" style="font-size: 14px">
                                    <thead class="navbar-danger text-white">
                                    <tr>
                                        <th>Email</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Middle Name</th>
                                        <th>Previous First Name</th>
                                        <th>Previous Last Name</th>
                                        <th>Dob</th>
                                        <th>Telephone Home</th>
                                        <th>Telephone Mobile</th>
                                        <th>Telephone Work</th>
                                        <th>In Iva</th>
                                        <th>In Dmp</th>
                                        <th>Should be Aware</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->title }}</td>
                                            <td>{{ $customer->first_name }}</td>
                                            <td>{{ $customer->last_name }}</td>
                                            <td>{{ $customer->middle_names }}</td>
                                            <td>{{ $customer->previous_first_name }}</td>
                                            <td>{{ $customer->previous_last_name }}</td>
                                            <td>{{ $customer->dob }}</td>
                                            <td>{{ $customer->telephone_home }}</td>
                                            <td>{{ $customer->telephone_mobile }}</td>
                                            <td>{{ $customer->telephone_work }}</td>
                                            <td>{{ $customer->in_iva ? 'Yes' : 'No' }}</td>
                                            <td>{{ $customer->in_dmp ? 'Yes' : 'No' }}</td>
                                            <td>{{ $customer->should_be_aware ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <a href="{{ route('admin.customers.show', @$customer->id)  }}" title="Edit"
                                                   class="btn btn-info btn-xs cus_btn mb-1">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.customers.edit', @$customer->id)  }}" title="Edit"
                                                   class="btn btn-info btn-xs cus_btn mb-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button onclick="deleteRow({{ @$customer->id }})" href="JavaScript:void(0)"
                                                        title="Delete" class="btn btn-danger btn-xs cus_btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form id="row-delete-form{{ @$customer->id }}" method="POST" class="d-none"
                                                      action="{{ route('admin.customers.destroy', @$customer->id) }}">
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="15">No Records</td>
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


                    {{ $customers->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}



                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


