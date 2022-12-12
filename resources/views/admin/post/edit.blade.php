@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Edit News</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Post</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <form class=" card p-2 " action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title', $post->title) }}"
                            name="title" placeholder="Title ...">
                        @error('title')
                            <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="shortContent" class="form-label">Short Content</label>
                        <textarea type="text" class="form-control" id="shortContent" name="shortContent" value={!! $post->shortContent !!}></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-lable" for="content">
                            Content
                        </label>
                        <textarea class="form-control" type="text" name="content" id="content" value={!! $post->content !!}></textarea>
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="0"
                                {{ old('status') == $post->status || $post->status == 0 ? 'selected' : '' }}>
                                Draft</option>
                            <option value="1"
                                {{ old('status') == $post->status || $post->status == 1 ? 'selected' : '' }}>Wait</option>
                        </select>
                    </div>

                    <div class=" mb-3">
                        <label class="form-lable">Category</label>
                        <select id="parentCate" name="cate_id" class="select2 form-select">
                            @foreach ($categories as $category)
                                <option class="l1 text-capitalize"
                                    {{ old('cate_id') == $category->id || $post->cate_id == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->cateName }}</option>
                                @if (count($category->children) > 0)
                                    @foreach ($category->children as $subcategory)
                                        <option class="l2 ps-2 text-capitalize"
                                            {{ old('cate_id') == $subcategory->id || $post->cate_id == $subcategory->id ? 'selected' : '' }}
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
                    <div class=" mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" value="{{ old('thumbnail', $post->thumbnail) }}" class="form-control"
                            name="thumbnail" id="thumbnail">
                        <img class="w-30 mt-2 " height="90" src="{{ asset('storage/post/' . $post->thumbnail) }}"
                            alt="">
                    </div>
                    <div class="mb-3">
                        <label for="postComment" class="form-label"> Note Approved</label>
                        @foreach ($pC as $item)
                            <p>{{ $item->comment }} <span class="text-capitalize ms-1" >by {{ $item->approved_name }}</span></p>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <a href="/post" class="btn btn-primary rounded-pill me-1">Back</a>
                    <button type="submit" class="btn btn-success me-1 rounded-pill"><i
                            class="fa-regular fa-paper-plane"></i> Update News</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });
            $('#shortContent').summernote({
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });

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
        });
    </script>
@endsection
