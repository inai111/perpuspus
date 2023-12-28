@extends('layouts.index')

@include('layouts.navbar')
@section('content')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Members List</h3>
            </div>
            <div class="mb-3">
                <a href="{{route('user.create')}}" id="createNew" type="button" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i>
                    New Member
                </a>
            </div>
            <div class="mb-3">
                <form class="d-flex" role="search">
                    <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            <div class="mb-3">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('user.show',['user'=>$user->id])}}"
                                        class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                        <a href="{{route('user.edit',['user'=>$user->id])}}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{route('user.destroy',['user'=>$user->id])}}"
                                        class="btn btn-sm btn-danger" onclick="confirm('Apakah Data akan dihapus')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-2">
                    {{$users->onEachSide(1)->links()}}
                </div>
            </div>

        </div>
    </div>
@endsection
