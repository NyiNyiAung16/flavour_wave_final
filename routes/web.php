<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PreorderController;
use App\Http\Controllers\Api\PreorderCountController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\LogisticsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceipesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Preorder;
use App\Models\Product;
use App\Models\User;

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

// Welcome page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'popularProducts' => Product::latest()->take(4)->get(),
        'user_id' => auth()->id()
    ]);
})->name('welcome');

//dashboard page
Route::get('/dashboard', [DashboardController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/me', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/me', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/me', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//about page
Route::get('/about',function(){
    return Inertia::render('About',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'user_id' => auth()->id()
    ]);
});

// customer
Route::get('customers', [UserController::class, 'show']);
Route::get('customers/{id}', [UserController::class, 'show_one']);
Route::post('customer/create', [UserController::class, 'createCustomer']);

//  order
Route::get('customers/{id}/preorders', [PreorderController::class, 'getPreorders']);
Route::post('preorders/create', [PreorderController::class, 'createPreorder'])->middleware(AuthMiddleware::class);
Route::get('preorders/{id}', [PreorderController::class, 'getPreOrder']);
Route::post('preorders/{preorder:order_id}/update', [PreorderController::class, 'update']);
Route::get('preorders', [PreorderController::class, 'getPreordersCountFor12Months']);

// product
Route::get('/products',[ProductController::class,'all']);
Route::get('/products/{product}/detail',[ProductController::class,'show'])->name('products.show');
Route::post('/product/create', [ProductController::class, 'create']);

//checkout
Route::get('/checkout',function(){
    return Inertia::render('Checkout',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'user_id' => auth()->id()
    ]);
});

//driver
Route::get('/drivers', [DriverController::class, 'show']);

//ingredients
Route::get('/ingredients', [IngredientsController::class, 'show']);
Route::post('/ingredient/create', [IngredientsController::class, 'create']);

//factories
Route::post('/factories', [FactoryController::class, 'store']);

//logistics
Route::get('/logisticsDepartment/dashboard',[LogisticsController::class,'index'])->name('logisticsDepartment.index');
Route::post('/deliver', [LogisticsController::class, 'make']);
Route::get('/deliver/count', [LogisticsController::class, 'getCount']);

//receipe
Route::post('/receipe/create', [ReceipesController::class, 'create']);

//warehouse
Route::get('/warehouseDepartment/dashboard',[WarehouseController::class,'index'])->name('warehouseDepartment.index');
Route::delete('/warehouseDepartment/{warehouse}/destroy',[WarehouseController::class,'destroy'])->name('warehouse.destroy');
Route::post('/warehouse/create', [WarehouseController::class, 'create']);
Route::post('order/chart', [PreorderCountController::class, 'preorderCountChart']);
Route::patch('warehouseDepartment/{warehouse}/patch',[WarehouseController::class,'storeWarehouseEdit'])->name('warehouse.patch');

//factory department
Route::get('/factoryDepartment/dashboard',[FactoryController::class,'index'])->name('factoryDepartment.index');
Route::get('/factoryDepartment/productsDetail/{factory}/edit',[FactoryController::class,'editPage']);
Route::get('/factoryDepartment/products/{product}/edit',[FactoryController::class,'editProduct'])->name('product.edit');
Route::post('/factoryDepartment/create',[FactoryController::class,'store'])->name('factory.store');
Route::put('/factoryDepartment/edit',[FactoryController::class,'editFactory'])->name('factory.edit');
Route::patch('/factoryDepartment/ingredients/{ingredient}/patch',[FactoryController::class,'storeEditIngredient'])->name('ingredient.patch');
Route::patch('/factoryDepartment/receipes/{receipe}/patch',[ReceipesController::class,'storeEditReceipe'])->name('receipe.patch');
Route::patch('/factoryDepartment/productDetail/{factory}/patch',[FactoryController::class,'storeFactoryEdit'])->name('factory.patch');
Route::patch('/factoryDepartment/products/{product}/patch',[ProductController::class,'storeProductEdit'])->name('product.patch');
Route::delete('/factoryDepartment/products/{product}/destroy',[FactoryController::class,'deleteProduct'])->name('product.destroy');
Route::delete('/factoryDepartment/factories/{factory}/destroy',[FactoryController::class,'deleteFactory'])->name('factory.destroy');
Route::delete('/factoryDepartment/ingredients/{ingredient}/destroy',[FactoryController::class,'deleteIngredient'])->name('ingredient.destroy');
Route::delete('/factoryDepartment/receipes/{receipe}/destroy',[FactoryController::class,'deleteReceipe'])->name('receipe.destroy');


//Admin Department
Route::get('/adminDepartment/dashboard',[AdminController::class,'index'])->name('adminDepartment.index');
Route::post('/adminDepartment/user/store',[AdminController::class,'store'])->name('user.store');

//Sale Department
Route::get('/saleDepartment/dashboard',[SaleController::class,'index'])->name('saleDepartment.index');