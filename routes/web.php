<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SimulationController;

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

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home.index');
// PACKS
Route::get('/packs', [PackController::class, 'index'])->name('pack.index');
// PRODUCTS
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
// BLOG
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/simulation', [SimulationController::class, 'index'])->name('simulation.index');
    Route::get('/simulation/photo-type', [SimulationController::class, 'photoType'])->name('simulation.photoType');
    Route::post('/simulation/store', [SimulationController::class, 'store'])->name('simulation.store');
    Route::get('/simulation/{simulation}/step-one', [SimulationController::class, 'createStepOne'])->name('simulation.create-step-one');
    Route::post('/simulation/{simulation}/step-one', [SimulationController::class, 'postStepOne'])->name('simulation.post-step-one');
    Route::get('/simulation/{simulation}/step-two', [SimulationController::class, 'createStepTwo'])->name('simulation.create-step-two');
    Route::post('/simulation/{simulation}/step-two', [SimulationController::class, 'postStepTwo'])->name('simulation.post-step-two');
    Route::get('/simulation/{simulation}/step-three', [SimulationController::class, 'createStepThree'])->name('simulation.create-step-three');
    Route::post('/simulation/{simulation}/step-three', [SimulationController::class, 'postStepThree'])->name('simulation.post-step-three');



});

Route::middleware(['admin'])->prefix('admin')->group(function () {});
