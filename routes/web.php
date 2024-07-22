<?php

use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ShippingCostsController;
use App\Http\Controllers\UserProductsController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

\Carbon\Carbon::setLocale('id');

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  $role = auth()->user()->role;
  $view = $role == User::ROLE_ADMIN ? "admin.dashboard" : "user.dashboard";

  if ($role == User::ROLE_ADMIN) {
    $waitingPaymentCount = Order::where('status', 'belum_membayar')->count();
    $paymentCompletedCount = Order::where('status', 'sudah_membayar')->count();
    $shippingCount = Order::where('status', 'dikirim')->count();
    $transactionCompletedCount = Order::where('status', 'selesai')->count();

    $lastTimeWaitingPayment = Order::where('status', 'belum_membayar')->latest()->first()->created_at ?? '-';
    $lastTimePaymentCompleted = Order::where('status', 'sudah_membayar')->latest()->first()->created_at ?? '-';
    $lastTimeShipping = Order::where('status', 'dikirim')->latest()->first()->created_at ?? '-';
    $lastTimeCompleted = Order::where('status', 'selesai')->latest()->first()->created_at ?? '-';

    $totalProducts = Product::count();

    return view($view, compact(
      'waitingPaymentCount',
      'paymentCompletedCount',
      'shippingCount',
      'transactionCompletedCount',
      'totalProducts',
      'lastTimeWaitingPayment',
      'lastTimePaymentCompleted',
      'lastTimeShipping',
      'lastTimeCompleted',
    ));
  } else {
    $categories = Category::withCount('products')->latest()->get();

    $carouselProducts = Product::latest()->take(5)->get();

    $products = DB::table('products')
      ->select('products.id', 'products.photo', 'categories.name as category', 'products.product_name', 'products.price', 'products.stock', 'products.description', 'products.updated_at', DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold'))
      ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
      ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
      ->when(request('q'), function ($query, $q) {
        return $query->where('products.product_name', 'like', '%' . $q . '%')->orWhere('products.description', 'like', '%' . $q . '%');
      })
      ->when(request('category'), function ($query, $category) {
        return $query->where('categories.name', $category);
      })
      ->groupBy('products.id', 'products.photo', 'categories.name', 'products.product_name', 'products.price', 'products.stock', 'products.description', 'products.updated_at')
      ->orderBy('total_sold', 'desc')
      ->simplePaginate(25);

    return view($view, [
      'products' => $products,
      'categories' => $categories,
      'carouselProducts' => $carouselProducts
    ]);
  }
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

  Route::get('/admin/bank_accounts', [BankAccountsController::class, 'index'])->name('admin.bank_accounts');
  Route::get('/admin/bank_accounts/create', [BankAccountsController::class, 'create'])->name('admin.bank_accounts.create');
  Route::post('/admin/bank_accounts/store', [BankAccountsController::class, 'store'])->name('admin.bank_accounts.store');
  Route::get('/admin/bank_accounts/{id}/edit', [BankAccountsController::class, 'edit'])->name('admin.bank_accounts.edit');
  Route::put('/admin/bank_accounts/{id}/update', [BankAccountsController::class, 'update'])->name('admin.bank_accounts.update');
  Route::delete('/admin/bank_accounts/{id}/destroy', [BankAccountsController::class, 'destroy'])->name('admin.bank_accounts.destroy');

  Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products');
  Route::get('/admin/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
  Route::get('/admin/products/{id}/show', [ProductsController::class, 'show'])->name('admin.products.show');
  Route::post('/admin/products/store', [ProductsController::class, 'store'])->name('admin.products.store');
  Route::get('/admin/products/{id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
  Route::put('/admin/products/{id}/update', [ProductsController::class, 'update'])->name('admin.products.update');
  Route::delete('/admin/products/{id}/destroy', [ProductsController::class, 'destroy'])->name('admin.products.destroy');

  Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.orders');
  Route::get('/admin/orders/create', [OrdersController::class, 'create'])->name('admin.orders.create');
  Route::get('/admin/orders/{id}/show', [OrdersController::class, 'show'])->name('admin.orders.show');
  Route::post('/admin/orders/store', [OrdersController::class, 'store'])->name('admin.orders.store');
  Route::get('/admin/orders/{id}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
  Route::put('/admin/orders/{id}/update', [OrdersController::class, 'update'])->name('admin.orders.update');
  Route::delete('/admin/orders/{id}/destroy', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');

  Route::get('/admin/customers', [CustomersController::class, 'index'])->name('admin.customers');
  Route::get('/admin/customers/{id}/show', [CustomersController::class, 'show'])->name('admin.customers.show');

  Route::get('/admin/reports', [ReportsController::class, 'index'])->name('admin.reports');
  Route::post('/admin/reports/generate', [ReportsController::class, 'generate'])->name('admin.reports.generate');
});

Route::get('/products/{id}/show', [UserProductsController::class, 'show'])->name('products.show');
Route::post('/products/{id}/checkout', [UserProductsController::class, 'checkout'])->name('products.checkout');

Route::get('/users/orders', [UserProductsController::class, 'orders'])->name('users.orders');
Route::put('/users/orders/{id}', [UserProductsController::class, 'cancelOrder'])->name('users.orders.cancel');
Route::post('/users/orders/{id}/pay', [UserProductsController::class, 'payOrder'])->name('users.orders.pay');
Route::post('/users/orders/{id}/accept', [UserProductsController::class, 'accept'])->name('users.orders.accept');
Route::get('/users/orders/{id}/detail', [UserProductsController::class, 'detail'])->name('users.orders.detail');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
