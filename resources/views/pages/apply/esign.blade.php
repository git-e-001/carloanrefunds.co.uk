@extends('layouts.app')


@push('style')
    <style>
        .contact-content {
            height: 400px;
            background-color: white;
            padding: 20px;
            border: 2px solid #DDDDDD;
            overflow-y: scroll;
        }

        .bg_color {
            background-color: #D5E8ED !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg_color">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12">
                    @include('admin.components.messages')
                    <div class="bg_color">
                        <div id="validation-errors" class="alert alert-danger" style="display:none">
                            <ul>
                                <li>First Name: {{ @$customer->first_name }}</li>
                            </ul>
                        </div>
                        <form method="POST" action="{{ route('apply.customer.esign.store') }}" accept-charset="UTF-8"
                              id="signature-form">
                            @csrf
                            <h1>Contractual agreement</h1>
                            <p>Before proceeding, we require a signature against both our customer contract and your
                                letter of
                                authority.</p>
                            <h2>Letter of Authority</h2>


                            <iframe  class="col-12" src="/apply/docs/loa" style="height: 400px; background-color: white; padding: 20px;"></iframe>

                            <div class="form-group py-3">
                                <label for="loa_sig" class="control-label">Please Sign Below – (To sign this Letter of
                                    Authority
                                    you can either use a mouse or, on a touch screen device, you can use your finger or
                                    a
                                    stylus. Please try to make your signature as accurate as possible as lenders may
                                    compare
                                    this to signatures they hold on file and it may hold things up if they do not match)
                                    Please
                                    make sure your signature stays within the box</label>
                                <input class="form-control input-md" placeholder="" name="loa_signature"
                                       type="hidden" value="">
                                <canvas id="letterOfAuthoritySignatureCanvas"
                                        style="background: white; width: 100%; height: 100px; border-radius: 4px; border: 1px solid rgb(204, 204, 204); touch-action: none;"
                                        width="1013" height="100"></canvas>
                                <button id="letterOfAuthoritySignatureClear" type="button"
                                        class="btn btn-warning btn-xs">
                                    Clear
                                </button>
                                <div class="help-block with-errors"></div>
                            </div>
                            <h2>Customer Contract</h2>


                            <iframe src="/apply/docs/contract" class="col-12" style="height: 400px; background-color: white; padding: 20px;"></iframe>

                            <div class="form-group py-3">
                                <label for="contract_sig" class="control-label">Please Sign Below – (To sign this
                                    Agreement you
                                    can either use a mouse or, on a touch screen device, you can use your finger or a
                                    stylus.
                                    Please try to make your signature as accurate as possible as lenders may compare
                                    this to
                                    signatures they hold on file and it may hold things up if they do not match) Please
                                    make
                                    sure your signature stays within the box</label>
                                <input class="form-control input-md" placeholder="" name="contract_signature"
                                       type="hidden"
                                       value="">
                                <canvas id="contract_sig_canvas"
                                        style="background: white; width: 100%; height: 100px; border-radius: 4px; border: 1px solid rgb(204, 204, 204); touch-action: none;"
                                        width="1013" height="100"></canvas>
                                <button id="contract-sig-clear" type="button" class="btn btn-warning btn-xs">Clear
                                </button>
                                <div class="help-block with-errors"></div>
                            </div>
{{--                            <p>In addition to the above confirmations please tick the boxes below if you give your--}}
{{--                                consent that--}}
{{--                                Redbridge Finance Limited may contact you about other products and services that we--}}
{{--                                offer that--}}
{{--                                we think may be of interest to you by:</p>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-xs-4 col-sm-2 control-label">--}}
{{--                                    <label>Email </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-8 col-sm-4">--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" name="optin_email" type="radio" value="1">--}}
{{--                                        Yes </label>--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" checked="checked" name="optin_email" type="radio" value="0">--}}
{{--                                        No </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-xs-4 col-sm-2 control-label">--}}
{{--                                    <label>--}}
{{--                                        SMS </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-8 col-sm-4">--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" name="optin_sms" type="radio" value="1">--}}
{{--                                        Yes </label>--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" checked="checked" name="optin_sms" type="radio" value="0">--}}
{{--                                        No </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-xs-4 col-sm-2 control-label">--}}
{{--                                    <label>--}}
{{--                                        Post </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-8 col-sm-4">--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" name="optin_post" type="radio" value="1">--}}
{{--                                        Yes </label>--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" checked="checked" name="optin_post" type="radio" value="0">--}}
{{--                                        No </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-xs-4 col-sm-2 control-label">--}}
{{--                                    <label>--}}
{{--                                        Telephone </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-xs-8 col-sm-4">--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" name="optin_telephone" type="radio" value="1">--}}
{{--                                        Yes </label>--}}
{{--                                    <label class="radio-inline">--}}
{{--                                        <input required="1" checked="checked" name="optin_telephone" type="radio"--}}
{{--                                               value="0">--}}
{{--                                        No </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <button type="button" id="validate-form" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <script>
        // start  letter of authority signature canvas
        var loaSig = document.getElementById("letterOfAuthoritySignatureCanvas");
        var loaSigPad = new SignaturePad(loaSig, {
            onEnd: function () {
                jQuery('input[name=loa_signature]').val(loaSigPad.toDataURL())
            }
        });
        jQuery(document).on('click', '#letterOfAuthoritySignatureClear', function () {
            jQuery('input[name=loa_signature]').val('');
            loaSigPad.clear();
        });
        // end  letter of authority signature canvas

        // Start  contact signature canvas
        var contractSig = document.getElementById("contract_sig_canvas");
        var contractSigPad = new SignaturePad(contractSig, {
            onEnd: function () {
                jQuery('input[name=contract_signature]').val(contractSigPad.toDataURL())
            }
        });
        jQuery(document).on('click', '#contract-sig-clear', function () {
            jQuery('input[name=contract_signature]').val('');
            contractSigPad.clear();
        });
        // end  contact signature canvas


        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            var previousData = {
                loa: loaSigPad.toDataURL(),
                contract: contractSigPad.toDataURL()
            };


            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            loaSig.width = loaSig.offsetWidth * ratio;
            loaSig.height = loaSig.offsetHeight * ratio;
            loaSig.getContext("2d").scale(ratio, ratio);
            loaSigPad.clear();

            contractSig.width = contractSig.offsetWidth * ratio;
            contractSig.height = contractSig.offsetHeight * ratio;
            contractSig.getContext("2d").scale(ratio, ratio);
            contractSigPad.clear();

            setTimeout(function () {
                loaSigPad.fromDataURL(previousData.loa);
                contractSigPad.fromDataURL(previousData.contract);
            });
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        /*
        * ---------------------------
        * Signature submit/validation
        * ---------------------------
        */

        jQuery('#validate-form').on('click', function (e) {
            var self = jQuery(this);
            var previousText = self.text();
            var alert = jQuery('#validation-errors');

            self.addClass('disabled').html('<i class="fa fa-refresh fa-spin"></i>');

            alert.hide();

            var formData = jQuery('#signature-form').serializeArray();
            var data = {};
            jQuery.each(formData, function (key, field) {
                data[field.name] = field.value;
            });

            jQuery.post('/apply/validate-esign', data, function (response) {
                if (response.status === 'error') {
                    alert.find('ul').html('');

                    jQuery.each(response.messages, function (key, error) {
                        alert.find('ul').append(jQuery('<li>').text(error));
                    });

                    alert.show();

                    jQuery('html, body').animate({scrollTop: '0px'}, 300);
                } else {
                    jQuery('#signature-form').trigger('submit');
                }

                self.removeClass('disabled').html(previousText);
            });
        });
    </script>


@endpush

