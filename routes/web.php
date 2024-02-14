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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\FactoryMiddleware;
use App\Http\Middleware\LogisticMiddleware;
use App\Http\Middleware\SaleMiddleware;
use App\Http\Middleware\WarehouseMiddleware;
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

// product
Route::get('/products',[ProductController::class,'all']);
Route::get('/products/{product}/detail',[ProductController::class,'show'])->name('products.show');

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

//dashboard page
Route::get('/dashboard', [DashboardController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// customer preorder
Route::post('preorders/create', [PreorderController::class, 'createPreorder'])->middleware(AuthMiddleware::class);


//checkout
Route::get('/checkout',function(){
    return Inertia::render('Checkout',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});




//logistics
Route::middleware(LogisticMiddleware::class)->group(function(){
    Route::get('/logisticsDepartment/dashboard',[LogisticsController::class,'index'])->name('logisticsDepartment.index');
    Route::post('/logisticsDepartment', [LogisticsController::class, 'store'])->name('deliver.store');
    Route::get('/logisticsDepartment/{preoderId}', [LogisticsController::class, "getPreorder"]);
    Route::get('/deliver/count', [LogisticsController::class, 'getCount']);
    Route::post('/logisticsDepartment/driver/store',[DriverController::class,'storeDriver'])->name('driver.store');
    Route::patch('/logisticsDepartment/drivers/{driver}/patch',[DriverController::class,'storeEditData'])->name('driver.patch');
    Route::patch('/logisticsDepartment/logistics/{logistic}/patch',[LogisticsController::class,'storeEditData'])->name('logistic.patch');
    Route::delete('/logisticsDepartment/drivers/{driver}/destroy',[DriverController::class,'destroy'])->name('driver.destroy');
    Route::delete('/logisticsDepartment/logistics/{logistic}/destroy',[LogisticsController::class,'destroy'])->name('logistic.destroy');
});

//receipe
Route::post('/receipe/create', [ReceipesController::class, 'create']);

//warehouse
Route::middleware(WarehouseMiddleware::class)->group(function(){
    Route::get('/warehouseDepartment/dashboard',[WarehouseController::class,'index'])->name('warehouseDepartment.index');
    Route::delete('/warehouseDepartment/{warehouse}/destroy',[WarehouseController::class,'destroy'])->name('warehouse.destroy');
    Route::post('/warehouse', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::post('order/chart', [PreorderCountController::class, 'preorderCountChart']);
    Route::patch('warehouseDepartment/{warehouse}/patch',[WarehouseController::class,'storeWarehouseEdit'])->name('warehouse.patch');
    Route::post('warehouseDepartment/updateDamage', [WarehouseController::class, 'updateDamage'])->name('warehouse.updateDamage');
    Route::post('warehouseDepartment/updateSaleReturn', [WarehouseController::class, 'saleReturn'])->name('warehouse.saleReturn');
    Route::patch('warehouseDepartment/updateAvailability', [WarehouseController::class, 'updateAvailability'])->name('warehouse.updateAvailability');;
});

//factory department
Route::get("/factoryDepartment/getAllProducts",[FactoryController::class, "getFactoryProduct"])->name("FactoryProduct"); // for warehouse data
Route::middleware(FactoryMiddleware::class)->group(function(){
    Route::get('/factoryDepartment/dashboard',[FactoryController::class,'index'])->name('factoryDepartment.index');
    Route::get('/factoryDepartment/productsDetail/{factory}/edit',[FactoryController::class,'editPage']);
    Route::get('/factoryDepartment/products/{product}/edit',[FactoryController::class,'editProduct'])->name('product.edit');
    Route::get('/factoryDepartment/receipes/{id}/edit',[FactoryController::class,'editReceipe'])->name('receipe.edit');
    Route::post('/factoryDepartment/createProduct',[FactoryController::class,'storeProduct'])->name('factory.product.store');
    Route::post('/factoryDepartment/createProductDetails',[FactoryController::class,'storeProductDetails'])->name('factory.productDetails.store');
    Route::post('/factoryDepartment/ingredient/store',[FactoryController::class,'storeIngredient'])->name('ingredient.store');
    Route::post('/factoryDepartment/receipe/store',[FactoryController::class,'storeReceipe'])->name('receipe.store');
    Route::put('/factoryDepartment/edit',[FactoryController::class,'editFactory'])->name('factory.edit');
    Route::patch('/factoryDepartment/ingredients/{ingredient}/patch',[FactoryController::class,'storeEditIngredient'])->name('ingredient.patch');
    Route::patch('/factoryDepartment/receipes/patch',[ReceipesController::class,'storeEditReceipe'])->name('receipe.patch');
    Route::patch('/factoryDepartment/productDetail/{factory}/patch',[FactoryController::class,'storeFactoryEdit'])->name('factory.patch');
    Route::patch('/factoryDepartment/products/{product}/patch',[ProductController::class,'storeProductEdit'])->name('product.patch');
    Route::delete('/factoryDepartment/products/{product}/destroy',[FactoryController::class,'deleteProduct'])->name('product.destroy');
    Route::delete('/factoryDepartment/factories/{factory}/destroy',[FactoryController::class,'deleteFactory'])->name('factory.destroy');
    Route::delete('/factoryDepartment/ingredients/{ingredient}/destroy',[FactoryController::class,'deleteIngredient'])->name('ingredient.destroy');
    Route::delete('/factoryDepartment/receipes/{receipe}/destroy',[FactoryController::class,'deleteReceipe'])->name('receipe.destroy');
});


//Admin Department
Route::middleware(AdminMiddleware::class)->group(function(){
    Route::get('/adminDepartment/dashboard',[AdminController::class,'index'])->name('adminDepartment.index');
    Route::get('/adminDepartment/users/{user}/edit',[AdminController::class,'showEditPage'])->name('user.edit');
    Route::post('/adminDepartment/user/store',[AdminController::class,'store'])->name('user.store');
    Route::post('/adminDepartment/report/store',[ReportController::class,'store'])->name('report.store');
    Route::delete('/adminDepartment/users/{user}/destroy',[AdminController::class,'destroy'])->name('user.destroy');
    Route::patch('/adminDepartment/users/{user}/edit',[AdminController::class,'storeEditData'])->name('user.patch');
});

//Sale Department
Route::middleware(SaleMiddleware::class)->group(function(){
    Route::get('/saleDepartment/dashboard',[SaleController::class,'index'])->name('saleDepartment.index');
    Route::post('/saleDepartment/preorders/{preorder}/store',[SaleController::class,'confrim'])->name('preorder.confrim');
    Route::patch('/saleDepartment/preorders/{preorder}/patch',[SaleController::class,'storeEditPreorder'])->name('preorder.patch');
});
