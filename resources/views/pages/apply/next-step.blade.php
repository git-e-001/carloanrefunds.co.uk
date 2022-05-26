@extends('layouts.app')


@push('style')
    <style>
        .bg_color{
            background-color: #D5E8ED!important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid bg_color">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12">

                    @include('admin.components.messages')

                    <h1>Your Claim</h1>
                    <p>{{ $customer->first_name }}, thank you for signing our Terms of Business. Now we need to know
                        more about your borrowings.</p>
                    <p>It is important that we provide accurate information to the lenders about the claims.</p>
                    <p>What we will do is to ask each lender to send you a "Statement of Account" so we know what to
                        base the claim on.</p>
                    <p>We will prepare, and send you, an email letter which you need to forward to the lenders to ask
                        for account details.
                        We’ll give you the email address needed for each of your lenders too. It really is very simple
                        and it works!
                        Sometimes the lenders actually find loans that our customers had forgotten about, which is
                        always a bonus!</p>
                    <p>As soon as the lender returns the information to you, you simply send it to us and we will review
                        your borrowings and decide if you have a valid claim.</p>
                    <p></p>
                    <p></p>
                    <div class="col-xs-8 col-xs-offset-2" style="margin-bottom: 20px;">
                        <a href="{{ route('apply.customer.no-info.loans') }}" class="btn btn-warning btn-block"
                           style="white-space: normal">
                            CLICK HERE TO TELL US WHO YOUR LENDERS ARE </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
