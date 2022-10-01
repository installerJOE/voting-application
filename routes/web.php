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
    Route::get('/contests/{slug}', 'showContest')->name('public.showContest');
    Route::post('/contests/{slug}/contestants/{contestant_number}/vote', 'voteContestant')->name('public.voteContestant');
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

    Route::middleware(['admin'])->controller(App\Http\Controllers\AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/admin/contests', 'contests')->name('admin.contests');
        Route::get('/admin/contests/create', 'createNewContest')->name('admin.createNewContest');
        Route::post('/admin/contests', 'storeContest')->name('admin.storeContest');
        Route::get('/admin/contests/{slug}', 'showContest')->name('admin.showContest');
        Route::post('/admin/contests/{contest}', 'updateContestBaseData')->name('admin.contests.updateContestBaseData');
        Route::post('/admin/contests/{contest}/start-registration', 'startContestReg')->name('admin.startContestReg');
        Route::post('/admin/contests/{contest}/end-registration', 'endContestReg')->name('admin.endContestReg');
        Route::post('/admin/contests/{contest}/start-voting', 'startContestVoting')->name('admin.startContestVoting');
        Route::post('/admin/contests/{contest}/end-voting', 'endContestVoting')->name('admin.endContestVoting');
        
        // Route::get('/admin/contests/{slug}/register', 'registerForContest')->name('user.registerForContest');
        // Route::post('/admin/contests/{slug}/register', 'submitContestRegistration')->name('user.submitContestRegistration');
        
        // Route::post('/users/{user}/assign-admin', 'addUserToAdmin')->name('admin.addUserToAdmin');
    });

    Route::controller(App\Http\Controllers\ContestantsController::class)->group(function(){
        Route::get('/user/dashboard', 'dashboard')->name('contestant.dashboard');
        Route::get('/user/contests', 'contests')->name('user.contests');
        Route::get('/user/contests/{slug}', 'showContest')->name('user.showContest');
        Route::get('/user/register-contest', 'register')->name('user.contests.register');
        Route::post('/user/register-contest', 'registerContest')->name('user.contests.registerContest');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
    // Route::get('/contests/{slug}/register', 'contestRegistration')->name('public.contestRegistration');
    // Route::post('/contests/{contest}/register', 'registerForContest')->name('public.registerForContest');
    // Route::get('/contests/{slug}/contestants/{contestant_number}', 'showContestant')->name('public.showContestant');
});

