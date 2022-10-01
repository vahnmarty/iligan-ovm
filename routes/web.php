<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Members\Registrants;
use App\Http\Livewire\Members\ReviewBoard;
use App\Http\Livewire\Members\CreateMember;
use App\Http\Livewire\Members\ManageMembers;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Members\MemberDashboard;
use App\Http\Livewire\Members\ReviewApplication;
use App\Http\Livewire\Collections\CreateCollection;
use App\Http\Livewire\Collections\ManageCollections;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

    Route::get('/members', MemberDashboard::class);
    Route::get('/members/index', ManageMembers::class);
    Route::get('/members/registrants', Registrants::class);
    Route::get('/members/create', CreateMember::class);
    Route::get('/members/pending-review', ReviewBoard::class);
    Route::get('/members/review/{uuid}', ReviewApplication::class);

    Route::group(['prefix' => 'mortuary'], function(){
        Route::get('/collections', ManageCollections::class);
        Route::get('/collections/create', CreateCollection::class);
    });
});

