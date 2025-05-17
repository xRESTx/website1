<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuestbookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestFormController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact.form');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/education', function () {
    return view('education');
});

Route::get('/interests', function () {
    return view('interests');
});

Route::get('/test', [TestFormController::class, 'show'])->name('test.show');
Route::post('/test', [TestFormController::class, 'submit'])->name('test.submit');
Route::get('/test/results', [TestFormController::class, 'showResults'])->name('test.results');


Route::get('/photo', [PhotoController::class, 'index']);

Route::get('/interests', [InterestController::class, 'index']);

Route::get('/guestbook', [GuestbookController::class, 'show'])->name('guestbook');
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.submit');


Route::get('/blog/editor', [BlogController::class, 'index'])->name('blog.editor');
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::post('/blog/import', [BlogController::class, 'uploadCsv'])->name('blog.csv');
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
