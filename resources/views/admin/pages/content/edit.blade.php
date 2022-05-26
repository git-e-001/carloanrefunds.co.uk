@extends('admin.layouts.app')

@section('title', 'Page Edit')


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
                        <h1>Page Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Page</a></li>
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
                                <h3 class="card-title">Update Page</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('admin.pages.update', $page) }}" method="post"
                                  id="contentUpdateForm"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title" class="control-label">Title</label>
                                                <input id="title" type="text"
                                                       value="{{ isset($page) ? $page->title : '' }}"
                                                       name="title" class="form-control" autofocus>
                                                @error('title')
                                                <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="appendNewContent">
                                        <div class="col-12 text-right">
                                            <a href="javascript:void(0)" class="btn btn-primary"
                                               id="addNewContentField">Add New</a>
                                        </div>
                                        @forelse($page->contents as $content)
                                            <div class="col-md-12 mt-5" id="removee-exit-content-{{$content->id}}">
                                                <div class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-danger"
                                                       onclick="existContentSectionRemove(this, {{$content->id}})">
                                                        Remove
                                                    </a>
                                                </div>
                                                <label for="body-{{$content->id}}">Simple Text</label>
                                                <textarea name="body[]" id="body-{{$content->id}}" class="TextEditor"
                                                          required>{!! $content->body !!}</textarea>
                                                <br>
                                                <label>Background Color</label>
                                                <input required type="text" class="colorPicker form-control col-3" name="bg_color[]" value="{{ $content->bg_color }}">
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card" style="margin:50px 0">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <label class="switch ">
                                                            <input type="checkbox"
                                                                   {{ $page->is_home ? 'checked' : '' }} name="is_home"
                                                                   class="success">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        Home
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card" style="margin:50px 0">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <label class="switch ">
                                                            <input type="checkbox"
                                                                   {{ $page->status ? 'checked' : '' }} name="status"
                                                                   class="success">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        Active
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card" style="margin:50px 0">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <label class="switch ">
                                                            <input type="checkbox" {{ $page->is_sitemap ? 'checked' : '' }} name="is_sitemap" class="success">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        Is Site-Map
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group">
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-danger">Cancel</a>
                                        <button class="btn btn-success" id="contentUpdateBtn" type="submit">Save
                                        </button>
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
    @include('admin.pages.content.content-js')

    <script>
        function existContentSectionRemove(el, id) {
            event.preventDefault()
            if (confirm('Are you sure to delete ?')) {
                let url = "{{url('pages/content-remove')}}/" + id
                axios.get(url)
                    .then(res => {
                        if (res.data.success) {
                            toastr.success(res.data.message)
                            $(el).parents('#removee-exit-content-' + id).remove()
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        }


        // start form submit actions
        $("#contentUpdateBtn").click(function (event) {
            event.preventDefault()
            $("#contentUpdateForm").submit()
        })

    </script>
@endpush
