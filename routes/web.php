<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(App\Http\Controllers\PublicPagesController::class)->group(function(){
    Route::get('/', 'index')->name('public.home');
    Route::get('/about', 'about')->name('public.about');
    Route::get('/contact', 'contact')->name('public.contact');
    Route::get('/contests', 'contests')->name('public.contests');
    // Route::get('/contests/{contest}', 'showContest')->name('public.showContest');
    Route::get('/contests/show-contest', 'showContest')->name('public.showContest');
    Route::get('/contests/show-contestant', 'showContestant')->name('public.showContestant');
    Route::post('/contests/show-contestant/vote', 'voteContestant')->name('public.voteContestant');
    Route::post('/newsletter/subscribe', 'subscribeNewsletter')->name('public.subscribeNewsletter');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
