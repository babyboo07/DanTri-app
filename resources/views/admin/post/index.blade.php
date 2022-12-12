@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Post</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Dashboard</li>
            <li class="breadcrumb-item active">Post</li>
        </ol>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <p>{{ session('status') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="py-2">
                    <a href="/post/create" class="btn btn-success">Create News</a>
                </div>
                <form action="{{ route('post.search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 d-flex">
                        <div class="col-sm-2 d-flex align-items-center m-1">
                            <input type="text"class="form-control" value="{{ old('search') }}" placeholder="Search..."
                                name="search" id="search">
                        </div>
                        <div class="col-sm-2 d-flex align-items-center m-1">
                            <select name="status" id="status" class="form-select ">
                                <option value="">Select status</option>
                                <option value="0">Draft</option>
                                <option value="1">Waitting</option>
                                <option value="2">Approved</option>
                                <option value="3">Rejected</option>
                            </select>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center m-1">
                            <select name="author_id" id="author_id" class="form-select">
                                <option value="">Select author</option>
                                @foreach ($author as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center m-1">
                            <select name="approved_id" id="approved_id" class="form-select ">
                                <option value="">Select approved</option>
                                @foreach ($approved as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 d-flex align-items-center m-1">
                            <input type="date" name="created_date" id="created_date" class="form-control">
                            <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped ">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Author</th>
                            <th scope="col">Approved</th>
                            <th scope="col">@sortablelink('status')</th>
                            <th scope="col"> @sortablelink('created_date')</th>
                            <th scope="col"> @sortablelink('approved_date')</th>
                            <th scope="col">Thumbnail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th>
                                    @switch ($post->hot)
                                        @case(1)
                                            <i class="fa-solid fa-fire-flame-curved text-danger"></i>
                                            {{ $post->title }}
                                        @break

                                        @case(0)
                                            {{ $post->title }}
                                        @break

                                        @default
                                    @endswitch
                                </th>
                                <td class="text-capitalize">{{ $post->cateName }}</td>
                                <td>{{ $post->author_name }}</td>
                                <td>{{ $post->approved_name }}</td>
                                <td>
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
                                </td>
                                <td>{{ \Carbon\Carbon::parse($post->created_date)->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($post->approved_date != null)
                                        {{ \Carbon\Carbon::parse($post->approved_date)->format('d/m/Y H:i') }}
                                    @endif
                                </td>
                                <td><img class="w-30 rounded-lg" height="90"
                                        src="{{ asset('storage/post/' . $post->thumbnail) }}" alt=""></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($post->status == 2)
                                                <a class="dropdown-item text-warning disabled"
                                                    href="/post/edit/{{ $post->id }}"><i
                                                        class="fa-solid fa-pen"></i></i>
                                                    Edit</a>
                                                <a href="#"
                                                    data-href="{{ route('category.updateStatus', $post->id) }}"
                                                    class="dropdown-item btn text-danger  disabled" id="btn_status"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                        class="fa-solid fa-trash pe-1"></i>Delete</a>
                                            @else
                                                <a class="dropdown-item text-warning"
                                                    href="/post/edit/{{ $post->id }}"><i
                                                        class="fa-solid fa-pen"></i></i>
                                                    Edit</a>
                                                <a href="#" data-href="{{ route('post.destroy', $post->id) }}"
                                                    class="dropdown-item btn text-danger" id="btn_delete"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                        class="fa-solid fa-trash pe-1"></i>Delete</a>
                                            @endif

                                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                                <a class="dropdown-item btn text-primary "
                                                    href="{{ route('post.approved', $post->id) }}"> <i
                                                        class="fa-regular fa-circle-check pe-1"></i>Approved News</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete News ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletePost" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#btn_delete', function() {
                $("#deletePost").attr("action", $(this).data("href"))
            });
        });
    </script>
@endsection
