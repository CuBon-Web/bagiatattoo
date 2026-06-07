@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    @php
        $ogBanner = $banner->first();
        $ogImage = $ogBanner && $ogBanner->image ? url($ogBanner->image) : url($setting->logo ?? '');
    @endphp
    {{ $ogImage }}
@endsection
@section('css')
    <style>
        .wptb-slider--youtube {
            overflow: hidden;
        }

        .wptb-slider--youtube .wptb-slider--poster {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .wptb-slider--image-media,
        .wptb-slider--poster-media {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .wptb-slider--youtube-iframe {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100vw;
            height: 56.25vw;
            min-height: 100%;
            min-width: 177.77vh;
            transform: translate(-50%, -50%);
            border: 0;
            pointer-events: none;
            z-index: 1;
        }

        @media (max-width: 767px) {
            .wptb-slider--youtube-iframe {
                display: block;
            }

            .wptb-slider--youtube .wptb-slider--poster {
                z-index: 1;
            }
        }

        .wptb-slider.style3 .wptb-slider--overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background:
            linear-gradient(90deg, rgb(0 0 0 / 28%) 0%, rgb(0 0 0 / 29%) 45%, rgb(0 0 0 / 23%) 100%), linear-gradient(180deg, rgb(0 0 0 / 34%) 0%, #00000000 45%, rgb(171 7 7 / 32%) 100%);
        }

        .wptb-slider.style3 .wptb-slider--inner {
            z-index: 2;
        }

        .about-image-left {
            max-width: 300px;
            height: 100%;
            object-fit: cover;
        }
        @media (max-width: 767px) {
            .about-image-left {
                max-width: 100%;
            }
        }

        /* Đặt lịch – giao diện điều đà, nữ tính */
        .booking-form-elegant {
            padding: 72px 0 88px;
            overflow: hidden;
        }

        .booking-form-elegant::before {
            background: #f5eeea;
        }

        .booking-form-elegant .wptb-item-layer {
            opacity: 0.12;
            pointer-events: none;
        }

        .booking-form-elegant .wptb-form--wrapper {
            max-width: 680px;
            margin: 0 auto;
            padding: 0;
            background: transparent;
            border-radius: 0;
        }

        .booking-form-elegant .wptb-form--wrapper::before {
            display: none;
        }

        .booking-form-elegant .booking-form__card {
            padding: 44px 48px 48px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(185, 8, 8, 0.08);
            box-shadow:
                0 24px 64px rgba(61, 48, 42, 0.07),
                0 1px 0 rgba(255, 255, 255, 0.9) inset;
            backdrop-filter: blur(8px);
        }

        .booking-form-elegant .booking-form__eyebrow {
            display: inline-block;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: rgba(185, 8, 8, 0.75);
    margin-bottom: 0;
    line-height: normal;
        }

        .booking-form-elegant .wptb-heading .wptb-item--title {
            font-family: var(--font-family-two);
    font-size: clamp(32px, 4vw, 33px);
    font-weight: 400;
    line-height: 1.2;
    letter-spacing: 0.02em;
    color: #000000;
    margin-bottom: 10px;
    font-style: italic;
        }

        .booking-form-elegant .wptb-heading .wptb-item--description {
            font-size: 16px;
            font-weight: 300;
            line-height: 1.7;
            color: #000000;
            max-width: 420px;
            margin: 0 auto;
        }

        .booking-form-elegant .booking-form__divider {
            width: 48px;
            height: 1px;
            margin: 20px auto 36px;
            background: linear-gradient(90deg, transparent, rgba(185, 8, 8, 0.35), transparent);
        }

        .booking-form-elegant .form-control {
            width: 100%;
            padding: 15px 20px;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.5;
            color: #3a3330;
            background: #faf8f6;
            border: 1px solid #e9dfd8;
            border-radius: 14px;
            border-bottom-width: 1px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .booking-form-elegant .form-control::placeholder {
            color: #b5a9a0;
            font-weight: 300;
        }

        .booking-form-elegant .form-control:focus {
            outline: none;
            background: #fff;
            border-color: rgba(185, 8, 8, 0.35);
            box-shadow: 0 0 0 4px rgba(185, 8, 8, 0.08);
        }

        .booking-form-elegant textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .booking-form-elegant .wptb-item--button {
            margin-top: 8px;
        }

        .booking-form-elegant .wptb-item--button .btn {
            min-width: 200px;
            padding: 14px 36px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #c41e1e 0%, #b90808 100%);
            box-shadow: 0 12px 28px rgba(185, 8, 8, 0.22);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .booking-form-elegant .wptb-item--button .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 36px rgba(185, 8, 8, 0.28);
        }

        .booking-form-elegant .wptb-item--button .text-first {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .theme-style--light .booking-form-elegant .wptb-form--wrapper,
        .theme-style--light .booking-form-elegant .wptb-form--wrapper::before {
            background: transparent;
        }

        @media (max-width: 767px) {
            .booking-form-elegant {
                padding: 48px 0 64px;
            }

            .booking-form-elegant .booking-form__card {
                padding: 32px 22px 36px;
                border-radius: 20px;
            }

            .booking-form-elegant .wptb-heading .wptb-item--title {
                font-size: 28px;
            }
        }

        /* Đánh giá khách hàng – phong cách Google Maps, nhẹ & nữ tính */
        .google-reviews-section {
            padding: 50px 0 0px;
            background: linear-gradient(180deg, #fdfbf9 0%, #f6f0ec 100%) !important;
            background-image: none !important;
        }

        .google-reviews-section .google-reviews__header {
            margin-bottom: 16px;
        }

        .google-reviews-section .google-reviews__badge-row {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            margin-bottom: 16px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid #ebe3dd;
            box-shadow: 0 4px 16px rgba(58, 45, 40, 0.05);
            font-size: 13px;
            font-weight: 500;
            color: #5f6368;
        }

        .google-reviews-section .google-reviews__title {
            font-family: var(--font-family-two);
            font-size: clamp(28px, 3.5vw, 40px);
            font-weight: 400;
            line-height: 1.25;
            color: #000000;
            font-style: italic;
            margin-bottom: 12px;
        }

        .google-reviews-section .google-reviews__subtitle {
            font-size: 15px;
    font-weight: 400;
    color: #000000;
    max-width: 520px;
    margin: 0 auto 20px;
    line-height: 1.7;
        }

        .google-reviews-section .google-reviews__summary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            color: #3a3330;
        }

        .google-reviews-section .google-reviews__summary-score {
            font-weight: 600;
            font-size: 22px;
            color: #b90808;
        }

        .google-reviews-section .google-reviews__summary-stars {
            color: #f4b400;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .google-reviews-section .google-reviews__summary-count {
            color: #8c8178;
            font-weight: 300;
        }

        .google-reviews-section .swiper-testimonial {
            padding-bottom: 0px;
        }

        /* Sidebar — thẻ Google Business (giống Google Maps) */
        .google-business-card {
            height: 100%;
        }

        .google-business-card__inner {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 22px 20px;
        }

        .google-business-card__top {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .google-business-card__logo {
            flex-shrink: 0;
            width: 72px;
            height: 72px;
            padding: 8px;
            border: 1px solid #e8eaed;
            border-radius: 4px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .google-business-card__logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .google-business-card__info {
            min-width: 0;
            flex: 1;
        }

        .google-business-card__title {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.35;
            color: #202124;
            margin: 0 0 10px;
            font-family: var(--font-family-base, Arial, sans-serif);
            font-style: normal;
        }

        .google-business-card__stars {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-bottom: 6px;
            color: #f4b400;
            font-size: 16px;
            line-height: 1;
        }

        .google-business-card__count {
            font-size: 14px;
            font-weight: 400;
            color: #202124;
            margin: 0;
            line-height: 1.4;
        }

        .google-business-card__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 11px 20px;
            border: 1px solid #dadce0;
            border-radius: 24px;
            background: #fff;
            color: #202124;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .google-business-card__btn:hover {
            background: #f8f9fa;
            border-color: #bdc1c6;
            color: #202124;
            box-shadow: 0 1px 2px rgba(60, 64, 67, 0.15);
        }

        @media (max-width: 991px) {
            .google-business-card {
                margin-bottom: 24px;
            }

            .google-business-card__inner {
                max-width: 360px;
                margin: 0 auto;
            }
        }

        .google-review-card {
            height: 100%;
            padding: 24px 26px 22px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid #ebe3dd;
            box-shadow: 0 8px 32px rgba(58, 45, 40, 0.06);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .google-review-card:hover {
            box-shadow: 0 14px 40px rgba(58, 45, 40, 0.09);
            transform: translateY(-2px);
        }

        .google-review-card__head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .google-review-card__author {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .google-review-card__avatar {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #f3e8e4 0%, #e8d5cf 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 600;
            color: #b90808;
        }

        .google-review-card__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .google-review-card__name {
            font-size: 15px;
            font-weight: 600;
            color: #202124;
            margin: 0 0 4px;
            line-height: 1.3;
        }

        .google-review-card__stars {
            color: #f4b400;
            font-size: 12px;
            letter-spacing: 1px;
            line-height: 1;
        }

        .google-review-card__badge {
            flex-shrink: 0;
            opacity: 0.9;
        }

        .google-review-card__text-wrap {
            margin-bottom: 12px;
        }

        .google-review-card__text {
            font-size: 17px;
            font-weight: 400;
            line-height: 1.65;
            color: #000000;
            margin: 0;
        }

        .google-review-card__text.is-clamped {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            line-clamp: 4;
            overflow: hidden;
            word-break: break-word;
        }

        .google-review-card__text.is-expanded {
            display: block;
            overflow: visible;
        }

        .google-review-card__toggle {
            display: inline-block;
            margin-top: 8px;
            padding: 0;
            border: none;
            background: none;
            color: #b90808;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .google-review-card__toggle:hover {
            color: #8a0606;
        }

        .google-review-card__toggle[hidden] {
            display: none !important;
        }

        .google-review-card__meta {
            font-size: 12px;
            color: #8c8178;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .google-reviews-section .google-reviews-pagination {
            bottom: 0 !important;
        }

        .google-reviews-section .google-reviews-pagination .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background: #d4c4bc;
            opacity: 1;
        }

        .google-reviews-section .google-reviews-pagination .swiper-pagination-bullet-active {
            background: #b90808;
            width: 22px;
            border-radius: 4px;
        }

        .google-reviews-section .wptb-swiper-navigation.style1 {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            z-index: 2;
            pointer-events: none;
        }

        .google-reviews-section .wptb-swiper-navigation.style1 .wptb-swiper-arrow {
            pointer-events: auto;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ebe3dd;
            box-shadow: 0 4px 14px rgba(58, 45, 40, 0.08);
            color: #3a3330;
        }

        .theme-style--light .google-reviews-section .wptb-swiper-navigation.style1 .wptb-swiper-arrow {
            background: #fff;
            color: #3a3330;
        }

        @media (max-width: 991px) {
            .google-reviews-section {
                padding: 0px 0 64px;
            }

            .google-reviews-section .wptb-swiper-navigation.style1 {
                display: none;
            }
        }

        .wptb-blog-grid-one .swiper-blog {
            padding-bottom: 0px;
        }

        .wptb-blog-grid-one .swiper-blog .swiper-pagination {
            bottom: 0;
        }

        .wptb-blog-grid-one .swiper-blog .wptb-swiper-navigation.style1 {
            top: 38%;
        }

        @media (max-width: 991px) {
            .wptb-blog-grid-one .swiper-blog .wptb-swiper-navigation.style1 {
                display: none;
            }
        }

        /* FAQ – giao diện nữ tính, nhẹ nhàng */
        .home-faq-elegant {
            position: relative;
            padding: 72px 0 8px;
            background: #f5eeea;
            overflow: hidden;
        }

        .home-faq-elegant::before,
        .home-faq-elegant::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .home-faq-elegant::before {
            width: 320px;
            height: 320px;
            top: -80px;
            right: -60px;
            background: radial-gradient(circle, rgba(243, 214, 205, 0.45) 0%, transparent 70%);
        }

        .home-faq-elegant::after {
            width: 240px;
            height: 240px;
            bottom: -40px;
            left: -40px;
            background: radial-gradient(circle, rgba(233, 223, 216, 0.5) 0%, transparent 70%);
        }

        .home-faq-elegant > .container {
            position: relative;
            z-index: 1;
        }

        .home-faq-elegant__intro {
            position: sticky;
            top: 100px;
        }

        .home-faq-elegant__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.24em;
            text-transform: uppercase;
            color: rgba(185, 8, 8, 0.72);
            margin-bottom: 14px;
        }

        .home-faq-elegant__eyebrow i {
            font-size: 14px;
            opacity: 0.85;
        }

        .home-faq-elegant__title {
            font-family: var(--font-family-two);
            font-size: clamp(30px, 3.6vw, 42px);
            font-weight: 400;
            line-height: 1.25;
            color: #000000;
            font-style: italic;
            margin-bottom: 16px;
        }

        .home-faq-elegant__subtitle {
            font-size: 16px;
            font-weight: 300;
            line-height: 1.75;
            color: #8c8178;
            margin-bottom: 28px;
            max-width: 340px;
        }

        .home-faq-elegant__note {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 20px 22px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(233, 223, 216, 0.9);
            box-shadow: 0 10px 32px rgba(58, 45, 40, 0.05);
        }

        .home-faq-elegant__note-icon {
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8ebe6 0%, #f0ddd5 100%);
            color: #b90808;
            font-size: 18px;
        }

        .home-faq-elegant__note-text {
            font-size: 14px;
            font-weight: 300;
            line-height: 1.65;
            color: #7a7068;
            margin: 0;
        }

        .home-faq-elegant__accordion .wptb--item {
            margin-bottom: 14px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid #ebe3dd;
            box-shadow: 0 6px 24px rgba(58, 45, 40, 0.04);
            overflow: hidden;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        .home-faq-elegant__accordion .wptb--item:hover {
            box-shadow: 0 10px 32px rgba(58, 45, 40, 0.07);
        }

        .home-faq-elegant__accordion .wptb--item.active {
            border-color: rgba(185, 8, 8, 0.18);
            box-shadow: 0 12px 36px rgba(185, 8, 8, 0.08);
        }

        .home-faq-elegant__accordion .wptb--item + .wptb--item .wptb-item-title {
            border-top: none;
        }

        .home-faq-elegant__accordion .wptb-item-title {
            font-size: 18px;
    line-height: 1.45;
    font-weight: 400;
    padding: 20px 36px 0px 24px;
            color: #3a3330;
            border-bottom: none;
        }

        .home-faq-elegant__accordion .wptb--item.active .wptb-item-title {
            color: #b90808;
            border-bottom: none;
        }

        .home-faq-elegant__accordion .wptb-item-title span {
            padding-right: 0;
        }

        .home-faq-elegant__accordion .wptb-item-title i {
            right: 18px;
            width: 34px;
            height: 34px;
            line-height: 34px;
            font-size: 14px;
            color: #b90808;
            background: linear-gradient(135deg, #faf3f0 0%, #f3e4de 100%);
            border: 1px solid rgba(185, 8, 8, 0.1);
        }

        .home-faq-elegant__accordion .wptb--item.active .wptb-item-title i {
            background: linear-gradient(135deg, #c41e1e 0%, #b90808 100%);
            color: #fff;
            border-color: transparent;
        }

        .home-faq-elegant__accordion .wptb-item--content {
            display: none;
            padding: 0 24px 22px;
        }

        .home-faq-elegant__accordion .wptb--item.active .wptb-item--content {
            display: block;
        }

        .home-faq-elegant__accordion .wptb-item--content p {
            font-size: 17px;
    font-weight: 400;
    line-height: 1.75;
    color: #000000;
    margin: 0;
    padding-top: 4px;
    border-top: 1px dashed rgba(233, 223, 216, 0.9);
        }

        .home-faq-elegant__footer {
            margin-top: 28px;
            text-align: center;
        }

        .home-faq-elegant__link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.06em;
            color: #b90808;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 999px;
            border: 1px solid rgba(185, 8, 8, 0.2);
            background: rgba(255, 255, 255, 0.6);
            transition: background 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }

        .home-faq-elegant__link:hover {
            color: #b90808;
            background: #fff;
            box-shadow: 0 8px 24px rgba(185, 8, 8, 0.12);
            transform: translateY(-1px);
        }

        @media (max-width: 991px) {
            .home-faq-elegant {
                padding: 0px 0 20px;
            }

            .home-faq-elegant__intro {
                position: static;
                text-align: center;
                margin-bottom: 8px;
            }

            .home-faq-elegant__subtitle,
            .home-faq-elegant__note {
                max-width: none;
            }

            .home-faq-elegant__note {
                text-align: left;
            }
        }

        @media (max-width: 575px) {
            .home-faq-elegant__accordion .wptb-item-title {
                font-size: 16px;
                padding-right: 52px;
            }
        }
    </style>
@endsection
@section('js')
    <script src="/frontend/js/google-review-card.js?v=1"></script>
@endsection
@section('content')
    <main class="wrapper">
        <!-- Slider Section -->
        @if ($banner->count())
            <section class="wptb-slider style3">
                <div class="swiper-container wptb-swiper-slider-three">
                    <div class="swiper-wrapper">
                        @foreach ($banner as $item)
                            @php
                                $isYoutube = $item->type === 'youtube' && $item->youtube_id;
                                $posterUrl = $item->image
                                    ? url($item->image)
                                    : ($isYoutube
                                        ? 'https://img.youtube.com/vi/' . $item->youtube_id . '/maxresdefault.jpg'
                                        : null);
                                $bannerImgEager = $loop->first;
                                $hasContent =
                                    trim(strip_tags($item->title ?? '')) ||
                                    trim(strip_tags($item->description ?? '')) ||
                                    trim($item->link ?? '');
                            @endphp
                            <div class="swiper-slide">
                                <div class="wptb-slider--item">
                                    @if ($isYoutube)
                                        <div class="wptb-slider--image wptb-slider--youtube">
                                            @if ($posterUrl)
                                                <div class="wptb-slider--poster">
                                                    {!! lazy_img($posterUrl, strip_tags($item->title ?? '') ?: 'Banner video', [
                                                        'eager' => $bannerImgEager,
                                                        'class' => 'wptb-slider--poster-media',
                                                    ]) !!}
                                                </div>
                                            @endif
                                            <iframe class="wptb-slider--youtube-iframe"
                                                src="https://www.youtube.com/embed/{{ $item->youtube_id }}?autoplay=1&mute=1&loop=1&playlist={{ $item->youtube_id }}&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1"
                                                title="{{ $item->title ?: 'Banner video' }}"
                                                allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen
                                                loading="lazy"></iframe>
                                        </div>
                                    @elseif($posterUrl)
                                        <div class="wptb-slider--image">
                                            {!! lazy_img($posterUrl, strip_tags($item->title ?? '') ?: 'Banner', [
                                                'eager' => $bannerImgEager,
                                                'class' => 'wptb-slider--image-media',
                                            ]) !!}
                                        </div>
                                    @endif

                                    @if ($isYoutube || $posterUrl)
                                        <div class="wptb-slider--overlay" aria-hidden="true"></div>
                                    @endif

                                    @if ($hasContent)
                                        <div class="wptb-slider--inner">
                                            <div class="wptb-item--inner">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="wptb-heading">
                                                                @if (trim(strip_tags($item->title ?? '')))
                                                                    <h1 class="wptb-item--title">{!! $item->title !!}
                                                                    </h1>
                                                                @endif
                                                                @if (trim(strip_tags($item->description ?? '')))
                                                                    <div class="wptb-item--description">
                                                                        {!! $item->description !!}</div>
                                                                @endif

                                                                @if (trim($item->link ?? ''))
                                                                    <div class="wptb-item--button">
                                                                        <a class="btn btn-two white" target="_blank"
                                                                            href="{{ $item->link }}">
                                                                            <span class="btn-wrap">
                                                                                <span class="text-first">Xem thêm</span>
                                                                                <span class="text-second">
                                                                                    <i class="bi bi-arrow-up-right"></i>
                                                                                    <i class="bi bi-arrow-up-right"></i>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                        <a class="btn btn-two creative" target="_blank" href="{{$setting->GA}}">
                                                                            <span class="btn-wrap">
                                                                                <span class="text-first">Đặt lịch
                                                                                    ngay</span>
                                                                                <span class="text-second"> <i
                                                                                        class="bi bi-arrow-up-right"></i> <i
                                                                                        class="bi bi-arrow-up-right"></i>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="wptb-bottom-pane justify-content-center">
                    <div class="wptb-swiper-dots style2">
                        <div class="swiper-pagination"></div>
                    </div>

                    <div class="wptb-swiper-navigation style3">
                        <div class="wptb-swiper-arrow swiper-button-prev"></div>
                        <div class="wptb-swiper-arrow swiper-button-next"></div>
                    </div>
                </div>
            </section>
        @endif
        @php
            $aboutImages = json_decode($gioithieu->image ?? '[]', true) ?: [];
        @endphp
        <section class="wptb-about-one bg-image-4"
            style="background-image: url('{{ static_bg('frontend/img/texture.png') }}'); background-position: 80%;">
            <div class="container">
                <div class="wptb-heading">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle"><span>01 //</span> GIỚI THIỆU</h6>
                        <h1 class="wptb-item--title"><span>{{$setting->company}}</span></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wptb-image-single wow fadeInUp">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image mt-3">
                                            @if (!empty($aboutImages[0]))
                                                {!! lazy_img($aboutImages[0], $setting->company ?? 'About us', [
                                                    'class' => 'about-image-left',
                                                ]) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-0 mt-5">
                                <div class="wptb-about--text">
                                    {!! $gioithieu->description !!}

                                    <div class="wptb-item--button round-button">
                                        <a class="btn btn-two" href="{{ route('aboutUs') }}">
                                            <span class="btn-wrap">
                                                <span class="text-first">Xem thêm</span>
                                                <span class="text-second"> <i class="bi bi-arrow-up-right"></i> <i
                                                        class="bi bi-arrow-up-right"></i> </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row wptb-about-funfact">
                            <div class="col-md-6 col-6 mb-4 mb-md-0">
                                <div class="wptb-counter1 style1 pd-right-60 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder align-items-center">
                                            <div class="wptb-item--value"><span class="odometer"
                                                    data-count="3000"></span><span class="suffix">+</span></div>
                                            <div class="wptb-item--text">Khách hàng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-6">
                                <div class="wptb-counter1 style1 pd-right-60 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder align-items-center">
                                            <div class="wptb-item--value flex-shrink-0"><span class="odometer"
                                                    data-count="5000"></span><span class="suffix">+</span></div>
                                            <div class="wptb-item--text">Hình xăm thực hiện</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="wptb-counter1 style1 pd-right-60 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder align-items-center">
                                            <div class="wptb-item--value flex-shrink-0"><span class="odometer"
                                                    data-count="98"></span><span class="suffix">%</span></div>
                                            <div class="wptb-item--text">Khách hàng hài lòng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="wptb-counter1 style1 pd-right-60 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder align-items-center">
                                            <div class="wptb-item--value flex-shrink-0"><span class="odometer"
                                                    data-count="100"></span><span class="suffix">%</span></div>
                                            <div class="wptb-item--text">Dụng cụ vô trùng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 ps-xl-5 mt-5 mt-xl-0 d-none d-xl-block">
                        <div class="wptb-image-single wow fadeInUp">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image mt-3">
                                    @if (!empty($aboutImages[1]))
                                        {!! lazy_img($aboutImages[1], $setting->company ?? 'About us') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wptb-item-layer wptb-item-layer-one">
                    {!! lazy_img(static_bg('frontend/img/light-1.png'), '') !!}
                </div>
                <div class="wptb-item-layer wptb-item-layer-two both-version">
                    {!! lazy_img(static_bg('frontend/img/light-2.png'), '') !!}
                    {!! lazy_img(static_bg('frontend/img/light-2-light.png'), '') !!}
                </div>
            </div>
        </section>

         <!-- Our Projects -->
         <section class="wptb-project">
            <div class="container">
               <div class="wptb-heading">
                  <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle"><span>02//</span> Tác Phẩm Nổi Bật</h6>
                        <h1 class="wptb-item--title"> <span>Mỗi hình xăm lưu giữ một ký ức đẹp</span></h1>
                  </div>
               </div>

               <div class="style-masonry effect-grayscale">
                  <div class="grid grid-3 gutter-10 clearfix"> 
                        <div class="grid-sizer"></div>   
                        @foreach ($duan as $item)
                        <div class="grid-item">
                           @include('layouts.project.item',['item' => $item])
                        </div> 
                        @endforeach                       
                        
                  </div>
               </div>

               <div class="wptb-item--button text-center mt-2">
                  <a class="btn btn-two text-uppercase" href="{{ route('duanTieuBieu') }}">
                        <span class="btn-wrap">
                           <span class="text-first">Xem tất cả tác phẩm</span>
                           <span class="text-second"> <i class="bi bi-arrow-up-right"></i> <i class="bi bi-arrow-up-right"></i> </span>
                        </span>
                  </a>
               </div>
            </div>
         </section>
        <!-- Albums -->
        <section class="wptb-album-one pd-bottom-0">
            <div class="container-full">
                <div class="wptb-heading mb-0">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle"><span>03 //</span>Albums Tác Phẩm</h6>
                        <h1 class="wptb-item--title lg"><span>Bộ Sưu Tập Tattoo Dành Cho Nữ</span></h1>
                    </div>
                </div>

                <div class="swiper-container swiper-gallery-two has-radius">
                    <div class="swiper-wrapper">
                     @foreach ($projectCate as $item)
                         <!-- Item -->
                        <div class="swiper-slide">
                           <div class="grid-item">
                               <div class="wptb-item--inner">
                                   <div class="wptb-item--image">
                                    @php
                                        $albumCateImage = (json_decode($item->image ?? '[]', true) ?: [])[0] ?? '';
                                    @endphp
                                    @if ($albumCateImage)
                                       {!! lazy_img($albumCateImage, $item->name, ['class' => 'project-thumb-image-cate']) !!}
                                    @endif
                                    <a class="wptb-item--link" href="{{ route('projectCategory',['slug'=>$item->slug]) }}"><i
                                            class="bi bi-chevron-right"></i></a>
                                </div>
                                   <div class="wptb-item--holder">
                                       <div class="wptb-item--meta">
                                           <h4><a href="{{ route('projectCategory',['slug'=>$item->slug]) }}">{{ $item->name }}</a></h4>
                                           <p>{{ $item->description }}</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                     @endforeach
                       
                    </div>

                    <!-- Swiper Navigation -->
                    <div class="wptb-swiper-navigation style2">
                        <div class="wptb-swiper-arrow swiper-button-prev"></div>
                        <div class="wptb-swiper-arrow swiper-button-next"></div>
                    </div>
                </div>

                {{-- <div class="shadow-heading">
                    <h1 class="wptb-item--title">ALBUMS</h1>
                </div> --}}
            </div>
        </section>

        <!-- Đặt lịch -->
        <section class="wptb-contact-form style1 booking-form-elegant">
            <div class="wptb-item-layer both-version" aria-hidden="true">
                {!! lazy_img(static_bg('frontend/img/texture-2.png'), '') !!}
            </div>
            <div class="container">
                <div class="wptb-form--wrapper">
                    <div class="booking-form__card">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner text-center">
                                <span class="booking-form__eyebrow">Liên hệ</span>
                                <h2 class="wptb-item--title">Đặt lịch ngay</h2>
                                <p class="wptb-item--description">Để lại thông tin, chúng tôi sẽ gọi lại và tư vấn cho bạn một cách tận tâm nhất.</p>
                                <div class="booking-form__divider"></div>
                            </div>
                        </div>

                        <form class="wptb-form" action="{{ route('postcontact') }}" method="post">
                            @csrf
                            <div class="wptb-form--inner">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group mb-0">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Họ và tên *" required autocomplete="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group mb-0">
                                            <input type="tel" name="phone" class="form-control"
                                                placeholder="Số điện thoại *" required autocomplete="tel">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-group mb-0">
                                            <textarea name="mess" class="form-control" rows="4"
                                                placeholder="Lời nhắn của bạn (tuỳ chọn)..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="wptb-item--button text-center">
                                            <button class="btn" type="submit">
                                                <span class="btn-wrap">
                                                    <span class="text-first">Gửi đăng ký</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team -->
        {{-- <section class="wptb-team-one">
            <div class="container">
                <div class="wptb-heading">
                    <div class="wptb-item--inner">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="wptb-item--subtitle"><span>05 //</span> Our Team</h6>
                                <h1 class="wptb-item--title mb-lg-0">Our Core Team of<br>
                                    <span>Photographers</span>
                                </h1>
                            </div>

                            <div class="col-lg-6">
                                <p class="wptb-item--description">we’re deeply passionate <span>catch your lovely memories
                                        in
                                        cameras</span>
                                    and Convey your love for every moment of life as a whole.</p>


                                <!-- Swiper Navigation -->
                                <div class="wptb-swiper-navigation style1">
                                    <div class="wptb-swiper-arrow swiper-button-prev"></div>
                                    <div class="wptb-swiper-arrow swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-container swiper-team">
                    <div class="swiper-wrapper">
                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/1.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Maxim Alexhander</h5>
                                            <p class="wptb-item--position">CEO, Kimono Agency</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/2.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Nelson Jameson</h5>
                                            <p class="wptb-item--position">Photographer</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/3.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Ellie Duncan</h5>
                                            <p class="wptb-item--position">Photographer</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/4.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Harold Earls</h5>
                                            <p class="wptb-item--position">Photographer</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/2.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Nelson Jameson</h5>
                                            <p class="wptb-item--position">Photographer</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Block -->
                        <div class="swiper-slide">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="https://wpthemebooster.com/demo/themeforest/html/kimono/assets/img/team/3.jpg"
                                            alt="img">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title">Ellie Duncan</h5>
                                            <p class="wptb-item--position">Photographer</p>
                                        </div>
                                        <div class="wptb-item--social">
                                            <a href="#">FB</a>
                                            <a href="#">IG</a>
                                            <a href="#">YT</a>
                                            <a href="#">DR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


        

        @if(isset($ReviewCus) && $ReviewCus->count())
        <!-- Đánh giá khách hàng (Google Maps style) -->
        <section class="wptb-testimonial-one google-reviews-section">
            <div class="container">
                <div class="google-reviews__header text-center">
                    <div class="google-reviews__badge-row">
                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span>Đánh giá trên Google Maps</span>
                    </div>
                    <h2 class="google-reviews__title">Cảm Nhận Từ Khách Hàng</h2>
                    <p class="google-reviews__subtitle">Những chia sẻ chân thực từ khách hàng đã đồng hành cùng Bagia Tattoo.</p>
                    <div class="google-reviews__summary">
                        <span class="google-reviews__summary-score">5.0</span>
                        <span class="google-reviews__summary-stars" aria-hidden="true">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </span>
                        <span class="google-reviews__summary-count">· {{ $ReviewCus->count() }} đánh giá</span>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-lg-3 col-md-4" style="margin: auto;">
                        
                        <aside class="box-content-feedback google-business-card" aria-label="Thông tin đánh giá Google">
                            <div class="google-business-card__inner">
                                <div class="google-business-card__top">
                                    <div class="google-business-card__logo">
                                        @if(!empty($setting->logo))
                                            <img src="{{ url($setting->logo) }}" alt="{{ $setting->logo }}">
                                        @endif
                                    </div>
                                    <div class="google-business-card__info">
                                        <h3 class="google-business-card__title">
                                            <span class="d-block fw-normal" style="font-size: 18px; color: #000000; margin-top: 4px;">{{ $setting->company }}</span>
                                        </h3>
                                        <div class="google-business-card__stars" aria-label="5 trên 5 sao">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <p class="google-business-card__count">
                                            130+ đánh giá trên Google
                                        </p>
                                    </div>
                                </div>
                                <a class="google-business-card__btn"
                                    href="https://admin.trustindex.io/api/googleWriteReview?place-id=ChIJj9gz0OOrNTERRIo5wmaGDLo"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    Viết đánh giá
                                </a>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="swiper-container swiper-testimonial position-relative">
                            <div class="swiper-wrapper">
                                @foreach($ReviewCus as $review)
                                <div class="swiper-slide">
                                    @include('layouts.review.google-card', ['review' => $review])
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination google-reviews-pagination"></div>
                            {{-- <div class="wptb-swiper-navigation style1">
                                <div class="wptb-swiper-arrow swiper-button-prev"></div>
                                <div class="wptb-swiper-arrow swiper-button-next"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="wptb-item--button text-center mt-2">
                    <a class="btn btn-two text-uppercase" target="_blank" href="https://www.google.com/maps/place/Ti%E1%BB%87m+x%C4%83m+Bagia+Tattoo/@21.0259198,105.8265987,1052m/data=!3m1!1e3!4m8!3m7!1s0x3135abe3d033d88f:0xba0c8666c2398a44!8m2!3d21.0259198!4d105.8265987!9m1!1b1!16s%2Fg%2F11jh6qsml8?entry=ttu&g_ep=EgoyMDI2MDYwMS4wIKXMDSoASAFQAw%3D%3D">
                          <span class="btn-wrap">
                             <span class="text-first">Xem thêm đánh giá</span>
                             <span class="text-second"> <i class="bi bi-arrow-up-right"></i> <i class="bi bi-arrow-up-right"></i> </span>
                          </span>
                    </a>
                 </div>
            </div>
        </section>
        @endif


        @if(isset($homeFaqs) && $homeFaqs->count())
        <section class="home-faq-elegant">
            <div class="container">
                <div class="row align-items-start g-4 g-lg-5">
                    <div class="col-lg-4">
                        <div class="home-faq-elegant__intro">
                            <span class="home-faq-elegant__eyebrow">
                                <i class="bi bi-chat-heart"></i> Hỗ trợ
                            </span>
                            <h2 class="home-faq-elegant__title">Câu hỏi thường gặp</h2>
                            <p class="home-faq-elegant__subtitle">Những thắc mắc phổ biến nhất — gửi gắm trong lời giải đáp nhẹ nhàng, để bạn an tâm trước mỗi buổi hẹn.</p>
                            <div class="home-faq-elegant__note">
                                <span class="home-faq-elegant__note-icon" aria-hidden="true">
                                    <i class="bi bi-flower1"></i>
                                </span>
                                <p class="home-faq-elegant__note-text">Chưa tìm thấy câu trả lời? Hãy nhắn tin cho chúng tôi — đội ngũ luôn sẵn sàng lắng nghe và tư vấn riêng cho bạn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="wptb-accordion wptb-accordion1 home-faq-elegant__accordion">
                            @foreach ($homeFaqs as $index => $faq)
                            <div class="wptb--item{{ $index === 0 ? ' active' : '' }}">
                                <div class="wptb-item-title">
                                    <span>{{ $faq->question }}</span>
                                    <i class="bi bi-plus-lg plus"></i>
                                    <i class="bi bi-dash-lg minus"></i>
                                </div>
                                <div class="wptb-item--content" @if($index !== 0) style="display: none;" @endif>
                                    <p>{!! nl2br(e($faq->answer)) !!}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Blog Grid -->
        @foreach ($blogCateForBlog as $item)
        <section class="wptb-blog-grid-one pb-0">
         <div class="container">
             <div class="wptb-heading">
                 <div class="wptb-item--inner">
                     <div class="row align-items-center">
                         <div class="col-lg-12">
                             {{-- <h6 class="wptb-item--subtitle"> <span>// âsd</span> Blog &  News</h6> --}}
                             <h2 class="wptb-item--title mb-0">
                                 <span>{{ languageName($item->name) }}</span>
                             </h2>
                         </div>
                     </div>
                 </div>
             </div>

             @if($item->listBlog->isNotEmpty())
             <div class="wptb-blog--inner">
                 <div class="swiper-container swiper-blog position-relative">
                     <div class="swiper-wrapper">
                         @foreach ($item->listBlog as $itemBlog)
                         <div class="swiper-slide">
                             <div class="wptb-blog-grid1 active highlight">
                                 <div class="wptb-item--inner">
                                     <div class="wptb-item--image">
                                         <a href="{{ route('detailBlog', ['slug' => $itemBlog->slug]) }}" class="wptb-item-link">
                                             {!! lazy_img($itemBlog->image, languageName($itemBlog->title)) !!}
                                         </a>
                                     </div>
                                     <div class="wptb-item--holder">
                                         <div class="wptb-item--date">{{ date_format($itemBlog->created_at, 'd/m/Y') }}</div>
                                         <h4 class="wptb-item--title">
                                             <a href="{{ route('detailBlog', ['slug' => $itemBlog->slug]) }}">{{ languageName($itemBlog->title) }}</a>
                                         </h4>
                                         <div class="wptb-item--meta">
                                             <div class="wptb-item--author line_2">{{languageName($itemBlog->description)}}</div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endforeach
                     </div>
                     <div class="swiper-pagination"></div>
                     <div class="wptb-swiper-navigation style1">
                         <div class="wptb-swiper-arrow swiper-button-prev"></div>
                         <div class="wptb-swiper-arrow swiper-button-next"></div>
                     </div>
                 </div>
             </div>
             @endif
         </div>
     </section>
        @endforeach
        <section class="pdb-0 pdt-0">
         <div class="container">
            <div class="wptb-office-address">
               <div class="row">
                   <div class="col-lg-4 col-md-6">
                       <div class="wptb-icon-box1 wow fadeInLeft">
                           <div class="wptb-item--inner flex-start">
                               <div class="wptb-item--icon"><i class="bi bi-facebook"></i></div>
                               <div class="wptb-item--holder">
                                   <h3 class="wptb-item--title">Facebook</h3>
                                   <p class="wptb-item--description">{{$setting->facebook}}</p>
                                   <a href="{{$setting->facebook}}" class="wptb-item--link">Visit Now</a>
                               </div>
                           </div>
                       </div>
                   </div>
      
                   <div class="col-lg-4 col-md-6 px-md-5">
                       <div class="wptb-icon-box1 wow fadeInLeft">
                           <div class="wptb-item--inner flex-start">
                               <div class="wptb-item--icon"><i class="bi bi-phone"></i></div>
                               <div class="wptb-item--holder">
                                   <h3 class="wptb-item--title">Số điện thoại</h3>
                                   <p class="wptb-item--description">{{$setting->phone1}}</p>
                                   <a href="tel:{{$setting->phone1}}" class="wptb-item--link">Call Now</a>
                               </div>
                           </div>
                       </div>
                   </div>
      
                   <div class="col-lg-4 col-md-6">
                       <div class="wptb-icon-box1 wow fadeInLeft">
                           <div class="wptb-item--inner flex-start">
                               <div class="wptb-item--icon"><i class="bi bi-map"></i></div>
                               <div class="wptb-item--holder">
                                   <h3 class="wptb-item--title">Địa chỉ</h3>
                                   <p class="wptb-item--description">{{$setting->address1}}</p>
                                   <a href="{{$setting->iframe_map}}" class="wptb-item--link">View Map</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
         </div>
        </section>
    </main>
@endsection
