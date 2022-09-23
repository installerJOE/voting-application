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

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::controller(App\Http\Controllers\UsersController::class)->group(function(){
        Route::get('/settings/profile', 'profile')->name('user.profile');
        Route::post('/settings/profile/picture', 'updateProfileImage')->name('user.updateProfileImage');
        Route::post('/settings/profile/bio-data', 'updateBioData')->name('user.updateBioData');
        Route::get('/settings/security', 'security')->name('user.security');
        Route::post('/settings/security', 'updatePassword')->name('users.updatePassword');
    });

    Route::controller(App\Http\Controllers\AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/admin/contests', 'contests')->name('admin.contests');
        Route::get('/admin/contests/create', 'createNewContest')->name('admin.createNewContest');
        Route::post('/admin/contests', 'storeContest')->name('admin.storeContest');
        Route::get('/admin/contests/{slug}', 'showContest')->name('admin.showContest');
        Route::post('/admin/contests/{contest}', 'endContest')->name('admin.endContest');
    });

    Route::controller(App\Http\Controllers\ContestantsController::class)->group(function(){
        Route::get('/contestant/dashboard', 'dashboard')->name('contestant.dashboard');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
});

