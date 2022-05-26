@extends('layouts/application-docs')

@section('content')

    {!! $agreement->contentWithVariables($customer) !!}

    <p class="p1">
        <span class="s1">
            Signature:
            @if(\Illuminate\Support\Facades\Storage::disk('s3')->exists('signatures/'.$customer->id.'/contract_sig.png'))
                <img
                    src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url('signatures/'.$customer->id.'/contract_sig.png')}}"
                    style="max-width:60%;vertical-align:middle">
            @else
                <span class="signature-container">
                        (Please sign in the white area below - your signature will then be transferred onto this line when it is submitted to us)
                    </span>
            @endif

          Date {{ date('d/m/Y') }}
        </span>
    </p>

@endsection
