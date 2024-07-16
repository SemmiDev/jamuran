<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingCostsController;
use App\Models\User;
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
  $role = auth()->user()->role;
  $view = $role == User::ROLE_ADMIN ? "admin.dashboard" : "user.dashboard";
  return view($view);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

  Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('admin.categories');
  Route::get('/admin/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
  Route::post('/admin/categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store');
  Route::get('/admin/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
  Route::put('/admin/categories/{id}/update', [CategoriesController::class, 'update'])->name('admin.categories.update');
  Route::delete('/admin/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

  Route::get('/admin/shipping_costs', [ShippingCostsController::class, 'index'])->name('admin.shipping_costs');
  Route::get('/admin/shipping_costs/create', [ShippingCostsController::class, 'create'])->name('admin.shipping_costs.create');
  Route::post('/admin/shipping_costs/store', [ShippingCostsController::class, 'store'])->name('admin.shipping_costs.store');
  Route::get('/admin/shipping_costs/{id}/edit', [ShippingCostsController::class, 'edit'])->name('admin.shipping_costs.edit');
  Route::put('/admin/shipping_costs/{id}/update', [ShippingCostsController::class, 'update'])->name('admin.shipping_costs.update');
  Route::delete('/admin/shipping_costs/{id}/destroy', [ShippingCostsController::class, 'destroy'])->name('admin.shipping_costs.destroy');

  Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products');
  Route::get('/admin/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
  Route::get('/admin/products/{id}/show', [ProductsController::class, 'show'])->name('admin.products.show');
  Route::post('/admin/products/store', [ProductsController::class, 'store'])->name('admin.products.store');
  Route::get('/admin/products/{id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
  Route::put('/admin/products/{id}/update', [ProductsController::class, 'update'])->name('admin.products.update');
  Route::delete('/admin/products/{id}/destroy', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
