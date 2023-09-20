@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tài liệu</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-8">
                    <div class="box-content-detail">
                        <h1 class="title-article-detail">{{ $document->title }}</h1>
                        <p class="time-main-article"><i class="far fa-clock"></i> {{ $document->created_at_format }}</p>
                        <div class="show-description">
                            {{ $document->description }}
                        </div>
                        <div class="show-content ck-content">
                            {!! $document->content !!}
                            <div class="text-center">
                                <button type="button" class="btn test-online-button btn-danger text-center" data-bs-toggle="modal" data-bs-target="#downloadDocument">
                                    <i class="fas fa-clipboard-list"></i> Tải tài liệu tham khảo
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="content-news-related">
                        <div class="title-article-related">Bài liên quan</div>
                        <div class="list-related-article">
                            @foreach($documents as $k => $item)
                                <div class="position-relative related-article">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="{{ route('detailDocument',['slug' => $item->slug,'id' => $item->id]) }}" class="link-black">
                                                @include('web.components.image',['src' => $item->image_resize['resize'],'title' => $item->title,'class' => 'hvr-grow' ])
                                            </a>
                                        </div>
                                        <div class="col-8">
                                            <div class="title-new position-relative">
                                                {{ $item->title }}
                                                <a href="{{ route('detailDocument',['slug' => $item->slug,'id' => $item->id]) }}" class="stretched-link"></a>
                                            </div>
                                            <p class="time-create-article ">
                                                <i class="far fa-clock"></i> {{ $item->created_at_format }}
                                            </p>
                                            <p class="description-related">
                                                {{ $item->description }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-news-highlights">
                        <div class="container">
                            <div class="title-article-highlights">Bài viết nổi bật</div>
                            <div class="list-related-article">
                                @foreach($documents as $k => $item)
                                    <div class="position-relative article-highlights">
                                        <div class="row g-2">
                                            <div class="col-5">
                                                <a href="{{ route('detailDocument',['slug' => $item->slug,'id' => $item->id]) }}" class="link-black">
                                                    @include('web.components.image',['src' => $item->image_resize['small'],'title' => $item->title,'class' => 'hvr-grow' ])
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <div class="title-new position-relative">
                                                    {{ $item->title }}
                                                    <a href="{{ route('detailDocument',['slug' => $item->slug,'id' => $item->id]) }}" class="stretched-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="content-news-highlights">
                        <div class="container">
                            <div class="title-article-highlights">Các khóa học tại IELTS TRAINER</div>
                            <div class="list-related-article">
                                @foreach($courses as $k => $item)
                                    <div class="position-relative article-highlights">
                                        <div class="row g-2">
                                            <div class="col-5">
                                                @include('web.components.image', ['src' => $item->image_resize['small'], 'title' => $item->title,'class' => 'img-product-i'])
                                            </div>
                                            <div class="col-7">
                                                <div class="title-program">
                                                    {{ $item->title }}
                                                </div>
                                                <p class="price-program">{{ format_money($item->price_new) }}</p>
                                                @if($item->price)
                                                    <p class="price-old-program">{{ format_money($item->price) }}</p>
                                                @endif
                                                <a href="{{ route('detailCourse',['slug' => $item->slug,'id' => $item->id]) }}" class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.document.modal')
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/news-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/content-ckeditor.css') }}">
@endsection

@section('script')
    @parent
@endsection
