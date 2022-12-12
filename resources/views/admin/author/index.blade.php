@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-4">Member</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Menber</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <div class="py-2">
                    @if (Auth::user()->role_id == 1)
                        <a href="/author/create" class="btn btn-primary">Create Member</a>
                    @else
                        <a href="/author/create" class="btn btn-primary disabled" disabled>Create Member</a>
                    @endif
                </div>
                <table class="table card-table">
                    <thead>
                        <tr>
                            <th>@sortablelink('id')</th>
                            <th>@sortablelink('name')</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($author as $item)
                            <tr>
                                <td><strong>{{ $item->id }}</strong>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-capitalize">{{ $item->roleName }}</td>
                                <td>
                                    @if (Auth::user()->role_id == 1)
                                        <a class="text-danger m-1" id="deleteAuthor" data-href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fa-solid fa-trash-can me-1"></i></a>
                                        <a class="text-primary m-1" id="updateAuthor"
                                            data-href="{{ route('updateRole', $item->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#updateModalAuthor"><i
                                                class="fa-regular fa-circle-check me-1"></i></a>
                                        <a class="text-primary m-1" id="updateApproved"
                                            data-href="{{ route('updateRole', $item->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#updateModalApproved"><i class="fa-solid fa-ghost me-1"></i></a>
                                    @endif
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete this Author ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="modalDeleteAuthor" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModalAuthor" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Author</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to update this member to author?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="modalAuthor" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="role_id" value={{ 3 }}>
                        <button type="submit" class="btn btn-primary">Update to author</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModalApproved" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Approved</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to update this member to approved?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="modalApproved" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="role_id" value={{ 4 }}>
                        <button type="submit" class="btn btn-warning">Update to approved</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#deleteAuthor', function() {
                $("#modalDeleteAuthor").attr("action", $(this).data("href"))
            });
            $(document).on('click', '#updateAuthor', function() {
                $("#modalAuthor").attr("action", $(this).data("href"))
            });
            $(document).on('click', '#updateApproved', function() {
                $("#modalApproved").attr("action", $(this).data("href"))
            });
        });
    </script>
@endsection
