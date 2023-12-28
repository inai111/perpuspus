@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Book List</h3>
            </div>

            <div class="mb-3">
                <a href="{{ route('book.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i>
                    New Book
                </a>
            </div>
            <div class="mb-3">
                <form class="d-flex" role="search">
                    <input name="title" class="form-control me-2" type="search" placeholder="Title" aria-label="Title"
                        value="{{ request('title') }}">
                    <input name="publisher" class="form-control me-2" type="search" placeholder="Publisher"
                        aria-label="Publisher" value="{{ request('publisher') }}">
                    <input name="author" class="form-control me-2" type="search" placeholder="Author" aria-label="Author"
                        value="{{ request('author') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            <div class="mb-3">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-lg-6 mb-3">
                            <div class="card rounded shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('book.show', ['book' => $book->id]) }}">
                                                <img src="{{ asset('storage/' . $book->cover_photo) }}"
                                                    alt="{{ $book->title }}" style="min-width:100px;max-height:200px">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex flex-column h-100">
                                                <a href="{{ route('book.show', ['book' => $book->id]) }}">
                                                    <h2>{{ $book->title }}</h2>
                                                </a>
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
                                                    @else
                                                    <div class="mt-auto">
                                                        <a type="button" class="btn btn-sm btn-success"
                                                            href="{{ route('book.borrow', ['book' => $book->id]) }}">
                                                            <i class="fa-solid fa-plus"></i> Borrow
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-2">
                    {{ $books->onEachSide(1)->links() }}
                </div>
            </div>

        </div>
    </div>


    <div class="modal" id="modalDelete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Yakin akan menghapus data ini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let modalElemDelete = document.getElementById('modalDelete');
        let modalDelete = new bootstrap.Modal(modalElemDelete);
        let deleteHandler = function(elem) {
            modalElemDelete.querySelector('form').action = elem.dataset.href;
            modalDelete.show();
        }

        let modalElemEdit = document.getElementById('modalEdit');
        let modalEdit = new bootstrap.Modal(modalElemEdit);
        let editHandler = function(elem) {
            modalElemEdit.querySelector('form #name').value = elem.dataset.name;
            modalElemEdit.querySelector('form').action = elem.dataset.href;
            modalEdit.show();
        }
    </script>
@endsection
