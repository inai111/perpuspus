<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibraryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        // 
    }
    public function editLibrary()
    {
        $library = Library::first();
        return view('library.edit',compact('library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        $validate = $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
        ]);

        $library->update($validate);
        return redirect('/')->with(['message' => 'Library Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        //
    }
}
