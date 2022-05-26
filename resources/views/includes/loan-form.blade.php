{{ Form::open([
    'url' => Request::url(),
    'class' => 'form-horizontal'
]) }}
    <fieldset>
        <legend>Lender and agreement</legend>
        <div class="form-group">
            <label class="col-sm-6 col-lg-5 control-label">Lender</label>
            <div class="col-sm-5">
                {{
                    Form::select(
                        'lender',
                        $lenders,
                        ($loan->lender_id === null) ? 'Please Select' : $loan->lender_id,
                        [
                            'class' => 'form-control input-md'
                        ]
                    )
                }}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-6 col-lg-5  control-label">Date of borrowing</label>
            <div class="clearfix visible-xs"></div>

            <div class="col-xs-8 col-sm-3 col-md-2">
                {{ Form::selectMonth('month', $loan->date->format('m')) }}
            </div>
            <div class="col-xs-4 col-sm-3 col-md-2">
                {{ Form::selectRange('year', 2007, 2014, $loan->date->format('Y')) }}
            </div>
        </div>
        <p class="text-muted">Because of much tighter regulations that came into force for lenders during 2014 we cannot handle claims for loans issued AFTER 31st December 2014.</p>
        <div class="clearfix"></div>

        <div class="form-group">
            <label class="col-sm-6 col-lg-5 control-label">Agreement number/ID</label>
            <div class="col-sm-4 col-md-4">
                {{
                    Form::text(
                        'agreement_id',
                        $loan->agreement_id,
                        [
                            'class' => 'form-control input-md',
                            'placeholder' => 'Not required'
                        ]
                    )
                }}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-6 col-lg-5 control-label">Original loan amount (capital borrowed)</label>
            <div class="col-sm-4 col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">&pound;</span>
                    {{
                        Form::tel(
                            'capital',
                            $loan->capital,
                            [
                                'class' => 'form-control input-md',
                                'placeholder' => 'e.g. 500',
                                'pattern' => '[0-9]*'
                            ]
                        )
                    }}
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Loan history</legend>

        <div class="form-group">
            <label class="col-sm-8 col-md-8 control-label">Have you complained to your lender about this loan before?</label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('previously_claimed', 1, $loan->previous_claimed, ['required' => 1]) }}
                Yes
            </label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('previously_claimed', 0, !$loan->previous_claimed, ['required' => 1]) }}
                No
            </label>
        </div>

        <div class="form-group">
            <label class="col-sm-8 col-md-8 control-label">Was this loan originally due to be repaid in a single repayment (normally on your next payday)?</label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('single_repayment', 1, $loan->single_repayment, ['required' => 1]) }}
                Yes
            </label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('single_repayment', 0, !$loan->single_repayment, ['required' => 1]) }}
                No
            </label>
        </div>

        <div class="form-group">
            <label class="col-sm-8 col-md-8 control-label">How many times did you rollover or extend your loan (that is by paying just the interest and keeping the loan for another month)?</label>
            <div class="col-sm-3 col-md-2">
                {{
                    Form::text(
                        'rollovers',
                        $loan->rollovers,
                        [
                            'class' => 'form-control input-md',
                            'placeholder' => 'e.g. 5'
                        ]
                    )
                }}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-8 col-md-8 control-label">Did you miss a payment on this loan or any of its rollovers and the lender offered to let you rollover again to get you out of debt? Y/N</label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('missed_payment_rollover_offered', 1, $loan->missed_payment_rollover_offered, ['required' => 1]) }}
                Yes
            </label>
            <label class="checkbox col-sm-2 col-md-1">
                {{ Form::radio('missed_payment_rollover_offered', 0, !$loan->missed_payment_rollover_offered, ['required' => 1]) }}
                No
            </label>
        </div>

        <div class="form-group">
            <label class="col-xs-12 control-label">What best describes the last loan in this series* of rollovers?</label>
                @foreach ($states as $state_id => $state)
                    <label class="checkbox col-offset-1 col-xs-10">
                        {{ Form::radio('state', $state_id, $loan->state_id === $state_id, ['required' => 1]) }}
                        {{$state}}
                    </label>
                @endforeach
            </label>
        </div>

    </fieldset>

    <button name="add" class="btn btn-primary pull-right">Save loan</button>
{{ Form::close() }}

<p><small>* We refer to a 'Loan Series' as an initial loan followed by a number of rollovers or extensions. If a loan is fully repaid and then you take out a new loan, this would be a new loan series.</small></p>