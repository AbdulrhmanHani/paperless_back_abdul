<?php

use App\Http\Controllers\InvitationController;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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


// Clear Cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('clear-compiled');
    Artisan::call('storage:link');
});

Route::get('order/invoice/{order_number}', 'App\Http\Controllers\OrderController@getInvoice')->name('invoice');


// Confirm_Invitation
Route::get('/invitation/{base64_email}/{token}', [InvitationController::class, 'confirm']);


Route::get('/', function () {
    // $qr = QrCode::size(500)
    //     ->format('png')
    //     ->generate(
    //         'https://www.google.com'
    //     );
    $qr = 'https://www.stackdeans.com';
    return view('emails.test-mail', [
        'qr' => $qr,
    ]);
});