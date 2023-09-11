@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="banner-home-article py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        {!! $banner->content !!}
                    </div>
                    <div class="col-md-6">
                        @include('web.components.image', ['src' => $banner->image_resize, 'title' => $banner->title])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row">
                @if(!empty($articles))
                    @foreach($articles as $item)
                        <div class="col-md-4 position-relative overflow-hidden item-article-home">
                            <a href="{{ route('detailArticle',[$item->slug,$item->id]) }}" class="link-black">
                                @include('web.components.image',['src' => $item->image_resize['resize'],'class' => 'img-new-home hvr-grow' ])
                            </a>
                            <div class="title-new position-relative">
                                {{ $item->title }}
                                <a href="{{ route('detailArticle',[$item->slug,$item->id]) }}" class="stretched-link"></a>
                            </div>
                            <p class="description-news">{{ $item->description }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $articles->links('web.components.pagination') }}
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/news-home.css') }}">
@endsection

@section('script')
    @parent
@endsection
