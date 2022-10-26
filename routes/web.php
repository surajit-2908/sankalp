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
Route::get('/about', ['as' => 'about', 'uses' => 'Frontend\IndexController@about']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'Frontend\IndexController@contact']);
Route::post('/save-contact', ['as' => 'save.contact', 'uses' => 'Frontend\IndexController@saveContact']);
Route::get('/online-training', ['as' => 'online.training', 'uses' => 'Frontend\IndexController@onlineTraining']);
Route::post('/online-training-payment', ['as' => 'online.training.payment', 'uses' => 'Frontend\IndexController@payment']);
Route::post('/online-training-booking/{id}', ['as' => 'online.training.booking', 'uses' => 'Frontend\IndexController@booking']);

Route::get('/user-login/{product_slug?}', ['as' => 'user.login', 'uses' => 'Frontend\AuthController@login']);
Route::post('/post-login', ['as' => 'login.user', 'uses' => 'Frontend\AuthController@loginUser']);
Route::get('/sign-up', ['as' => 'signup', 'uses' => 'Frontend\AuthController@signUp']);
Route::get('/email-verify/{email}', ['as' => 'email.verify', 'uses' => 'Frontend\AuthController@emailVerify']);
Route::post('/post-sign-up', ['as' => 'signup.user', 'uses' => 'Frontend\AuthController@signUpUser']);

Route::get('/forgot-password', ['as' => 'forgot.password', 'uses' => 'Frontend\AuthController@forgotPassword']);
Route::post('/reset-password', ['as' => 'reset.password', 'uses' => 'Frontend\AuthController@resetPassword']);
Route::get('/reset-password/{otp}', ['as' => 'reset.new.password', 'uses' => 'Frontend\AuthController@resetNewPassword']);
Route::post('/update-forgot-password', ['as' => 'update.forgot.password', 'uses' => 'Frontend\AuthController@updateForgotPassword']);

Route::get('/shop/{cat_slug?}', ['as' => 'shop', 'uses' => 'Frontend\ShopController@shop']);
Route::get('/product-details/{product_slug}', ['as' => 'product.detail', 'uses' => 'Frontend\ShopController@productDetail']);

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
    Route::get('forgotpassword', ['as' => 'admin.forgotpassword', 'uses' => 'Admin\AuthController@forgotPassword']);
    Route::post('sendpasswordresetlink', ['as' => 'admin.sendpasswordresetlink', 'uses' => 'Admin\AuthController@sendPasswordResetLink']);
    Route::get('resetpassword/{token}', ['as' => 'admin.resetpassword', 'uses' => 'Admin\AuthController@resetPassword']);
    Route::post('dopasswordreset', ['as' => 'admin.dopasswordreset', 'uses' => 'Admin\AuthController@doPasswordReset']);
});

