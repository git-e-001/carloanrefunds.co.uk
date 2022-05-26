@extends('admin.layouts.app')
@section('title', 'Setting Update')

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
                        <h1>Setting Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Setting</a></li>
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
                                <h3 class="card-title">Update Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.settings.update', $setting->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <div class="card-body">

                                    <div class="form-group">
                                        <label id="header_top_title" class="control-label">Header Top Text</label>
                                        <textarea id="header_top_title"
                                                  name="header_top_title"
                                                  class="form-control TextEditor">{{isset($setting->header_top_title) ? $setting->header_top_title : old('header_top_title')}}</textarea>
                                        @error('header_top_title')
                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                         </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label id="site_top_bar_bg_color" class="control-label">Header Top Background
                                            Color</label>
                                        <input type="text" class="form-control colorPicker col-3"
                                               name="site_top_bar_bg_color"
                                               value="{{ isset($setting->site_top_bar_bg_color) && $setting->site_top_bar_bg_color ?  $setting->site_top_bar_bg_color : old('site_top_bar_bg_color')}}"/>
                                        @error('site_top_bar_bg_color')
                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input accept="image/*" onchange="previewImage(this);" type="file"
                                                       name="logo"
                                                       class="custom-file-input file-src" id="logo">
                                                <label class="custom-file-label" for="logo">Choose file</label>
                                            </div>
                                        </div>

                                        @error('logo')
                                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if(isset($setting) && @$setting->image->base_path)
                                        <div class="image-sec-hide">
                                            <div class="d-flex">
                                                <img class="mb-3 img-thumbnail" id="old_img"
                                                     src="{{ @$setting->image->url }}" width="100px"
                                                     style="height: 100px">
                                                <a onclick="deleteImage(this, '{{ @$setting->image->base_path }}', '{{ @$setting->id }}')"
                                                   class="text-danger image-delete ml-2" href="javascript:void(0)">
                                                    <i class="fa fa-trash image_preview_delete_icon"></i></a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="image-sec-hide">
                                        <div class="d-flex">
                                            <img id="preview_image" class="mb-3 display_none" width="100px"
                                                 height="100px">
                                            <a onclick="chancelImage(this, 'file-src')"
                                               class="text-danger ml-2 chancel_btn display_none" href="#">
                                                <strong class="h4">X</strong>
                                            </a>
                                        </div>
                                    </div>

                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label id="description_one" class="control-label">Footer Address</label>--}}
                                    {{--                                        <textarea class="form-control TextEditor" name="description_one" id="description_one">{{ isset($setting->description_one) && $setting->description_one ? $setting->description_one : old('description_one')}}</textarea>--}}
                                    {{--                                        @error('description_one')--}}
                                    {{--                                        <span class="help-block m-b-none text-danger">--}}
                                    {{--                                            {{ $message }}--}}
                                    {{--                                        </span>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}

                                    <div class="form-group">
                                        <label id="description_two" class="control-label">Footer Top Sections
                                            Descriptions</label>
                                        <textarea class="form-control TextEditor" name="description_two"
                                                  id="description_two">{{ isset($setting->description_two) && $setting->description_two ?  $setting->description_two : old('description_two')}}</textarea>
                                        @error('description_two')
                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label id="footer_top_section_bg_color" class="control-label">Footer Top Sections
                                            Background Color</label>
                                        <input type="text" class="form-control colorPicker col-3"
                                               name="footer_top_section_bg_color"
                                               value="{{ isset($setting->footer_top_section_bg_color) && $setting->footer_top_section_bg_color ?  $setting->footer_top_section_bg_color : old('footer_top_section_bg_color')}}"/>
                                        @error('footer_top_section_bg_color')
                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           {{ isset($setting) && $setting->status ? 'checked':old('status') }}
                                                           name="status" class="success">
                                                    <span class="slider round"></span>
                                                </label>
                                                Publication Status
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="form-group">
                                            <a href="{{ route('admin.settings.index') }}" class="btn btn-danger"
                                               type="submit">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Save Change</button>
                                        </div>
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

@push('script')

@endpush
