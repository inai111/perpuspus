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
                <table>
                    <tr>
                        <th></th>
                    </tr>
                    @foreach ($borrows as $borrow)
                    <tr>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
                <div class="my-2">
                    {{ $borrows->onEachSide(1)->links() }}
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
