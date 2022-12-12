@foreach ($categories as $item)
    <li class="has-child "><a href="{{ route('sreachByCategory', $item->id) }}"> {{ $item->cateName }}</a>
        <ul class="submenu">
            @foreach ($item->children()->get() as $item)
                <li><a href="{{ route('sreachByCategory', $item->id) }}">{{ $item->cateName }}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach
