<div class="col-md-4">
    <div class="form-group">
        <label for="title" class="control-label">Title</label>

        <select class="form-control input-md" name="title" required>
            <option {{ isset($customer) && $customer->title  == 'Dr' ? 'selected' : '' }} value="Dr">Dr</option>
            <option {{ isset($customer) && $customer->title == 'Miss' ? 'selected' : '' }} value="Miss">Miss</option>
            <option {{ isset($customer) && $customer->title == 'Mr' ? 'selected' : '' }} value="Mr">Mr</option>
            <option {{ isset($customer) && $customer->title  == 'Mrs' ? 'selected' : '' }} value="Mrs">Mrs</option>
            <option {{ isset($customer) && $customer->title  == 'Ms' ? 'selected' : '' }} value="Ms">Ms</option>
        </select>

        @error('title')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="first_name" class="control-label">First Name</label>
        <input id="first_name" type="text"
               value="{{ isset($customer) ? $customer->first_name : old('first_name')}}"
               name="first_name" class="form-control" autofocus>
        @error('first_name')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="last_name" class="control-label">Last Name</label>
        <input id="last_name" type="text"
               value="{{ isset($customer) ? $customer->last_name : old('last_name')}}"
               name="last_name" class="form-control" autofocus>
        @error('last_name')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="middle_names" class="control-label">Middle Name</label>
        <input id="middle_names" type="text"
               value="{{ isset($customer) ? $customer->middle_names : old('middle_names')}}"
               name="middle_names" class="form-control" autofocus>
        @error('middle_names')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="previous_first_name" class="control-label">Previous First
            Name</label>
        <input id="previous_first_name" type="text"
               value="{{ isset($customer) ? $customer->previous_first_name : old('previous_first_name')}}"
               name="previous_first_name" class="form-control" autofocus>
        @error('previous_first_name')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="previous_last_name" class="control-label">Previous Last
            Name</label>
        <input id="previous_last_name" type="text"
               value="{{ isset($customer) ? $customer->previous_last_name : old('previous_last_name')}}"
               name="previous_last_name" class="form-control" autofocus>
        @error('previous_last_name')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="dob" class="control-label">Dob</label>
        <input id="dob" type="text"
               value="{{ isset($customer) ? $customer->dob : old('dob')}}"
               name="dob" class="form-control dateTime" autofocus>
        @error('dob')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="telephone_home" class="control-label">Telephone Home</label>
        <input id="telephone_home" type="text"
               value="{{ isset($customer) ? $customer->telephone_home : old('telephone_home')}}"
               name="telephone_home" class="form-control" autofocus>
        @error('telephone_home')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="telephone_mobile" class="control-label">Telephone
            Mobile</label>
        <input id="telephone_mobile" type="text"
               value="{{ isset($customer) ? $customer->telephone_mobile : old('telephone_mobile')}}"
               name="telephone_mobile" class="form-control" autofocus>
        @error('telephone_mobile')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="telephone_work" class="control-label">Telephone Work</label>
        <input id="telephone_work" type="text"
               value="{{ isset($customer) ? $customer->telephone_work : old('telephone_work')}}"
               name="telephone_work" class="form-control" autofocus>
        @error('telephone_work')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <input id="email" type="text"
               value="{{ isset($customer) ? $customer->email : old('email')}}"
               name="email" class="form-control" autofocus>
        @error('email')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="email_confirmation" class="control-label">Email Confirmation</label>
        <input id="email_confirmation" type="text"
               value="{{ isset($customer) ? $customer->email : old('email_confirmation')}}"
               name="email_confirmation" class="form-control" autofocus>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="in_iva" class="control-label">In Iva</label>
        <select name="in_iva" id="in_iva" class="form-control">
            <option value="1" {{ isset($customer) && $customer->in_iva == 1 ? 'selected' :  '' }} >Yes</option>
            <option value="0" {{ isset($customer) && $customer->in_iva == 0 ? 'selected' :  '' }}>No</option>
        </select>
        @error('in_iva')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="in_dmp" class="control-label">In Dmp</label>
        <select name="in_dmp" id="in_iva" class="form-control">
            <option value="1" {{ isset($customer) && $customer->in_dmp == 1 ? 'selected' :  '' }} >Yes</option>
            <option value="0" {{ isset($customer) && $customer->in_dmp == 0 ? 'selected' :  '' }}>No</option>
        </select>
        @error('in_dmp')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="should_be_aware" class="control-label">Should Be Aware</label>
        <select name="should_be_aware" id="should_be_aware" class="form-control">
            <option value="1" {{ isset($customer) && $customer->should_be_aware == 1 ? 'selected' :  '' }} >Yes</option>
            <option value="0" {{ isset($customer) && $customer->should_be_aware == 0 ? 'selected' :  '' }}>No</option>
        </select>
        @error('should_be_aware')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label for="utm_source" class="control-label">Utm Source</label>
        <input type="text" id="utm_source" name="utm_source"
               value="{{ isset($customer) ? $customer->utm_source : old('utm_source')}}"
               class="form-control">
        @error('utm_source')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

