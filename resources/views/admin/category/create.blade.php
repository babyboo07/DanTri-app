@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4">Catgory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Catgory</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>

        <div class="conatiner row mx-auto">
            <form class="card p-1 pt-2 col-9" action="{{ route('category.create') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3 ">
                        <label for="created_date" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="cateName" name="cateName"
                            placeholder="Category Name">
                    </div>
                    <div class=" mb-3">
                        <label class="form-label"> Parent Category</label>
                        <select id="parentCate" name="parent_id" class="form-select">
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label class="form-label">Sub Category</label>
                        <select id="subCate" name="subCate[]" class="form-select" multiple="multiple">
                        </select>
                    </div>
                    <div class="col-md">
                        <small class="form-label">Position</small>
                        <div class="form-check mt-1">
                            <input name="position" class="form-check-input" type="radio" value="" id="position" />
                            <label class="form-check-label" for="defaultRadio1">None </label>
                        </div>
                        <div class="form-check">
                            <input name="position" class="form-check-input" type="radio" value="1" id="position" />
                            <label class="form-check-label" for="defaultRadio2">Position Top </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="2" id="position" name="position" />
                            <label class="form-check-label" for="disabledRadio1"> Position center </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="3" id="position" name="position" />
                            <label class="form-check-label" for="disabledRadio2"> Position bottom</label>
                        </div>
                    </div>
                    <div class="mb-3 float-end">
                        <input type="hidden" name="status" id="status" value={{ 1 }}>
                        <a href="/category" class="btn btn-primary rounded-pill me-1">Back</a>
                        <button type="submit" class="btn btn-success rounded-pill ">Create</button>
                    </div>
                </div>
            </form>
            <div class="col"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#parentCate').select2({
                placeholder: 'Select category',
                ajax: {
                    url: "{{ route('getCateParent') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.cateName,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#subCate').select2({
                placeholder: 'Select category',
                ajax: {
                    url: "{{ route('getCateAll') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.cateName,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
