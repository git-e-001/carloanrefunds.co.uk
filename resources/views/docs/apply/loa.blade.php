@extends('layouts/application-docs')

@section('content')

    <style>
        li {
            margin-bottom: 5px;
        }
    </style>

    <p class="p1">
        <span class="s1">
            <strong>
               Letter of Authority
            </strong>
        </span>
    </p>

    <table class="t1" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="td1" valign="top">
                <p class="p3"><span
                        class="s2">Full Name: {{ $customer->title }} {{ $customer->first_name }} {{ $customer->middle_names }} {{ $customer->last_name}}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="td1" valign="top">
                <p class="p3"><span
                        class="s2">Previous Names Used: {{ $customer->previous_first_name }} {{ $customer->previous_last_name}}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="td1" valign="top">
                <p class="p3"><span
                        class="s2">Date of Birth:{{ \Carbon\Carbon::parse($customer->dob)->format('d/m/Y') }}</span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="td2" valign="top">
                <p class="p3"><span
                        class="s2">Current Address (Including Postcode):  {{ $customer->currentAddress->line_1 }} {{ $customer->currentAddress->line_2 }} {{ $customer->currentAddress->line_3 }} {{ $customer->currentAddress->city }} {{ $customer->currentAddress->county }} {{ $customer->currentAddress->postcode }}</span>
                </p>
            </td>
        </tr>

        @foreach ($customer->previousAddresses as $previousAddress)
            <tr>
                <td class="td2" valign="top">
                    <p class="p3"><span
                            class="s2">Previous Address (Including Postcode'): {{ $previousAddress->line_1 }} {{ $previousAddress->line_2 }} {{ $previousAddress->line_3 }} {{ $previousAddress->city }} {{ $previousAddress->county }} {{ $previousAddress->postcode }}</span>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    {!! $agreement->contentWithVariables($customer) !!}

    <p class="p3">
        <span class="s2">
            <strong>
                Signature:
                @if(\Illuminate\Support\Facades\Storage::disk('s3')->exists('signatures/'.$customer->id.'/loa_sig.png'))
                    <img
                        src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url('signatures/'.$customer->id.'/loa_sig.png')}}"
                        style="max-width:60%;vertical-align:middle">
                @else
                    <span class="signature-container">
                            (Please sign in the white area below - your signature will then be transferred onto this line when it is submitted to us)
                        </span>
                @endif
               Date {{ date('d/m/Y') }}
            </strong>
        </span>
    </p>

    <p class="p1">
        <span class="s1">
            Redbridge Finance is Registered in England & Wales with Company Number 10625599. Registered Office: Highfield, Crossing Lane, Claydon, Banbury, OX17 1EX. Redbridge Finance is a Claims Management Company that is Authorised and Regulated by the Financial Conduct Authority. Firm Reference Number: 836097. VAT Number 270 5830 08. ICO Registration Number ZA533663
        </span>
    </p>
    <p class="p1">
        <span class="s1">
            DocID – 1200002 Version 2.0 – April 2017
        </span>
    </p>

@endsection
