@extends('admin.layouts.app')
@section('title', 'Change password')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}" class="h1"><b>{{ config('app.name') }}</b></a>
                </li>
                <li class="active">
                    <strong>Change Password</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Change Password</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <form role="form" action="{{ route('admin.password.update') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label>Old Password</label><span class="required-star"> *</span>
                                        <input name="old_password" type="password" placeholder="Enter old password"
                                               class="form-control">

                                        @error('old_password')
                                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label><span class="required-star"> *</span>
                                        <input name="password" type="password" placeholder="Enter new password"
                                               class="form-control">

                                        @error('password')
                                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label><span class="required-star"> *</span>
                                        <input name="password_confirmation" type="password"
                                               placeholder="Enter confirm password" class="form-control">

                                        @error('confirm_password')
                                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">
                                            <strong>Update</strong>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
