<div class="container-fluid bg-light px-0"
     style="background-color: {{@$globalSettingInfo->footer_top_section_bg_color}}!important;">
    <div class="container">
        <footer class="pt-3">
            <div class="footer-top py-3">
                <div class="row" style="margin: 0 0 20px 0;">
                    <div class="col-md-6 mb-3">
                        <img
                            width="250" height="50"
                            src="{{ @$globalSettingInfo->image ? $globalSettingInfo->image()->where('type', 'logo')->first()->url : '' }}"
                            alt="">
                        {{--                        asset('frontend/assets/images/logo.png')--}}
                    </div>
                    <div class="col-12">
                        {!! @$globalSettingInfo->description_two !!}
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@if(count($footer_top_menus->menuItems) > 0)
    <div class="container-fluid bg-light px-0" style="background-color: {{@$footer_top_menus->bg_color}}!important;">
        <div class="container">
            <footer class="pt-3">
                <div class="footer-top py-3">
                    <div class="row">
                        @foreach($footer_top_menus->menuItems()->get()->chunk(5) as  $footerTopMenues)
                            <div class="col-md-3 col-sm-12 text-md-left text-center link">
                                <ul>
                                    @foreach($footerTopMenues as $footM)
                                        @if($footM->type === 'custom-url')
                                            <li>
                                                <a class="text-white rounded-sm" target="{{ $footM->target }}"
                                                   style="color: {{$footM->text_color}}!important; background-color: {{$footM->bg_color}}!important;"
                                                   href="{{ $footM->value }}">{{ $footM->name }}</a>
                                            </li>
                                        @elseif($footM->type === 'url')
                                            <li>
                                                <a class="text-white rounded-sm" target="{{ $footM->target }}"
                                                   style="color: {{$footM->text_color}}!important; background-color: {{$footM->bg_color}}!important;"
                                                   href="{{ url($footM->value) }}">{{ $footM->name }}</a>
                                            </li>
                                        @elseif($footM->type === 'route')
                                            <li>
                                                <a class="text-white rounded-sm" target="{{ $footM->target }}"
                                                   style="color: {{$footM->text_color}}!important; background-color: {{$footM->bg_color}}!important;"
                                                   href="{{ route($footM->value) }}">{{ $footM->name }}</a>
                                            </li>
                                        @elseif($footM->type === 'page')
                                            <li>
                                                <a class="text-white rounded-sm" target="{{ $footM->target }}"
                                                   style="color: {{$footM->text_color}}!important; background-color: {{$footM->bg_color}}!important;"
                                                   href="{{ url($footM->value) }}">{{ $footM->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endif

<div class="container-fluid" style="background-color: {{@$footer_bottom_menus->bg_color}}!important;">
    <div class="container">
        <div class="text-center body_color py-3 footer_bottom"
             style="background-color: {{@$footer_bottom_menus->bg_color}}!important;">
            <small class="text-dark">
                <span class="mr-3">© {{ date('Y') }} Copyright {{ config('app.name') }} all rights reserved.</span>
                @if(count($footer_bottom_menus->menuItems) > 0)
                    @foreach($footer_bottom_menus->menuItems()->status()->orderBy('order', "ASC")->get() as $key => $footer_bottom_menu)
                        @if($footer_bottom_menu->type === 'custom-url')
                            {{ $key !== 0 ? '|' : '' }} <a target="{{ $footer_bottom_menu->target }}"
                                                           style="color: {{$footer_bottom_menu->text_color}}!important; background-color: {{$footer_bottom_menu->bg_color}}!important;"
                                                           href="{{ $footer_bottom_menu->value }}">{{ $footer_bottom_menu->name }}</a>
                        @elseif($footer_bottom_menu->type === 'url')
                            {{ $key !== 0 ? '|' : '' }} <a target="{{ $footer_bottom_menu->target }}"
                                                           style="color: {{$footer_bottom_menu->text_color}}!important; background-color: {{$footer_bottom_menu->bg_color}}!important;"
                                                           href="{{ url($footer_bottom_menu->value) }}">{{ $footer_bottom_menu->name }}</a>
                        @elseif($footer_bottom_menu->type === 'route')
                            {{ $key !== 0 ? '|' : '' }} <a target="{{ $footer_bottom_menu->target }}"
                                                           style="color: {{$footer_bottom_menu->text_color}}!important; background-color: {{$footer_bottom_menu->bg_color}}!important;"
                                                           href="{{ route($footer_bottom_menu->value) }}">{{ $footer_bottom_menu->name }}</a>
                        @elseif($footer_bottom_menu->type === 'page')
                            {{ $key !== 0 ? '|' : '' }} <a target="{{ $footer_bottom_menu->target }}"
                                                           style="color: {{$footer_bottom_menu->text_color}}!important; background-color: {{$footer_bottom_menu->bg_color}}!important;"
                                                           href="{{ url($footer_bottom_menu->value) }}">{{ $footer_bottom_menu->name }}</a>
                        @endif
                    @endforeach
                @endif
            </small>
        </div>
    </div>
</div>

