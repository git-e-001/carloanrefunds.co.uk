@extends('admin.layouts.app')

@section('title', 'Change the apply button')

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Apply Button</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Button</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.apply.button.store') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="apply_btn">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="btn_text" class="control-label">Button
                                                    Text</label>
                                                <input id="btn_text" type="text"
                                                       value="{{ isset($page_btn) && $page_btn->btn_text ? $page_btn->btn_text : old('btn_text')  }}"
                                                       name="btn_text" class="form-control" autofocus>

                                                @error('btn_text')
                                                <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="btn_text_color" class="control-label">Text
                                                    Color</label>
                                                <input id="btn_text_color" type="text"
                                                       value="{{ isset($page_btn) && $page_btn->btn_text_color ? $page_btn->btn_text_color : old('btn_text_color')  }}"
                                                       name="btn_text_color" class="form-control colorPicker" autofocus>

                                                @error('btn_text_color')
                                                <span class="help-block m-b-none text-danger">
                                                {{ $message }}
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="btn_link" class="control-label">Button
                                                    Link</label>
                                                <input id="btn_link" type="text"
                                                       value="{{ isset($page_btn) && $page_btn->btn_link ? $page_btn->btn_link : old('btn_link')  }}"
                                                       name="btn_link" class="form-control" autofocus>

                                                @error('btn_link')
                                                <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="header_apply_border_color" class="control-label">Button
                                                    Border Color</label>
                                                <input id="btn_border_color" type="text"
                                                       value="{{ isset($page_btn) && $page_btn->btn_border_color ? $page_btn->btn_border_color : old('btn_border_color')  }}"
                                                       name="btn_border_color" class="form-control colorPicker"
                                                       autofocus>

                                                @error('btn_border_color')
                                                <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="btn_bg_color" class="control-label">Button
                                                    Background Color</label>
                                                <input id="btn_bg_color" type="text"
                                                       value="{{ isset($page_btn) && $page_btn->btn_bg_color ? $page_btn->btn_bg_color : old('btn_bg_color')  }}"
                                                       name="btn_bg_color" class="form-control colorPicker" autofocus>

                                                @error('btn_bg_color')
                                                <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


