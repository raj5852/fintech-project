<?php

use App\Http\Controllers\AddOrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//----Admin-----
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AfeatureController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MembershFipController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductRequestController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\AboutOneController;
use App\Http\Controllers\Admin\AboutTwoController;
use App\Http\Controllers\Admin\BackupControler;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\CreateWorker;
use App\Http\Controllers\Admin\DiscussionController;
use App\Http\Controllers\Admin\FixedSpecificationController;
use App\Http\Controllers\Admin\ManageApiController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\RequestProductController as ReqProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AdminAndUser\CommentController as AdminAndUserCommentController;
use App\Http\Controllers\Api\BinanceController;
//----Front-----
use App\Http\Controllers\Front\FrontController;

//----Payment-----
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\CryptoController;
use App\Http\Controllers\Payment\NowPaymentController;
use App\Http\Controllers\Payment\PaymentActionController;


//----User-----
use App\Http\Controllers\User\RequestProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishListController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\RechargeController;
use App\Http\Controllers\RequestController;


use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\RenewController;
use App\Http\Controllers\NowPaymentRedirectController;
use App\Http\Controllers\User\DiscussionController as UserDiscussionController;
use App\Http\Controllers\User\NotificationController as UserNotificationController;
use App\Http\Controllers\User\PreOrderController;
use App\Http\Controllers\User\PrivateCommentController;
use App\Http\Controllers\User\ResetController;
use App\Mail\ProductEmail;
use App\Models\Admin\Membership;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;
use App\Models\NowPaymentOrder;
use App\Models\User;
use App\Models\User\Subscription;
use App\Notifications\ProductUpdateNotification;
use App\Services\Frontend\UserProfileService;
use App\Services\User\MembershipService;
use App\Services\User\UserActiveMembership;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Auth::routes();

//Logout without session
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth')->name('logout');

