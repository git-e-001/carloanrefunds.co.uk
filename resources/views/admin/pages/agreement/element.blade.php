<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input id="name" type="text"
                   value="{{ isset($agreement) ? $agreement->name : old('name')}}"
                   name="name" class="form-control" autofocus>
            @error('name')
                <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="text" class="control-label">Content</label>
           <textarea name="text" id="text" class="TextEditor">{{ isset($agreement) ? $agreement->content : old('text')}}</textarea>
            @error('text')
                <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
