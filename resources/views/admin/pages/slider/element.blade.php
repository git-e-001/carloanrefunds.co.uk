<div class="form-group">
    <label for="title" class="control-label">Title <span class="required-star"> *</span></label>
    <input id="title" type="text" value="{{ isset($slider) ? $slider->title : old('title')}}"
           name="title" class="form-control" autofocus>

    @error('title')
    <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

{{--<div class="row">--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <label for="btn_text" class="control-label">Button Text</label>--}}
{{--            <input id="btn_text" type="text" value="{{ isset($slider) ? $slider->btn_text : old('btn_text')}}"--}}
{{--                   name="btn_text" class="form-control" autofocus>--}}

{{--            @error('btn_text')--}}
{{--            <span class="help-block m-b-none text-danger">--}}
{{--            {{ $message }}--}}
{{--        </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <label for="btn_link" class="control-label">Button Link</label>--}}
{{--            <input id="btn_link" type="text" value="{{ isset($slider) ? $slider->btn_link : old('btn_link')}}"--}}
{{--                   name="btn_link" class="form-control" autofocus>--}}

{{--            @error('btn_link')--}}
{{--            <span class="help-block m-b-none text-danger">--}}
{{--            {{ $message }}--}}
{{--        </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <label for="btn_color" class="control-label">Button Color</label>--}}
{{--            <input id="btn_color" type="text" value="{{ isset($slider) ? $slider->btn_color : old('btn_color')}}"--}}
{{--                   name="btn_color" class="form-control colorPicker" autofocus>--}}
{{--            @error('btn_color')--}}
{{--            <span class="help-block m-b-none text-danger">--}}
{{--            {{ $message }}--}}
{{--        </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}






<div class="form-group">
    <label id="description" class="control-label">Short Description</label>
    <textarea class="form-control TextEditor" name="description"
              id="description">{{ isset($slider) && $slider->description ? $slider->description : old('description')}}</textarea>
    @error('description')
    <span class="help-block m-b-none text-danger">
        {{ $message }}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image<span class="required-star"> *</span></label>
    <div class="input-group">
        <div class="custom-file">
            <input onchange="previewImage(this);" accept="image/*" type="file" name="image" class="file-src' custom-file-input"
                   id="image">
            <label class="custom-file-label" for="image">Choose file</label>
        </div>
    </div>
    @error('image')
    <span class="help-block m-b-none text-danger">{{ $message }}</span>
    @enderror
</div>

@if(isset($slider->image) && @$slider->image->base_path)
    <div class="image-sec-hide">
        <div class="d-flex">
            <img class="mb-3 img-thumbnail" id="old_img" src="{{ @$slider->image->url }}" width="100px" style="height: 100px">
            <a onclick="deleteImage(this, '{{ @$slider->image->base_path }}', '{{ @$slider->id }}')" class="text-danger image-delete ml-2" href="javascript:void(0)">
                <i class="fa fa-trash image_preview_delete_icon"></i></a>
        </div>
    </div>
@endif

<div class="image-sec-hide">
    <div class="d-flex">
        <img id="preview_image" class="mb-3 display_none" width="100px" height="100px">
        <a onclick="chancelImage(this, 'file-src')" class="text-danger ml-2 chancel_btn display_none" href="#">
            <strong class="h4">X</strong>
        </a>
    </div>
</div>

<div>
    <div class="form-group mb-0">
        <label class="mb-0">
            <input name="status"
                   {{ isset($slider) && $slider->status ? 'checked':old('status')}} type="checkbox"
                   class="i-checks">
            Publication Status
        </label>
    </div>
</div>

