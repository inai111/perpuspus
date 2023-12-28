@extends('layouts.index')
@include('layouts.navbar')
@section('content')
    <div class="container-fluid">
        <div style="height:250px" class="card">
            <div class="card-body">
                <div class="my-auto d-flex flex-column h-100">
                    <h1>{{$title}}</h1>
                    <p>{{$description}}</p>
                    <div class="mt-auto">
                        <a href="{{route('book.index')}}" class="btn btn-success px-4">See Books</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
