<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LiabilityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaxController;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/', [CustomerController::class, 'store'])->name('store')->middleware([HandlePrecognitiveRequests::class]);
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('bills')->name('bills.')->group(function () {
        Route::get('/', [BillController::class, 'index'])->name('index');
        Route::get('/create', [BillController::class, 'create'])->name('create');
        Route::post('/', [BillController::class, 'store'])->middleware([HandlePrecognitiveRequests::class])->name('store');
        Route::get('/{bill}', [BillController::class, 'show'])->name('show');
        Route::get('/{bill}/edit', [BillController::class, 'edit'])->name('edit');
        Route::put('/{bill}', [BillController::class, 'update'])->name('update');
        Route::delete('/{bill}', [BillController::class, 'destroy'])->name('destroy');
    });

    Route::resources([
        'meters' => MeterController::class,
        'payments' => PaymentController::class,
        'expenses' => ExpenseController::class,
        'employees' => EmployeeController::class,
        'notifications' => NotificationController::class,
        'reports' => ReportController::class,
        'taxes' => TaxController::class,
        'liabilities' => LiabilityController::class,
    ]);
});



require __DIR__.'/auth.php';
