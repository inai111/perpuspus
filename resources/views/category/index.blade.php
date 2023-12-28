@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Categories List</h3>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <button onclick="createHandler()" id="createNew" type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i>
                            New Category
                        </button>
                    </div>
                    <div class="mb-3">
                        <form class="d-flex" role="search">
                            <input name="search" class="form-control me-2" type="search" placeholder="Search"
                                aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="mb-3">
                        <table class="table table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" data-name="{{ $category->name }}"
                                                    data-href="{{ route('category.update', ['category' => $category->id]) }}"
                                                    class="btn btn-sm btn-primary" onclick="editHandler(this)">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button type="button"
                                                    data-href="{{ route('category.destroy', ['category' => $category->id]) }}"
                                                    class="btn btn-sm btn-danger" onclick="deleteHandler(this)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="my-2">
                    {{ $categories->onEachSide(1)->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('category.store') }}" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="new Category" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
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

    <div class="modal" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="new Category" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let modalElem = document.getElementById('staticBackdrop');
        let modal = new bootstrap.Modal(modalElem);
        let createHandler = function(event) {
            modalElem.querySelector('form #name').value = '';
            modal.show();
        }

        let modalElemEdit = document.getElementById('modalEdit');
        let modalEdit = new bootstrap.Modal(modalElemEdit);
        let editHandler = function(elem) {
            modalElemEdit.querySelector('form #name').value = elem.dataset.name;
            modalElemEdit.querySelector('form').action = elem.dataset.href;
            modalEdit.show();
        }

        let modalElemDelete = document.getElementById('modalDelete');
        let modalDelete = new bootstrap.Modal(modalElemDelete);
        let deleteHandler = function(elem) {
            modalElemDelete.querySelector('form').action = elem.dataset.href;
            modalDelete.show();
        }
    </script>
@endsection
