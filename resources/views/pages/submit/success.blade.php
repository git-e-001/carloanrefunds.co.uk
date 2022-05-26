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
                    <h2>{{$customer->first_name}}, your application has now been submitted to our team.</h2>
                    <p>We have just sent you an automated email with details of the claims you have asked us to
                        investigate, along with some instructions to help get your claim started. Please check your
                        email (including the SPAM or JUNK folders)</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <!-- Event snippet for Complete application form conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-849463995/wV1mCJeAoHgQu5WHlQM'});
    </script>
@endpush
