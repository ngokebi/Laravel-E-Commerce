<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\SliderController;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');
});



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');
});




// Admin all Route

// Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
//     Route::get('/login', [AdminController::class, 'LoginForm']);
//     Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
// });

// Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
//     return view('admin.index');
// })->name('admin.dashboard')->middleware('auth:admin');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/password', [AdminProfileController::class, 'AdminPassword'])->name('admin.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'UpdatePassword'])->name('admin.profile.changepassword');

    //  All Brands Route

    Route::prefix('brand')->group(function () {

        Route::get('/all', [BrandController::class, 'Brands'])->name('all.brand');
        Route::get('/add', [BrandController::class, 'AddBrands'])->name('add.brand');
        Route::post('/store', [BrandController::class, 'StoreBrands'])->name('store.brand');
        Route::get('/edit/{id}', [BrandController::class, 'EditBrands'])->name('edit.brand');
        Route::get('/delete/{id}', [BrandController::class, 'DeleteBrands'])->name('delete.brand');
        Route::post('/update', [BrandController::class, 'UpdateBrands'])->name('update.brand');
    });

    // All Category Route

    Route::prefix('category')->group(function () {

        Route::get('/all', [CategoryController::class, 'Category'])->name('all.category');
        Route::get('/add', [CategoryController::class, 'AddCategory'])->name('add.category');
        Route::post('/store', [CategoryController::class, 'StoreCategory'])->name('store.category');
        Route::get('/edit/{id}', [CategoryController::class, 'EditCategory'])->name('edit.category');
        Route::get('/delete/{id}', [CategoryController::class, 'DeleteCategory'])->name('delete.category');
        Route::post('/update', [CategoryController::class, 'UpdateCategory'])->name('update.category');
    });

    // All SubCategory Route

    Route::prefix('subcategory')->group(function () {

        Route::get('/all', [SubCategoryController::class, 'SubCategory'])->name('all.subcategory');
        Route::get('/add', [SubCategoryController::class, 'AddSubCategory'])->name('add.subcategory');
        Route::post('/store', [SubCategoryController::class, 'StoreSubCategory'])->name('store.subcategory');
        Route::get('/edit/{id}', [SubCategoryController::class, 'EditSubCategory'])->name('edit.subcategory');
        Route::get('/delete/{id}', [SubCategoryController::class, 'DeleteSubCategory'])->name('delete.subcategory');
        Route::post('/update', [SubCategoryController::class, 'UpdateSubCategory'])->name('update.subcategory');
    });

    // All SubSubCategory Route

    Route::prefix('sub_subcategory')->group(function () {

        Route::get('/all', [SubCategoryController::class, 'Sub_SubCategory'])->name('all.sub_subcategory');
        Route::get('/add', [SubCategoryController::class, 'AddSub_SubCategory'])->name('add.sub_subcategory');
        Route::post('/store', [SubCategoryController::class, 'StoreSub_SubCategory'])->name('store.sub_subcategory');
        Route::get('/edit/{id}', [SubCategoryController::class, 'EditSub_SubCategory'])->name('edit.sub_subcategory');
        Route::get('/delete/{id}', [SubCategoryController::class, 'DeleteSub_SubCategory'])->name('delete.sub_subcategory');
        Route::post('/update', [SubCategoryController::class, 'UpdateSub_SubCategory'])->name('update.sub_subcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'Get_SubCategory']);
        Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'Get_SubSubCategory']);
    });

    // All Products Route

    Route::prefix('products')->group(function () {

        Route::get('/all', [ProductsController::class, 'Products'])->name('manage.products');
        Route::get('/add', [ProductsController::class, 'AddProducts'])->name('add.products');
        Route::post('/store', [ProductsController::class, 'StoreProducts'])->name('store.products');
        Route::get('/edit/{id}', [ProductsController::class, 'EditProducts'])->name('edit.products');
        Route::get('/delete/{id}', [ProductsController::class, 'DeleteProducts'])->name('delete.products');
        Route::post('/update', [ProductsController::class, 'UpdateProducts'])->name('update.products');
        Route::post('/update/image', [ProductsController::class, 'UpdateProductImage'])->name('update.product.image');
        Route::post('/update/main_image', [ProductsController::class, 'UpdateProductMainImage'])->name('update.product.main_image');
        Route::get('/delete/images/{id}', [ProductsController::class, 'DeleteProductsImages'])->name('product.delete.images');
        Route::get('/inactive/{id}', [ProductsController::class, 'Inactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductsController::class, 'Active'])->name('product.active');
        Route::get('/details/{id}', [ProductsController::class, 'ProductDetails'])->name('detail.products');
    });

    // All Slider Route

    Route::prefix('slider')->group(function () {

        Route::get('/all', [SliderController::class, 'Slider'])->name('manage.slider');
        Route::get('/add', [SliderController::class, 'AddSlider'])->name('add.slider');
        Route::post('/store', [SliderController::class, 'StoreSlider'])->name('store.slider');
        Route::get('/edit/{id}', [SliderController::class, 'EditSlider'])->name('edit.slider');
        Route::get('/delete/{id}', [SliderController::class, 'DeleteSlider'])->name('delete.slider');
        Route::post('/update', [SliderController::class, 'UpdateSlider'])->name('update.slider');
        Route::get('/inactive/{id}', [SliderController::class, 'Inactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'Active'])->name('slider.active');
    });
});

// User All Route

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/update', [IndexController::class, 'UpdateProfile'])->name('user.profileupdate');
Route::post('/user/profile', [IndexController::class, 'UpdatePassword'])->name('user.password');
Route::post('/user/profile/picture', [IndexController::class, 'UpdatePicture'])->name('user.picture');

// Frontend Product Details
Route::get('/product/details/{id}/{name}', [IndexController::class, 'ProductDetails']);

// Frontend Product Tags
Route::get('/product/tag/{tag}', [IndexController::class, 'TagProduct']);

// SubCategory WIse Data
Route::get('/subcategory/product/{subcat_id}/{subcat_name}', [IndexController::class, 'SubCatWIseProduct']);

// SubSubCategory WIse Data
Route::get('/subsubcategory/product/{subsubcat_id}/{subsubcat_name}', [IndexController::class, 'SubSubCatWIseProduct']);

// Product View Modal ( add to cart)
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
