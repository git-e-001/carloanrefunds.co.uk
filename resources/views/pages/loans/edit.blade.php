@extends('layouts.app')



@section('content')

    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="container-fluid">
                @include('includes/errors')

                <!-- Add loan -->
                <h2>Edit loan for claim</h2>

                @include('includes/loan-form')

            </div>
        </div>
    </div>

@endsection
