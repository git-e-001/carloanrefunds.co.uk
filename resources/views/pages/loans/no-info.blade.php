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
            <div class="row pt-5 justify-content-center">
                <div class="col-lg-12">
                    <h2>Your Claim</h2>
                    <p>
                        In order that we can prepare letters that you can send straight to your lenders to get the
                        details of your borrowings we need to know the lenders that you had loans with. Please enter them all
                        below:
                    </p>

                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div id="loan-table">
                                <div class="table-responsive well">
                                    <h3>Lender Details</h3>
                                    <template v-if="!loan.deleted" v-for="(loan, key) in loans">

                                        <div class="form-group"
                                             :class="{'has-error': errors.has('loans['+key+'][lender_id]')}">
                                            <label>Lender</label>
                                            <select class="form-control" v-model="loan.lender_id"
                                                    v-validate="'required'"
                                                    :name="'loans['+key+'][lender_id]'">
                                                <option :value="null" disabled>Choose Lender</option>
                                                @foreach($lenders as $id => $lender)
                                                    <option value="{{$id}}"
                                                            :disabled="lenderSelected({{$id}})">{{$lender}}</option>
                                                @endforeach
                                            </select>
                                            <span v-show="errors.has('loans['+key+'][lender_id]')"
                                                  class="help-block"><% errors.first('loans[' + key + '][lender_id]') %></span>
                                        </div>
                                        <div v-if="loan_count > 1" class="form-group text-right"
                                             style="margin-top:10px">
                                            <button type="button" class="btn btn-danger"
                                                    v-on:click="remove(key)">DELETE
                                            </button>
                                        </div>
                                        <hr>
                                    </template>

                                    <div class="form-group">
                                        <label>If more lenders to add, click here</label><br>
                                        <button type="button" class="btn btn-info"
                                                :class="{'btn-block': breakpoint !== 'desktop'}" v-on:click="add()">
                                            ADD ANOTHER LENDER
                                        </button>
                                        <br>

                                        <label>Only click here when you have finished adding your lenders</label><br>
                                        <button :disabled="loading" type="button" class="btn btn-warning"
                                                :class="{'btn-block': breakpoint !== 'desktop'}"
                                                v-on:click="submit()">
                                            <span v-if="!loading">SUBMIT</span>
                                            <span v-else>Loading....</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><strong>
                            <strong>If you need additional help or have other questions please email us at&nbsp;<a
                                    href="mailto:claimsteam@carloanrefunds.co.uk">claimsteam@carloanrefunds.co.uk</a>&nbsp;before
                                you proceed.</strong>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        var loanTable;
        jQuery(document).ready(function () {
            loanTable = new Vue({
                el: '#loan-table',
                data: {
                    loans: [],
                    loading: false,
                    breakpoint: 'desktop'
                },
                created: function () {
                    var dictionary = {
                        en: {
                            messages: {
                                required: function () {
                                    return 'This field is required';
                                },
                                numeric: function () {
                                    return 'This field may only contain numeric characters.';
                                }
                            }
                        }
                    };

                    this.$validator.localize(dictionary);

                    this.loans = {!! json_encode($loans ? $loans : []) !!};

                    if (this.loans.length === 0) {
                        this.add();
                    }
                },
                computed: {
                    loan_count: function () {
                        var count = 0;
                        jQuery.each(this.loans, function (key, loan) {
                            if (!loan.deleted) {
                                count++;
                            }
                        });

                        return count;
                    }
                },
                methods: {
                    add: function () {
                        this.loans.push({
                            id: 0,
                            lender_id: null,
                            lender_name: '',
                            previously_claimed: 0,
                            deleted: false
                        });
                    },
                    remove: function (key) {
                        if (this.loans[key].id > 0) {
                            this.loans[key].deleted = true;
                        } else {
                            this.loans.splice(key, 1);
                        }

                        this.$forceUpdate();
                    },
                    submit: function () {
                        var self = this;

                        this.$validator.validateAll().then(function (result) {
                            if (result) {
                                self.loading = true;

                                axios.post('{{url('loans/no-info')}}', {loans: self.loans}).then(function (response) {
                                    response = response.data;

                                    if (response.status === 'success') {
                                        window.location.replace(response.url);
                                    }

                                    self.loading = false;
                                });
                            }
                        });
                    },
                    lenderSelected: function (id) {
                        var selected = false;

                        $.each(this.loans, function (key, loan) {
                            if (loan.lender_id == id) {
                                selected = true;
                            }
                        });

                        return selected;
                    }
                },
                delimiters: ['<%', '%>']
            });

            jQuery(window).resize(function () {
                loanTable.breakpoint = window.getComputedStyle(document.querySelector('body'), ':before').getPropertyValue('content').replace(/\"/g, '');
            }).resize();
        });
    </script>
@endpush
