<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MegamenuController as AdminMegamenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogCategoryController as AdminBlogCategoryController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ShippingController as AdminShippingController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter.subscribe');

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'category'])->name('shop.category');

// Product
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{id}/review', [ProductController::class, 'storeReview'])->name('product.review')->middleware('auth');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::delete('/cart/coupon', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');

// Wishlist
Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle')->middleware('auth');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index')->middleware('auth');

// Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
    Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Payment Gateways
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/stripe/process', [PaymentController::class, 'stripeProcessGet'])->name('stripe.process.get');
    Route::post('/stripe/process', [PaymentController::class, 'stripeProcess'])->name('stripe.process');
    Route::get('/paypal/redirect', [PaymentController::class, 'paypalRedirect'])->name('paypal.redirect');
    Route::get('/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    Route::post('/stripe/webhook', [PaymentController::class, 'stripeWebhook'])->name('stripe.webhook');
});

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Managed Pages
Route::get('/about', [HomeController::class, 'page'])->defaults('slug', 'about')->name('about');
Route::get('/terms', [HomeController::class, 'page'])->defaults('slug', 'terms')->name('terms');
Route::get('/privacy', [HomeController::class, 'page'])->defaults('slug', 'privacy')->name('privacy');
Route::get('/refund', [HomeController::class, 'page'])->defaults('slug', 'refund')->name('refund');

// CMS Pages
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page.show');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot-password', [AuthController::class, 'forgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Account
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{orderNumber}', [AccountController::class, 'orderDetail'])->name('orders.detail');
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::put('/addresses/{id}', [AccountController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/addresses/{id}', [AccountController::class, 'deleteAddress'])->name('addresses.delete');
    Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('wishlist');
    Route::put('/change-password', [AccountController::class, 'changePassword'])->name('password.change');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [DashboardController::class, 'loginForm'])->name('login');
        Route::post('/login', [DashboardController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    // Admin Protected Routes
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Products
        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/duplicate', [AdminProductController::class, 'duplicate'])->name('products.duplicate');
        Route::post('products/{id}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
        Route::post('products/{id}/images', [AdminProductController::class, 'uploadImages'])->name('products.images.upload');
        Route::delete('products/images/{imageId}', [AdminProductController::class, 'deleteImage'])->name('products.images.delete');

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Brands
        Route::resource('brands', AdminBrandController::class);

        // Orders
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::post('orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::post('orders/{id}/update-payment', [AdminOrderController::class, 'updatePayment'])->name('orders.update-payment');
        Route::get('orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');

        // Users
        Route::resource('users', AdminUserController::class);
        Route::post('users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');

        // Megamenu
        Route::resource('megamenu', AdminMegamenuController::class);
        Route::post('megamenu/{megamenu}/toggle-status', [AdminMegamenuController::class, 'toggleStatus'])->name('megamenu.toggle-status');
        Route::post('megamenu/{id}/columns', [AdminMegamenuController::class, 'storeColumn'])->name('megamenu.columns.store');
        Route::post('megamenu/{id}/banner', [AdminMegamenuController::class, 'storeBanner'])->name('megamenu.banner.store');
        Route::post('megamenu/sort', [AdminMegamenuController::class, 'sort'])->name('megamenu.sort');

        // CMS Pages
        Route::resource('pages', AdminPageController::class);

        // Sliders
        Route::resource('sliders', AdminSliderController::class);
        Route::post('sliders/sort', [AdminSliderController::class, 'sort'])->name('sliders.sort');

        // Banners
        Route::resource('banners', AdminBannerController::class);

        // Blog
        Route::resource('blog', AdminBlogController::class);
        Route::resource('blog-categories', AdminBlogCategoryController::class)->except(['show']);

        // Coupons
        Route::resource('coupons', AdminCouponController::class);

        // Reviews
        Route::resource('reviews', AdminReviewController::class)->only(['index', 'show', 'destroy']);
        Route::post('reviews/{id}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
        Route::post('reviews/{id}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');

        // Settings
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::get('settings/payment', [AdminSettingController::class, 'payment'])->name('settings.payment');
        Route::post('settings/payment', [AdminSettingController::class, 'updatePayment'])->name('settings.payment.update');
        Route::get('settings/email', [AdminSettingController::class, 'email'])->name('settings.email');
        Route::post('settings/email', [AdminSettingController::class, 'updateEmail'])->name('settings.email.update');
        Route::get('settings/seo', [AdminSettingController::class, 'seo'])->name('settings.seo');
        Route::post('settings/seo', [AdminSettingController::class, 'updateSeo'])->name('settings.seo.update');

        // Shipping
        Route::resource('shipping', AdminShippingController::class);

        // Newsletter
        Route::get('newsletters', [AdminNewsletterController::class, 'index'])->name('newsletters.index');
        Route::delete('newsletters/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletters.destroy');
        Route::post('newsletters/export', [AdminNewsletterController::class, 'export'])->name('newsletters.export');

        // Contacts
        Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

        // Reports
        Route::get('reports/sales', [AdminReportController::class, 'sales'])->name('reports.sales');
        Route::get('reports/products', [AdminReportController::class, 'products'])->name('reports.products');
        Route::get('reports/customers', [AdminReportController::class, 'customers'])->name('reports.customers');

        // Media Upload (AJAX)
        Route::post('upload', [AdminProductController::class, 'uploadMedia'])->name('upload.media');
    });
});
