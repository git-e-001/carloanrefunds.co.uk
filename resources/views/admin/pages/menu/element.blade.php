<input type="hidden" name="menu_id" value="{{ @$menu->id }}">
<div class="form-group">

    {{--    {{ dd($menuTypes, $menuItem->type) }}--}}

    <select onchange="pathType($(this).val())" data-placeholder="Page Select" style="width: 100%;" id="type" name="type"
            class="pageSelect2 whenValidationError whenUpdateTypeChange" required autofocus>
        <option></option>
        @foreach($menuTypes as $key => $menuType)
            <option
                value="{{ $key }}" {{ isset($menuItem) && $menuItem->type == $key ? 'selected' : '' }}>{{ $menuType }}</option>
        @endforeach
    </select>
    @error('type')
    <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="othersInputs {{ isset($menuItem) ? '' : 'd-none' }}">
    <div class="form-group">
        <label for="name" class="control-label">Name<span class="required-star">*</span></label>
        <input id="name" type="text"
               value="{{ isset($menuItem) ? $menuItem->name : old('name')}}"
               name="name" class="form-control" autofocus>
        @error('name')
        <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="icon" class="control-label">Icon</label>
        <select data-placeholder="Icon Select" style="width: 100%;" id="icon" name="icon"
                class="pageSelect2" autofocus>
            @foreach($fontawesome as $icon)
                <option
                    value="{{ @$icon->id }}" {{ isset($menuItem) && $menuItem->icon == $icon->id ? 'selected' : '' }}>{{ @$icon->className }}</option>
            @endforeach
        </select>
        @error('icon')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
    @if(isset($menuItem))
        <div class="form-group">
            <label for="value" class="control-label setLabel">{{ ucwords(@$menuItem->type) }}<span
                    class="required-star">*</span></label>
            <div class="ifCustomUrl {{ $menuItem->type === 'custom-url' ? 'd-none' : ''}}">
                <select data-placeholder="Url/Route/Page Select" style="width: 100%;" id="value" name="value1"
                        class="type pageSelect2">
                    @if($menuItem->type !== 'custom-url')
                        @foreach($types as $type)
                            <option
                                value="{{ $type['value'] }}" {{ isset($menuItem) && $menuItem->value == $type['value'] ? 'selected' : '' }} >{{ $type['type'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @error('custom_value')
            <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
            <div class="ifChangeType">
                <input id="value" type="text"
                       value="{{ isset($menuItem) ? $menuItem->value : old('custom_value') }}"
                       name="custom_value"
                       class="form-control {{ $menuItem->type === 'custom-url' ? '' : 'd-none'}} custom_url" autofocus>
                @error('custom_value')
                <span class="help-block m-b-none text-danger">
                    {{ $message   }}
                </span>
                @enderror
            </div>
        </div>
    @else
        <div class="form-group">
            <label for="value" class="control-label setLabel"></label>
            <div class="ifCustomUrl">
                <select data-placeholder="Url/Route/Page Select" style="width: 100%;" id="value" name="value1"
                        class="type pageSelect2">
                </select>
            </div>
            <input id="value" type="text"
                   value="{{ isset($menuItem) ? $menuItem->value : old('custom_value')}}"
                   name="custom_value" class="form-control d-none custom_url" autofocus>
            @error('custom_value')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
            @enderror
            @error('value1')
            <span class="help-block m-b-none text-danger">
                {{ $message   }}
            </span>
            @enderror
        </div>
    @endif
    <div class="form-group">
        <label for="text_color" class="control-label">Text Color</label>
        <input id="text_color" type="text" value="{{ isset($menuItem) ? $menuItem->text_color : old('text_color')}}"
               name="text_color" class="form-control colorPicker">
        @error('text_color')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="bg_color" class="control-label">Background Color</label>
        <input id="bg_color" type="text" value="{{ isset($menuItem) ? $menuItem->bg_color : old('bg_color')}}"
               name="bg_color" class="form-control colorPicker">
        @error('bg_color')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="target" class="control-label">Target: </label>
        <label for="blank" class="ml-3 ">_Blank</label>
        <input {{ old('target') === 'blank' ? 'checked' : '' }}
               {{ isset($menuItem) && $menuItem->target == '_blank' ? 'Checked' : '' }}
               id="blank" type="radio"
               value="_blank"
               name="target" class="m-2" autofocus>
        <label for="self">_Self</label><input {{ old('target') === 'self' ? 'checked' : '' }} id="self" type="radio"
                                              {{ isset($menuItem) && $menuItem->target === '_self' ? 'Checked' : '' }}
                                              value="_self"
                                              name="target" class="m-2" autofocus>
        <br>
        @error('target')
        <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div>
        <div class="form-group mb-0">
            <label class="mb-0">
                <input name="status"
                       {{ old('status') ? 'checked' : '' }}
                       {{ isset($menuItem) && $menuItem->status ? 'Checked': '' }} type="checkbox"
                       class="i-checks">
                Publication Status
            </label>
        </div>
    </div>
</div>
@push('script')
    <script>
        @if($errors->any())
        var previousType = '{{ old('type') }}';
        getDeta(previousType)
        {{--var r = '{{ old('value1') }}';--}}
        {{--$(".type").append(`<option selected value="${r}"> ${r} </option>`)--}}
        $(".othersInputs").removeClass('d-none')
        setLevel($(".whenValidationError").val());
        $('.type').html('<option selected value="">@error('*') {{ ucwords($message) }} @enderror</option>')
        @endif

        @if(isset($menuItem))
        $(".whenUpdateTypeChange").on('change', function () {
            const type = $(this).val();
            if (type === 'custom-url') {
                $('.type').find('option').remove();
            } else {
                $(".custom_url").val('')
            }

        })
        @endif

        @if(old('type'))
        $("#type").val("{{ old('type') }}")
        pathType("{{ old('type') }}")
        @endif


        function pathType(menuName) {
            $(".othersInputs").removeClass('d-none')
            let menuType = menuName;
            @if(isset($menuItem))
            if (menuType === 'custom-url') {
                $(".ifChangeType").removeClass('d-none')
                $(".custom_url").val('');
            }
            @endif
            setLevel(menuType);
            $('.type').find('option').remove();
            if (menuType === 'custom-url') {
                $('.type').find('option').remove();
                $('.custom_url').removeClass('d-none')
                $('.ifCustomUrl').addClass('d-none')
            } else {
                $('.ifCustomUrl').removeClass('d-none')
                $('.custom_url').addClass('d-none')
                getDeta(menuType)
            }
        }

        function getDeta(menuType) {
            $.get('{{ route("admin.menu-type.change") }}', {type: menuType}, function (response) {
                var i = 0;
                for (i; i < response.length; i++) {
                    var type = response[i].type;
                    var value = response[i].value;
                    $(".type").append(`<option value="${value}"> ${type} </option>`);
                }
            });
        }

        function setLevel(menuType) {
            var label = menuType.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                return letter.toUpperCase();
            });
            var star = '<span class="required-star">*</span>'
            $(".setLabel").html(label + star)
        }

        $(document).ready(function () {
            var $eventSelectOfPage = $(".pageSelect2");
            $eventSelectOfPage.select2()
        });
    </script>
@endpush
