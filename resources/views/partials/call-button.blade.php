@php
    $cbw = array_merge([
        'phone' => $setting->phone1 ?? '',
        'facebook' => $setting->facebook ?? '',
        'instagram' => $setting->fbPixel ?? '',
        'tiktok' => $setting->google ?? '',
        'messenger' => $setting->GA ?? '',
        'position' => 'right',
        'theme' => 'brand',
        'above_totop' => true,
        'hint' => 'Liên hệ ngay',
        'labels' => [
            'phone' => 'Gọi hotline',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'tiktok' => 'TikTok',
            'messenger' => 'Messenger',
        ],
    ], $cbw ?? []);

    $cbwPhone = preg_replace('/\s+/', '', $cbw['phone'] ?? '');
    $hasAny = $cbwPhone || ($cbw['facebook'] ?? '') || ($cbw['instagram'] ?? '') || ($cbw['tiktok'] ?? '') || ($cbw['messenger'] ?? '');
@endphp

@if($hasAny)
<aside
    class="cbw{{ ($cbw['position'] ?? 'right') === 'left' ? ' cbw--left' : '' }}{{ ($cbw['theme'] ?? 'brand') === 'light' ? ' cbw--theme-light' : '' }}{{ !empty($cbw['above_totop']) ? ' cbw--above-totop' : '' }}"
    id="call-button-widget"
    aria-label="Liên hệ nhanh"
    data-cbw-phone="{{ $cbw['phone'] ?? '' }}"
    data-cbw-facebook="{{ $cbw['facebook'] ?? '' }}"
    data-cbw-instagram="{{ $cbw['instagram'] ?? '' }}"
    data-cbw-tiktok="{{ $cbw['tiktok'] ?? '' }}"
    data-cbw-messenger="{{ $cbw['messenger'] ?? '' }}"
    data-cbw-position="{{ $cbw['position'] ?? 'right' }}"
    data-cbw-theme="{{ $cbw['theme'] ?? 'brand' }}"
    data-cbw-above-totop="{{ !empty($cbw['above_totop']) ? 'true' : 'false' }}"
>
    <div class="cbw__panel" role="group" aria-label="Kênh liên hệ">
        <a
            class="cbw__item cbw__item--phone"
            data-cbw-link="phone"
            href="#"
            target="_self"
            rel="noopener"
            aria-label="{{ $cbw['labels']['phone'] ?? 'Gọi hotline' }}"
            @if(!$cbwPhone) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['phone'] ?? 'Gọi hotline' }}</span>
            <span class="cbw__icon"><i class="bi bi-telephone-fill" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--facebook"
            data-cbw-link="facebook"
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['facebook'] ?? 'Facebook' }}"
            @if(empty($cbw['facebook'])) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['facebook'] ?? 'Facebook' }}</span>
            <span class="cbw__icon"><i class="bi bi-facebook" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--instagram"
            data-cbw-link="instagram"
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['instagram'] ?? 'Instagram' }}"
            @if(empty($cbw['instagram'])) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['instagram'] ?? 'Instagram' }}</span>
            <span class="cbw__icon"><i class="bi bi-instagram" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--tiktok"
            data-cbw-link="tiktok"
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['tiktok'] ?? 'TikTok' }}"
            @if(empty($cbw['tiktok'])) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['tiktok'] ?? 'TikTok' }}</span>
            <span class="cbw__icon"><i class="bi bi-tiktok" aria-hidden="true"></i></span>
        </a>
        <a
            class="cbw__item cbw__item--messenger"
            data-cbw-link="messenger"
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ $cbw['labels']['messenger'] ?? 'Messenger' }}"
            @if(empty($cbw['messenger'])) hidden @endif
        >
            <span class="cbw__label">{{ $cbw['labels']['messenger'] ?? 'Messenger' }}</span>
            <span class="cbw__icon"><i class="bi bi-messenger" aria-hidden="true"></i></span>
        </a>
    </div>

    <button type="button" class="cbw__toggle" aria-expanded="false" aria-controls="call-button-widget">
        <span class="cbw__pulse" aria-hidden="true"></span>
        <span class="cbw__toggle-icon cbw__toggle-icon--open" aria-hidden="true"><i class="bi bi-chat-heart-fill"></i></span>
        <span class="cbw__toggle-icon cbw__toggle-icon--close" aria-hidden="true"><i class="bi bi-x-lg"></i></span>
    </button>
    <span class="cbw__hint" role="tooltip">{{ $cbw['hint'] ?? 'Liên hệ ngay' }}</span>
</aside>
@endif
