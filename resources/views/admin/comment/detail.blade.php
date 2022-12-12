@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Approved Comment</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Comment</li>
            <li class="breadcrumb-item active">Approved</li>
        </ol>
        <a href="/comment" class="btn btn-primary rounded-pill mb-3">Back</a>

        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="label-form" for="">From Post:</label>
                            <h4>{{ $comment->title }}</h4>
                            <p>{!! $comment->shortContent !!}</p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="label-form">Comment:</label>
                            <p class="fs-5 fw-semibold text-black">{{ $comment->content }}</p>
                        </div>
                        <div class="mb-3">
                            <label for=""class="label-form">Reply:</label>
                            @if ($reply)
                                <p class="fs-5 fw-semibold text-black">{{ $reply->content }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Actions</h5>
                        <div class="mb-3 d-flex justify-content-evenly">
                            <form action="{{ route('Acceptedcomment', $comment->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="status" id="status" value="{{ 1 }}">

                                <button class="btn rounded-pill btn-success" type="submit"> <i
                                        class="fa-regular fa-circle-check pe-1"></i>Approved</button>
                            </form>
                            <form action="{{ route('Acceptedcomment', $comment->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="status" id="status" value="{{ 2 }}">
                                <button class="btn rounded-pill btn-danger" type="submit"><i
                                        class="fa-regular fa-circle-xmark pe-1"></i>Rejected</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Comment info
                        </h5>
                        <div class="mb-3">
                            <label for="created_date" class="form-lable">Author: </label>
                            <p class="d-inline p-2">{{ $comment->username }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="created_date" class="form-lable">Comment date: </label>
                            <p class="d-inline p-2">{{ $comment->comment_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
