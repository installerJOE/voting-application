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
    Route::get('/contests/{slug}/contestants/{contestant_number}', 'showContestant')->name('public.showContestant');
    Route::post('/contests/{slug}/contestants/{contestant_number}/vote', 'voteContestant')->name('public.voteContestant');
    Route::post('/newsletter/subscribe', 'subscribeNewsletter')->name('public.subscribeNewsletter');
    Route::post('/contests/{contest}/sponsorship/send-request', 'sendSponsorshipRequest')->name('public.sendSponsorshipRequest');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::controller(App\Http\Controllers\UsersController::class)->group(function(){
        Route::get('/settings/profile', 'profile')->name('user.profile');
        Route::post('/settings/profile/update-image', 'updateProfileImage')->name('user.updateProfileImage');
        Route::post('/settings/profile/update/bio-data', 'updateBioData')->name('user.updateBioData');
        Route::get('/settings/security', 'security')->name('user.security');
        Route::post('/settings/security', 'updatePassword')->name('users.updatePassword');
    });

    Route::middleware(['admin'])->controller(App\Http\Controllers\AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/admin/contests', 'contests')->name('admin.contests.overview');
        Route::get('/admin/contests/create', 'createNewContest')->name('admin.createNewContest');
        Route::get('/admin/contests/{slug}', 'showContest')->name('admin.showContest');
        Route::get('/admin/contests/{slug}/requests', 'showContestRequests')->name('admin.contests.showContestRequests');

        Route::post('/admin/contests', 'storeContest')->name('admin.storeContest');
        Route::post('/admin/contests/{contest}', 'updateContestBaseData')->name('admin.contests.updateContestBaseData');
        Route::post('/admin/contests/{contest}/update-voting-data', 'updateContestVotingData')->name('admin.contests.updateContestVotingData');
        Route::post('/admin/contests/{contest}/update-contest-image', 'updateContestImage')->name('admin.contests.updateContestImage');
        Route::post('/admin/contests/{contest}/delete', 'deleteContest')->name('admin.contests.deleteContest');

        Route::post('/admin/contests/{contest}/start-registration', 'startContestReg')->name('admin.startContestReg');
        Route::post('/admin/contests/{contest}/end-registration', 'endContestReg')->name('admin.endContestReg');
        Route::post('/admin/contests/{contest}/start-voting', 'startContestVoting')->name('admin.startContestVoting');
        Route::post('/admin/contests/{contest}/end-voting', 'endContestVoting')->name('admin.endContestVoting');
        
        Route::post('/admin/contests/{slug}/requests', 'acceptContestant')->name('admin.contests.acceptContestant');
        
        // Route::post('/users/{user}/assign-admin', 'addUserToAdmin')->name('admin.addUserToAdmin');
    });

    Route::middleware(['user'])->controller(App\Http\Controllers\ContestantsController::class)->group(function(){
        Route::get('/user/dashboard', 'dashboard')->name('contestant.dashboard');
        Route::get('/user/contests', 'contests')->name('user.contests');
        Route::get('/user/contests/{slug}/contestants/{number}', 'showContest')->name('user.showContest');
        Route::get('/user/register-contest', 'register')->name('user.contests.register');
        Route::post('/user/register-contest', 'registerContest')->name('user.contests.registerContest');
        Route::post('/user/contestants/{contestant}', 'updateContestantProfile')->name('contestant.updateProfile');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
    // Route::get('/contests/{slug}/register', 'contestRegistration')->name('public.contestRegistration');
    // Route::post('/contests/{contest}/register', 'registerForContest')->name('public.registerForContest');
    // Route::get('/contests/{slug}/contestants/{contestant_number}', 'showContestant')->name('public.showContestant');
});

