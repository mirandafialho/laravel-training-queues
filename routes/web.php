<?php

use App\Jobs\MakeOrder;
use App\Jobs\RunPayment;
use App\Jobs\ValidateCard;

use Illuminate\Bus\BatchRepository;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

use App\Jobs\SendNotificationsJob;

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

Route::get('/', function (BatchRepository $batchRepository) {
    return view('welcome', [
        'batches' => $batchRepository->get()
    ]);
});

Route::get('send-notification-to-all', function() {
    SendNotificationsJob::dispatch();

    return redirect('/');
});

Route::get('run-batch', function() {
    Bus::batch([
        new MakeOrder,
        new ValidateCard,
        new RunPayment
    ])->name('Run Batch Example ' . rand(0, 10))->dispatch();

    return redirect('/');
});
