@foreach ($spHot as $item)
    <article class="article-items" style="width: 100%; margin-top: 10px;">
        <div class="article-thumb">
            <a href="{{ route('news', $item->id) }}"><img height="100" width="150"
                    src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
        </div>
        <h3 class="article-title">
            <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
        </h3>
    </article>
@endforeach
