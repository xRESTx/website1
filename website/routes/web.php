<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TestFormController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

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
Route::post('/guestbook/import', [GuestbookController::class, 'import'])->name('guestbook.import');


Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::post('/blog/import', [BlogController::class, 'uploadCsv'])->name('blog.csv');
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
Route::get('/blog/editor', [BlogController::class, 'editor'])->name('blog.editor');
Route::post('/blog/{post}/comment', [BlogController::class, 'addComment'])->name('blog.comment');
Route::post('/blog/comment', [BlogController::class, 'submitComment'])->name('myBlog-modal');


//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
//Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/visits', [LoginController::class, 'showVisits'])->name('admin.visits');
Route::post('/login/login-form', [LoginController::class, 'submit'])->name('login-form');
Route::post('/register/register-form', [LoginController::class, 'submitRegister'])->name('register-form');
Route::post('/check-username', [LoginController::class, 'checkUsername'])->name('check.username');


Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

