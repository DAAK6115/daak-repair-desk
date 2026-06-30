<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RepairController;
use App\Models\Repair;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'today' => Repair::whereDate('deposit_date', today())->count(),
            'diagnosis' => Repair::where('status', Repair::STATUS_DIAGNOSIS)->count(),
            'repairing' => Repair::where('status', Repair::STATUS_REPAIRING)->count(),
            'ready' => Repair::where('status', Repair::STATUS_READY)->count(),
            'delivered' => Repair::where('status', Repair::STATUS_DELIVERED)->count(),
        ];

        $latestRepairs = Repair::with(['client', 'device'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'latestRepairs'));
    })->name('dashboard');

    Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');
    Route::get('/repairs/create', [RepairController::class, 'create'])->name('repairs.create');
    Route::post('/repairs', [RepairController::class, 'store'])->name('repairs.store');
    Route::get('/repairs/{repair}', [RepairController::class, 'show'])->name('repairs.show');
    Route::patch('/repairs/{repair}/status', [RepairController::class, 'updateStatus'])->name('repairs.update-status');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});