@extends('admin.layouts.app')

@section('title', 'SEO')

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All SEO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">SEO</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.seos.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="page_id" class="control-label">Select Page</label>
                                        <select id="page_id" name="page_id" class="form-control"
                                                onchange="choosePage(this)">
                                            <option value="">Page</option>
                                            @foreach($pages as $page)
                                                <option
                                                    {{ isset($welcome_page) && $welcome_page->id == $page->id ? 'selected' : '' }} value="{{ $page->id }}">{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('page_id')
                                        <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="page_title" class="control-label">Title or meta
                                                            title</label>
                                                        <input id="page_title" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->page_title : old('page_title')}}"
                                                               name="page_title" class="form-control" autofocus>

                                                        @error('page_title')
                                                        <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="og_title" class="control-label">Open graph
                                                            title</label>
                                                        <input id="og_title" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->og_title : old('og_title')}}"
                                                               name="og_title" class="form-control" autofocus>

                                                        @error('og_title')
                                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="og_type" class="control-label">Open graph
                                                            type</label>
                                                        <input id="og_type" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->og_type : old('og_type')}}"
                                                               name="og_type" class="form-control" autofocus>

                                                        @error('og_type')
                                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="og_url" class="control-label">Open graph url</label>
                                                        <input id="og_url" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->og_url : old('og_url')}}"
                                                               name="og_url" class="form-control" autofocus>

                                                        @error('og_url')
                                                        <span class="help-block m-b-none text-danger">
                                            {{ $message }}
                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="twitter_title" class="control-label">Twitter
                                                            Title</label>
                                                        <input id="twitter_title" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->twitter_title : old('twitter_title')}}"
                                                               name="twitter_title" class="form-control" autofocus>

                                                        @error('twitter_title')
                                                        <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="twitter_card" class="control-label">Twitter
                                                            card</label>
                                                        <input id="twitter_card" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->twitter_card : old('twitter_card')}}"
                                                               name="twitter_card" class="form-control" autofocus>

                                                        @error('twitter_card')
                                                        <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="twitter_site" class="control-label">Twitter
                                                            site</label>
                                                        <input id="twitter_site" type="text"
                                                               value="{{ isset($welcome_page->seo) ? $welcome_page->seo->twitter_site : old('twitter_site')}}"
                                                               name="twitter_site" class="form-control" autofocus>

                                                        @error('twitter_site')
                                                        <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="image">Open graph Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input onchange="previewImage(this);" accept="image/*"
                                                                       type="file"
                                                                       name="og_img"
                                                                       class="custom-file-input"
                                                                       id="og_image">
                                                                <label class="custom-file-label" for="og_image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                        @error('og_img')
                                                        <span
                                                            class="help-block m-b-none text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mr-5">
                                                        @php
                                                            $og_image = isset($welcome_page->seo) && $welcome_page->seo->images ? @$welcome_page->seo->images()->where('type', 'og_image')->first() : null
                                                        @endphp
                                                        <div class="d-flex">
                                                            <img
                                                                class="mb-3"
                                                                id="preview_image"
                                                                src="{{ isset($og_image) && @$og_image !== null ? @$og_image->url  : asset('backend/dist/img/no-image.jpg') }}"
                                                                width="100px"
                                                                height="100px"
                                                                alt="open-graph-image-preview"
                                                            >
                                                            <a onclick="deleteDBImage(this)"
                                                               data-imageBasePath="{{ @$og_image->base_path }}"
                                                               data-imageAbleId="{{ @$welcome_page->seo->id }}"
                                                               class="text-danger image-delete ml-2 deleteOgImage"
                                                               href="javascript:void(0)">
                                                                <i class="fa fa-trash image_preview_delete_icon"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="image">Twitter Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input onchange="previewImage2(this);" accept="image/*"
                                                                       type="file"
                                                                       name="twitter_img" class="custom-file-input"
                                                                       id="twitter_image">
                                                                <label class="custom-file-label" for="twitter_image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                        @error('twitter_img')
                                                        <span
                                                            class="help-block m-b-none text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        @php
                                                            $tw_image = isset($welcome_page->seo) && $welcome_page->seo->images ? @$welcome_page->seo->images()->where('type', 'twitter_image')->first() : null
                                                        @endphp
                                                        <div class="d-flex">
                                                            <img
                                                                class="mb-3"
                                                                id="preview_image2"
                                                                src="{{ isset($tw_image) && @$tw_image !== null ? @$tw_image->url : asset('backend/dist/img/no-image.jpg') }}"
                                                                width="100px"
                                                                height="100px"
                                                                alt="twitter-image-preview"
                                                            >
                                                            <a onclick="deleteDBImage(this)"
                                                               data-imageBasePath="{{ @$tw_image->base_path }}"
                                                               data-imageAbleId="{{ @$welcome_page->seo->id }}"
                                                               class="text-danger image-delete ml-2 deleteTwitterImage"
                                                               href="javascript:void(0)">
                                                                <i class="fa fa-trash image_preview_delete_icon"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="page_keywords" class="control-label">Meta
                                                            keywords</label>

                                                        <textarea id="page_keywords" name="page_keywords"
                                                                  class="form-control"
                                                                  autofocus>{{ isset($welcome_page->seo) ? $welcome_page->seo->page_keywords : old('page_keywords')}}</textarea>

                                                        @error('page_keywords')
                                                        <span class="help-block m-b-none text-danger">
                                                {{ $message }}
                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="page_description" class="control-label">Meta
                                                            Description</label>
                                                        <textarea class="form-control" name="page_description"
                                                                  id="page_description">{{ isset($welcome_page->seo) && $welcome_page->seo->page_description ? $welcome_page->seo->page_description : old('page_description')}}</textarea>
                                                        @error('page_description')
                                                        <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="og_description" class="control-label">Open Graph
                                                            Description</label>
                                                        <textarea class="form-control" name="og_description"
                                                                  id="og_description">{{ isset($welcome_page->seo) && $welcome_page->seo->og_description ? $welcome_page->seo->og_description : old('og_description')}}</textarea>
                                                        @error('og_description')
                                                        <span class="help-block m-b-none text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">

                                                    <div class="form-group">
                                                        <label for="twitter_description" class="control-label">Twitter
                                                            Description</label>
                                                        <textarea class="form-control" name="twitter_description"
                                                                  id="twitter_description">{{ isset($welcome_page->seo) && $welcome_page->seo->twitter_description ? $welcome_page->seo->twitter_description : old('twitter_description')}}</textarea>
                                                        @error('twitter_description')
                                                        <span class="help-block m-b-none text-danger">
                                                {{ $message }}
                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="page_scripts" class="control-label">Page
                                                            Scripts</label>
                                                        <textarea class="form-control" name="page_scripts"
                                                                  id="page_scripts">{{ isset($welcome_page->seo) && $welcome_page->seo->page_scripts ? $welcome_page->seo->page_scripts : old('page_scripts')}}</textarea>
                                                        @error('page_scripts')
                                                        <span class="help-block m-b-none text-danger">
                                                        {{ $message }}
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('script')
    <script>
        function choosePage(el) {
            let id = $(el).val()
            if (id) {
                axios.get('{{ url('admin/pages-seo-content') }}/' + id)
                    .then(res => {
                        if (res.data) {
                            let data = res.data;
                            $("#page_title").val(data.page_title)
                            $("#page_keywords").val(data.page_keywords)
                            $("#page_description").val(data.page_description)
                            $("#page_scripts").val(data.page_scripts)
                            $("#og_title").val(data.og_title)
                            $("#og_type").val(data.og_type)
                            $("#og_url").val(data.og_url)
                            $("#og_description").val(data.og_description)
                            $("#twitter_title").val(data.twitter_title)
                            $("#twitter_site").val(data.twitter_site)
                            $("#twitter_card").val(data.twitter_card)
                            $("#twitter_description").val(data.twitter_description)
                            $("#preview_image").attr('src', data.og_image)
                            $("#preview_image2").attr('src', data.twitter_image)

                            data.images.forEach(item => {
                                if (item.type === "og_image") {
                                    $(".deleteOgImage").data('imagebasepath', item.base_path)
                                    $(".deleteOgImage").data('imageableid', data.id)
                                } else {
                                    $(".deleteTwitterImage").data('imagebasepath', item.base_path)
                                    $(".deleteTwitterImage").data('imageableid', data.id)
                                }
                            })

                            // $(".deleteOgImage").data('imagebasepath', data.image.base_path)
                            // wantToImageDelete = true
                        } else {
                            $("#page_title").val('')
                            $("#page_keywords").val('')
                            $("#page_description").val('')
                            $("#page_scripts").val('')
                            $("#og_title").val('')
                            $("#og_type").val('')
                            $("#og_url").val('')
                            $("#og_description").val('')
                            $("#twitter_title").val('')
                            $("#twitter_site").val('')
                            $("#twitter_card").val('')
                            $("#twitter_description").val('')
                            $("#preview_image").attr('src', '')
                            $("#preview_image2").attr('src', '')
                            // wantToImageDelete = false
                        }
                    })
            }
        }


        function deleteDBImage(e) {
            let base_path = $(e).data('imagebasepath')
            let id = $(e).data('imageableid')
            this.deleteImage(e, base_path, id)
        }

    </script>
@endpush

