@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Approved Video</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Video</li>
            <li class="breadcrumb-item active">Approved</li>
        </ol>
        <a href="/video" class="btn btn-primary rounded-pill mb-3">Back</a>
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{ $video->title }}</h5>
                        </div>
                        <div class="mb-3">
                            <span>{{ $video->description }}</span>
                        </div>
                        <iframe width="100%" height="450" id="video"
                            src="https://www.youtube.com/embed/{{ $video->link }}"></iframe>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">Actions</h5>
                        <div class="mb-3 d-flex justify-content-evenly">
                            <form action="{{ route('video.status', $video->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="my-2 form-check">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        {{ old('hot') || $video->hot == 1 ? 'checked' : '' }} name="hot" id="hot">
                                    <label class="form-check-label" for="hot">Hot</label>
                                </div>
                                <input type="hidden" name="status" id="status" value="{{ 2 }}">
                                <button class="btn rounded-pill btn-success" type="submit"> <i
                                        class="fa-regular fa-circle-check pe-1"></i>Approved</button>
                            </form>
                            <form action="#" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="my-2 form-check">
                                    <input class="form-check-input " value="0" type="hidden" name="hot"
                                        id="hot">
                                    {{-- <label class="form-check-label" for="hot">Hot</label> --}}
                                </div>
                                <input type="hidden" name="status" id="status" value="{{ 3 }}">
                                <button class="btn rounded-pill btn-danger" type="submit"><i
                                        class="fa-regular fa-circle-xmark pe-1"></i>Rejected</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">Video Info</h5>
                        <div class="mb-3">
                            <label for="created_date" class="form-label">Created Date: </label>
                            <p class="d-inline p-2">{{ $video->created_at }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author: </label>
                            <p class="d-inline p-2 text-uppercase">{{ $video->author_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="catepost" class="form-label">Category: </label>
                            <p class="d-inline p-2 text-uppercase">{{ $video->cateName }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status: </label>
                            <p class="d-inline p-2">
                                @switch ($video->status)
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
                        <div class="mb-3">
                            <label for="kind" class="form-label">Kind:</label>
                            <p class="d-inline p-2">
                                @switch ($video->kind)
                                    @case(1)
                                        <span class="badge bg-label-dark me-1">{{ 'Nomal Video' }}</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-label-dark me-1">{{ 'Short Video' }}</span>
                                    @break

                                    @default
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
