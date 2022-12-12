@foreach ($allCate as $item)
    <li><a href="{{ route('sreachByCategory', $item->id) }}">{{ $item->cateName }}</a>
        <ul class="nf-submenu">
            @foreach ($item->children()->get() as $item)
                <li><a href="{{ route('sreachByCategory', $item->id) }}">{{ $item->cateName }}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach
