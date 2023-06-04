<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\SubCategoryController; 
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
Auth::routes(['verify'=> true]);
Route::middleware('auth')->group(function () {
//Category
 
Route::get('/add-category','CategoryController@category');
Route::post('/add-category-post','CategoryController@categoryPost');
Route::get('/view-category-list','CategoryController@categoryView');
Route::get('/delete-category/{cat_id}', 'CategoryController@categoryDelete');
Route::get('/edit-category/{cat_id}', 'CategoryController@categoryEdit');
Route::post('/update-category-post','CategoryController@categoryUpdate');

//Sub Category

Route::get('/add-subcategory','SubCategoryController@SubCategory');
Route::post('/add-subcategory-post','SubCategoryController@SubCategoryPost');
Route::get('/view-subcategory-list','SubCategoryController@SubCategoryView');
Route::get('/delete-subcategory/{cat_id}', 'SubCategoryController@SubCategoryDelete');
Route::get('/edit-subcategory/{cat_id}', 'SubCategoryController@SubCategoryEdit');
Route::post('/update-subcategory-post','SubCategoryController@SubCategoryUpdate');
Route::get('/deleted-subcategory', 'SubCategoryController@SubCategoryDeleted');
Route::get('/restore-subcategory/{id}', 'SubCategoryController@SubCategoryRestore');
Route::get('/permanent-deleted-subcategory/{id}', 'SubCategoryController@SubCategoryPDeleted');
Route::get('/add-product','ProductController@product');
Route::post('/add-product-post','ProductController@productPost');
Route::get('/view-product-list','ProductController@productView');
Route::get('/delete-product/{cat_id}', 'ProductController@productDelete');
Route::get('/edit-product/{pro_id}', 'ProductController@productEdit');
Route::post('/update-product-post','ProductController@productUpdate');
Route::get('/home','HomeController@index')->name('home');
Route::get('/checkout','CheckoutController@Checkout')->name('checkout');
Route::get('/api/get-district-list/{division_id}','CheckoutController@GetdistrictList')->name('GetdistrictList');
Route::post('/payment','PaymentController@Payment')->name('Payment');
});
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/','FrontendController@FrontPage')->name('FrontPage');
Route::get('/item/{slug}','FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/single-cart/{slug}','FrontendController@SingleCart')->name('SingleCart');
Route::get('/cart','CartController@cart')->name('cart');
Route::get('/cart/{coupon}','CartController@cart')->name('Couponcart');
Route::get('/single/cart-delete/{id}','CartController@SingleCartDelete')->name('SingleCartDelete');
Route::post('/cart/update','CartController@CartUpdate')->name('CartUpdate');
Route::get('/shop','FrontendController@shop')->name('shop');

Route::get('login/google', 'SocialController@redirectToProvider')->name('redirectToProvider');
Route::get('login/google/callback', 'SocialController@handleProviderCallback')->name('handleProviderCallback');