<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', ['as' => 'index', 'uses' => 'Frontend\IndexController@index']);
Route::get('/about-us', ['as' => 'about.us', 'uses' => 'Frontend\IndexController@aboutUs']);
Route::get('/product/{cat_slug}', ['as' => 'product', 'uses' => 'Frontend\IndexController@product']);
Route::get('/product/details/{product_slug}', ['as' => 'product.details', 'uses' => 'Frontend\IndexController@productDetails']);
Route::get('/enquiry', ['as' => 'enquiry', 'uses' => 'Frontend\IndexController@enquiry']);
Route::get('/reload-captcha', ['as' => 'reload.captcha', 'uses' => 'Frontend\IndexController@reloadCaptcha']);
Route::post('/save-enquiry', ['as' => 'save.enquiry', 'uses' => 'Frontend\IndexController@saveEnquiry']);
Route::post('/save-enquiry', ['as' => 'save.enquiry', 'uses' => 'Frontend\IndexController@saveEnquiry']);
Route::post('/show-tracking-details', ['as' => 'show.tracking.details', 'uses' => 'Frontend\IndexController@showTrackingDetails']);


Route::group([
    'prefix' => 'administrator'
], function () {
    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\AuthController@index']);
    Route::get('/', ['as' => 'login', 'uses' => 'Admin\AuthController@index']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@login']);
});

Route::group([
    'middleware' => ['auth:admin'], 'prefix' => 'administrator'
], function () {
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);

    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    Route::post('profile/change_password', ['as' => 'admin.profile.change_password', 'uses' => 'Admin\ProfileController@changePassword']);
    Route::post('profile/update', ['as' => 'admin.profile.update', 'uses' => 'Admin\ProfileController@profileUpdate']);

    Route::group(['prefix' => 'order'], function () {
        Route::get('', ['as' => 'admin.order', 'uses' => 'Admin\OrderController@index']);
        Route::get('add', ['as' => 'admin.order.add', 'uses' => 'Admin\OrderController@orderAdd']);
        Route::post('insert', ['as' => 'admin.order.insert', 'uses' => 'Admin\OrderController@orderInsert']);
        Route::post('status', ['as' => 'admin.order.status', 'uses' => 'Admin\OrderController@orderStatus']);
        Route::get('remove/{id}', ['as' => 'admin.order.remove', 'uses' => 'Admin\OrderController@orderRemove']);
        Route::get('user-log/{id}', ['as' => 'admin.order.user.log', 'uses' => 'Admin\OrderController@orderUserLog']);
    });

    Route::group(['prefix' => 'company'], function () {
        Route::get('', ['as' => 'admin.company', 'uses' => 'Admin\CompanyController@index']);
        Route::get('add', ['as' => 'admin.company.add', 'uses' => 'Admin\CompanyController@companyAdd']);
        Route::post('insert', ['as' => 'admin.company.insert', 'uses' => 'Admin\CompanyController@companyInsert']);
        Route::get('edit/{id}', ['as' => 'admin.company.edit', 'uses' => 'Admin\CompanyController@companyEdit']);
        Route::post('update/{id}', ['as' => 'admin.company.update', 'uses' => 'Admin\CompanyController@companyUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.company.remove', 'uses' => 'Admin\CompanyController@companyRemove']);
    });

    Route::group(['prefix' => 'enquiry'], function () {
        Route::get('', ['as' => 'admin.enquiry', 'uses' => 'Admin\EnquiryController@index']);
        Route::get('status/{id}/{status}', ['as' => 'admin.enquiry.status', 'uses' => 'Admin\EnquiryController@enquiryStatus']);
        Route::get('view/{id}', ['as' => 'admin.enquiry.view', 'uses' => 'Admin\EnquiryController@enquiryView']);
    });

    Route::group(['prefix' => 'tracking'], function () {
        Route::get('', ['as' => 'admin.tracking', 'uses' => 'Admin\TrackingController@index']);
        Route::get('remove/{id}', ['as' => 'admin.tracking.remove', 'uses' => 'Admin\TrackingController@trackingRemove']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('', ['as' => 'admin.category', 'uses' => 'Admin\CategoryController@index']);
        Route::get('add', ['as' => 'admin.category.add', 'uses' => 'Admin\CategoryController@categoryAdd']);
        Route::post('insert', ['as' => 'admin.category.insert', 'uses' => 'Admin\CategoryController@categoryInsert']);
        Route::get('edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Admin\CategoryController@categoryEdit']);
        Route::post('update/{id}', ['as' => 'admin.category.update', 'uses' => 'Admin\CategoryController@categoryUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.category.remove', 'uses' => 'Admin\CategoryController@categoryRemove']);
    });

    Route::group(['prefix' => 'sub-category'], function () {
        Route::get('', ['as' => 'admin.sub.category', 'uses' => 'Admin\SubCategoryController@index']);
        Route::get('add', ['as' => 'admin.sub.category.add', 'uses' => 'Admin\SubCategoryController@subCategoryAdd']);
        Route::post('insert', ['as' => 'admin.sub.category.insert', 'uses' => 'Admin\SubCategoryController@subCategoryInsert']);
        Route::get('edit/{id}', ['as' => 'admin.sub.category.edit', 'uses' => 'Admin\SubCategoryController@subCategoryEdit']);
        Route::post('update/{id}', ['as' => 'admin.sub.category.update', 'uses' => 'Admin\SubCategoryController@subCategoryUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.sub.category.remove', 'uses' => 'Admin\SubCategoryController@subCategoryRemove']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('', ['as' => 'admin.product', 'uses' => 'Admin\ProductController@index']);
        Route::get('detail/{id}', ['as' => 'admin.product.detail', 'uses' => 'Admin\ProductController@productDetail']);
        Route::get('add', ['as' => 'admin.product.add', 'uses' => 'Admin\ProductController@productAdd']);
        Route::post('insert', ['as' => 'admin.product.insert', 'uses' => 'Admin\ProductController@productInsert']);
        Route::get('edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Admin\ProductController@productEdit']);
        Route::post('update/{id}', ['as' => 'admin.product.update', 'uses' => 'Admin\ProductController@productUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.product.remove', 'uses' => 'Admin\ProductController@productRemove']);
        Route::get('status/{id}', ['as' => 'admin.product.status', 'uses' => 'Admin\ProductController@productStatus']);
        Route::post('remove/img', ['as' => 'admin.product.img.remove', 'uses' => 'Admin\ProductController@imgRemove']);
    });
    Route::get('get-sub-cat/{cat_id}', ['as' => 'admin.get.sub-cat', 'uses' => 'Admin\ProductController@getSubCat']);

    // sub-admin access denied
    Route::middleware([SubAdminCheck::class])->group(function () {
        Route::group(['prefix' => 'sub-admin'], function () {
            Route::get('', ['as' => 'admin.sub.admin', 'uses' => 'Admin\SubAdminController@index']);
            Route::get('add', ['as' => 'admin.sub.admin.add', 'uses' => 'Admin\SubAdminController@subAdminAdd']);
            Route::post('insert', ['as' => 'admin.sub.admin.insert', 'uses' => 'Admin\SubAdminController@subAdminInsert']);
            Route::get('edit/{id}', ['as' => 'admin.sub.admin.edit', 'uses' => 'Admin\SubAdminController@subAdminEdit']);
            Route::post('update/{id}', ['as' => 'admin.sub.admin.update', 'uses' => 'Admin\SubAdminController@subAdminUpdate']);
            Route::get('remove/{id}', ['as' => 'admin.sub.admin.remove', 'uses' => 'Admin\SubAdminController@subAdminRemove']);
        });

        Route::group(['prefix' => 'meta-tag'], function () {
            Route::get('', ['as' => 'admin.meta.tag', 'uses' => 'Admin\MetaTagController@index']);
            Route::get('edit/{id}', ['as' => 'admin.meta.tag.edit', 'uses' => 'Admin\MetaTagController@metaTagEdit']);
            Route::post('update/{id}', ['as' => 'admin.meta.tag.update', 'uses' => 'Admin\MetaTagController@metaTagUpdate']);
        });

        Route::group(['prefix' => 'user-log'], function () {
            Route::get('/', ['as' => 'admin.user.log', 'uses' => 'Admin\UserLogController@index']);
            Route::get('remove/{id}', ['as' => 'admin.user.log.remove', 'uses' => 'Admin\UserLogController@userLogRemove']);
        });
        Route::post('ckeditor/upload', ['as' => 'ckeditor.upload', 'uses' => 'Admin\ContentController@uploadCkEditorImage']);
    });
});

// Clear configuration cache:
Route::get('/optimize-clear', function () {
    $status = Artisan::call('optimize:clear');
    return '<h1>Configurations optimize cleared</h1>';
});
