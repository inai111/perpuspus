<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
use App\Models\Library;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function(){
    Route::get('user/setting', [UserController::class,'setting'])->name('user.setting');
    Route::put('user/setting', [UserController::class,'settingupdate']);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::get('book/{book}/borrow', [BookController::class,'bookborrow'])->name('book.borrow');
    Route::resource('book', BookController::class);
    Route::get('library/edit', [LibraryController::class,'editLibrary'])->name('library.setting');
    Route::resource('library', LibraryController::class);
    Route::resource('borrow', BorrowController::class);
    
    Route::get('/logout', function () {
        auth()->logout();
        return redirect(route('login'))->with(['message' => 'logout Berhasil']);
    })->name('logout');
});

Route::get('/',function(){
    $data = Library::first();
    return view('welcome',$data);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    
    Route::post('/login', function () {
        $request = request();
    
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if(Auth::attempt(Arr::only($validation,['password','email']))){
            if(auth()->user()->role_id == 1){
                return redirect(route('user.index'));
            }else{
                return redirect(route('book.index'));
            }
        }
    
        return redirect(route('login'))->withErrors(['message' => 'invalid credentials']);
    })->name('login');
});


