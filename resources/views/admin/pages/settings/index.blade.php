@extends('admin.layouts.app')

@section('title', 'Settings')

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
                        <h1>Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Setting</li>
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

                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="navbar-danger text-white">
                                    <tr>
                                        <th>Header Title</th>
                                        <th>Logo</th>
                                        {{--                                        <th>Footer Logo</th>--}}
                                        <th>Footer Content</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($settings as $setting)
                                        <tr>
                                            <td class="text-left">{!! ucfirst(Str::limit(@$setting->header_top_title, 50))  !!}</td>
                                            <td>
                                                @php
                                                    $image = $setting->image && $setting->image()->where('type', 'logo')->first()? $setting->image()->where('type', 'logo')->first()->url : ''
                                                @endphp
                                                <img width="100" height="100"
                                                     src="{{ $image }}"
                                                     alt="{{$image?? 'logo'}}">
                                            </td>
                                            <td class="text-left">{!!  ucfirst(Str::limit(@$setting->description_one, 50)) !!}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.settings.edit', $setting->id)  }}" title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
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
