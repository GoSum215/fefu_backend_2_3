<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegistrationController;
use \App\Http\Controllers\AppealController;
use App\Http\Controllers\WebLoginController;
use App\Http\Controllers\WebLogoutController;
use App\Http\Controllers\WebProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SuggestAppeal;

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
});

Route::get('/news', [NewsController::class, 'getList'])->name('news_list');

Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_item');

Route::get('/appeal', [AppealController::class, 'create'])
    ->name('appeal')
    ->withoutMiddleware([SuggestAppeal::class]);

Route::post('/appeal/save', [AppealController::class, 'save'])
    ->name('save_appeal')
    ->withoutMiddleware([SuggestAppeal::class]);

Route::match(['get', 'post'], '/registration', RegistrationController::class)->name('registration');

Route::match(['get', 'post'], '/login', WebLoginController::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/logout', WebLogoutController::class)->name('logout');
    Route::get('/profile', WebProfileController::class)->name('profile');
});
