<?php

use App\Models\Url;
use App\Models\Attempt;
use App\Models\SessionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortnerController;

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
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/shorten/view', function () {return view('addurl');})->name('shorten.view');
    Route::post('/dashboard/shorten', [UrlShortnerController::class, 'store'])->name('shorten.store');
    Route::get('/dashboard/shorten/delete/{id}', [UrlShortnerController::class, 'delete'])->name('shorten.delete');
    Route::post('/dashboard/url/update/{id}', [UrlShortnerController::class, 'urlUpdate'])->name('url.update');
    Route::get('/dashboard/shorten/edit/{id}', function ($id) {   $editdata = Url::find($id);return view('editurl',compact('editdata'));})->name('shorten.edit');
    Route::get('/open-shorten-url/{shortened}', [UrlShortnerController::class, 'redirect'])->name('shorten.redirect');
    Route::get('/dashboard/activate/{id}', [UrlShortnerController::class, 'Activate'])->name('shorten.activate');
    Route::get('/dashboard/deactivate/{id}', [UrlShortnerController::class, 'Deactivate'])->name('shorten.deactivate');   
    Route::get('/dashboard/upgrade', function () {$limit = Attempt::find(Auth::user()->id);return view('upgrade',compact('limit'));})->name('upgrade');
    Route::post('/dashboard/upgrade/update', [UrlShortnerController::class, 'UpgradeUpdate'])->name('upgrade.update');
});

Route::get('/dashboard', function () {
    $userurllist = App\Models\Url::latest()->where('user_id',Auth::user()->id)->paginate(5);
    return view('dashboard', compact('userurllist'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
