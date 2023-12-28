@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Create New Member</h3>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-10 mb-3">
                        <div class="card rounded shadow">
                            <div class="card-body">
                                <div class="d-flex flex-column h-100">
                                    <form action="{{ route('user.store') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Member Name</label>
                                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name" name="name"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_id" class="form-label">Role</label>
                                            <select @class(['form-select', 'is-invalid' => $errors->has('role_id')]) aria-label="Default select example"
                                                name="role_id" id="role_id" required>
                                                <option selected disabled value="">Select Category</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        @if (old('role_id') == $role->id) selected @endif>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Member Email</label>
                                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('email')]) id="email" name="email"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) id="password"
                                                name="password" value="{{ old('password') }}">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Password
                                                Confirmation</label>
                                            <input type="password" @class(['form-control']) id="password_confirmation"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Create
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
