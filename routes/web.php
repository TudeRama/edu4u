<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin;
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

Route::get('/buku', function () {
    return view('welcome',[
        'data'=>Admin::all(),
        'teknik'=>Admin::where('kategori_id', 1)->get(),
        'ekonomi'=>Admin::where('kategori_id', 2)->get(),
        'olahraga'=>Admin::where('kategori_id', 3)->get(),
        'kedokteran'=>Admin::where('kategori_id', 4)->get(),
        'ilmu_pendidikan'=>Admin::where('kategori_id', 5)->get(),
        'bahasa_dan_seni'=>Admin::where('kategori_id', 6)->get(),
        'hukum'=>Admin::where('kategori_id', 7)->get()

    ]);
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('buku/{nama}',[BukuController::class, 'show'])->name('buku.show');

require __DIR__.'/auth.php';
