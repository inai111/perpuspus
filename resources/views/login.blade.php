@extends('layouts.index')

@section('content')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0">Login</div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="name@example.com" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
