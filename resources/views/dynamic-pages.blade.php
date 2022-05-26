@extends('layouts.app')

{{--Start => for seo--}}
@section('page_title', isset($page->seo) && $page->seo->page_title ? $page->seo->page_title : 'Payday Loan Claim Specialists - Redbridge Finance')
@section('page_description', isset($page->seo) && $page->seo->page_description ? $page->seo->page_description : 'Payday Loan Claim Specialists - Redbridge Finance')
@section('page_keywords', isset($page->seo) && $page->seo->page_keywords ? $page->seo->page_keywords : '')
@section('page_og_title', isset($page->seo) && $page->seo->og_title ? $page->seo->og_title : '')
@section('page_og_type', isset($page->seo) && $page->seo->og_type ? $page->seo->og_type : '')
@section('page_og_url', isset($page->seo) && $page->seo->og_url ? $page->seo->og_url : '')
@section('page_og_description', isset($page->seo) && $page->seo->og_description ? $page->seo->og_description : '')
@section('page_og_image', isset($page->seo) && $page->seo->og_image ? $page->seo->og_image : '')
@section('page_twitter_title', isset($page->seo) && $page->seo->twitter_title ? $page->seo->twitter_title : '')
@section('page_twitter_site', isset($page->seo) && $page->seo->twitter_site ? $page->seo->twitter_site : '')
@section('page_twitter_card', isset($page->seo) && $page->seo->twitter_card ? $page->seo->twitter_card : '')
@section('page_twitter_description', isset($page->seo) && $page->seo->twitter_description ? $page->seo->twitter_description : '')
@section('page_twitter_image', isset($page->seo) && $page->seo->twitter_image ? $page->seo->twitter_image : '')


{{--$doc = new DOMDocument();--}}
{{--$doc->loadHTML($page->seo->page_scripts);--}}
{{--$script_tags =  $doc->getElementsByTagName('script');--}}



{{--$result = '';--}}
{{--foreach ($script_tags as $script_tag) {--}}
{{--$result .= "<script src=".$script_tag->getAttribute('src')."></script>";--}}
{{--}--}}

{{--dd($result);--}}

@php
    $result = '';
    if (isset($page->seo->page_scripts) && $page->seo->page_scripts){
    $doc = new DOMDocument();
        $doc->loadHTML($page->seo->page_scripts);
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
        {!! isset($page->seo) && $result ? $result : '' !!}
    @endsection
@endif

@section('content')
    @forelse($page->contents as $content)
        <div class="container-fluid px-0" style="background-color: {{$content->bg_color}} !important;">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12">
                        {!! $content->body !!}
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
@endsection
