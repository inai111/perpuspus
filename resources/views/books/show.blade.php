@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Book Detail</h3>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card rounded shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="imgPreview" class="img-thumbnail"
                                            src="{{ asset('storage/' . $book->cover_photo) }}" alt="{{ $book->title }}"
                                            style="min-width:100px;max-height:200px;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex flex-column h-100">
                                            <h2>{{ $book->title }}</h2>
                                            <div class="text-muted">Author: {{ $book->author }}</div>
                                            <div class="text-muted">Publisher: {{ $book->publisher }}</div>
                                            <div class="text-muted">Category: {{ $book->category->name }}</div>
                                            @if (auth()->user()->role_id == 1)
                                                <div class="d-flex mt-auto gap-2">
                                                    <a type="button" class="btn btn-sm btn-primary"
                                                        href="{{ route('book.edit', ['book' => $book->id]) }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button type="button" onclick="deleteHandler(this)"
                                                        data-href="{{ route('book.destroy', ['book' => $book->id]) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const reader = new FileReader();
        let ppElem = document.querySelector('img#imgPreview');
        let inputCover = document.querySelector('input[name=cover_photo]');

        reader.onload = function() {
            ppElem.src = reader.result;
        };

        inputCover.addEventListener('change', function(e) {
            reader.readAsDataURL(this.files[0])
        })
    </script>
@endsection
