@extends('layouts.main.master')
@section('title')
    {{ $blog_detail->seo_title ? $blog_detail->seo_title : languageName($blog_detail->title) }}
@endsection
@section('description')
    {{ $blog_detail->meta_description ? $blog_detail->meta_description : languageName($blog_detail->description) }}
@endsection
@section('image')
    {{ url('' . $blog_detail->image) }}
@endsection
@section('schema')
    @php
        $cleanText = function ($value) {
            $text = (string) $value;
            // Remove zero-width chars that usually appear from copy/paste.
            return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
        };
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
        $postTitle = $cleanText(languageName($blog_detail->title));
        $postDescription = $cleanText(
            $blog_detail->meta_description ?: strip_tags(languageName($blog_detail->description)),
        );
        $postContentText = trim($cleanText(strip_tags(languageName($blog_detail->content))));
        preg_match_all('/[\p{L}\p{N}]+/u', $postContentText, $wordMatches);
        $postWordCount = count($wordMatches[0]);
        $postUrl = url()->current();
        $homeUrl = route('home');
        $categoryUrl = route('listCateBlog', ['slug' => $blog_detail->category]);
        $siteName = $setting->webname ?? ($setting->company ?? 'Website');
        $publisherName = $setting->company ?? $siteName;
        $publisherLogo = !empty($setting->logo) ? url($setting->logo) : url('' . $blog_detail->image);
    @endphp
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": {!! json_encode(url('/') . '#website', $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "name": {!! json_encode($siteName, $jsonFlags) !!}
    },
    {
      "@type": "Organization",
      "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!},
      "name": {!! json_encode($publisherName, $jsonFlags) !!},
      "url": {!! json_encode(url('/'), $jsonFlags) !!},
      "logo": {
        "@type": "ImageObject",
        "url": {!! json_encode($publisherLogo, $jsonFlags) !!}
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": {!! json_encode($postUrl . '#breadcrumb', $jsonFlags) !!},
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": {!! json_encode($homeUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
          "item": {!! json_encode($categoryUrl, $jsonFlags) !!}
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": {!! json_encode($postTitle, $jsonFlags) !!},
          "item": {!! json_encode($postUrl, $jsonFlags) !!}
        }
      ]
    },
    {
      "@type": "BlogPosting",
      "@id": {!! json_encode($postUrl . '#article', $jsonFlags) !!},
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": {!! json_encode($postUrl, $jsonFlags) !!}
      },
      "headline": {!! json_encode($postTitle, $jsonFlags) !!},
      "description": {!! json_encode($postDescription, $jsonFlags) !!},
      "articleSection": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},
      "inLanguage": "vi-VN",
      "wordCount": {{ $postWordCount }},
      "datePublished": {!! json_encode(optional($blog_detail->created_at)->toIso8601String(), $jsonFlags) !!},
      "dateModified": {!! json_encode(optional($blog_detail->updated_at)->toIso8601String(), $jsonFlags) !!},
      "image": [
        {
          "@type": "ImageObject",
          "url": {!! json_encode(url(''.$blog_detail->image), $jsonFlags) !!}
        }
      ],
      "author": {
        "@type": "Person",
        "name": {!! json_encode($cleanText($blog_detail->author ?: 'Admin'), $jsonFlags) !!}
      },
      "publisher": {
        "@type": "Organization",
        "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!}
      }
    }
  ]
}
</script>
@endsection
@section('css')
    <style>
        @media (min-width: 992px) {
            .blog-details .blog-details-sidebar.pin-box {
                align-self: flex-start;
            }
        }

        @media (max-width: 991px) {
            .blog-details .blog-details-sidebar.pin-box {
                position: static !important;
            }
        }
    </style>
@endsection
@section('js')
@endsection
@section('content')
    <main class="wrapper">
        <!-- Page Header -->
        <section class="wptb-project pd-top-140 pd-bottom-5">
          <div class="container">
              <div class="wptb-heading">
                  <div class="wptb-item--inner text-center">
                      {{-- <h6 class="wptb-item--subtitle"><span>01//</span> {{ $Cate->name }}</h6> --}}
                      <h1 class="wptb-item--title"> <span>{{ languageName($blog_detail->title) }}</span></h1>
                  </div>
              </div>
  
          </div>
      </section>

        <!-- Details Content -->
        <section class="blog-details">
            <div class="container">
                <div class="row">

                    <div class="col-lg-9 col-md-8 pe-md-5">
                        <div class="blog-details-inner">
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="wptb-item--meta d-flex align-items-center gap-4">
                                        <div class="wptb-item wptb-item--author"><a href="#"><i
                                                    class="bi bi-pencil-square"></i> <span>Admin</span></a></div>
                                        <div class="wptb-item wptb-item--date"><a href="#"><i
                                                    class="bi bi-calendar3"></i> <span>{{date_format($blog_detail->created_at,'d/m/Y')}}</span></a></div>
                                    </div>
                                </div>

                                <div class="intro">
                                    {!!languageName($blog_detail->content)!!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Sidebar  -->
                    <div class="col-lg-3 col-md-4 p-md-0 mt-5 mt-md-0">

                        <div class="sidebar">

                            <div class="widget widget_block">
                                <div class="wp-block-group__inner-container">
                                    <h2 class="widget-title">Dịch vụ của chúng tôi</h2>
                                    <ul class="wp-block-categories-list wp-block-categories">
                                        @foreach ($servicehome as $item)
                                        <li class="cat-item"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a> <i
                                                class="bi bi-chevron-right"></i></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- end widget -->

                            <div class="widget widget_block">
                                <div class="wp-block-group__inner-container">
                                    <h2 class="widget-title">Bài viết mới</h2>
                                    <ul class="wp-block-latest-posts__list wp-block-latest-posts">
                                        @foreach ($bloglq as $item)
                                        <li>
                                            <div class="latest-posts-content">
                                                <h5><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h5>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="widget widget_block">
                                <h2 class="widget-title">
                                    Album Nổi Bật
                                </h2>
                                <div class="wp-block-tag-list wp-block-tag">
                                    @foreach ($projectCate as $item)
                                    <a href="{{route('projectCategory', $item->slug)}}" class="tag-cloud-link">{{($item->name)}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end widget -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Details Content -->

    </main>
@endsection
