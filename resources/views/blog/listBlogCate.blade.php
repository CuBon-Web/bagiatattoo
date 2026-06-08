@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
{{$title_page}} 
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('schema')
@php
    $cleanText = function ($value) {
        $text = (string) $value;
        // Remove zero-width chars that usually appear from copy/paste.
        return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
    };
    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
    $currentUrl = url()->current();
    $homeUrl = route('home');
    $siteUrl = url('/');
    $categoryUrl = route('listCateBlog', ['slug' => $cate_name]);
    $pageTitle = $cleanText($title_page);
    $siteName = $cleanText($setting->webname ?? $setting->company ?? $title_page);
    $publisherName = $cleanText($setting->company ?? $siteName);
    $publisherLogo = !empty($setting->logo)
        ? url($setting->logo)
        : (!empty($banner[0]->image) ? url($banner[0]->image) : null);

    $itemListElements = [];
    foreach ($blog as $index => $item) {
        $postUrl = route('detailBlog', ['slug' => $item->slug]);
        $postImage = !empty($item->image) ? url($item->image) : null;
        $itemListElements[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'url' => $postUrl,
            'item' => array_filter([
                '@type' => 'BlogPosting',
                'headline' => $cleanText(languageName($item->title)),
                'description' => $cleanText(strip_tags(languageName($item->description))),
                'datePublished' => optional($item->created_at)->toIso8601String(),
                'image' => $postImage,
                'mainEntityOfPage' => $postUrl,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }),
        ];
    }

    $schemaGraph = [
        [
            '@type' => 'WebSite',
            '@id' => $siteUrl . '#website',
            'url' => $siteUrl,
            'name' => $siteName,
            'inLanguage' => 'vi-VN',
        ],
        array_filter([
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $publisherName,
            'url' => $siteUrl,
            'logo' => $publisherLogo ? [
                '@type' => 'ImageObject',
                'url' => $publisherLogo,
            ] : null,
        ], function ($value) {
            return !is_null($value) && $value !== '';
        }),
        [
            '@type' => 'BreadcrumbList',
            '@id' => $currentUrl . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ',
                    'item' => $homeUrl,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $pageTitle,
                    'item' => $categoryUrl,
                ],
            ],
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => $currentUrl . '#collection',
            'url' => $currentUrl,
            'name' => $pageTitle,
            'description' => $pageTitle,
            'inLanguage' => 'vi-VN',
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => $siteUrl . '#website',
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $currentUrl . '#itemlist',
            'name' => $pageTitle,
            'numberOfItems' => count($itemListElements),
            'itemListElement' => $itemListElements,
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $schemaGraph], $jsonFlags) !!}</script>
@endsection
@section('css')
@endsection
@section('js')

@endsection
@section('content')
<main class="wrapper">
       
    <section class="wptb-project pd-top-140 pd-bottom-5">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    {{-- <h6 class="wptb-item--subtitle"><span>01//</span> {{ $Cate->name }}</h6> --}}
                    <h1 class="wptb-item--title"> <span>{{ $cate_name }}</span></h1>
                </div>
            </div>

        </div>
    </section>
    <section class="wptb-blog-grid-one">
        <div class="container">
            
            <div class="row">
                @foreach ($blog as $item)
                <div class="col-lg-4 col-sm-6">
                    <div class="wptb-blog-grid1 highlight wow fadeInLeft active" style="visibility: visible; animation-name: fadeInLeft;">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <a href="{{route('detailBlog',['slug'=>$item->slug])}}" class="wptb-item-link"><img src="{{url(''.$item->image)}}" alt="{{languageName($item->title)}}"></a>
                            </div>
                            <div class="wptb-item--holder">
                                {{-- <div class="wptb-item--date">{{date_format($item->created_at,'d/m/Y')}}</div> --}}
                                <h4 class="wptb-item--title"><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h4>
                                
                                <div class="wptb-item--meta">
                                    <div class="wptb-item--author">By <a href="#">Admin</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

                <div class="wptb-pagination-wrap text-center">
                        {{ $blog->links() }}
            </div>
        </div>
    </section>
</main>

@endsection