@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Comment</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Dashboard</li>
            <li class="breadcrumb-item active">Comment</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Post</th>
                            <th>User</th>
                            <th>@sortablelink('content')</th>
                            <th>@sortablelink('comment_date')</th>
                            <th>Approved</th>
                            <th>@sortablelink('approved_date')</th>
                            <th>Reply</th>
                            <th>@sortablelink('status')</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($comment as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td class="text-capitalize">{{ $item->userName }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->comment_date)->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->approved_name }}</td>
                                <td>
                                    @if ($item->approved_date != null)
                                        {{ \Carbon\Carbon::parse($item->approved_date)->format('d/m/Y H:i') }}
                                    @endif
                                </td>
                                <?php $reply = $item->parentComment(); ?>
                                @if ($reply)
                                    <td>{{ $reply->content }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    @switch ($item->status)
                                        @case(0)
                                            <span class="badge bg-label-warning me-1">{{ 'Waitting' }}</span>
                                        @break

                                        @case(1)
                                            <span class="badge bg-label-success me-1"> {{ 'Approved' }}</span>
                                        @break

                                        @case(2)
                                            <span class="badge bg-label-danger me-1">{{ 'Rejected' }}</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td>
                                    <a class="text-danger m-1" id="deleteComment"
                                        data-href="{{ route('deleteComment', $item->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash-can me-1"></i></a>
                                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                        <a class="text-primary m-1" href="/comment/approved/{{ $item->id }}"><i
                                                class="fa-regular fa-circle-check me-1"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $comment->links() }}
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
                    Do you want to delete this Comment ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="modalApproved" method="POST" enctype="multipart/form-data">
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
            $(document).on('click', '#deleteComment', function() {
                $("#modalApproved").attr("action", $(this).data("href"))
            });
        });
    </script>
@endsection
