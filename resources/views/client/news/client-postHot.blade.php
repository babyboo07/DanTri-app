<article class="article-item">
    <div class="article-thumb">
        {{-- @if ($postHot->thumbnail != null) --}}
            <a href="{{ route('news', $postHot->id) }}">
                <img height="516" width="344" src="{{ asset('storage/post/' . $postHot->thumbnail) }}"
                    alt="" />
            </a>
        {{-- @else
            <a href="#">
                <img height="516" width="344" src="{{ asset('storage/error/error.jpg') }}" alt="" />
            </a>
        @endif --}}

    </div>
    <div class="article-content">
        <h3 class="article-title">
            <a href="{{ route('news', $postHot->id) }}">
                {{ $postHot->title }}</a>
        </h3>
        <div class="article-excerpt">
            <a href="{{ route('news', $postHot->id) }}">
                {!! $postHot->shortContent !!}
            </a>
        </div>
    </div>
</article>
