@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="content-wrapper" style="min-height: 1662.75px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">{{ ucfirst(auth()->user()->name) }}</li>
                            <li class="breadcrumb-item active"> Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">


                        <div class="card card-outline card-danger">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-circle" width="100px" height="100px"
                                         src="{{ auth()->user()->image->url }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ ucwords(auth()->user()->name) }}</h3>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#profile"
                                                            data-toggle="tab">Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#changeProfile"
                                                            data-toggle="tab">Update Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Setting</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                     src="{{ auth()->user()->image->url == '' ?
                                                            asset('backend/dist/img/no-image.jpg') :
                                                             auth()->user()->image->url }}" alt="User Image">
                                                <span class="username">
                                                  <a href="#">{{ auth()->user()->name }}</a>
                                                </span>
                                                <span class="description">{{ auth()->user()->updated_at->diffForHumans()  }}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <img width="100%" class="img-fluid" src="{{ auth()->user()->image->url }}" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><strong>Name:</strong> {{ ucwords(auth()->user()->name) }}</p>
                                                            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="changeProfile">
                                        <!-- The timeline -->
                                        <form action="{{ route('admin.profile.update', Auth::id()) }}" method="post" enctype="multipart/form-data">
                                            @method('patch')
                                            @csrf
                                            <div class="panel-body">

                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input id="name" value="{{ @$admin->name }}" type="text" name="name" class="form-control">
                                                    @error('name')
                                                        <span class="help-block m-b-none text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" value="{{ @$admin->email }}" id="email" class="form-control">

                                                    @error('email')
                                                        <span class="help-block m-b-none text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Profile Image</label>
                                                    <div class="custom-file">
                                                        <input onchange="previewImage(this);" id="image" name="profile_image" type="file" class="file-src custom-file-input">
                                                        <label for="image" class="custom-file-label">Choose file...</label>
                                                    </div>

                                                    @error('image')
                                                        <span class="help-block m-b-none text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                @if(isset($admin) && @$admin->image->base_path)
                                                    <div class="image-sec-hide">
                                                        <div class="d-flex">
                                                            <img class="mb-3 img-thumbnail" id="old_img" src="{{ @$admin->image->url }}" width="100px" style="height: 100px">
                                                            <a onclick="deleteImage(this, '{{ @$admin->image->base_path }}')" class="text-danger image-delete ml-2" href="javascript:void(0)">
                                                                <i class="fa fa-trash image_preview_delete_icon"></i></a>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="image-sec-hide">
                                                    <div class="d-flex">
                                                        <img id="preview_image" class="mb-3 display_none" width="100px" height="100px">
                                                        <a onclick="chancelImage(this, 'file-src')" class="text-danger ml-2 chancel_btn display_none" href="#">
                                                            <strong class="h4">X</strong>
                                                        </a>
                                                    </div>
                                                </div>

                                                <button class="btn btn-sm btn-info" type="submit">Update</button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="settings">
                                        <form action="{{ route('admin.password.change') }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="old_password">Old Password</label>
                                                    <input type="password" id="old_password" name="old_password" class="form-control">

                                                    @error('old_password')
                                                    <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="new_password">New Password</label>
                                                    <input type="password" id="new_password" name="new_password" class="form-control">

                                                    @error('new_password')
                                                    <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">

                                                    @error('confirm_password')
                                                    <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-sm btn-info" type="submit">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
