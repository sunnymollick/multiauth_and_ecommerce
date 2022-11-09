<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Category\CouponController;
use App\Http\Controllers\Admin\Category\NewsletterController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Web\FrontController;
use App\Http\Controllers\Web\UserProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactController;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/',[FrontController::class,'index']);

Route::group(['prefix' => 'admin', 'middleware'=>['admin:admin']], function () {
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin_backend.pages.index');
})->name('dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('frontend.pages.user.user_profile');
})->name('dashboard');



// User Routes Go Here
Route::get('user/logout',[MainUserController::class,'Logout'])->name('user.logout');
Route::get('user/profile',[MainUserController::class,'userProfile'])->name('user.profile')->middleware(['auth:sanctum,web','verified']);
Route::get('edit/user/profile',[MainUserController::class,'editUserProfile'])->name('edit.user.profile');
Route::post('update/user/profile',[MainUserController::class,'userProfileUpdate'])->name('user.update');
Route::get('change/user/password',[MainUserController::class,'userPasswordChange'])->name('user.password.change');
Route::post('update/user/password',[MainUserController::class,'updateUserPassword'])->name('update.user.password');

// Route::get('admin/view/order/{id}',[MainUserController::class,'viewOrder'])->name('view.order');
// Admin Routes Go Here

Route::get('admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('admin/profile',[MainAdminController::class,'adminProfile'])->name('admin.profile');
Route::get('edit/admin/profile',[MainAdminController::class,'editAdminProfile'])->name('edit.admin.profile');
Route::post('update/admin/profile',[MainAdminController::class,'adminProfileUpdate'])->name('admin.update');
Route::get('change/admin/password',[MainAdminController::class,'adminPasswordChange'])->name('admin.password.change');
Route::post('update/admin/password',[MainAdminController::class,'updateAdminPassword'])->name('update.admin.password');

// Category routes go here
Route::get('admin/category',[CategoryController::class,'category'])->name('categories');
Route::post('store/category',[CategoryController::class,'storeCategory'])->name('store.category');
Route::get('delete/category/{id}',[CategoryController::class,'categoryDelete'])->name('delete.category');
Route::get('edit/category/{id}',[CategoryController::class,'categoryEdit'])->name('edit.category');
Route::post('update/category/{id}',[CategoryController::class,'categoryUpdate'])->name('update.category');

// Brands Route Go Here
Route::get('admin/brand',[BrandController::class,'brand'])->name('brands');
Route::post('admin/store/brand',[BrandController::class,'storeBrand'])->name('store.brand');
Route::get('delete/brand/{id}',[BrandController::class,'brandDelete'])->name('delete.brand');
Route::get('edit/brand/{id}',[BrandController::class,'brandEdit'])->name('edit.brand');
Route::post('update/brand/{id}',[BrandController::class,'brandUpdate'])->name('update.brand');


// Sub Categories Routes Go Here
Route::get('admin/sub/category',[SubCategoryController::class,'subCategory'])->name('sub.category');
Route::post('store/sub/category',[SubCategoryController::class,'storeSubCategory'])->name('store.sub.category');
Route::get('delete/sub/category/{id}',[SubCategoryController::class,'subCategoryDelete'])->name('delete.sub.category');
Route::get('edit/sub/category/{id}',[SubCategoryController::class,'subCategoryEdit'])->name('edit.sub.category');
Route::post('update/sub/category/{id}',[SubCategoryController::class,'subCategoryUpdate'])->name('update.sub.category');

// Coupon Controller Go Here
Route::get('admin/coupon',[CouponController::class,'coupon'])->name('admin.coupon');
Route::post('store/coupon',[CouponController::class,'storeCoupon'])->name('store.coupon');
Route::get('delete/coupon/{id}',[CouponController::class,'couponDelete'])->name('delete.coupon');
Route::get('edit/coupon/{id}',[CouponController::class,'couponEdit'])->name('edit.coupon');
Route::post('update/coupon/{id}',[CouponController::class,'couponUpdate'])->name('update.coupon');


// Newsletter Routes Go Here
Route::get('admin/newsletter',[NewsletterController::class,'newsletter'])->name('admin.newsletter');
Route::get('delete/subscriber/{id}',[NewsletterController::class,'subscriberDelete'])->name('delete.subscriber');
Route::delete('delete/all/newsletter',[NewsletterController::class,'deleteAllNewsletter'])->name('delete.all.newsletter');
Route::post('store/newsletter',[FrontController::class,'storeNewsletter'])->name('store.newsletter');



// Product Routes Go Here
Route::get('admin/all/product',[ProductController::class,'index'])->name('admin.all.product');
Route::get('get/subcategory/{id}',[ProductController::class,'getSubcategory']);
Route::get('admin/add/product',[ProductController::class,'create'])->name('admin.add.product');
Route::post('admin/store/product',[ProductController::class,'store'])->name('admin.store.product');
Route::get('admin/inactive/product/{id}',[ProductController::class,'inactive'])->name('inactive.product');
Route::get('admin/active/product/{id}',[ProductController::class,'active'])->name('active.product');
Route::get('admin/view/product/{id}',[ProductController::class,'viewProduct'])->name('view.product');
Route::get('admin/delete/product/{id}',[ProductController::class,'deleteProduct'])->name('delete.product');
Route::get('admin/edit/product/{id}',[ProductController::class,'editProduct'])->name('edit.product');
Route::post('admin/update/product/without/image/{id}',[ProductController::class,'updateProductWithoutImage'])->name('update.product.without.image');
Route::post('admin/update/product/with/image/{id}',[ProductController::class,'updateProductWithImage'])->name('update.product.images');

//Admin Sites Blog Routes Go Here
Route::get('blog/category/list',[PostController::class,'BlogCatList'])->name('add.blog.categorylist');
Route::post('admin/store/blog/category',[PostController::class,'BlogCatStore'])->name('store.blog.category');
Route::get('blog/category/delete/{id}',[PostController::class,'DeleteBlogCat'])->name('delete.blog.category');
Route::get('blog/category/edit/{id}',[PostController::class,'EditBlogCat'])->name('edit.blog.category');
Route::post('update/blog/category/{id}',[PostController::class,'UpdateBlogCat'])->name('update.blog.category');


Route::get('add/blog/post',[PostController::class,'create'])->name('add.blog.post');
Route::get('all/blog/post',[PostController::class,'index'])->name('all.blog.post');
Route::post('admin/post/store',[PostController::class,'store'])->name('store.post');
Route::get('delete/blog/post/{id}',[PostController::class,'delete'])->name('delete.blog.post');
Route::get('edit/blog/post/{id}',[PostController::class,'EditPost'])->name('edit.blog.post');
Route::post('admin/post/update/{id}',[PostController::class,'updatePost'])->name('blog.post.update');
Route::get('view/blog/post/{id}',[PostController::class,'viewPost'])->name('view.blog.post');


// Wishlist Routes Go Here
Route::get('add/wishlist/{id}',[WishlistController::class,'addWishlist']);

// All Cart Routes Go Here
Route::get('add/to/cart/{id}',[CartController::class,'addToCart']);
Route::get('check/cart',[CartController::class,'checkCart']);
Route::get('show/cart',[CartController::class,'showCart'])->name('show.cart');
Route::get('remove/cart/{rowId}',[CartController::class,'removeCart'])->name('cart.remove');
Route::post('update/cart/item/{rowId}',[CartController::class,'updateCart'])->name('update.cartitem');
Route::get('cart/product/view/{id}',[CartController::class,'viewProduct']);
Route::post('insert/into/cart',[CartController::class,'insertCart'])->name('insert.into.cart');
Route::get('user/checkout',[CartController::class,'checkout'])->name('user.checkout');
Route::get('user/wishlist',[CartController::class,'wishlist'])->name('user.wishlist');
Route::post('apply/coupon',[CartController::class,'coupon'])->name('apply.coupon');
Route::get('remove/coupon',[CartController::class,'couponRemove'])->name('coupon.remove');

// All Payment Routes Go Here
Route::get('payment/step',[PaymentController::class,'payment'])->name('payment.step');
Route::post('user/payment/process',[PaymentController::class,'paymentProcess'])->name('payment.process');
Route::post('user/stripe/charge',[PaymentController::class,'stripeCharge'])->name('stripe.charge');
Route::post('cash/on/delivery',[PaymentController::class,'cashOnDelivery'])->name('cash.on.delivery');

// Product Details Routes Go Here
Route::get('product/details/{id}/{product_name}',[UserProductController::class,'productView'])->name('product.details');
Route::post('add/cart/product/{id}',[UserProductController::class,'addCart'])->name('add.card.product');


//web Sites Blog Routes Go Here
Route::get('blog/post',[BlogController::class,'blog'])->name('blog.post');
Route::get('language/english',[BlogController::class,'english'])->name('language.english');
Route::get('language/bangla',[BlogController::class,'bangla'])->name('language.bangla');
Route::get('single/blog/{id}',[BlogController::class,'singleBlog'])->name('single.blog');

// Sub category products route go here
Route::get('subcategory/products/{id}',[UserProductController::class,'productsView'])->name('subcategory.product');
Route::get('category/products/{id}',[UserProductController::class,'categoryProductView'])->name('category.all.product');


// Admin Order Route Go Here
Route::get('admin/new/order',[OrderController::class,'newOrder'])->name('admin.neworder');
Route::get('admin/view/order/{id}',[OrderController::class,'viewOrder'])->name('view.order');
Route::get('admin/payment/accept/{id}',[OrderController::class,'paymentAccept'])->name('admin.payment.accept');
Route::get('admin/payment/cancel/{id}',[OrderController::class,'paymentCancel'])->name('admin.payment.cancel');

Route::get('admin/accept/payment',[OrderController::class,'acceptPayment'])->name('admin.accept.payment');
Route::get('admin/cancel/order',[OrderController::class,'cancelOrder'])->name('admin.cancel.order');
Route::get('admin/process/payment',[OrderController::class,'processPayment'])->name('admin.process.payment');
Route::get('admin/success/payment',[OrderController::class,'successPayment'])->name('admin.success.payment');

Route::get('admin/delivery/process/{id}',[OrderController::class,'deliveryProcess'])->name('admin.delivery.process');
Route::get('admin/delivery/done/{id}',[OrderController::class,'deliveryDone'])->name('admin.delivery.done');

// SEO Setting Routes Go Here
Route::get('admin/seo',[SeoController::class,'seo'])->name('admin.seo');
Route::post('update/seo/{id}',[SeoController::class,'seoUpdate'])->name('update.seo');

// Order Tracking Routes Go Here
Route::post('order/tracking',[FrontController::class,'orderTracking'])->name('order.tracking');

// Order Report Routes Go Here
Route::get('today/order',[ReportController::class,'todayOrder'])->name('today.order');
Route::get('today/delivery',[ReportController::class,'todayDelivery'])->name('today.delivery');
Route::get('this/month',[ReportController::class,'thisMonth'])->name('this.month');
Route::get('search/report',[ReportController::class,'search'])->name('search.report');
Route::post('search/by/year',[ReportController::class,'searchByYear'])->name('search.by.year');
Route::post('search/by/month',[ReportController::class,'searchByMonth'])->name('search.by.month');
Route::post('search/by/date',[ReportController::class,'searchByDate'])->name('search.by.date');

// Admin User Role Routes Go Here
Route::get('admin/all/user',[UserRoleController::class,'userRole'])->name('admin.all.user');
Route::get('admin/create/admin',[UserRoleController::class,'userCreate'])->name('create.admin');
Route::post('admin/store/admin',[UserRoleController::class,'storeUser'])->name('admin.store.user');
Route::get('admin/delete/{id}',[UserRoleController::class,'userDelete'])->name('admin.delete');
Route::get('admin/edit/{id}',[UserRoleController::class,'userEdit'])->name('edit.admin');
Route::post('admin/update/{id}',[UserRoleController::class,'userUpdate'])->name('admin.update.user');

// Site Setting Routes Go Here
Route::get('admin/site/setting',[SettingController::class,'siteSetting'])->name('admin.site.setting');
Route::post('update/site/setting/{id}',[SettingController::class,'updateSiteSetting'])->name('update.site.setting');

// Return Order Routes Go Here
Route::get('success/list',[PaymentController::class,'successList'])->name('success.orderlist');
Route::get('request/return/{id}',[PaymentController::class,'requestReturn'])->name('request.return');

Route::get('admin/return/request',[ReturnController::class,'adminRequestReturn'])->name('admin.return.request');
Route::get('admin/approve/return/{id}',[ReturnController::class,'adminApproveReturn'])->name('admin.approve.return');
Route::get('admin/all/return',[ReturnController::class,'adminAllReturn'])->name('admin.all.return');

// Stock Routes Go Here
Route::get('admin/product/stock',[StockController::class,'productStock'])->name('admin.product.stock');

// Contact Routes Go Here
Route::get('contact/with/us',[ContactController::class,'contact'])->name('contact.page');
Route::post('contact/form',[ContactController::class,'contactForm'])->name('contact.form');
Route::get('all/message',[StockController::class,'allMessage'])->name('all.message');
Route::get('view/message/{id}',[StockController::class,'viewMessage'])->name('view.message');


// Search Product Routes Go Here
Route::post('product/search',[FrontController::class,'search'])->name('product.search');
