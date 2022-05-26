@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="container-fluid">
                @include('includes/errors')

                {{ Form::open([
                    'url' => 'apply/partial-loans/add',
                    'class' => 'form-horizontal',
                    'id' => 'partial-loans-form'
                ]) }}
                    <h2>Your loans</h2>
                    <p>Please add all the lenders you have had a loan with:</p>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Lender:</label>
                        <div class="col-sm-5">
                            {{
                                Form::select(
                                    'lender_list',
                                    $lenders,
                                    'Please Select',
                                    [
                                        'class' => 'form-control input-md',
                                        'v-model' => 'lender_name'
                                    ]
                                )
                            }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">(Or enter manually:)</label>
                        <div class="col-md-4">
                            {{
                                Form::text(
                                    'lender_name',
                                    '',
                                    [
                                        'class' => 'form-control input-md',
                                        'placeholder' => 'e.g. Finance Me 123',
                                        'v-model' => 'lender_name'
                                    ]
                                )
                            }}
                        </div>
                    </div>

                    <p>Please select the number of loans taken with each lender (Please only count NEW loans where the funds were physically sent to your bank. We will be asking about Rollovers or Extension Loans later)</p>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Number of loans:</label>
                        <div class="col-md-4">
                            {{
                                Form::number(
                                    'loans',
                                    '',
                                    [
                                        'class' => 'form-control input-md',
                                        'placeholder' => 'e.g. 3'
                                    ]
                                )
                            }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add lender</button>
                {{ Form::close() }}

                <div class="table-responsive well">
                    <h3>Your lenders</h3>
                    @if ($partialLoans->count() === 0)
                        <p>You have not yet entered any lenders.  Start by entering one above.</p>
                    @else
                        <table class="table table-striped table-bordered">
                        @foreach ($partialLoans as $partialLoanNumber => $partialLoan)
                            <tr>
                                <td>{{$partialLoan->lender}}</td>
                                <td>{{$partialLoan->loans}}</td>
                                <td width="1"><a href="/apply/partial-loans/{{$partialLoanNumber + 1}}/delete" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                        </table>

                        <p>Once you've added all your lenders, click "Continue".
                            <a href="/apply/esign" class="pull-right btn btn-primary">Continue</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
