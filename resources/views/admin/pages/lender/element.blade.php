<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input id="name" type="text"
                   value="{{ isset($lender) ? $lender->name : old('name')}}"
                   name="name" class="form-control" autofocus>
            @error('name')
            <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
            @enderror
        </div>
    </div>
</div>
