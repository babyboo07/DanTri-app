@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Dashboard</li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="py-2">
            @if (Auth::user()->role_id == 1)
                <a href="/category/create" class="btn btn-primary">Create Category</a>
            @else
                <a href="/category/create" class="btn btn-primary disabled" disabled>Create Category</a>
            @endif
        </div>
        <table class="table table-striped ">
            <thead>
                <tr class="table-primary">
                    <th scope="col">@sortablelink('id')</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub Category</th>
                    <th scope="col">@sortablelink('status')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td class="text-capitalize">{{ $category->cateName }}</td>
                        <td>
                            @foreach ($category->children()->get() as $subcate)
                                <span class="badge bg-label-secondary me-1">{{ $subcate->cateName }}</span>
                            @endforeach
                        </td>
                        <td>
                            @switch ($category->status)
                                @case(1)
                                    <span class="badge bg-label-success me-1">Active</span>
                                @break

                                @case(2)
                                    <span class="badge bg-label-danger me-1">Disabled</span>
                                @break

                                @default
                            @endswitch
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if (Auth::user()->role_id == 1)
                                        <a class="dropdown-item text-warning" href="/category/edit/{{ $category->id }}"><i
                                                class="fa-solid fa-pen"></i>
                                            Edit</a>
                                        @if ($category->status == 2)
                                            <a href="#" data-href="{{ route('category.updateStatus', $category->id) }}"
                                                class="dropdown-item btn text-danger  disabled" id="btn_status"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa-solid fa-trash pe-1"></i>Delete</a>
                                        @else
                                            <a href="#" data-href="{{ route('category.updateStatus', $category->id) }}"
                                                class="dropdown-item btn text-danger" id="btn_status" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="fa-solid fa-trash pe-1"></i>Delete</a>
                                        @endif
                                    @else
                                        <a class="dropdown-item text-warning disabled"
                                            href="/category/edit/{{ $category->id }}"><i class="fa-solid fa-pen"></i>
                                            Edit</a>

                                        <a href="#" data-href="{{ route('category.updateStatus', $category->id) }}"
                                            class="dropdown-item btn text-danger  disabled" id="btn_status"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="fa-solid fa-trash pe-1"></i>Delete</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete Category ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="updateStatus" method="POST">
                        <input type="hidden" name="status" id="status" value="{{ 2 }}">
                        @csrf
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
            $(document).on('click', '#btn_status', function() {
                $("#updateStatus").attr("action", $(this).data("href"))
            });
        });
    </script>
@endsection
