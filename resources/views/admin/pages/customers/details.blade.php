@extends('admin.layouts.app')

@section('title', 'Customer Details')

@push('style')

@endpush

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body p-0 table-responsive">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-4">
                                        <table class="table table-striped table-hover" style="font-size: 14px">
                                            <thead class="navbar-danger text-white">
                                            <tr>
                                                <th class="text-center" colspan="2">Basic Information</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Title:</th>
                                                <td>{{ $customer->title }}</td>
                                            </tr>
                                            <tr>
                                                <th>First Name:</th>
                                                <td>{{ $customer->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Name:</th>
                                                <td>{{ $customer->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Middle Name:</th>
                                                <td>{{ $customer->middle_names }}</td>
                                            </tr>
                                            <tr>
                                                <th>Previous First Name:</th>
                                                <td>{{ $customer->previous_first_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Previous Last Name:</th>
                                                <td>{{ $customer->previous_last_name }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <table class="table table-striped table-hover" style="font-size: 14px">
                                            <thead class="navbar-danger text-white">
                                            <tr>
                                                <th class="text-center" colspan="2">Contact Information</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{ $customer->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telephone Home</th>
                                                <td>{{ $customer->telephone_home }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telephone Mobile</th>
                                                <td>{{ $customer->telephone_mobile }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telephone Work</th>
                                                <td>{{ $customer->telephone_work }}</td>
                                            </tr>
                                            <tr>
                                                <th>Authority signature</th>
                                                <td><img width="400"
                                                         src="{{  $customer->AuthoritySign ? $customer->AuthoritySign->url : '' }}"
                                                         alt="no">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Contact signature</th>
                                                <td><img width="400"
                                                         src="{{  $customer->ContactSign ? $customer->ContactSign->url : '' }}"
                                                         alt="no">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <table class="table table-striped table-hover" style="font-size: 14px">
                                            <thead class="navbar-danger text-white">
                                            <tr>
                                                <th class="text-center" colspan="2">Optional Information</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>In Iva</th>
                                                <td>{{ $customer->in_iva ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>In Dmp</th>
                                                <td>{{ $customer->in_dmp ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Should Be Aware</th>
                                                <td>{{ $customer->should_be_aware ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Esigned TS</th>
                                                <td>{{ $customer->esigned_ts }}</td>
                                            </tr>
                                            <tr>
                                                <th>Optional Email</th>
                                                <td>{{ $customer->optin_email ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Optional Telephone</th>
                                                <td>{{ $customer->optin_telephone ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Optional Sms</th>
                                                <td>{{ $customer->optin_sms ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Optional Post</th>
                                                <td>{{ $customer->optin_post ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Utm Source</th>
                                                <td>{{ $customer->utm_source }}</td>
                                            </tr>
                                            <tr>
                                                <th>Declared Bankrupt</th>
                                                <td>{{ $customer->declared_bankrupt ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Bankrupt Petition</th>
                                                <td>{{ $customer->bankrupt_petition ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Individual Voluntary Arrangement</th>
                                                <td>{{ $customer->individual_voluntary_arrangement ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Individual Voluntary Arrangement Approved</th>
                                                <td>{{ $customer->individual_voluntary_arrangement_approved ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Debt Relief Order</th>
                                                <td>{{ $customer->debt_relief_order ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Arrangement Like</th>
                                                <td>{{ $customer->arrangement_like ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <table class="table table-striped table-hover" style="font-size: 14px">
                                            <thead class="navbar-danger text-white">
                                            <tr>
                                                <th class="text-center" colspan="2">Current Address</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Post Code</th>
                                                <td>{{ @$customer->currentAddress->postcode }}</td>
                                            </tr>

                                            <tr>
                                                <th>Address One</th>
                                                <td>{{ @$customer->currentAddress->line_1 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address Two</th>
                                                <td>{{ @$customer->currentAddress->line_2 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address Three</th>
                                                <td>{{ @$customer->currentAddress->line_3 }}</td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td>{{ @$customer->currentAddress->city }}</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>{{ @$customer->currentAddress->county }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body p-0 table-responsive">
                                    <h4 class="pl-4 pb-3">Previous Address</h4>
                                    <table class="table table-striped table-hover" style="font-size: 14px">
                                        <thead class="navbar-danger text-white">
                                        <tr>
                                            <th>Post Code</th>
                                            <th>Address One</th>
                                            <th>Address Two</th>
                                            <th>Address Three</th>
                                            <th>City</th>
                                            <th>Country</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($customer->previousAddresses as $address)
                                            <tr>
                                                <td>{{ @$address->postcode }}</td>
                                                <td>{{ @$address->line_1 }}</td>
                                                <td>{{ @$address->line_2 }}</td>
                                                <td>{{ @$address->line_3 }}</td>
                                                <td>{{ @$address->city }}</td>
                                                <td>{{ @$address->county }}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="7">No previous address</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body p-0 table-responsive mt-5">
                                    <h4 class="pl-4 pb-3">Loans</h4>
                                    <table class="table table-striped table-hover" style="font-size: 14px">
                                        <thead class="navbar-danger text-white">
                                        <tr>
                                            <th>Lender Name</th>
                                            <th>Agreement</th>
                                            <th>state_id</th>
                                            <th>Lender Name</th>
                                            <th>Date</th>
                                            <th>Capital</th>
                                            <th>Previously Claimed</th>
                                            <th>Single Repayment</th>
                                            <th>Rollovers</th>
                                            <th>Missed Payment Rollover Offered</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($customer->loans as $loan)
                                            <tr>
                                                <td>{{ @$loan->lender->name }}</td>
                                                <td>{{ @$loan->agreement_id }}</td>
                                                <td>{{ @$loan->state->description }}</td>
                                                <td>{{ @$loan->lender_name }}</td>
                                                <td>{{ @$loan->date }}</td>
                                                <td>{{ @$loan->capital }}</td>
                                                <td>{{ @$loan->previously_claimed }}</td>
                                                <td>{{ @$loan->single_repayment }}</td>
                                                <td>{{ @$loan->rollovers }}</td>
                                                <td>{{ @$loan->missed_payment_rollover_offered }}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="7">No lenders</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


