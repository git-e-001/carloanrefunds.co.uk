@extends('layouts/app')

@section('styles')
<style>
    body:before {
        content: "mobile";
        display: none;
    }

    @media (min-width: 576px) {
        body:before {
            content: "mobile";
        }

        .loan-container {
            padding-left:14px;
            padding-right:14px;
        }
    }

    @media (min-width: 768px) {
        body:before {
            content: "tablet";
        }

        .loan-container {
            padding-left:14px;
            padding-right:14px;
        }
    }

    @media (min-width: 992px) {
        body:before {
            content: "desktop";
        }

        .loan-container {
            padding-left:85px;
            padding-right:85px;
        }
    }

    @media (min-width: 1200px) {
        body:before {
            content: "desktop";
        }

        .loan-container {
            padding-left:85px;
            padding-right:85px;
        }
    }
</style>
@append

@section('content')

    <div class="row">
        <div class="col-xs-12 loan-container">
            <div class="container-fluid">
                <h2>@lang('loan.your_claim')</h2>
                <p>{{$customer->first_name}}@lang('loan.thank_you')</p>
                <p>@lang('loan.enter_new_loan')</p>
                <p>@lang('loan.may_take_while')</p>
                <p>@lang('loan.find_information')</p>
                <p><strong>@lang('loan.dont_know_details')</strong></p>
                <p><strong>@lang('loan.not_know_details')</p>
                <div id="loan-table">
                    <div v-if="breakpoint != 'desktop'">
                        <h3>@lang('loan.lender_and_loan_details')</h3>
                        <template v-for="(loan, key) in loans">
                            <div v-if="!loan.deleted" class="well">
                                <div class="col-xs-12 col-sm-6" style="padding:0 2px">
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][lender_id]')}">
                                        <label>@lang('loan.lender')</label>
                                        <select class="form-control" v-model="loan.lender_id" v-validate="'required'" :name="'loans['+key+'][lender_id]'">
                                            <option :value="null" disabled>@lang('loan.choose_lender')</option>
                                            @foreach($lenders as $id => $lender)
                                                <option value="{{$id}}">{{$lender}}</option>
                                            @endforeach
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][lender_id]')" class="help-block"><% errors.first('loans['+key+'][lender_id]') %></span>
                                    </div>
                                    <div v-if="loan.lender_id == 0" class="form-group" :class="{'has-error': errors.has('loans['+key+'][lender_name]')}">
                                        <input type="text" class="form-control" placeholder="Name" v-model="loan.lender_name" v-validate="'required'" :name="'loans['+key+'][lender_name]'">
                                        <span v-show="errors.has('loans['+key+'][lender_name]')" class="help-block"><% errors.first('loans['+key+'][lender_name]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][month]')}">
                                        <label>@lang('loan.date_of_loan')</label>
                                        <select class="form-control" v-model="loan.month" v-validate="'required'" :name="'loans['+key+'][month]'">
                                            <option :value="null" disabled>Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][month]')" class="help-block"><% errors.first('loans['+key+'][month]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][year]')}">
                                        <select class="form-control" v-model="loan.year" v-validate="'required'" :name="'loans['+key+'][year]'">
                                            <option :value="null" disabled>Year</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][year]')" class="help-block"><% errors.first('loans['+key+'][year]') %></span>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('loan.agreement_number')</label>
                                        <input type="text" class="form-control" placeholder="If known" v-model="loan.agreement_id">
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][capital]')}">
                                        <label>@lang('loan.loan_amount')</label>
                                        <input type="number" min="0" class="form-control" v-model="loan.capital" v-validate="'required|numeric'" :name="'loans['+key+'][capital]'">
                                        <span v-show="errors.has('loans['+key+'][capital]')" class="help-block"><% errors.first('loans['+key+'][capital]') %></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6" style="padding:0 2px">
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][previously_claimed]')}">
                                        <label>@lang('loan.complained_before')</label>
                                        <select class="form-control" v-model="loan.previously_claimed" v-validate="'required'" :name="'loans['+key+'][previously_claimed]'">
                                            <option :value="null" disabled>Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][previously_claimed]')" class="help-block"><% errors.first('loans['+key+'][previously_claimed]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][single_repayment]')}">
                                        <label>@lang('loan.was_payday_loan')</label>
                                        <select class="form-control" v-model="loan.single_repayment" v-validate="'required'" :name="'loans['+key+'][single_repayment]'">
                                            <option :value="null" disabled>Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][single_repayment]')" class="help-block"><% errors.first('loans['+key+'][single_repayment]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][rollovers]')}">
                                        <label>@lang('loan.how_many_rollovers')</label>
                                        <select class="form-control" v-model="loan.rollovers" v-validate="'required'" :name="'loans['+key+'][rollovers]'">
                                            <option :value="null" disabled>Choose</option>
                                            @for($i = 1; $i < 31; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][rollovers]')" class="help-block"><% errors.first('loans['+key+'][rollovers]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][missed_payment_rollover_offered]')}">
                                        <label>@lang('loan.get_into_arrears')</label>
                                        <select class="form-control" v-model="loan.missed_payment_rollover_offered" v-validate="'required'" :name="'loans['+key+'][missed_payment_rollover_offered]'">
                                            <option :value="null" disabled>Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][missed_payment_rollover_offered]')" class="help-block"><% errors.first('loans['+key+'][missed_payment_rollover_offered]') %></span>
                                    </div>
                                    <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][state_id]')}">
                                        <label>@lang('loan.describe_last_loan')</label>
                                        <select class="form-control" v-model="loan.state_id" v-validate="'required'" :name="'loans['+key+'][state_id]'">
                                            <option :value="null" disabled>Choose</option>
                                            @foreach ($states as $state_id => $state)
                                                <option value="{{$state_id}}">{{$state}}</option>
                                            @endforeach
                                        </select>
                                        <span v-show="errors.has('loans['+key+'][state_id]')" class="help-block"><% errors.first('loans['+key+'][state_id]') %></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <div v-if="loan_count > 1" class="form-group text-right" style="margin-top:10px">
                                        <button type="button" class="btn btn-primary" v-on:click="remove(key)">@lang('global.delete')</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </template>

                        <div class="col-xs-12 col-sm-6" style="margin-bottom:10px;">
                            <button type="button" class="btn btn-primary btn-block" v-on:click="add()">@lang('loan.new_loan_or_lender')</button>
                        </div>
                        <div class="col-xs-12 col-sm-6" style="margin-bottom:10px;">
                            <button :disabled="loading" type="button" class="btn btn-primary btn-block" v-on:click="submit()">
                                <span v-if="!loading">@lang('global.submit')</span>
                                <span v-else><i class="fa fa-refresh fa-spin"></i></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div v-if="breakpoint == 'desktop'">
                        <div class="table-responsive well">
                            <h3>@lang('loan.lender_and_loan_details')</h3>

                            <template v-if="!loan.deleted" v-for="(loan, key) in loans">
                                <table class="table table-striped table-bordered table-responsive" style="margin:0;border-bottom: 0">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('loan.lender')
                                        </th>
                                        <th>
                                            @lang('loan.date_of_loan')
                                        </th>
                                        <th>
                                            @lang('loan.agreement_number')
                                        </th>
                                        <th>
                                            @lang('loan.loan_amount')
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="border-bottom: 0">
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][lender_id]')}">
                                                <select class="form-control" v-model="loan.lender_id" v-validate="'required'" :name="'loans['+key+'][lender_id]'">
                                                    <option :value="null" disabled>@lang('loan.choose_lender')</option>
                                                    @foreach($lenders as $id => $lender)
                                                        <option value="{{$id}}">{{$lender}}</option>
                                                    @endforeach
                                                    <option value="0">Other</option>
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][lender_id]')" class="help-block"><% errors.first('loans['+key+'][lender_id]') %></span>
                                            </div>
                                            <div v-if="loan.lender_id == 0" class="form-group" :class="{'has-error': errors.has('loans['+key+'][lender_name]')}">
                                                <input type="text" class="form-control" placeholder="Name" v-model="loan.lender_name" v-validate="'required'" :name="'loans['+key+'][lender_name]'">
                                                <span v-show="errors.has('loans['+key+'][lender_name]')" class="help-block"><% errors.first('loans['+key+'][lender_name]') %></span>
                                            </div>
                                        </td>
                                        <td style="border-bottom: 0">
                                            <div class="col-md-6" style="padding-left: 0">
                                                <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][month]')}">
                                                    <select class="form-control" v-model="loan.month" v-validate="'required'" :name="'loans['+key+'][month]'">
                                                        <option :value="null" disabled>Month</option>
                                                        <option value="1">January</option>
                                                        <option value="2">February</option>
                                                        <option value="3">March</option>
                                                        <option value="4">April</option>
                                                        <option value="5">May</option>
                                                        <option value="6">June</option>
                                                        <option value="7">July</option>
                                                        <option value="8">August</option>
                                                        <option value="9">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                    <span v-show="errors.has('loans['+key+'][month]')" class="help-block"><% errors.first('loans['+key+'][month]') %></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0">
                                                <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][year]')}">
                                                    <select class="form-control" v-model="loan.year" v-validate="'required'" :name="'loans['+key+'][year]'">
                                                        <option :value="null" disabled>Year</option>
                                                        <option value="2007">2007</option>
                                                        <option value="2008">2008</option>
                                                        <option value="2009">2009</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                    </select>
                                                    <span v-show="errors.has('loans['+key+'][year]')" class="help-block"><% errors.first('loans['+key+'][year]') %></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="border-bottom: 0">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="If known" v-model="loan.agreement_id">
                                            </div>
                                        </td>
                                        <td style="border-bottom: 0">
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][capital]')}">
                                                <input type="number" min="0" class="form-control" v-model="loan.capital" v-validate="'required|numeric'" :name="'loans['+key+'][capital]'">
                                                <span v-show="errors.has('loans['+key+'][capital]')" class="help-block"><% errors.first('loans['+key+'][capital]') %></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-striped table-bordered table-responsive" style="margin:0">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('loan.complained_before')
                                        </th>
                                        <th>
                                            @lang('loan.was_payday_loan')
                                        </th>
                                        <th>
                                            @lang('loan.how_many_rollovers')
                                        </th>
                                        <th>
                                            @lang('loan.get_into_arrears')
                                        </th>
                                        <th>
                                            @lang('loan.describe_last_loan')
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][previously_claimed]')}">
                                                <select class="form-control" v-model="loan.previously_claimed" v-validate="'required'" :name="'loans['+key+'][previously_claimed]'">
                                                    <option :value="null" disabled>Choose</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][previously_claimed]')" class="help-block"><% errors.first('loans['+key+'][previously_claimed]') %></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][single_repayment]')}">
                                                <select class="form-control" v-model="loan.single_repayment" v-validate="'required'" :name="'loans['+key+'][single_repayment]'">
                                                    <option :value="null" disabled>Choose</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][single_repayment]')" class="help-block"><% errors.first('loans['+key+'][single_repayment]') %></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][rollovers]')}">
                                                <select class="form-control" v-model="loan.rollovers" v-validate="'required'" :name="'loans['+key+'][rollovers]'">
                                                    <option :value="null" disabled>Choose</option>
                                                    @for($i = 1; $i < 31; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][rollovers]')" class="help-block"><% errors.first('loans['+key+'][rollovers]') %></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][missed_payment_rollover_offered]')}">
                                                <select class="form-control" v-model="loan.missed_payment_rollover_offered" v-validate="'required'" :name="'loans['+key+'][missed_payment_rollover_offered]'">
                                                    <option :value="null" disabled>Choose</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][missed_payment_rollover_offered]')" class="help-block"><% errors.first('loans['+key+'][missed_payment_rollover_offered]') %></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" :class="{'has-error': errors.has('loans['+key+'][state_id]')}">
                                                <select class="form-control" v-model="loan.state_id" v-validate="'required'" :name="'loans['+key+'][state_id]'">
                                                    <option :value="null" disabled>Choose</option>
                                                    @foreach ($states as $state_id => $state)
                                                        <option value="{{$state_id}}">{{$state}}</option>
                                                    @endforeach
                                                </select>
                                                <span v-show="errors.has('loans['+key+'][state_id]')" class="help-block"><% errors.first('loans['+key+'][state_id]') %></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div v-if="loan_count > 1" class="form-group text-right" style="margin-top:10px">
                                    <button type="button" class="btn btn-primary" v-on:click="remove(key)">@lang('global.delete')</button>
                                </div>

                                <hr>
                            </template>

                            <div class="form-group">
                                <div class="col-md-6" style="padding-left:0">
                                    <button type="button" class="btn btn-primary" v-on:click="add()">@lang('loan.new_loan_or_lender')</button>
                                </div>
                                <div class="col-md-6 text-right" style="padding-right:0">
                                    <button :disabled="loading" type="button" class="btn btn-primary" v-on:click="submit()">
                                        <span v-if="!loading">@lang('global.submit')</span>
                                        <span v-else><i class="fa fa-refresh fa-spin"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var loanTable;
        jQuery(document).ready(function(){
            loanTable = new Vue({
                el: '#loan-table',
                data: {
                    loans: [],
                    loading: false,
                    breakpoint: 'desktop'
                },
                created: function(){
                    var dictionary = {
                        en: {
                            messages:{
                                required: function() {
                                    return 'This field is required';
                                },
                                numeric: function(){
                                    return 'This field may only contain numeric characters.';
                                }
                            }
                        }
                    };

                    this.$validator.updateDictionary(dictionary);

                    this.loans = {!! json_encode($loans ? $loans : []) !!};

                    if(this.loans.length === 0){
                        this.add();
                    }
                },
                computed: {
                    loan_count: function(){
                        var count = 0;
                        jQuery.each(this.loans, function(key, loan){
                            if(!loan.deleted){
                                count++;
                            }
                        });

                        return count;
                    }
                },
                methods: {
                    add: function(){
                        this.loans.push({
                            id:0,
                            lender_id: null,
                            lender_name: '',
                            agreement_id: '',
                            year: null,
                            month: null,
                            capital: '',
                            previously_claimed: null,
                            single_repayment: null,
                            rollovers: null,
                            missed_payment_rollover_offered: null,
                            state_id: null,
                            deleted: false
                        });
                    },
                    remove: function(key){
                        if(this.loans[key].id > 0){
                            this.loans[key].deleted = true;
                        } else {
                            this.loans.splice(key, 1);
                        }

                        this.$forceUpdate();
                    },
                    submit: function(){
                        var self = this;

                        this.$validator.validateAll().then(function(result){
                            if (result) {
                                self.loading = true;

                                axios.post('{{url('loans')}}', {loans: self.loans}).then(function (response) {
                                   response = response.data;

                                    if(response.status === 'success'){
                                        window.location.replace(response.url);
                                    }

                                    self.loading = false;
                                });
                            }
                        });
                    }
                },
                delimiters: ['<%', '%>']
            });

            jQuery(window).resize(function () {
                loanTable.breakpoint = window.getComputedStyle(document.querySelector('body'), ':before').getPropertyValue('content').replace(/\"/g, '');
            }).resize();
        });
    </script>
@append
