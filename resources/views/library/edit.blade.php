@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Edit Library Info</h3>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card rounded shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex flex-column h-100">
                                            <form action="{{ route('library.update', ['library' => $library->id]) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Library Title</label>
                                                    <input type="text" @class([
                                                        "form-control","is-invalid"=>$errors->has('title')
                                                        ]) id="title" name="title"
                                                        value="{{ old('title', $library->title) }}" required>
                                                        @error('title')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                                                    >{{ old('description', $library->description) }}</textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary">
                                                    Update
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

    inputCover.addEventListener('change',function(e){
        reader.readAsDataURL(this.files[0])
    })
</script>
@endsection
