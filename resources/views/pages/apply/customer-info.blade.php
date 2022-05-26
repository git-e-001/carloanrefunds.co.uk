@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .required {
            font-size: 6px;
            color: red
        }

        .bg_color {
            background-color: #D5E8ED !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg_color">
        <div class="container">
            <div class="row pt-5 justify-content-center">
                <div class="col-lg-10">

                    @include('admin.components.messages')


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('apply.customer.info.store') }}"
                          accept-charset="UTF-8" class="form-horizontal" id="customer-info-form"
                          role="form">
                        @csrf
                        <fieldset>
                            <legend class="text-left">Personal Details</legend>
                            <hr class="mt-0">
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class="control-label">Title <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <select class="form-control input-md" name="title" required>
                                            <option {{ old('title') == 'Dr' ? 'selected' : '' }} value="Dr">Dr</option>
                                            <option {{ old('title') == 'Miss' ? 'selected' : '' }} value="Miss">Miss
                                            </option>
                                            <option {{ old('title') == 'Mr' ? 'selected' : '' }} value="Mr">Mr</option>
                                            <option {{ old('title') == 'Mrs' ? 'selected' : '' }} value="Mrs">Mrs
                                            </option>
                                            <option {{ old('title') == 'Ms' ? 'selected' : '' }} value="Ms">Ms</option>
                                        </select>
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class="control-label">First Name <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" required placeholder="First name"
                                               data-error="Required" name="first_name" type="text"
                                               value="{{ old('first_name') }}">
                                        @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Middle name(s)</label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" placeholder="Middle name(s)"
                                               name="middle_names"
                                               type="text" value="{{ old('middle_names') }}">
                                        @error('middle_names')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label" for="ln">Surname <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" required placeholder="Surname"
                                               data-error="Required" name="last_name" type="text"
                                               value="{{ old('last_name') }}">
                                        @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Date of Birth <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="has-feedback">
                                            <div class="input-group dob">
                                                <input class="form-control dateTime" value="{{ old('dob') }}"
                                                       placeholder="Choose date" name="dob" type="text">
                                            </div>
                                        </div>
                                        @error('dob')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">

                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Have you used any other names? <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required
                                                   {{ old('previous_aliases') == '1' ? 'checked' : '' }} class="previewName"
                                                   name="previous_aliases" type="radio"
                                                   value="1">Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required
                                                   {{ old('previous_aliases') == '0' ? 'checked' : '' }} class="previewName"
                                                   checked="checked"
                                                   name="previous_aliases"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('previous_aliases')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="previous_personal_details"
                                 class="{{ old('previous_aliases') == '1' ? '' : 'd-none' }}">
                                <p class="text-muted">Please enter the FULL previous/other name under which you took out
                                    one
                                    or more of your loans, e.g. Mr Joseph Charles Blogs.</p>

                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">Previous First Name</label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input class="form-control input-md" placeholder="Previous first name"
                                                   data-validate="0" name="previous_first_name" type="text"
                                                   value="{{ old('previous_first_name') }}">
                                            @error('previous_first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label" for="ln">Previous Surname</label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input class="form-control input-md" placeholder="Previous surname"
                                                   name="previous_last_name" type="text"
                                                   value="{{ old('previous_last_name') }}">
                                            @error('previous_last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <legend class="text-left">Address</legend>
                            <hr class="mt-0">

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Postcode <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" required
                                               autocomplete="off" autocorrect="off" autocapitalize="off"
                                               spellcheck="false"
                                               placeholder="Postcode"
                                               name="address_postcode" type="text"
                                               value="{{ old('address_postcode') }}">
                                        @error('address_postcode')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="home-address-autofill">
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">Address Line 1<sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input placeholder="Address Line 1"
                                                   required="required" data-error="Required"
                                                   autocomplete="false"
                                                   autocorrect="off" name="address_line_1" type="text"
                                                   value="{{ old('address_line_1') }}"
                                                   class="form-control">
                                            @error('address_line_1')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">Address Line 2</label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input placeholder="Address Line 2" name="address_line_2" type="text"
                                                   value="{{ old('address_line_2') }}" class="form-control input-md">
                                            @error('address_line_2')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">Address Line 3</label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input placeholder="Address Line 3" name="address_line_3" type="text"
                                                   value="{{ old('address_line_3') }}" class="form-control">
                                            @error('address_line_3')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">City <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input placeholder="City" required="required" data-error="Required"
                                                   name="address_city" type="text" value="{{ old('address_city') }}"
                                                   class="form-control">
                                            @error('address_city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-12 text-lg-right">
                                            <label class=" control-label">Country</label>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <input placeholder="Country" name="address_county" type="text"
                                                   value="{{ old('address_county') }}" class="form-control">
                                            @error('address_county')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>
                                                Have you lived at any previous addresses in the period in which you took
                                                out
                                                your
                                                loans? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                            <small> It is REALLY important to give us your previous addresses. Without
                                                this
                                                information the lender will not be able to find your record. </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <label class="radio-inline">
                                                <input required class="previewAddress"
                                                       id="isPreviewAddressradioField"
                                                       data-isoldpreview="{{ old('lived_another_address') }}"
                                                       v-model="lived_another_address"
                                                       name="lived_another_address"
                                                       type="radio" :value="true">
                                                Yes </label>

                                            <label class="radio-inline">
                                                <input required class="previewAddress"
                                                       v-model="lived_another_address"
                                                       name="lived_another_address"
                                                       type="radio" :value="false">
                                                No </label>

                                            @error('lived_another_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div v-show="lived_another_address">
                                <legend class="text-left">Previous Addresses {{ old('previous_addresses.*') }}</legend>
                                <hr class="mt-0">
                                <previous-addresses
                                    v-bind:prefill-addresses="{{ json_encode(old('previous_addresses', [])) }}"></previous-addresses>
                            </div>

                            <legend class="text-left">Contact</legend>
                            <hr class="mt-0">

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Email Address <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" required placeholder="Email Address"
                                               id="email"
                                               data-error="Required" data-pattern-error="Must be a valid email address"
                                               name="email" type="email" value="{{ old('email') }}">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Confirm Email Address <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" placeholder="Confirm Email Address"
                                               required
                                               data-match="#email" data-error="Required"
                                               data-match-error="Your email must typed twice identically"
                                               name="email_confirmation" type="email"
                                               value="{{ old('email_confirmation') }}">
                                        <small class="control-label">
                                            As email is our primary method of contact, please ensure that <a
                                                href="/cdn-cgi/l/email-protection#345758555d5947405155597446515056465d505351525d5a555a5751"><span
                                                    class="__cf_email__"
                                                    data-cfemail="e0838c81898d939485818da092858482928984878586898e818e8385">[email&#160;protected]</span></a>
                                            is whitelisted </small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Home Tel</label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" placeholder="Optional"
                                               name="telephone_home"
                                               type="tel" value="{{ old('telephone_home') }}">
                                        @error('telephone_home')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-5">

                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <label class=" control-label">Mobile Tel <sup><i
                                                    class="required fa fa-star"></i></sup></label>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input class="form-control input-md" required placeholder="07000001234"
                                               maxlength="11"
                                               minlength="11" pattern="^07[0-9]{9}$" data-error="Required"
                                               data-pattern-error="Mobile only (e.g. 07000001234)"
                                               name="telephone_mobile"
                                               type="tel" value="{{ old('telephone_mobile') }}">

                                        @error('telephone_mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <legend class="text-left">Other Details</legend>
                            <hr class="mt-0">

{{--                            <div class="form-group">--}}
{{--                                <div class="row justify-content-center">--}}
{{--                                    <div class="col-lg-3 col-md-12 text-lg-right">--}}
{{--                                        <div class=" control-label">--}}
{{--                                            <label>Are you in an IVA? <sup><i--}}
{{--                                                        class="required fa fa-star"></i></sup></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4 col-md-12">--}}
{{--                                        <label class="radio-inline">--}}
{{--                                            <input required="1"--}}
{{--                                                   {{ old('in_iva') == '1' ? 'checked' : '' }} name="in_iva"--}}
{{--                                                   type="radio" value="1">--}}
{{--                                            Yes </label>--}}
{{--                                        <label class="radio-inline">--}}
{{--                                            <input required="1"--}}
{{--                                                   {{ old('in_iva') == '0' ? 'checked' : '' }} name="in_iva"--}}
{{--                                                   type="radio" value="0">--}}
{{--                                            No </label>--}}
{{--                                        @error('in_iva')--}}
{{--                                        <small class="text-danger">{{ $message }}</small>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <div class="row justify-content-center">--}}
{{--                                    <div class="col-lg-3 col-md-12 text-lg-right">--}}
{{--                                        <div class=" control-label">--}}
{{--                                            <label>Are you currently in a Debt Management Program? <sup><i--}}
{{--                                                        class="required fa fa-star"></i></sup></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4 col-md-12">--}}
{{--                                        <label class="radio-inline">--}}
{{--                                            <input required="1"--}}
{{--                                                   {{ old('in_dmp') == '1' ? 'checked' : '' }} name="in_dmp"--}}
{{--                                                   type="radio" value="1">--}}
{{--                                            Yes--}}
{{--                                        </label>--}}
{{--                                        <label class="radio-inline">--}}
{{--                                            <input required="1"--}}
{{--                                                   {{ old('in_dmp') == '0' ? 'checked' : '' }} name="in_dmp"--}}
{{--                                                   type="radio" value="0">--}}
{{--                                            No--}}
{{--                                        </label>--}}
{{--                                        @error('in_dmp')--}}
{{--                                        <small class="text-danger">{{ $message }}</small>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div> --}}
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Have you ever been declared bankrupt? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('declared_bankrupt') == '1' ? 'checked' : '' }} name="declared_bankrupt"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('declared_bankrupt') == '0' ? 'checked' : '' }} name="declared_bankrupt"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('declared_bankrupt')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Are you subject to a bankruptcy petition? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('bankrupt_petition') == '1' ? 'checked' : '' }} name="bankrupt_petition"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('bankrupt_petition') == '0' ? 'checked' : '' }} name="bankrupt_petition"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('bankrupt_petition')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Are you subject to, or have ever been subject to, an individual voluntary arrangement (IVA)? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('individual_voluntary_arrangement') == '1' ? 'checked' : '' }} name="individual_voluntary_arrangement"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('individual_voluntary_arrangement') == '0' ? 'checked' : '' }} name="individual_voluntary_arrangement"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('individual_voluntary_arrangement')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Have you proposed an individual voluntary arrangement which is yet to be approved or rejected by creditors? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('individual_voluntary_arrangement_approved') == '1' ? 'checked' : '' }} name="individual_voluntary_arrangement_approved"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('individual_voluntary_arrangement_approved') == '0' ? 'checked' : '' }} name="individual_voluntary_arrangement_approved"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('individual_voluntary_arrangement_approved')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div> <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Are you currently subject to, or have ever been subject to, a debt relief order? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('debt_relief_order') == '1' ? 'checked' : '' }} name="debt_relief_order"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('debt_relief_order') == '0' ? 'checked' : '' }} name="debt_relief_order"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('debt_relief_order')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div><div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>are you, or have you, ever been subject to any other similar process or arrangement which is like those listed in (a) to (e)? <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('arrangement_like') == '1' ? 'checked' : '' }} name="arrangement_like"
                                                   type="radio" value="1">
                                            Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('arrangement_like') == '0' ? 'checked' : '' }} name="arrangement_like"
                                                   type="radio" value="0">
                                            No
                                        </label>
                                        @error('arrangement_like')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <p>
                                If you have answered yes to any of the questions above, please be aware that any refund, compensation, or settlement monies might, in certain circumstances be off set against your outstanding debts and you may not receive any actual cash.
                            </p>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-lg-5 col-md-12 text-lg-right">
                                        <div class=" control-label">
                                            <label>Please confirm that there is nothing that you are aware of that would
                                                prevent
                                                you
                                                from: <sup><i
                                                        class="required fa fa-star"></i></sup></label>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                Reading and understanding any of the documentation we will send you
                                            </li>
                                            <li class="list-group-item">
                                                Reading and understanding any of the agreements that you will be asked
                                                to
                                                sign
                                            </li>
                                            <li class="list-group-item">
                                                Making decisions that may be required of you during this claim
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-lg-5 col-md-12 text-lg-right"></div>
                                    <div class="col-lg-6 col-md-12">
                                        <label class="radio-inline">
                                            <input required="1"
                                                   {{ old('should_be_aware') == '1' ? 'checked' : '' }} name="should_be_aware"
                                                   type="radio" value="1">
                                            Confirmed </label>
                                        <label class="radio-inline" style="margin-left:0">
                                            <input required="1"
                                                   {{ old('should_be_aware') == '0' ? 'checked' : '' }} name="should_be_aware"
                                                   type="radio" value="0">
                                            No, I many have difficulty doing this and may need extra help </label>

                                        @error('should_be_aware')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-12">
                                        <label class=" control-label" for="submit"></label>
                                        <button name="next" class="btn btn-warning btn-block">Next</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(".dateTime").flatpickr(
            {
                dateFormat: "d-m-Y",
            }
        );


        $(".previewName").each(function (event) {
            $(this).on('click', function () {
                if ($(this).val() == 1) {
                    $("#previous_personal_details").removeClass('d-none')
                } else {
                    $("#previous_personal_details").addClass('d-none')
                }
            })
        })
    </script>
@endpush