/*------------------------------------------
--------------------------------------------
All Front Routes List
--------------------------------------------
--------------------------------------------*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/membership', [FrontController::class, 'membership'])->name('membership');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/customer-request', [FrontController::class, 'customerRequest'])->name('customer.request');
Route::get('/product/details/{product_slug}', [FrontController::class, 'productDetails'])->name('product.details');
Route::get('/preorder-view', [FrontController::class, 'preorder_view'])->name('preorder_view');
Route::get('/license', [FrontController::class, 'license'])->name('license');
Route::get('/preorder-details/{slug}', [FrontController::class, 'preorder_details'])->name('preorder_details');
Route::post('store/request/product', [RequestProductController::class, 'storeRequestProduct'])->name('store.request.product');

Route::get('/contact-us', [FrontController::class, 'ContatctUs']);
Route::post('/contact-store', [FrontController::class, 'ContatctStore']);

Route::post('/request-store', [RequestController::class, 'RequestStore']);
Route::post('/request-done', [RequestController::class, 'RequestDOne']);



Route::get('/privacy-policy', [FrontController::class, 'PrivacyPolicy']);
Route::get('/term-service', [FrontController::class, 'TeamAndCondition']);
Route::get('/about-us', [FrontController::class, 'AboutUs']);
Route::get('/how-it-work', [FrontController::class, 'HowToWork']);
Route::post('/subscriber/store', [FrontController::class, 'subscriberStore']);


Route::get('/member/product/{id}', [FrontController::class, 'MenberProduct']);

// ---Social Login Route---
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});


//----User Verify Route-----
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/user/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//----Cart Route----
Route::get('cart/index', [CartController::class, 'index'])->name('index.cart');
Route::post('add/cart', [CartController::class, 'store'])->name('add.cart');
Route::get('cart/show', [CartController::class, 'show']);
Route::get('user/cart/show', [CartController::class, 'show']);
Route::get('product/details/cart/show', [CartController::class, 'show']);
Route::get('get/{cat_slug}/cart/show', [CartController::class, 'show']);
Route::get('get/{cat_slug}/{ sub_cat }/cart/show', [CartController::class, 'show']);
Route::get('product/details/cart/count', [CartController::class, 'cartCount']);
Route::get('user/cart/count', [CartController::class, 'cartCount']);
Route::get('cart/count', [CartController::class, 'cartCount']);
Route::post('cart/update', [CartController::class, 'update'])->name('update.cart');
Route::any('delete/cart/{id}', [CartController::class, 'destroy'])->name('delete.cart');
Route::post('add/buy', [CartController::class, 'Buystore'])->name('add.buy');

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('user')->middleware(['auth', 'user-access:user', 'verified'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
    Route::get('/my-orders', [HomeController::class, 'myOrders'])->name('user.my-orders');
    Route::get('/my-order/{id}', [HomeController::class, 'myOrderDetails'])->name('user.my-order.details');

    Route::get('/my-wallet', [HomeController::class, 'myWallet'])->name('user.my-wallet');
    Route::get('/my-wishlist', [HomeController::class, 'myWishlist'])->name('user.my-wishlist');
    Route::get('/membership-product', [HomeController::class, 'membershipProduct'])->name('user.membership-product');
    Route::get('/edit-profile', [HomeController::class, 'editProfile'])->name('user.edit-profile');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('user.change-password');
    Route::get('/order', [HomeController::class, 'Order'])->name('user.order');


    Route::get('nowpayment-product-success', [NowPaymentRedirectController::class, 'success']);


    //order view
    Route::get('order/view/{id}', [UserController::class, 'OrderView'])->name('user.order.view');
    Route::get('review/{id}', [UserController::class, 'Review'])->name('user.review');
    Route::post('review/store', [UserController::class, 'ReviewStore'])->name('user.review.store');

    //----User Profile Route----//
    Route::get('profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('profile/update', [UserController::class, 'userProfileUpdate'])->name('user.update.profile');
    Route::get('password/change', [UserController::class, 'changePassword'])->name('user.password.change');
    Route::post('password/update', [UserController::class, 'updatePassword'])->name('user.password.update');


    //----Wishlist Route----
    Route::get('wishlist', [WishListController::class, 'all'])->name('index.wishlist');
    Route::get('add/wish-list/{id}', [WishListController::class, 'store'])->name('add.wishlist');
    Route::get('count/wishlist', [WishListController::class, 'wishCount']);
    Route::get('show/wishlist', [WishListController::class, 'show']);
    Route::delete('/delete/wishlist/{id}', [WishListController::class, 'destroy'])->name('delete.wishlist');
    Route::post('/delete/wish-item/{id}', [WishListController::class, 'deleteWishItem'])->name('delete.wish.Item');
    Route::get('view/wishlist', [WishListController::class, 'view']);
    Route::get('/delete/wishlist/{id}', [WishListController::class, 'destroy'])->name('wishlist.delete');

    //----Apply coupon Route----//
    Route::post('apply/coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

    //----Checkout Route----//
    Route::post('checkouts', [CheckoutController::class, 'index'])->name('checkout.page');
    Route::get('checkouts', [CheckoutController::class, 'redirectToCheckout']);
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout');


    //----Subscription Route----//
    Route::get('subscription', [CheckoutController::class, 'subscriptionIndex'])->name('subscription.page');
    Route::post('subscription', [CheckoutController::class, 'subscriptionStore'])->name('subscription');

    //----Paypal Payment Route----
    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

    //----Paypal Recharge Route-----
    Route::get('recharge', [RechargeController::class, 'index'])->name('recharge.page');
    Route::post('recharge', [RechargeController::class, 'store'])->name('recharge');

    //----Stripe Payment Route----
    Route::post('stripe', [StripeController::class, 'stripePayment'])->name('stripe.payment');
    Route::get('paypal-success', [PaymentActionController::class, 'paypalSuccessUrl'])->name('paypal-success');



    //bitcoin



    // routes/web.php

    Route::match(['get', 'post'], '/payments/crypto/pay', Victorybiz\LaravelCryptoPaymentGateway\Http\Controllers\CryptoPaymentController::class)
        ->name('payments.crypto.pay');

    Route::post('/payments/crypto/callback', [CryptoController::class, 'callback'])
        ->withoutMiddleware(['web', 'auth']);





    Route::get('bitcoin/payment', [CryptoController::class, 'CoinGate'])->name('bitcoin.payment');
    Route::post('bitcoin/callback', [CryptoController::class, 'callback'])->name('bitcoin.callback');

    Route::post('edokan/payment', [CryptoController::class, 'Edokan'])->name('edokan.payment');
    Route::get('edokan/done', [CryptoController::class, 'EdokanDOne'])->name('edokan.done');
    Route::get('edokan/cancell', [CryptoController::class, 'EdokanCalcell'])->name('edokan.cancell');

    Route::post('nowpayment/payment', [NowPaymentController::class, 'NowPayment'])->name('nowpayment.payment');

    // notification

    Route::get('load-notifications', [UserNotificationController::class, 'index'])->name('notification.load-more');
    Route::get('product-link/{id}', [UserNotificationController::class, 'productLink'])->name('notification.product-link');
    Route::get('/renew-membership', [FrontController::class, 'renew_membership'])->name('renew_membership');
    Route::post('renew-membership', [RenewController::class, 'store'])->name('user.renew-store');

    // pre-order-payment
    Route::post('pre-order-payment/{slug}', [PreOrderController::class, 'payment'])->name('pre-order-payment');

    // Route::post('/discussion', [FrontController::class, 'store'])->name('user.discussion');
});

Route::middleware(['auth'])->group(function () {
    Route::post('comment-delete', [AdminAndUserCommentController::class, 'delete'])->name('comment.delete');
    Route::post('comment-to-product', [AdminAndUserCommentController::class, 'store'])->name('comment-to-product');
    Route::resource('userdiscussion', UserDiscussionController::class);
    Route::get('/discussionDetails/{PrivatePost}', [FrontController::class, 'discussionDetails'])->name('discussionDetails');
    Route::get('/discussion/{slug}', [FrontController::class, 'discussion'])->name('discussion');
    Route::get('/private-comments/{postid}', [FrontController::class, 'privatecomments'])->name('privatecomments');
    Route::resource('privatecomment', PrivateCommentController::class);
});


Route::get('product-comments', [CommentController::class, 'comments'])->name('product.commnets');

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/

Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');


Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('dashboard',[HomeController::class,'dashboard'])->name('worker.dashboard');
    //show all users
    Route::get('all-user', [HomeController::class, 'allusers'])->name('admin.all-user');
    Route::get('genarel-members', [HomeController::class, 'genarelMembers'])->name('admin.genarel-members');
    Route::get('vip-members', [HomeController::class, 'vipMembers'])->name('admin.vip-members');
    Route::get('premium-members', [HomeController::class, 'premiumMembers'])->name('admin.premium-members');
    Route::get('elite-members', [HomeController::class, 'eliteMembers'])->name('admin.elite-members');
    Route::get('reseller-members', [HomeController::class, 'resellerMembers'])->name('admin.reseller-members');


    Route::get('pending-user', [HomeController::class, 'pendingUser'])->name('admin.pending.user');
    Route::get('pending-to-active/{id}', [HomeController::class, 'pendingToActive'])->name('admin.pending.to.active.user');

    //add balance
    Route::resource('balance', BalanceController::class);

    Route::get('add/{id}/user-subscription', [HomeController::class, 'addSubscription'])->name('addsubscription');
    Route::post('user-subscription/{id}', [HomeController::class, 'storeSubscription'])->name('storesubscription');
    Route::get('subscription/{id}/edit', [HomeController::class, 'editSubscription'])->name('editSubscription');
    Route::post('updatesubscription/{id}/update', [HomeController::class, 'updateSubscription'])->name('updatesubscription');
    Route::get('subscription/{id}/delete', [HomeController::class, 'deleteSubscription'])->name('subscription-delete');
    //----Admin Profile Route----//
    Route::get('profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile/update', [AdminController::class, 'adminProfileUpdate'])->name('update.profile');
    Route::get('password/change', [AdminController::class, 'changePassword'])->name('password.change');
    Route::post('password/update', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    // offer
    Route::post('offer-created', [OfferController::class, 'store'])->name('admin.offer');

    Route::get('website/setting', [SettingController::class, 'WebSite'])->name('website.setting');
    Route::post('update/setting/{id}', [SettingController::class, 'SettingUpdate'])->name('update.setting');

    Route::get('all/contact', [SettingController::class, 'AllConatct'])->name('all.contact');
    Route::get('contact/view/{id}', [SettingController::class, 'ContactView'])->name('contact.view');
    Route::get('contact/delete/{id}', [SettingController::class, 'ConatctDelete'])->name('contact.delete');

    Route::get('about/us', [AboutController::class, 'AboutUs'])->name('about.us');
    Route::post('update/about/{id}', [AboutController::class, 'AboutUpdate'])->name('update.about');


    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'ALlOrder'])->name('admin.order');
        Route::get('/email', [OrderController::class, 'orderEmail'])->name('admin.order.email');
        Route::get('view/{id}', [OrderController::class, 'OrderView'])->name('view.view');
        Route::get('pre-orders', [OrderController::class, 'preorders'])->name('admin.preorders');
        Route::get('order-delete/{id}', [OrderController::class, 'orderdelete'])->name('admin.orderdelete');
        Route::resource('addorder', AddOrderController::class)->only('create', 'store');
    });



    //----Category Route----//
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index.category');
        Route::post('store', [CategoryController::class, 'store'])->name('store.category');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update.category');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');
    });

    //----Category Route----//
    Route::group(['prefix' => 'sub-category'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('index.sub_category');
        Route::post('store', [SubCategoryController::class, 'store'])->name('store.sub_category');
        Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('edit.sub_category');
        Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('update.sub_category');
        Route::get('delete/{id}', [SubCategoryController::class, 'destroy'])->name('delete.sub_category');
    });

    //----Brand Route----//
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index.brand');
        Route::post('store', [BrandController::class, 'store'])->name('store.brand');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('update.brand');
        Route::get('delete/{id}', [BrandController::class, 'destroy'])->name('delete.brand');
    });


    //----Fixed Specification Route----//
    Route::group(['prefix' => 'fixed/specification'], function () {
        Route::get('/', [FixedSpecificationController::class, 'index'])->name('specification.index');
        Route::post('store', [FixedSpecificationController::class, 'store'])->name('specification.store');
        Route::get('edit/{id}', [FixedSpecificationController::class, 'edit'])->name('specification.edit');
        Route::post('update/{id}', [FixedSpecificationController::class, 'update'])->name('specification.update');
        Route::get('delete/{id}', [FixedSpecificationController::class, 'delete'])->name('specification.delete');
    });


    //----Product Route----//
    Route::group(['prefix' => 'product'], function () {
        Route::get('create', [ProductController::class, 'create'])->name('create.product');
        Route::get('/', [ProductController::class, 'index'])->name('index.product');
        Route::get('/preorders', [ProductController::class, 'preorders'])->name('product.preorders');
        Route::post('store', [ProductController::class, 'store'])->name('store.product');
        Route::get('view/{id}', [ProductController::class, 'show']);
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update.product');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('delete.product');
        Route::get('image/delete/{image}', [ProductController::class, 'ImageDelete'])->name('delete.image');
        Route::get('status-change/{productId}/{statusId}', [ProductController::class, 'stausChange'])->name('product.status.change')->where(['productId' => '[0-9]+', 'statusId' => '[01]']);

        Route::get('delete-url/{productid}/{indexnumber}',[ProductController::class,'deleteurl'])->name('product.url.delete');
        //---Json data----//
        Route::get('/get/subcategory/{cat_id}', [ProductController::class, 'getSubcategory']);
    });


    //----Membership Route----//
    Route::group(['prefix' => 'membership'], function () {
        Route::get('create', [MembershipController::class, 'create'])->name('create.membership');
        Route::get('/', [MembershipController::class, 'index'])->name('index.membership');
        Route::post('store', [MembershipController::class, 'store'])->name('store.membership');
        Route::get('edit/{id}', [MembershipController::class, 'edit'])->name('edit.membership');
        Route::post('update/{id}', [MembershipController::class, 'update'])->name('update.membership');
        Route::delete('delete/{id}', [MembershipController::class, 'destroy'])->name('delete.membership');
        Route::get('all-membership', [MembershipController::class, 'allMembership'])->name('all.membership');
    });


    //----Coupon Route----//
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('index.coupon');
        Route::post('store', [CouponController::class, 'store'])->name('store.coupon');
        Route::get('edit/{id}', [CouponController::class, 'edit'])->name('edit.coupon');
        Route::post('update/{id}', [CouponController::class, 'update'])->name('update.coupon');
        Route::get('delete/{id}', [CouponController::class, 'destroy'])->name('delete.coupon');
    });


    //----Testiminial Route----//
    Route::group(['prefix' => 'testimonial'], function () {
        Route::get('create', [TestimonialController::class, 'create'])->name('create.testimonial');
        Route::get('/', [TestimonialController::class, 'index'])->name('index.testimonial');
        Route::post('store', [TestimonialController::class, 'store'])->name('store.testimonial');
        Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('edit.testimonial');
        Route::post('update/{id}', [TestimonialController::class, 'update'])->name('update.testimonial');
        Route::get('delete/{id}', [TestimonialController::class, 'destroy'])->name('delete.testimonial');
    });

    //---- Feature Route ----//
    Route::group(['prefix' => 'features'], function () {
        Route::get('create', [FeaturesController::class, 'create'])->name('create.features');
        Route::get('/', [FeaturesController::class, 'index'])->name('index.features');
        Route::post('store', [FeaturesController::class, 'store'])->name('store.features');
        Route::get('edit/{id}', [FeaturesController::class, 'edit'])->name('edit.features');
        Route::post('update/{id}', [FeaturesController::class, 'update'])->name('update.features');
        Route::get('delete/{id}', [FeaturesController::class, 'destroy'])->name('delete.features');
    });

    //---- About Feature Route ----//
    Route::group(['prefix' => 'afeatures'], function () {
        Route::get('/', [AfeatureController::class, 'index'])->name('index.afeature');
        Route::post('store', [AfeatureController::class, 'store'])->name('store.afeature');
        Route::get('edit/{id}', [AfeatureController::class, 'edit'])->name('edit.afeature');
        Route::post('update/{id}', [AfeatureController::class, 'update'])->name('update.afeature');
        Route::get('delete/{id}', [AfeatureController::class, 'destroy'])->name('delete.afeature');
    });

    // Route::group(['prefix' => 'itwork'], function () {
    //     Route::get('/',[ItWorkController::class, 'index'])->name('index.itwork');
    //     Route::post('store',[ItWorkController::class, 'store'])->name('store.itwork');
    //     Route::get('edit/{id}',[ItWorkController::class, 'edit'])->name('edit.itwork');
    //     Route::post('update/{id}',[ItWorkController::class, 'update'])->name('update.itwork');
    //     Route::delete('delete/{id}',[ItWorkController::class, 'destroy'])->name('delete.itwork');
    // });

    //---- Page Feature Route ----//
    Route::group(['prefix' => 'page'], function () {
        Route::get('/', [PageController::class, 'index'])->name('index.page');
        Route::post('store', [PageController::class, 'store'])->name('store.page');
        Route::get('/view/{id}', [PageController::class, 'show']);
        Route::get('edit/{id}', [PageController::class, 'edit'])->name('edit.page');
        Route::post('update/{id}', [PageController::class, 'update'])->name('update.page');
        Route::get('delete/{id}', [PageController::class, 'destroy'])->name('delete.page');
    });

    //---- Social Route ----//
    Route::group(['prefix' => 'social'], function () {
        Route::get('/', [SocialController::class, 'index'])->name('index.social');
        Route::post('store', [SocialController::class, 'store'])->name('store.social');
        Route::get('edit/{id}', [SocialController::class, 'edit']);
        Route::post('update/{id}', [SocialController::class, 'update'])->name('update.social');
        Route::get('delete/{id}', [SocialController::class, 'destroy'])->name('delete.social');
    });


    Route::group(['prefix' => 'productrequest'], function () {
        Route::get('/', [ProductRequestController::class, 'index'])->name('index.productrequest');
        Route::get('add', [ProductRequestController::class, 'add'])->name('add.productrequest');
        Route::post('store', [ProductRequestController::class, 'store'])->name('store.productrequest');
        Route::get('edit/{id}', [ProductRequestController::class, 'edit'])->name('edit.productrequest');
        Route::post('update/{id}', [ProductRequestController::class, 'update'])->name('update.productrequest');
        Route::get('delete/{id}', [ProductRequestController::class, 'destroy'])->name('delete.productrequest');
        Route::get('add-request',[ProductRequestController::class,'addrequest'])->name('addrequest');
        Route::post('request-store',[ProductRequestController::class,'requeststore'])->name('admin.requeststore');

    });

    Route::group(['prefix' => 'productrequesttwo'], function () {
        Route::get('/', [MedicineController::class, 'index'])->name('index.productrequesttwo');
        Route::get('add', [MedicineController::class, 'add'])->name('add.productrequesttwo');
        Route::post('store', [MedicineController::class, 'store'])->name('store.productrequesttwo');
        Route::get('edit/{id}', [MedicineController::class, 'edit'])->name('edit.productrequesttwo');
        Route::post('update/{id}', [MedicineController::class, 'update'])->name('update.productrequesttwo');
        Route::get('delete/{id}', [MedicineController::class, 'destroy'])->name('delete.productrequesttwo');
    });

    //----market Route----//
    Route::group(['prefix' => 'market'], function () {
        Route::get('/', [MarketController::class, 'index'])->name('index.market');
        Route::get('add', [MarketController::class, 'add'])->name('add.market');
        Route::post('store', [MarketController::class, 'store'])->name('store.market');
        Route::get('edit/{id}', [MarketController::class, 'edit'])->name('edit.market');
        Route::post('update/{id}', [MarketController::class, 'update'])->name('update.market');
        Route::get('delete/{id}', [MarketController::class, 'delete'])->name('delete.market');
    });

    // Manage API KEY
    Route::group(['prefix' => 'api'], function () {
        Route::get('/', [ManageApiController::class, 'index'])->name('index.api');
        Route::get('/{id}/edit', [ManageApiController::class, 'edit'])->name('edit.api');
        Route::post('update-api/{id}', [ManageApiController::class, 'update'])->name('update.api');
    });





    Route::group(['prefix' => 'aboutone'], function () {
        Route::get('/', [AboutOneController::class, 'index'])->name('index.aboutone');
        Route::get('add', [AboutOneController::class, 'add'])->name('add.aboutone');
        Route::post('store', [AboutOneController::class, 'store'])->name('store.aboutone');
        Route::get('edit/{id}', [AboutOneController::class, 'edit'])->name('edit.aboutone');
        Route::post('update/{id}', [AboutOneController::class, 'update'])->name('update.aboutone');
        Route::get('delete/{id}', [AboutOneController::class, 'delete'])->name('delete.aboutone');
    });

    Route::group(['prefix' => 'abouttwo'], function () {
        Route::get('/', [AboutTwoController::class, 'index'])->name('index.abouttwo');
        Route::get('add', [AboutTwoController::class, 'add'])->name('add.abouttwo');
        Route::post('store', [AboutTwoController::class, 'store'])->name('store.abouttwo');
        Route::get('edit/{id}', [AboutTwoController::class, 'edit'])->name('edit.abouttwo');
        Route::post('update/{id}', [AboutTwoController::class, 'update'])->name('update.abouttwo');
        Route::get('delete/{id}', [AboutTwoController::class, 'delete'])->name('delete.abouttwo');
    });



    //router homepage

    Route::group(['prefix' => 'homepage'], function () {
        Route::get('/', [HomePageController::class, 'index'])->name('index.homepage');
        Route::get('add', [HomePageController::class, 'add'])->name('add.homepage');
        Route::post('store', [HomePageController::class, 'store'])->name('store.homepage');
        Route::get('edit/{id}', [HomePageController::class, 'edit'])->name('edit.homepage');
        Route::post('update/{id}', [HomePageController::class, 'update'])->name('update.homepage');
        Route::get('delete/{id}', [HomePageController::class, 'delete'])->name('delete.homepage');
    });




    //---- Subscriber Route ----//
    Route::group(['prefix' => 'subscriber'], function () {
        Route::get('/', [SubscriberController::class, 'index'])->name('index.subscriber');
        Route::post('promotion/email/send', [SubscriberController::class, 'sendPromotionEmail'])->name('send.promotion.email');

        Route::get('delete/subscriber/{id}', [SubscriberController::class, 'destroy'])->name('delete.subscriber');
    });


    //---- Request Product Route ----//
    Route::group(['prefix' => 'request-product'], function () {
        Route::get('/index', [ReqProductController::class, 'index'])->name('index.request.product');
        Route::get('/old', [ReqProductController::class, 'indexOld'])->name('old.request.product');
        Route::get('/view/{id}', [ReqProductController::class, 'show']);
        Route::get('/dawnload/{file}', [ReqProductController::class, 'Dawnload']);

        Route::get('detail/{id}', [ReqProductController::class, 'edit']);
        Route::get('delete/request/product/{id}', [ReqProductController::class, 'destroy'])->name('delete.request.product');
    });
    Route::get('/notification-clear', [NotificationController::class, 'clear']);

    Route::get('database-backup', [BackupControler::class, 'index'])->name('admin.databse-backup');

    //discussion
    Route::resource('discussion', DiscussionController::class);
    //role
    Route::resource('role',RoleController::class);
    Route::resource('create-user',CreateWorker::class);
});
Route::post('custom-reset-password', [ResetController::class, 'index'])->name('custom.password.reset');

Route::get('custom-reset-password/{token}', [ResetController::class, 'showResetPasswordForm'])->name('custom.reset.password.get');
Route::post('reset-password', [ResetController::class, 'submitResetPasswordForm'])->name('custom.reset.password.post');

//webhook

Route::get('migrate', function () {
    Artisan::call('migrate');
});

Route::get('demo', function () {

    // $user = User::create([
    //     'name' => 'robi',
    //     'email' => 'robi@gmail.com',
    //     'password' => bcrypt('password'),
    //     'type'=>'worker'
    // ]);

    // $role = Role::create(['name' => 'admin']);

    // $permissions = Permission::pluck('id','id')->all();

    // $role->syncPermissions($permissions);

    // $user->assignRole([$role->id]);

    // return         $permissions = Permission::where('id','!=',5)->pluck('id', 'id')->all();

    return auth()->user()->hasPermissionTo('dashboard');

});
