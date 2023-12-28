@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Book Edit</h3>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card rounded shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="imgPreview" class="img-thumbnail"
                                        src="{{ asset('storage/' . $book->cover_photo) }}"
                                        alt="{{ $book->title }}" style="min-width:100px;max-height:200px;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex flex-column h-100">
                                            <form action="{{ route('book.update', ['book' => $book->id]) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="cover_photo" class="form-label">Cover Book</label>
                                                    <input type="file" @class([
                                                        "form-control","is-invalid"=>$errors->has('cover_photo')
                                                        ]) id="cover_photo" name="cover_photo">
                                                    @error('cover_photo')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Book Title</label>
                                                    <input type="text" @class([
                                                        "form-control","is-invalid"=>$errors->has('title')
                                                        ]) id="title" name="title"
                                                        value="{{ old('title', $book->title) }}" required>
                                                        @error('title')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="author" class="form-label">Category</label>
                                                    <select @class(['form-select', 'is-invalid' => $errors->has('categoty_id')]) 
                                                     aria-label="Default select example" name="category_id"
                                                     id="category_id" required>
                                                        <option selected disabled value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if(old('category_id',$book->category_id)==$category->id)
                                                                selected @endif
                                                                >{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="author" class="form-label">Book Author</label>
                                                    <input type="text" @class([
                                                        "form-control","is-invalid"=>$errors->has('author')
                                                        ]) id="author" name="author"
                                                        value="{{ old('author', $book->author) }}" required>
                                                        @error('author')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="publisher" class="form-label">Book Publisher</label>
                                                    <input type="text" @class([
                                                        "form-control","is-invalid"=>$errors->has('publisher')
                                                        ]) id="publisher" name="publisher"
                                                        value="{{ old('publisher', $book->publisher) }}" required>
                                                        @error('publisher')
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
