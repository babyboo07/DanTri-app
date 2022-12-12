@foreach ($spotlight as $item)
    <article class="article-item" style="width: 100%;">
        <div class="article-thumb"> <a href="{{ route('news', $item->id) }}">
                <img alt="" width="234" height="156"
                    src="{{ asset('storage/post/' . $item->thumbnail) }}" /></a>
        </div>
        <h3 class="article-title"> <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a> </h3>
    </article>
@endforeach
