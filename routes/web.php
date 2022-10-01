<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Members\Registrants;
use App\Http\Livewire\Members\ReviewBoard;
use App\Http\Livewire\Members\CreateMember;
use App\Http\Livewire\Members\ManageMembers;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Members\MemberDashboard;
use App\Http\Livewire\Logistics\CreateBorrower;
use App\Http\Livewire\Logistics\ManageBorrowers;
use App\Http\Livewire\Logistics\ManageMaterials;
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


Route::group(['prefix' => 'logistics', 'middleware' => ['auth']], function(){
    Route::get('materials', ManageMaterials::class);
    Route::get('borrowers', ManageBorrowers::class);
    Route::get('borrowers/create', CreateBorrower::class);
});

