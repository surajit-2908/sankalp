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


// Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', ['as' => 'index', 'uses' => 'Frontend\IndexController@index']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'Frontend\IndexController@contact']);
Route::post('/save-contact', ['as' => 'save.contact', 'uses' => 'Frontend\IndexController@saveContact']);

//Authorized routes
Route::group([
    'middleware' => ['auth'], 'prefix' => 'user'
], function () {
    Route::get('/logout', ['as' => 'user.logout', 'uses' => 'Frontend\AuthController@logoutUser']);

    Route::get('/cart', ['as' => 'user.cart', 'uses' => 'Frontend\ShopController@cart']);
    Route::post('/add-cart/{product_id}', ['as' => 'add.cart', 'uses' => 'Frontend\ShopController@addCart']);
    Route::post('/remove-cart-item', ['as' => 'remove.cart.item', 'uses' => 'Frontend\ShopController@removeCartItem']);
    Route::post('/change-quantity', ['as' => 'change.quantity', 'uses' => 'Frontend\ShopController@changeQuantity']);
    Route::post('/change-quantity-check-out', ['as' => 'change.quantity.checkOut', 'uses' => 'Frontend\ShopController@changeQuantityChckOut']);

    Route::post('/buy-now/{product_id}', ['as' => 'buy.now', 'uses' => 'Frontend\ShopController@buyNow']);
    Route::get('/check-out', ['as' => 'check.out', 'uses' => 'Frontend\BookingController@checkOut']);
    Route::post('/payment', ['as' => 'payment', 'uses' => 'Frontend\BookingController@payment']);
    Route::post('/booking', ['as' => 'booking', 'uses' => 'Frontend\BookingController@booking']);
    Route::get('/{booking_type}/booking-success', ['as' => 'booking.success', 'uses' => 'Frontend\BookingController@bookingSuccess']);

    Route::get('/my-orders', ['as' => 'user.my.orders', 'uses' => 'Frontend\ProfileController@myOrder']);
    Route::get('/online-training-orders', ['as' => 'user.online.training.orders', 'uses' => 'Frontend\ProfileController@onlineTrainingOrder']);

    Route::get('/profile-info', ['as' => 'user.profile.info', 'uses' => 'Frontend\ProfileController@index']);
    Route::post('/profile-update', ['as' => 'user.profile.update', 'uses' => 'Frontend\ProfileController@updateProflie']);
    Route::post('/password-update', ['as' => 'user.password.update', 'uses' => 'Frontend\ProfileController@changePassword']);
    Route::post('/update-image', ['as' => 'user.update.image', 'uses' => 'Frontend\ProfileController@updateImage']);

    Route::get('/manage-address', ['as' => 'user.manage.address', 'uses' => 'Frontend\ProfileController@manageAddress']);
    Route::post('/insert-address', ['as' => 'user.insert.address', 'uses' => 'Frontend\ProfileController@insertAddress']);
    Route::get('/edit-address/{address_id}', ['as' => 'admin.edit.address', 'uses' => 'Frontend\ProfileController@editAddress']);
    Route::post('/update-address/{address_id}', ['as' => 'user.update.address', 'uses' => 'Frontend\ProfileController@updateAddress']);
    Route::post('/remove-address', ['as' => 'user.address.remove', 'uses' => 'Frontend\ProfileController@removeAddress']);
    Route::get('/default-address/{id}', ['as' => 'user.address.default', 'uses' => 'Frontend\ProfileController@addressDefault']);
    Route::post('/update-mobile/{address_id}', ['as' => 'user.update.mobile', 'uses' => 'Frontend\ProfileController@updateMobile']);

    Route::get('/my-rating-reviews', ['as' => 'user.my.rating.review', 'uses' => 'Frontend\RatingController@myRatingReview']);
    Route::get('/rating-reviews/{booking_number}/{product_slug}', ['as' => 'user.rating.review', 'uses' => 'Frontend\RatingController@ratingReview']);
    Route::post('/save-reviews/{booking_number}/{product_id}', ['as' => 'user.save.rating', 'uses' => 'Frontend\RatingController@saveReview']);
    Route::get('/remove-rating/{rating_id}', ['as' => 'user.remove.rating', 'uses' => 'Frontend\RatingController@removeRating']);

    Route::get('/online-training-rating-reviews', ['as' => 'user.online.training.rating.review', 'uses' => 'Frontend\OnlineTrainingRatingController@myRatingReview']);
    Route::get('/online-training-rating-reviews/{booking_number}/{online_training_id}', ['as' => 'user.add.online.training.rating.review', 'uses' => 'Frontend\OnlineTrainingRatingController@ratingReview']);
    Route::post('/save-online-training-reviews/{booking_number}', ['as' => 'user.save.online.training.rating', 'uses' => 'Frontend\OnlineTrainingRatingController@saveReview']);
    Route::get('/remove-online-training-rating/{rating_id}', ['as' => 'user.remove.online.training.rating', 'uses' => 'Frontend\OnlineTrainingRatingController@removeRating']);
});

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

    Route::group(['prefix' => 'order'], function () {
        Route::get('', ['as' => 'admin.order', 'uses' => 'Admin\OrderController@index']);
        Route::get('add', ['as' => 'admin.order.add', 'uses' => 'Admin\OrderController@orderAdd']);
        Route::post('insert', ['as' => 'admin.order.insert', 'uses' => 'Admin\OrderController@orderInsert']);
        Route::get('edit/{id}', ['as' => 'admin.order.edit', 'uses' => 'Admin\OrderController@orderEdit']);
        Route::post('update/{id}', ['as' => 'admin.order.update', 'uses' => 'Admin\OrderController@orderUpdate']);
        Route::get('status/{id}/{status}', ['as' => 'admin.order.status', 'uses' => 'Admin\OrderController@orderStatus']);
        Route::get('remove/{id}', ['as' => 'admin.order.remove', 'uses' => 'Admin\OrderController@orderRemove']);
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

});

// Clear configuration cache:
Route::get('/optimize-clear', function () {
    $status = Artisan::call('optimize:clear');
    return '<h1>Configurations optimize cleared</h1>';
});
