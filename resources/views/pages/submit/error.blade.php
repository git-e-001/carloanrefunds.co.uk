@extends('layouts.app')
@push('style')
    <style>
        .bg_color {
            background-color: #D5E8ED !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid bg_color">
        <div class="container">
            <div class="row py-5">
                <div class="col-12">
                    <h2>global.error_occurred</h2>
                    <p>submit.error_thank_you_for_submit</p>
                    <p>global.thank_you</p>
                    <p>submit.claims_team</p>
                </div>
            </div>
        </div>
    </div>
@endsection
