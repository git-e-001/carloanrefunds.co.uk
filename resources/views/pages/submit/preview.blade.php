@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="container-fluid">
                @include('includes/errors')

                <h2>Submit claim</h2>

                <h3>Claim checklist:</h3>
                <table class="lead">
                    <tr><td><i class="fa fa-check" aria-hidden="true"></i> Personal details supplied</td></tr>
                    <tr><td><i class="fa fa-check" aria-hidden="true"></i> LOA (letter of authority) e-signed</td></tr>
                    <tr><td><i class="fa fa-check" aria-hidden="true"></i> Customer contract e-signed</td></tr>
                    @foreach ($preflightChecks as $description => $passed)
                    <tr><td><i class="fa fa-{{$passed ? 'check' : 'times'}}" aria-hidden="true"></i> {{$description}}</td></tr>
                    @endforeach
                </table>

                @if (array_search(false, $preflightChecks) !== false)
                    <p class="lead">Your claim isn't ready to be submitted yet.  Go back and resolve the issues above to proceed.</p>
                    <hr>
                    <a href="/loans" class="btn btn-primary">Go back</a>
                @else
                    <p class="lead">We have everything needed to process your claim.
                        <br><small>(Feel free to print this page for your own records.)</small></p>
                    <div class="text-center">
                        {{ Form::open([
                            'url' => 'submit',
                        ]) }}
                            <button type="submit" class="btn btn-primary">Submit application</button>
                        {{ Form::close() }}
                    </div>

                    <hr>
                    <h3>Claim summary</h3>

                    @foreach ($loans as $loan_number => $display_loan)
                    <div class="row col-xs-12 col-sm-offset-2 col-sm-8 {{$loan_number %2 === 1 ? 'col-md-offset-2' : 'col-md-offset-0'}} col-md-5 col-lg-5 well well-sm">
                        <div class="col-xs-6 text-right"><strong>Lender:</strong></div>
                        <div class="col-xs-6">{{$display_loan->lender->name}}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 text-right"><strong>Date first borrowed:</strong></div>
                        <div class="col-xs-6">{{$display_loan->date->format('M Y')}}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 text-right"><strong>Capital borrowed:</strong></div>
                        <div class="col-xs-6">&pound;{{$display_loan->capital}}</div>
                        <div class="clearfix"></div>

                        @if ($display_loan->agreement_id !== null)
                            <div class="col-xs-6 text-right"><strong>Agreement ID:</strong></div>
                            <div class="col-xs-6">{{$display_loan->agreement_id}}</div>
                            <div class="clearfix"></div>
                        @endif


                        <div class="col-xs-12 text-center"><strong>Last loan in this series of rollovers:</strong><br>"{{$display_loan->state->description}}"</div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
