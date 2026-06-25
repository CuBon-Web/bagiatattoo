@php
    $projectImages = json_decode($item->images ?? '[]', true) ?: [];
    $projectThumb = $projectImages[0] ?? '';
    $projectThumbUrl = $projectThumb;

    if ($projectThumbUrl && preg_match('#^/frontend/#', $projectThumbUrl)) {
        $projectThumbUrl = r2_asset(ltrim($projectThumbUrl, '/'));
    } elseif ($projectThumbUrl && !preg_match('#^https?://#i', $projectThumbUrl) && strpos($projectThumbUrl, '/') === 0) {
        $projectThumbUrl = url($projectThumbUrl);
    } elseif ($projectThumbUrl && !preg_match('#^https?://#i', $projectThumbUrl)) {
        $projectThumbUrl = url('/' . ltrim($projectThumbUrl, '/'));
    }
@endphp
@if($projectThumb)
<a href="{{ $projectThumbUrl }}"
    class="wptb-item--inner project-item-link"
    data-fancybox="project-thumb"
    data-caption="{{ $item->name }}"
    aria-label="Xem ảnh: {{ $item->name }}">
    <div class="wptb-item--image project-thumb-image">
        {!! lazy_img($projectThumb, $item->name) !!}
    </div>
</a>
@endif
