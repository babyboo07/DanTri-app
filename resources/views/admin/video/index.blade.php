@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Video</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Dashboard</li>
            <li class="breadcrumb-item active">Video</li>
        </ol>
        <div class="py-2">
            <a href="/video/create" class="btn btn-primary">Create Video</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Created date</th>
                            <th>Approved</th>
                            <th>Approved date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($video as $item)
                            <tr>
                                <td>
                                    @switch ($item->status)
                                        @case(1)
                                            <i class="fa-brands fa-youtube text-danger me-3"></i>
                                            <strong class="text-warning">{{ $item->title }}</strong>
                                        @break

                                        @case(2)
                                            <i class="fa-brands fa-youtube text-danger me-3"></i>
                                            <strong class="text-success">{{ $item->title }}</strong>
                                        @break

                                        @case(3)
                                            <i class="fa-brands fa-youtube text-danger me-3"></i>
                                            <strong class="text-secondary">{{ $item->title }}</strong>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="text-capitalize">{{ $item->cateName }}</td>
                                <td>{{ $item->author_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->approved_name }}</td>
                                <td>
                                    @if ($item->approved_date != null)
                                        {{ \Carbon\Carbon::parse($item->approved_date)->format('d/m/Y H:i') }}
                                    @endif
                                </td>
                                <td> @switch ($item->status)
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
                                <td>
                                    <a class="text-danger m-1" id="deleteVideo"
                                        data-href="{{ route('video.delete', $item->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash-can me-1"></i></a>
                                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                        <a class="text-primary m-1" href="/video/approved/{{ $item->id }}"><i
                                                class="fa-regular fa-circle-check me-1"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $video->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete Short Video ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-Video" method="POST">
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
            $(document).on('click', '#deleteVideo', function() {
                $("#delete-Video").attr("action", $(this).data("href"))
            });
        });
    </script>
@endsection
