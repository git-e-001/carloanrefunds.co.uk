@extends('layouts.app')

@push('style')
    <style>
        .bg_color {
            background-color: #D5E8ED !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid px-0 bg_color">
        <div class="container">
            <div class="row py-5">
                <div class="col-12">
                    <h1>Next steps...</h1>

                    <p>We have now received your LOA (letter of authority) and customer contract, applying the electronic signature you have just supplied.</p>
                    <p>Before we can start the claims process we now need to know details about each loan you have asked us to investigate.</p>

                    <p>We appreciate that this may take a while to complete, but it will allow us to put together a strong complaint to the lender.</p>
                    <p>If you cannot find all the information that is fine but the more information we have the more chance we can put together a complaint.</p>
                    <p>You may find the information in a number of places such as in emailed copies of your loan documents sent by the lender, or on your bank statement. If your lender offered you an online 'customer area' this too may have records of your borrowing.</p>
                    <p>If you do not have the time to do this now, or need to look further to find the information please do not worry as we will contact you in the next 7 – 10 days to collect this. Alternatively, you can either call us with the information on 01284 724 651 or email it to claimsteam@carloanrefunds.co.uk</p>

                    <!--<p>We've emailed you a link to get back to this step if you don't have time to do this right now.</p>-->
                    <div class="text-center"><a href="" class="btn btn-primary">Proceed</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
