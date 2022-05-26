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
                    <h2>{{ $customer->first_name }}, your application has now been submitted to our team.</h2>
                    <p>You will now receive an email with a letter in it that needs to be downloaded and then
                        reattached and
                        emailed to the lender. We will provide the email address for each lender when we send each
                        letter.</p>
                    <p>Where you have asked for letters for more than one lender these will come in separate
                        emails.</p>
                    <p>Please note the emails are sent out automatically at 8am the following day you applied.
                        Please check
                        that these emails do not end up in your spam or junk folder and if you have not heard from
                        us within
                        this time then please email is at <a href="mailto:claimsteam@carloanrefunds.co.uk">claimsteam@carloanrefunds.co.uk</a>.
                    </p>
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
