@extends('layouts.app')

{{--Start => for seo--}}
@section('page_title', isset($welcome_page->seo) && $welcome_page->seo->page_title ? $welcome_page->seo->page_title : 'Payday Loan Claim Specialists - Redbridge Finance')
@section('page_description', isset($welcome_page->seo) && $welcome_page->seo->page_description ? $welcome_page->seo->page_description : 'Payday Loan Claim Specialists - Redbridge Finance')
@section('page_keywords', isset($welcome_page->seo) && $welcome_page->seo->page_keywords ? $welcome_page->seo->page_keywords : '')
@section('page_og_title', isset($welcome_page->seo) && $welcome_page->seo->og_title ? $welcome_page->seo->og_title : '')
@section('page_og_type', isset($welcome_page->seo) && $welcome_page->seo->og_type ? $welcome_page->seo->og_type : '')
@section('page_og_url', isset($welcome_page->seo) && $welcome_page->seo->og_url ? $welcome_page->seo->og_url : '')
@section('page_og_description', isset($welcome_page->seo) && $welcome_page->seo->og_description ? $welcome_page->seo->og_description : '')
@section('page_og_image', isset($welcome_page->seo) && $welcome_page->seo->og_image ? $welcome_page->seo->og_image : '')
@section('page_twitter_title', isset($welcome_page->seo) && $welcome_page->seo->twitter_title ? $welcome_page->seo->twitter_title : '')
@section('page_twitter_site', isset($welcome_page->seo) && $welcome_page->seo->twitter_site ? $welcome_page->seo->twitter_site : '')
@section('page_twitter_card', isset($welcome_page->seo) && $welcome_page->seo->twitter_card ? $welcome_page->seo->twitter_card : '')
@section('page_twitter_description', isset($welcome_page->seo) && $welcome_page->seo->twitter_description ? $welcome_page->seo->twitter_description : '')
@section('page_twitter_image', isset($welcome_page->seo) && $welcome_page->seo->twitter_image ? $welcome_page->seo->twitter_image : '')
@php
        $result = '';
        if (isset($welcome_page->seo->page_scripts) && $welcome_page->seo->page_scripts){
            $doc = new DOMDocument();
            $doc->loadHTML($welcome_page->seo->page_scripts);
            $script_tags = $doc->getElementsByTagName('script');

            foreach ($script_tags as $script_tag) {

                 $src = $script_tag->getAttribute('src');
                 $get_type = $script_tag->getAttribute('type');
                 $type = $get_type ? "type=" . '"'.$get_type.'"' : '';

                if ($src) {
                    $result .= "<script $type src=" . '"'.$src.'"' . "></script>";
                } else {
                    $result .= "<script $type>".$script_tag->textContent."</script>";
                }
            }
        }

@endphp
@if($result !== '')
    @section('page_scripts')
        {!! isset($welcome_page->seo) && $result ? $result : '' !!}
    @endsection
@endif
{{--End => for seo--}}

@push('style')
    <style>
        .content {
            top: 121px !important;
        }

        .slider-container img {
            height: 100%;
            min-width: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .content {
                top: 160px !important;
            }
        }

        @media (max-width: 414px) {
            .content {
                top: 113px !important;
            }

            .content p, span {
                font-size: 15px !important;
            }
        }

    </style>
@endpush

@section('content')

    @if(count($sliders))
        <div class="container-fluid px-0">
            <section>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner slider-container">
                        @foreach($sliders as $key => $slider)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img class="d-block w-100 slider-img"
                                     src="{{ @$slider->image ? @$slider->image->url : '' }}"
                                     alt="{{  @$slider->image->url ?? @$slider->title }}">
                                <div class="content pl-2">
                                    {!! @$slider->description !!}
                                </div>
                                {{--                                @if(@$slider->btn_link || @$slider->btn_text)--}}
                                {{--                                    <div class="apply-btn">--}}
                                {{--                                        <a href="{{ @$slider->btn_link }}" target="_blank"--}}
                                {{--                                           style="background-color: {{ $slider->btn_color }}"--}}
                                {{--                                           class="btn  btn-lg px-5">{{ @$slider->btn_text ?? 'Apply' }} <i--}}
                                {{--                                                class="fa fa-chevron-circle-right"></i></a>--}}
                                {{--                                    </div>--}}
                                {{--                                @endif--}}
                            </div>
                        @endforeach
                    </div>
                    @if(count($sliders) > 1)
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </section>
        </div>
    @endif


    @forelse($pages as $page)
        @forelse($page->contents as $content)
            <div class="container-fluid p-0" style="background-color: {{$content->bg_color}} !important;">
                <div class="container">
                    <div class="row py-5 justify-content-center">
                        <div class="col-xs-12">
                            {!! @$content->body !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    @empty
        <span class="pb">No recode found</span>
    @endforelse
@endsection