Route::group([
    'middleware' => ['auth:admin'], 'prefix' => 'administrator'
], function () {
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);

    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    Route::post('profile/change_password', ['as' => 'admin.profile.change_password', 'uses' => 'Admin\ProfileController@changePassword']);
    Route::get('settings', ['as' => 'admin.settings', 'uses' => 'Admin\ProfileController@setting']);
    Route::post('update-settings/{id}', ['as' => 'admin.update.settings', 'uses' => 'Admin\ProfileController@updateSetting']);

    Route::get('feedback', ['as' => 'admin.feedback', 'uses' => 'Admin\FeedbackController@index']);
    Route::get('feedback/remove/{id}', ['as' => 'admin.feedback.remove', 'uses' => 'Admin\FeedbackController@feedbackRemove']);

    Route::group(['prefix' => 'brand'], function () {
        Route::get('', ['as' => 'admin.brand', 'uses' => 'Admin\BrandController@index']);
        Route::get('add', ['as' => 'admin.brand.add', 'uses' => 'Admin\BrandController@brandAdd']);
        Route::post('insert', ['as' => 'admin.brand.insert', 'uses' => 'Admin\BrandController@brandInsert']);
        Route::get('edit/{id}', ['as' => 'admin.brand.edit', 'uses' => 'Admin\BrandController@brandEdit']);
        Route::post('update/{id}', ['as' => 'admin.brand.update', 'uses' => 'Admin\BrandController@brandUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.brand.remove', 'uses' => 'Admin\BrandController@brandRemove']);
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

    Route::group(['prefix' => 'variation'], function () {
        Route::get('', ['as' => 'admin.variation', 'uses' => 'Admin\VariationController@index']);
        Route::get('add', ['as' => 'admin.variation.add', 'uses' => 'Admin\VariationController@variationAdd']);
        Route::post('insert', ['as' => 'admin.variation.insert', 'uses' => 'Admin\VariationController@variationInsert']);
        Route::get('edit/{id}', ['as' => 'admin.variation.edit', 'uses' => 'Admin\VariationController@variationEdit']);
        Route::post('update/{id}', ['as' => 'admin.variation.update', 'uses' => 'Admin\VariationController@variationUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.variation.remove', 'uses' => 'Admin\VariationController@variationRemove']);
    });

    Route::group(['prefix' => 'variation-option'], function () {
        Route::get('', ['as' => 'admin.variation.option', 'uses' => 'Admin\VariationOptionController@index']);
        Route::get('add', ['as' => 'admin.variation.option.add', 'uses' => 'Admin\VariationOptionController@variationOptionAdd']);
        Route::post('insert', ['as' => 'admin.variation.option.insert', 'uses' => 'Admin\VariationOptionController@variationOptionInsert']);
        Route::get('edit/{id}', ['as' => 'admin.variation.option.edit', 'uses' => 'Admin\VariationOptionController@variationOptionEdit']);
        Route::post('update/{id}', ['as' => 'admin.variation.option.update', 'uses' => 'Admin\VariationOptionController@variationOptionUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.variation.option.remove', 'uses' => 'Admin\VariationOptionController@variationOptionRemove']);
    });

    Route::group(['prefix' => 'online-training'], function () {
        Route::get('', ['as' => 'admin.online.training', 'uses' => 'Admin\OnlineTrainingController@index']);
        Route::get('detail/{id}', ['as' => 'admin.online.training.detail', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingDetail']);
        Route::get('add', ['as' => 'admin.online.training.add', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingAdd']);
        Route::post('insert', ['as' => 'admin.online.training.insert', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingInsert']);
        Route::get('edit/{id}', ['as' => 'admin.online.training.edit', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingEdit']);
        Route::post('update/{id}', ['as' => 'admin.online.training.update', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.online.training.remove', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingRemove']);
        Route::get('bottom/status/{id}', ['as' => 'admin.online.training.bottom.status', 'uses' => 'Admin\OnlineTrainingController@bottomStatus']);
        Route::get('rating-remove/{id}', ['as' => 'admin.online.training.rating.remove', 'uses' => 'Admin\OnlineTrainingController@onlineTrainingRatingRemove']);
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
        Route::get('featured/status/{id}', ['as' => 'admin.product.featured.status', 'uses' => 'Admin\ProductController@productFeaturedStatus']);
        Route::post('remove/img', ['as' => 'admin.product.img.remove', 'uses' => 'Admin\ProductController@imgRemove']);
        Route::get('rating-remove/{id}', ['as' => 'admin.product.rating.remove', 'uses' => 'Admin\ProductController@productRatingRemove']);
    });
    Route::get('get-sub-cat/{cat_id}', ['as' => 'admin.get.sub-cat', 'uses' => 'Admin\ProductController@getSubCat']);
    Route::get('get-variation/{unique_id}', ['as' => 'admin.get.variation', 'uses' => 'Admin\ProductController@getVar']);
    Route::get('get-variation-option/{variation_id}', ['as' => 'admin.get.var.opt', 'uses' => 'Admin\ProductController@getVarOpt']);

    Route::group(['prefix' => 'product-variant'], function () {
        Route::get('/{product_id}', ['as' => 'admin.product.variant', 'uses' => 'Admin\ProductVariantController@index']);
        Route::post('update/{id}', ['as' => 'admin.product.variant.update', 'uses' => 'Admin\ProductVariantController@productVariantUpdate']);
        Route::post('remove', ['as' => 'admin.product.variant.remove', 'uses' => 'Admin\ProductVariantController@variantRemove']);
    });

    Route::group(['prefix' => 'product-faq'], function () {
        Route::get('/{product_id}', ['as' => 'admin.product.faq', 'uses' => 'Admin\ProductFaqController@index']);
        Route::post('update/{id}', ['as' => 'admin.product.faq.update', 'uses' => 'Admin\ProductFaqController@productFaqUpdate']);
        Route::post('remove', ['as' => 'admin.product.faq.remove', 'uses' => 'Admin\ProductFaqController@productFaqRemove']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('', ['as' => 'admin.user', 'uses' => 'Admin\UserController@index']);
        Route::get('status/{id}', ['as' => 'admin.user.status', 'uses' => 'Admin\UserController@userStatus']);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('', ['as' => 'admin.order', 'uses' => 'Admin\OrderController@index']);
        Route::get('view/{booking_id}', ['as' => 'admin.order.view', 'uses' => 'Admin\OrderController@view']);
        Route::get('order-status/{booking_id}/{status}', ['as' => 'admin.order.status', 'uses' => 'Admin\OrderController@orderStatus']);
    });

    Route::group(['prefix' => 'online-training-order'], function () {
        Route::get('', ['as' => 'admin.online.training.order', 'uses' => 'Admin\OnlineTrainingOrderController@index']);
        Route::get('view/{booking_id}', ['as' => 'admin.online.training.order.view', 'uses' => 'Admin\OnlineTrainingOrderController@view']);
        Route::get('order-status/{booking_id}/{status}', ['as' => 'admin.online.training.order.status', 'uses' => 'Admin\OnlineTrainingOrderController@orderStatus']);
    });

    ///------------------content managements------------------------//

    Route::group(['prefix' => 'testimonial'], function () {
        Route::get('', ['as' => 'admin.testimonial', 'uses' => 'Admin\TestimonialController@index']);
        Route::get('add', ['as' => 'admin.testimonial.add', 'uses' => 'Admin\TestimonialController@testimonialAdd']);
        Route::post('insert', ['as' => 'admin.testimonial.insert', 'uses' => 'Admin\TestimonialController@testimonialInsert']);
        Route::get('edit/{id}', ['as' => 'admin.testimonial.edit', 'uses' => 'Admin\TestimonialController@testimonialEdit']);
        Route::post('update/{id}', ['as' => 'admin.testimonial.update', 'uses' => 'Admin\TestimonialController@testimonialUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.testimonial.remove', 'uses' => 'Admin\TestimonialController@testimonialRemove']);
    });

    Route::group(['prefix' => 'content'], function () {
        Route::get('', ['as' => 'admin.content', 'uses' => 'Admin\ContentController@index']);
        Route::get('/{page}', ['as' => 'admin.content.listing', 'uses' => 'Admin\ContentController@content']);
        Route::get('edit/{id}', ['as' => 'admin.content.edit', 'uses' => 'Admin\ContentController@contentEdit']);
        Route::post('update/{id}', ['as' => 'admin.content.update', 'uses' => 'Admin\ContentController@contentUpdate']);
    });
});

// Clear configuration cache:
// Route::get('/optimize-clear', function () {
//     $status = Artisan::call('optimize:clear');
//     return '<h1>Configurations optimize cleared</h1>';
// });
