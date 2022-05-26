@extends('admin.layouts.app')

@section('title', 'Sliders')

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
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
                                <div class="col-sm-11">
                                    <form action="{{ route('admin.sliders.index')}}" method="get" role="form">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="perPage" class="control-label">Records Per
                                                            Page</label>
                                                    </div>
                                                    <div class="col-md-4 pr-0 responsive_p_r_15">
                                                        <select name="perPage" id="perPage" onchange="submit()"
                                                                class="input-sm form-control custom_field_height">
                                                            <option
                                                                value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>
                                                                10
                                                            </option>
                                                            <option
                                                                value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>
                                                                25
                                                            </option>
                                                            <option
                                                                value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>
                                                                50
                                                            </option>
                                                            <option
                                                                value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>
                                                                100
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                        <div class="float-left input-group">
                                                            <input name="keyword" type="text"
                                                                   value="{{ request('keyword') }}"
                                                                   class="input-sm form-control custom_field_height"
                                                                   placeholder="Search Here">
                                                            <span class="input-group-btn">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 p-0 responsive_p_l_15">
                                            <span>
                                                <a href="{{ route('admin.sliders.index') }}"
                                                   class="btn btn-default btn-sm custom_field_height">Reset
                                                </a>
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-1 d-flex align-items-end">
                                    <div>
                                        <a href="{{ route('admin.sliders.create') }}"
                                           class="btn btn-sm btn-primary float-right">
                                            <i class="fa fa-plus"></i> <strong>Create</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Image</th>
                                        <th class="text-left">Title</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(@$sliders as $slider)
                                        <tr>
                                            <td>
                                                <img width="100" height="80"
                                                     src="{{ @$slider->image->url ?? asset('backend/dist/img/no-image.jpg')}}"
                                                     alt="{{ @$slider->image->url ?? @$slider->title }}">
                                            </td>
                                            <td class="text-left">{{ ucfirst(Str::limit(@$slider->title, 50)) }}</td>

                                            <td>
                                                <a onclick="changeStatus(this)" id="{{ @$slider->id }}"
                                                   data-route="{{ route('admin.sliders.status.change', '') }}"
                                                   href="javascript:void(0)"
                                                   title="Change publication status">
                                                    @if(@$slider->status)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Disable</span>
                                                    @endif
                                                </a>
                                            </td>


                                            <td class="text-center">

                                                <a href="{{ route('admin.sliders.edit', @$slider->id)  }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                <button onclick="deleteRow({{ @$slider->id }})"
                                                        href="JavaScript:void(0)"
                                                        title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form id="row-delete-form{{ @$slider->id }}" method="POST"
                                                      class="d-none"
                                                      action="{{ route('admin.sliders.destroy', @$slider->id) }}">
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                @if (count(@$sliders))
                                    {{ @$sliders->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                                @else
                                    <div class="text-center"> Slider not found</div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
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


