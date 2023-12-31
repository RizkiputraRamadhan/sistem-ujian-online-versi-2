<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ExamController;
use App\Http\Controllers\Backend\GuruController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\SiswaController;
use App\Http\Controllers\Backend\DiskusiController;
use App\Http\Controllers\Backend\KategoriController;
use App\Http\Controllers\backend\QuestionController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //Categories
    Route::get('/categories', [KategoriController::class, 'index']);
    Route::get('/categories/create', [KategoriController::class, 'create']);
    Route::get('/categories/edit/{id}', [KategoriController::class, 'edit']);
    Route::get('/categories/publish/{id}', [KategoriController::class, 'publish']);
    Route::get('/categories/draft/{id}', [KategoriController::class, 'draft']);
    Route::post('/categories/store', [KategoriController::class, 'store']);
    Route::post('/categories/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/categories/destroy/{id}', [KategoriController::class, 'destroy']);
    // question
    Route::get('/question/create/{id}', [QuestionController::class, 'create']);
    Route::get('/question/edit/{id}', [QuestionController::class, 'edit']);
    Route::post('/question/store/{id}', [QuestionController::class, 'store']);
    Route::post('/question/update/{id}', [QuestionController::class, 'update']);
    Route::get('/question/publish/{id}', [QuestionController::class, 'publish']);
    Route::get('/question/draft/{id}', [QuestionController::class, 'draft']);
    Route::delete('/question/destroy/{id}', [QuestionController::class, 'destroy']);
    //akun siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::post('/siswa/profil/store', [SiswaController::class, 'profil']);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::post('/siswa/update/{id}', [SiswaController::class, 'update']);
    Route::get('/siswa/detail/{id}', [SiswaController::class, 'show']);
    Route::delete('/siswa/destroy/{id}', [SiswaController::class, 'destroy']);
    //akun guru
    Route::get('/guru', [GuruController::class, 'index']);
    Route::post('/guru/store', [GuruController::class, 'store']);
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit']);
    Route::post('/guru/update/{id}', [GuruController::class, 'update']);
    Route::get('/guru/detail/{id}', [GuruController::class, 'show']);
    Route::delete('/guru/destroy/{id}', [GuruController::class, 'destroy']);
    //result
    Route::get('/result', [ExamController::class, 'result']);
    Route::get('/result/{id}', [ExamController::class, 'detailResult']);

    //diskusi
    Route::get('/diskusi', [DiskusiController::class, 'index']);
    Route::post('/diskusi', [DiskusiController::class, 'store']);
    //ujian
    Route::get('/ujian', [ExamController::class, 'index']);
    Route::get('/{token}', [ExamController::class, 'exam']);
    Route::post('/{token}', [ExamController::class, 'save']);
});

// middleware admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('user', UserController::class);
});
