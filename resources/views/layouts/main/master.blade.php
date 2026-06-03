<!DOCTYPE html>
<html lang="vi-VN">

<head>
    @php
        $seoCanonical = trim($__env->yieldContent('canonical')) ?: seo_canonical_url();
        $seoRobots = trim($__env->yieldContent('robots')) ?: seo_robots_directive();
        $seoTitle = trim($__env->yieldContent('title'));
        $seoDescription = trim($__env->yieldContent('description'));
        $seoImage = trim($__env->yieldContent('image'));
        $seoSiteName = $setting->webname ?? ($setting->company ?? config('app.name'));
    @endphp
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#d70018">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle }}</title>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta http-equiv="Content-Language" content="vi" />
    <link rel="alternate" href="{{ $seoCanonical }}" hreflang="vi-vn" />
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}" />
    <meta name="googlebot" content="{{ $seoRobots }}">
    <meta name="revisit-after" content="3 days" />
    <meta name="rating" content="General">
    <meta name="application-name" content="{{ $seoSiteName }}" />
    <meta name="theme-color" content="#ed3235" />
    <meta name="msapplication-TileColor" content="#ed3235" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="{{ $seoSiteName }}" />
    @if($seoImage)
    <link rel="apple-touch-icon-precomposed" href="{{ $seoImage }}" sizes="700x700">
    @endif
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:site_name" content="{{ $seoSiteName }}">
    <meta property="og:image:alt" content="{{ $seoTitle }}">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDescription }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />
    <meta name="twitter:url" content="{{ $seoCanonical }}" />
    <meta itemprop="name" content="{{ $seoTitle }}">
    <meta itemprop="description" content="{{ $seoDescription }}">
    <meta itemprop="image" content="{{ $seoImage }}">
    <meta itemprop="url" content="{{ $seoCanonical }}">
    <link rel="canonical" href="{{ $seoCanonical }}">
    @if($seoImage)
    <link rel="image_src" href="{{ $seoImage }}" />
    @endif
    <link rel="shortcut icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <link rel="icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @hasSection('schema')
        @yield('schema')
    @else
        @include('partials.seo-organization')
    @endif
   <!-- Styles Include -->
   <link rel="stylesheet" href="/frontend/css/main.css">
   <link rel="stylesheet" href="/frontend/css/call-button.css">
   <link rel="stylesheet" href="/frontend/css/google-translate-lang.css">
   @yield('css')
</head>

<body class="theme-style--light">
   {{-- Đồng bộ cookie trước khi Google Translate tải (VI/EN ổn định trên server) --}}
   <script>
   (function () {
       var KEY = 'gt_site_lang';
       var PAGE = 'vi';
       var lang = 'vi';
       var expired = 'googtrans=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
       var host = location.hostname;
       var domains = [null];

       try {
           var stored = localStorage.getItem(KEY);
           if (stored === 'en' || stored === 'vi') lang = stored;
       } catch (e) {}

       if (host && host.indexOf('.') !== -1 && host !== 'localhost') {
           var root = host.replace(/^www\./, '');
           domains.push('.' + root, root);
       }

       domains.forEach(function (d) {
           document.cookie = d ? expired + ';domain=' + d : expired;
       });

       var val = lang === 'en' ? '/' + PAGE + '/en' : '/' + PAGE + '/' + PAGE;
       var secure = location.protocol === 'https:' ? ';Secure' : '';
       document.cookie = 'googtrans=' + encodeURIComponent(val) + ';path=/;max-age=31536000;SameSite=Lax' + secure;
   })();
   </script>
   <div id="google_translate_element" aria-hidden="true"></div>
   <!-- Preloader -->
   <div id="preloader">
      <div class="preloader-inner">
         <div class="spinner">
            <video style="width: 120px;height: auto;" src="/frontend/img/1780045539_8c77227f.mp4" autoplay muted loop></video>
            <div class="loading-dot" aria-hidden="true">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      </div>
   </div>
   @include('layouts.header.index')

   <!-- Main Wrapper-->
   @yield('content')

   <!-- Footer -->
   @include('layouts.footer.index')
   @include('partials.call-button')
   <div class="totop">
      <a href="#"><i class="bi bi-chevron-up"></i></a>
   </div>
    <!-- Core JS -->
    <script src="/frontend/js/jquery-3.6.0.min.js"></script>

    <!-- Framework -->
    <script src="/frontend/js/bootstrap.min.js"></script>
    
    <!-- WOW Scroll Effect -->
    <script src="/frontend/js/wow.min.js"></script>

    <!-- Swiper Slider -->
    <script src="/frontend/js/swiper-bundle.min.js"></script>
    <script src="/frontend/js/swiper-gl.min.js"></script>

     <!-- Odometer Counter -->
     <script src="/frontend/js/appear.js"></script>
     <script src="/frontend/js/odometer.js"></script>

     <!-- Projects -->
     <script src="/frontend/js/isotope.pkgd.min.js"></script>
     <script src="/frontend/js/imagesloaded.pkgd.min.js"></script>
     
     <script src="/frontend/js/tilt.jquery.js"></script>
     <script src="/frontend/js/isotope-init.js"></script>

     <!-- Fancybox -->
     <script src="/frontend/js/jquery.fancybox.min.js"></script>

     <!-- Flatpickr -->
     <script src="/frontend/js/flatpickr.min.js"></script>

    <!-- Nice Select -->
    <script src="/frontend/js/jquery.nice-select.min.js"></script>



    <!-- Theme Custom JS -->
    <script src="/frontend/js/theme.js"></script>
    <script src="/frontend/js/call-button.js"></script>
    <script src="/frontend/js/google-translate-lang.js?v=2"></script>
   @yield('js')
</body>

</html>