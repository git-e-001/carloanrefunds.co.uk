{{--start header top-bar--}}

@if(isset($globalSettingInfo->header_top_title))
    <div class="container-fluid" style="background-color: {{ @$globalSettingInfo->site_top_bar_bg_color }}!important;">
        <div class="container">
            <div class="text-center header_top_mr_0 py-3">
                {!! @$globalSettingInfo->header_top_title !!}
            </div>
        </div>
    </div>
@endif
{{--end header top-bar--}}

{{--start main header--}}
<div class="container-fluid header-bg" style="background-color: {{@$topmenus->bg_color}}!important;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light"
             style="background-color: {{@$topmenus->bg_color}}!important;">
            <a class="navbar-brand" href="/">
                <img class="d-inline-block align-top" width="250" height="50"
                     src="{{ @$globalSettingInfo->image ? $globalSettingInfo->image()->where('type', 'logo')->first()->url : '' }}"
                     alt="">
                {{--                asset('frontend/assets/images/logo.png')--}}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if(count($topmenus->menuItems) > 0)
                        @foreach($topmenus->menuItems as $top_menu)
                            @if($top_menu->slug !== 'apply')
                                @if($top_menu->type === 'custom-url')
                                    <li class="nav-item">
                                        <a target="{{ $top_menu->target }}" class="nav-link text-white rounded-sm"
                                           style="color: {{$top_menu->text_color}}!important; background-color: {{$top_menu->bg_color}}!important;"
                                           href="{{ $top_menu->value }}">{{ $top_menu->name }}</a>
                                    </li>
                                @elseif($top_menu->type === 'url')
                                    <li class="nav-item">
                                        <a target="{{ $top_menu->target }}" class="nav-link text-white rounded-sm"
                                           style="color: {{$top_menu->text_color}}!important; background-color: {{$top_menu->bg_color}}!important;"
                                           href="{{ url($top_menu->value) }}">{{ $top_menu->name }}</a>
                                    </li>
                                @elseif($top_menu->type === 'route')
                                    <li class="nav-item">
                                        <a target="{{ $top_menu->target }}" class="nav-link text-white rounded-sm"
                                           style="color: {{$top_menu->text_color}}!important; background-color: {{$top_menu->bg_color}}!important;"
                                           href="{{ route($top_menu->value) }}">{{ $top_menu->name }}</a>
                                    </li>
                                @elseif($top_menu->type === 'page')
                                    <li class="nav-item">
                                        <a target="{{ $top_menu->target }}" class="nav-link text-white rounded-sm"
                                           style="color: {{$top_menu->text_color}}!important; background-color: {{$top_menu->bg_color}}!important;"
                                           href="{{ url($top_menu->value) }}">{{ $top_menu->name }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </ul>
                @if(!isset($hide_start_claim))
                    @php
                        $apply_btn = \App\Models\PageButton::where('type', 'apply_btn')->first()
                    @endphp
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ isset($apply_btn) && $apply_btn->btn_link ?  $apply_btn->btn_link : config('buttons.header_apply_btn_link') }}"
                               style="
                                   color: {{ isset($apply_btn) && $apply_btn->btn_text_color ?  $apply_btn->btn_text_color : config('buttons.header_apply_text_color') }}!important;
                                   background-color: {{ isset($apply_btn) && $apply_btn->btn_bg_color ?  $apply_btn->btn_bg_color : config('buttons.header_apply_bg_color')}}!important;
                                   border-color: {{ isset($apply_btn) && $apply_btn->btn_border_color ?  $apply_btn->btn_border_color : config('buttons.header_apply_border_color') }}!important;
                                   "
                               class="btn btn-warning px-5">{{ isset($apply_btn) && $apply_btn->btn_text ?  $apply_btn->btn_text : config('buttons.header_apply_btn_text') }}</a>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</div>
{{--end main header--}}

