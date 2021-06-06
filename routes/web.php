<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('coming-soon');
});*/



Route::get('/','IndexController@index');

Route::match(['get', 'post'], '/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

//Products Filter Page
Route::match(['get', 'post'],'/products-filter','ProductsController@filter');

//Products Filter Page testcolor
Route::match(['get', 'post'],'/products-filter-color','ProductsController@color');

// Product Detail Page
Route::get('/product/{id}','ProductsController@product');

// Cart Page
Route::match(['get', 'post'],'/cart','ProductsController@cart');

// Add to Cart Route
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Delete Product from Cart Route
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Update Product Quantity from Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Get Product Attribute Price
Route::any('/get-product-price','ProductsController@getProductPrice');

// Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

// Login-Register
Route::get('/login-register','UsersController@userLoginRegister');
Route::post('/user-register','UsersController@register');
Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');
Route::match(['get','post'],'recover-password','AdminController@recoverPassword');

// Confirm Account
Route::get('confirm/{code}','UsersController@confirmAccount');

// User Login
Route::post('/user-login','UsersController@login');

// User logout
Route::get('/user-logout', 'UsersController@logout');

// Search products
Route::post('/search-products','ProductsController@searchProducts');





// All routes after login
Route::group(['middleware' => ['frontlogin']], function () {
	// User account page
	Route::match(['get','post'],'/account','UsersController@account');
	// Check User Current Password
	Route::post('/check-user-pwd','UsersController@chkUserPassword');
	// Update User Password
	Route::post('/update-user-pwd','UsersController@updatePassword');
	//Checkout page
	Route::match(['get','post'],'/checkout','ProductsController@checkout');
	// Order Review page
	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	// Place order Page
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	//Thanks page
	Route::get('/thanks','ProductsController@thanks');
	//Paypal page
	Route::get('/paypal','ProductsController@paypal');
	//Users orders page
	Route::get('/orders','ProductsController@userOrders');
	//Users ordered products page
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	//Delete user profile image
	Route::get('/account/delete-user-image/{id}','UsersController@deleteUserImage');

	//Routes for comments
	Route::match(['get','post'],'/comment/add-comment','CommentController@addComment');
	Route::get('/comment/delete-comment/{id}','CommentController@deleteComment');
	Route::match(['get','post'],'/comment/edit-comment/{id}','CommentController@editComment');

	//Routes for reviews
	Route::match(['get','post'],'/review/add-review','ReviewController@addReview');
	Route::match(['get','post'],'/review/edit-review/{id}','ReviewController@editReview');
	Route::get('/review/delete-review/{id}','ReviewController@deleteReview');

	//Likes
	Route::match(['get','post'],'/like/add-like','PostController@addLike');

	// Routes for Wishlist
	Route::get('/addToWishlist/{id}','ProductsController@Wishlist');
	Route::match(['get','post'],'/wishlist','ProductsController@viewWishlist');
	Route::get('/removeWishlist/{id}', 'ProductsController@removeWishlist');


});

// Check if email already exist
Route::match(['get','post'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['adminlogin']], function () {
	Route::get('/admin/dashboard','AdminController@dashboard');	
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get', 'post'],'/admin/update-pwd','AdminController@updatePassword');

	// Admin Categories Routes
	Route::match(['get', 'post'], '/admin/add-category','CategoryController@addCategory');
	Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');

	// Admin Products Routes
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
	Route::get('/admin/view-products','ProductsController@viewProducts');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
	Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');
	
	Route::match(['get', 'post'], '/admin/add-images/{id}','ProductsController@addImages');
	Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteProductAltImage');

	// Admin Attributes Routes
	Route::match(['get', 'post'], '/admin/add-attributes/{id}','ProductsController@addAttributes');
	Route::match(['get', 'post'], '/admin/edit-attributes/{id}','ProductsController@editAttributes');
	Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

	// Admin Coupon Routes
	Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
	Route::get('/admin/view-coupons','CouponsController@viewCoupons');
	Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
	Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');
	Route::get('/cart/apply-coupon','ProductsController@applyCoupon');

	// Admin Banners Routes
	Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
	Route::get('/admin/view-banners','BannersController@viewBanners');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
	Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');

	//Admin Post Routes
	Route::match(['get','post'],'/admin/add-post','PostController@addPost');
	Route::get('/admin/view-posts','PostController@viewPosts');
	Route::match(['get','post'],'/admin/edit-post/{id}','PostController@editPost');
	Route::get('/admin/delete-post/{id}','PostController@deletePost');
	Route::get('/admin/delete-post-image/{id}','PostController@deletePostImage');

	// Admin CMS pages routes
	Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');
	Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');
	Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage');
	Route::get('admin/view-cms-pages','CmsController@viewCmsPages');

	// Admin Orders Routes
	Route::get('/admin/view-orders','ProductsController@viewOrders');

	// Admin Orders Details Routes
	Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');

	// Order Invoice
	Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

	//Update Order Status
	Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');

	//View registered users
	Route::get('/admin/view-users','UsersController@viewUsers');

	// Admin/Sub-Admin view Route
	Route::get('/admin/view-admins','AdminController@viewAdmins');

	// Add Admin/Sub-Admin
	Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmin');

	// Edit Admin/Sub-Admin
	Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmin');

	// Delete Admin/Sub-Admin
	Route::match(['get', 'post'], '/admin/delete-admin/{id}','AdminController@deleteAdmin');

	// On sale price for product
	Route::get('/admin/addSale', 'AdminController@addSale');

	Route::get('/admin/banUser', 'AdminController@banUser');



	
 //Admin Matrix folder
Route::get('/admin/buttons', function(){
	return view('admin.matrix.buttons');
});
Route::get('/admin/widgets', function(){
	return view('admin.matrix.widgets');
});
Route::get('/admin/form-common', function(){
	return view('admin.matrix.form-common');
});
Route::get('/admin/tables', function(){
	return view('admin.matrix.tables');
});
Route::get('/admin/interface-elements', function(){
	return view('admin.matrix.interface-elements');
});
Route::get('/admin/error404', function(){
	return view('admin.matrix.error404');
});
Route::get('/admin/grid', function(){
	return view('admin.matrix.grid');
});

});

Route::get('/logout','AdminController@logout');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Display Contact Page
Route::match(['get','post'],'/page/contact','CmsController@contact');

//Display Terms of use Page
Route::match(['get','post'],'/page/terms','CmsController@terms');

//Display all Blogs
Route::match(['get','post'],'/page/blog','PostController@show_blogs');

//Display Single Blog page
Route::get('/page/blog/{id}','PostController@single_blog');

//Display CMS page
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');

