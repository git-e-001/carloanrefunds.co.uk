@extends('layouts.app')


@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .bg_color {
            background-color: #D5E8ED !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg_color">
        <div class="container">
            @include('admin.components.messages')
            <div class="row justify-content-center py-5">
                <div class="col-md-6">
                    <form method="POST" action="{{ url('apply/esign-validation') }}" accept-charset="UTF-8"
                          class="form-horizontal" id="esign-validation-form" role="form">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="last_name">Restart Surname</label>
                            <input class="form-control" placeholder="Surname" value="{{ old('last_name') }}"
                                   required id="last_name"
                                   name="last_name" type="text">
                            @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">Restart Date Of Birth</label>
                            <input class="form-control dateTime" required value="{{ old('date_of_birth') }}"
                                   placeholder="Choose date" name="date_of_birth" type="text">
                            @error('date_of_birth')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block pull-right">Next</button>
                        </div>
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
    </script>
@endpush

