<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = request('title');
        $publisher = request('publisher');
        $author = request('author');

        $books = Book::where('title', 'like', "%{$title}%")
            ->Where('publisher', 'like', "%{$publisher}%")
            ->Where('author', 'like', "%{$author}%")
            ->with('category')
            ->paginate(5)->appends(request()->query());
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validate = $request->validated();
        $validate['cover_photo'] = $validate['cover_photo']->store('assets/img', 'public');
        $book = Book::create($validate);

        return redirect(route('book.show',['book'=>$book->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validate = $request->validated();

        if (isset($validate['cover_photo']) && $validate['cover_photo'] instanceof UploadedFile) {
            $validate['cover_photo'] = $validate['cover_photo']->store('assets/img', 'public');
        }

        $book->update($validate);
        return redirect(route('book.show', ['book' => $book->id]))->with(['message' => 'Book updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();
        return redirect()->back()->with(['message' => 'Category Deleted']);
    }

    public function bookborrow(Book $book)
    {
        $user = User::find(auth()->user()->id);

        $user->borrows()->firstOrNew([
            'book_id' => $book->id,
            'status'=>'pending'
        ])->save();

        return redirect()->back()->with(['message' => 'Book Borrowed']);
    }
}
