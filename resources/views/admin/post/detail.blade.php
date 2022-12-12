@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Approved News</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Post</li>
            <li class="breadcrumb-item active">Approved</li>
        </ol>
        <a href="/post" class="btn btn-primary rounded-pill mb-3">Back</a>
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{ $post->title }}</h5>
                        </div>
                        <p>{!! $post->shortContent !!}</p>
                        <p>{!! $post->content !!}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">Actions</h5>
                        <div class="mb-3 d-flex justify-content-evenly">
                            <form action="{{ route('post.status', $post->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="approved_id" id="approved_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="status" id="status" value="{{ 2 }}">
                                <div class="my-2 form-check">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        {{ old('hot') || $post->hot == 1 ? 'checked' : '' }} name="hot" id="hot">
                                    <label class="form-check-label" for="hot">Hot</label>
                                </div>
                                <button class="btn rounded-pill btn-success" type="submit"> <i
                                        class="fa-regular fa-circle-check pe-1"></i>Approved</button>
                            </form>
                            <form action="{{ route('post.status', $post->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="my-2 form-check">
                                    <input class="form-check-input " value="0" type="hidden" name="hot"
                                        id="hot">
                                    {{-- <label class="form-check-label" for="hot">Hot</label> --}}
                                </div>
                                <input type="hidden" name="approved_id" id="approved_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="status" id="status" value="{{ 3 }}">
                                <button class="btn rounded-pill btn-danger" type="submit"><i
                                        class="fa-regular fa-circle-xmark pe-1"></i>Rejected</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">Post Info</h5>
                        <div class="mb-3">
                            <label for="created_date" class="form-lable">Created Date: </label>
                            <p class="d-inline p-2">{{ $post->created_date }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-lable">Author: </label>
                            <p class="d-inline p-2 text-uppercase">{{ $post->author_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="catepost" class="form-lable">Category: </label>
                            <p class="d-inline p-2 text-uppercase">{{ $post->cateName }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-lable">Status: </label>
                            <p class="d-inline p-2">
                                @switch ($post->status)
                                    @case(0)
                                        <span class="badge bg-label-info me-1">{{ 'Draft' }}</span>
                                    @break

                                    @case(1)
                                        <span class="badge bg-label-warning me-1">{{ 'Waitting' }}</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-label-success me-1"> {{ 'Approved' }}</span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-label-danger me-1">{{ 'Rejected' }}</span>
                                    @break

                                    @default
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">Post thumbnail</h5>
                        <div class="mb-3">
                            <img class="w-50 rounded-lg" width=""
                                src="{{ asset('storage/post/' . $post->thumbnail) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card my-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <form action="{{ route('postcommnet.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h5 class="card-title">
                                    Comment
                                </h5>
                                <textarea class="form-control" name="comment" id="comment" placeholder="Comment" rows="3"></textarea>
                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="approved_id" id="approved_id"
                                    value="{{ Auth::user()->id }}">
                                <div class="mt-2">
                                    <button class="btn rounded-pill btn-primary float-end "
                                        type="submit">Comment</button>
                                </div>
                            </form>
                        </div>
                        <div class="my-5">
                            <label for="postComment" class="form-label"> Note Approved</label>
                            @foreach ($pC as $item)
                                <p>{{ $item->comment }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
