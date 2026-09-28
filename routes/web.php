<?php

use App\Http\Controllers\Admin\ClearCacheController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

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

require __DIR__ . '/home.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
require __DIR__ . '/botman.php';

// Platform License & Node Management
Route::any('/activate', function () {
	return view('activate.index', [
		'settings' => Settings::where('id', '1')->first(),
	]);
});

Route::get('register-license', [ClearCacheController::class, 'saveLicense']);

Route::any('/revoke', function () {
	return view('revoke.index');
});

Route::post('/reset-password', [NewPasswordController::class, 'store'])
	->middleware(['guest:' . config('fortify.guard')])
	->name('password.update');

// Graceful GET /logout handler to prevent MethodNotAllowedHttpException on mobile/direct navigation
Route::get('/logout', function (\Illuminate\Http\Request $request) {
	if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
		\Illuminate\Support\Facades\Auth::guard('admin')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('adminloginform')->with('status', 'Admin has been logged out!');
	}

	\Illuminate\Support\Facades\Auth::guard('web')->logout();
	$request->session()->invalidate();
	$request->session()->regenerateToken();
	return redirect('/login')->with('status', 'You have been successfully logged out.');
})->name('logout.get');