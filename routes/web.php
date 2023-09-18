<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lti\LtiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Resource\ResourceController;
use App\Http\Controllers\ResourceFile\ResourceFileController;

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

// -----------------------------------------------------------------------------
// * /
// -----------------------------------------------------------------------------
Route::get('/', function () {
    return redirect()->route('auth.index');
});

// -----------------------------------------------------------------------------
// * Authentication
// -----------------------------------------------------------------------------
Route::controller(AuthController::class)
    ->group(function () {
        // * Login
        Route::get('login', 'index')
            ->name('auth.index');

        Route::post('login', 'login')
            ->name('auth.login');

        Route::get('logout', 'logout')
            ->name('auth.logout')
            ->middleware('auth');
        // * End Login

        // * Password Recovery
        Route::get('/forgot-password', 'forgotPasswordShow')
            ->name('password.request')
            ->middleware('guest');

        Route::post('/forgot-password', 'forgotPassword')
            ->name('password.email')
            ->middleware('guest');

        Route::get('/reset-password/{token}', 'resetPasswordShow')
            ->name('password.reset')
            ->middleware('guest');

        Route::post('/reset-password', 'resetPassword')
            ->name('password.update')
            ->middleware('guest');
        // * End Password Recovery
    });

// -----------------------------------------------------------------------------
// * Resource
// -----------------------------------------------------------------------------
Route::resource('resource', ResourceController::class)
    ->middleware('auth');

// -----------------------------------------------------------------------------
// * Resource File
// -----------------------------------------------------------------------------
Route::prefix('file')
    ->group(function () {
        Route::get('{resource}/download', [ResourceFileController::class, 'download'])
            ->name('file.download')
            ->middleware('auth')
            ->can('download_file', 'resource');

        Route::get('{resource}/show', [ResourceFileController::class, 'show'])
            ->name('file.show')
            ->middleware('auth')
            ->can('show_file', 'resource');

        Route::get('{resource}/{file?}', [ResourceFileController::class, 'get'])
            ->name('file.get')
            ->where('file', '.*');
    });

// -----------------------------------------------------------------------------
// * LTIAAS
// -----------------------------------------------------------------------------
Route::prefix('lti')
    ->group(function () {
        Route::get('launch', [LtiController::class, 'launch'])
            ->name('lti.launch')
            ->middleware('auth.lti');

        Route::get('deeplink', [LtiController::class, 'deeplink'])
            ->name('lti.deeplink')
            ->middleware('auth.lti');

        Route::post('deeplinking/form', [LtiController::class, 'deeplinkingForm'])
            ->name('lti.deeplinking.form')
            ->middleware('auth.lti');

        Route::get('/{file?}', function (Request $request) {
            return redirect()->route('file.get', [
                'resource' => session('resource'),
                'file' => $request->file
            ]);
        })
            ->where('file', '.*');
    });
