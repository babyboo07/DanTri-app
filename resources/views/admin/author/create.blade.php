@extends('admin.layouts.admin')
@section('content')
    <div class="container">
        <h1 class="mt-4"> Create Member</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Member</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>

        <div class="conatiner row mx-auto">
            <form class="card p-1 pt-2 col-5" action="{{ route('createMember') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3 ">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name"
                            placeholder="Username">
                        @error('name')
                            <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email"
                            placeholder="Email">
                        @error('email')
                            <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option value="">---Select role---</option>
                            @foreach ($role as $item)
                                <option class="text-capitalize" value="{{ $item->id }}">{{ $item->roleName }}</option>
                            @endforeach

                        </select>
                        @error('role_id')
                            <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" value="{{ old('password') }}" id="password"
                            name="password" placeholder="Password" required autocomplete="new-password">
                        @error('password')
                            <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="password-confirm"class="form-label">{{ __('Confirm Password') }}</label>
                        <div class="input-group input-group-merge">
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                            @error('password-confirm')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 float-end">
                        <a href="/author" class="btn btn-primary rounded-pill me-1">Back</a>
                        <button type="submit" class="btn btn-success rounded-pill ">Create</button>
                    </div>
                </div>
            </form>
            <div class="col"></div>
        </div>
    </div>
@endsection
