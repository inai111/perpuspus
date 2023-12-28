@extends('layouts.index')

@section('content')
@include('layouts.navbar')
<div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Setting</h3>
            </div>

            <div class="mb-3">
                <form method="post">
                    @method('PUT')
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name"
                            name="name" value="{{ old('name',$user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('email')]) id="email"
                            name="email" value="{{ old('email',$user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) id="password"
                            name="password" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">New Password Confirmation</label>
                        <input type="password" @class(['form-control']) id="password_confirmation"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-success">Update</button>
                </form>
            </div>

        </div>
    </div>
@endsection
