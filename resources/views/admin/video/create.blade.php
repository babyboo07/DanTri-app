@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Video</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Video</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>

        <div class="conatiner row mx-auto">
            <div class="card col">
                <div class="card-body">
                    <div class="mb-3 ">
                        <label for="created_date" class="form-label">Video link</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Copy your link Youtube"id="link"
                                name="link" aria-describedby="button-addon2">
                            <button class="btn btn-outline-info" type="button" id="button-addon2">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div id="preview" class="card-body" style="display: none">
                        <h5>Preview Video</h5>
                        <form action="{{ route('video.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title Video</label>
                                        <input type="text text-primary" placeholder="Video title"
                                            class="form-control-plaintext" readonly id="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <iframe id="video"></iframe>
                                    </div>
                                </div>
                                <div class=" mb-3 col">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select id="parentCate" name="cate_id" class="form-select w-100"
                                            style="width: 100%">
                                            @foreach ($categories as $category)
                                                <option class="l1 text-capitalize"
                                                    {{ old('cate_id') == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">
                                                    {{ $category->cateName }}</option>
                                                @if (count($category->children) > 0)
                                                    @foreach ($category->children as $subcategory)
                                                        <option class="l2 ps-2 text-capitalize"
                                                            {{ old('cate_id') == $subcategory->id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">
                                                            {{ $subcategory->cateName }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cate_id')
                                            <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kind</label>
                                        <select class="form-select w-100" style="width: 100%" name="kind" id="kind">
                                            <option class="text-capitalize" value="1">Nomal Video</option>
                                            <option class="text-capitalize" value="2">Short Video</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        {{-- <textarea class="form-control" readonly id="description" name="description" rows="3"></textarea> --}}
                                        <input type="text" class="form-control-plaintext text-primary" 
                                            id="description" name="description">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 float-end">
                                <input type="hidden" name="status" id="status" value={{ 1 }}>
                                <input type="hidden" name="thumbnail" id="thumbnail">
                                <input type="hidden" name="videoID" id="videoID">
                                <a href="/video" class="btn btn-primary rounded-pill me-1">Back</a>
                                <button type="submit" class="btn btn-success rounded-pill float-end">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#parentCate').select2({
                templateResult: function(data) {
                    // We only really care if there is an element to pull classes from
                    if (!data.element) {
                        return data.text;
                    }

                    var $element = $(data.element);

                    var $wrapper = $('<span></span>');
                    $wrapper.addClass($element[0].className);

                    $wrapper.text(data.text);

                    return $wrapper;
                }
            });

            $('#button-addon2').click(function() {
                var link = $('#link').val()
                var videoId = link.substring(link.search("=") + 1)
                console.log(videoId);
                var request = $.ajax({
                    url: 'https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' +
                        videoId + '&key=AIzaSyCgEt73YSvaf7t-ZzQEfQEXfa2Q0e9UlCI',
                    dataType: 'json',
                    delay: 250,
                });
                request.done(function(data) {
                    console.log(data.items[0]);
                    $("#preview").attr('style', "display:block;")
                    $("#title").attr("value", data.items[0].snippet.localized.title);
                    $("#videoID").attr("value", data.items[0].id);
                    $("#thumbnail").attr("value", data.items[0].snippet.thumbnails.maxres.url);
                    $("#video").attr("src", "https://www.youtube.com/embed/" + data.items[0].id);
                    $('#description').attr("value", data.items[0].snippet.localized.description);
                });


            })
        });
    </script>
@endsection
