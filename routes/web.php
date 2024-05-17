<?php 
use Illuminate\Support\Facades\Route; 
use App\Models\Permalink; 
use app\Http\Controllers\Front\StemController; 

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

	Route::fallback(function () { return view("errors.404"); }); 
	Route::group(["prefix"=>"laravel-filemanager","middleware"=>["web","auth:admin","setLfmPath"]], function(){ 
			\UniSharp\LaravelFilemanager\Lfm::routes(); 
			Route::post( "summernote/upload", "Admin\SummernoteController@uploadFileManager" )->name("lfm.summernote.upload"); 
	}); 
	
	Route::get("/backup", "Front\FrontendController@backup"); 
	/*======================================================= 
	******************** Front Routes ********************** =======================================================*/ 
	Route::post("/push", "Front\PushController@store"); 
	Route::group(["middleware" => "setlang"], function (){ 
			Route::get("/", "Front\FrontendController@index")->name("front.index"); 
			Route::get('/aboutus', 'Front\StemController@aboutus')->name('about.detail'); 
			Route::get('/contactus', 'Front\StemController@contactUs')->name('contact.detail'); 
			Route::post('/contactus/query', 'Front\StemController@storeContactQuery')->name('contact.query'); 
			Route::get('/tenders', 'Front\StemController@tenders')->name('front.tenders'); 
			Route::get('/budget/report', 'Front\StemController@profitReport')->name('budget.report'); 
			Route::get('/news/img', 'Front\StemController@index')->name('front.stem.img'); 
			Route::get('/galleries/{slug}', 'Front\GalleryController@index')->name('front.gallerys'); 
			Route::get('/documents/{slug}', 'Front\StemController@circular')->name('front.circular'); 
			Route::get('/water/tariff', 'Front\StemController@waterTariff')->name('front.water.tariff'); 
			Route::get('/history', 'Front\StemController@history')->name('front.stem.history'); 

			Route::get("/committee/{slug}", "Front\StemController@showLeadership")->name( "front.leadership"); 
			Route::get('/news', 'Front\FrontendController@news')->name('front.news'); 
			Route::get('/news/details/{id}', 'Front\StemController@details')->name('front.news.details'); 
			Route::get('/egovernance', 'Front\EgoveranceController@index')->name('front.egoverance'); 
			Route::group(["prefix" => "donation"], function () { 
				Route::get( "/paystack/success", "Payment\causes\PaystackController@successPayment" )->name("donation.paystack.success"); 
			}); 
			//causes donation payment 
			Route::post("/cause/payment", "Front\CausesController@makePayment")->name( "front.causes.payment" ); 
			//event tickets payment 
			Route::post("/event/payment", "Front\EventController@makePayment")->name( "front.event.payment" ); 
			//causes donation payment via Paypal 
			Route::get( "/cause/paypal/payment/success", "Payment\causes\PaypalController@successPayment" )->name("donation.paypal.success"); 
			Route::get( "/cause/paypal/payment/cancel", "Payment\causes\PaypalController@cancelPayment" )->name("donation.paypal.cancel"); 
			//causes donation payment via Paytm 
			Route::post( "/cause/paytm/payment/success", "Payment\causes\PaytmController@paymentStatus" )->name("donation.paytm.paymentStatus"); 
			//causes donation payment via Razorpay 
			Route::post( "/cause/razorpay/payment/success", "Payment\causes\RazorpayController@successPayment" )->name("donation.razorpay.success"); 
			Route::post( "/cause/razorpay/payment/cancel", "Payment\causes\RazorpayController@cancelPayment" )->name("donation.razorpay.cancel"); 
			//causes donation payment via Payumoney 
			Route::post( "/cause/payumoney/payment", "Payment\causes\PayumoneyController@payment" )->name("donation.payumoney.payment"); 
			//causes donation payment via Flutterwave 
			Route::post( "/cause/flutterwave/success", "Payment\causes\FlutterWaveController@successPayment" )->name("donation.flutterwave.success"); 
			Route::post( "/cause/flutterwave/cancel", "Payment\causes\FlutterWaveController@cancelPayment" )->name("donation.flutterwave.cancel"); 
			Route::get( "/cause/flutterwave/success", "Payment\causes\FlutterWaveController@successPage" )->name("donation.flutterwave.successPage"); 
			//causes donation payment via Instamojo 
			Route::get( "/cause/instamojo/success", "Payment\causes\InstamojoController@successPayment" )->name("donation.instamojo.success"); 
			Route::post( "/cause/instamojo/cancel", "Payment\causes\InstamojoController@cancelPayment" )->name("donation.instamojo.cancel"); 
			//causes donation payment via Mollie 
			Route::get( "/cause/mollie/success", "Payment\causes\MollieController@successPayment" )->name("donation.mollie.success"); 
			Route::post( "/cause/mollie/cancel", "Payment\causes\MollieController@cancelPayment" )->name("donation.mollie.cancel"); 
			// Mercado Pago 
			Route::post( "/cause/mercadopago/cancel", "Payment\causes\MercadopagoController@cancelPayment" )->name("donation.mercadopago.cancel"); 
			Route::post( "/cause/mercadopago/success", "Payment\causes\MercadopagoController@successPayment" )->name("donation.mercadopago.success"); 
			Route::post( "/payment/instructions", "Front\FrontendController@paymentInstruction" )->name("front.payment.instructions"); 
			Route::post("/sendmail", "Front\FrontendController@sendmail")->name( "front.sendmail" ); 
			Route::post("/subscribe", "Front\FrontendController@subscribe")->name( "front.subscribe" ); 
			Route::get("/quote", "Front\FrontendController@quote")->name("front.quote"); 
			Route::post("/sendquote", "Front\FrontendController@sendquote")->name( "front.sendquote" ); 
			Route::get( "/checkout/payment/{slug1}/{slug2}", "Front\FrontendController@loadpayment" )->name("front.load.payment"); 
			// Package Order Routes 
			Route::post("/package-order", "Front\FrontendController@submitorder")->name("front.packageorder.submit");
			Route::get( "/order-confirmation/{packageid}/{packageOrderId}", "Front\FrontendController@orderConfirmation" )->name("front.packageorder.confirmation"); 
			Route::get( "/payment/{packageid}/cancle", "Payment\PaymentController@paycancle" )->name("front.payment.cancle"); 
			//Paypal Routes 
			Route::post("/paypal/submit", "Payment\PaypalController@store")->name( "front.paypal.submit" ); 
			Route::get("/paypal/{packageid}/notify", "Payment\PaypalController@notify")->name("front.paypal.notify");
			//Stripe Routes 
			Route::post("/stripe/submit", "Payment\StripeController@store")->name("front.stripe.submit"); 
			//Paystack Routes 
			Route::post("/paystack/submit", "Payment\PaystackController@store")->name( "front.paystack.submit" ); 
			//PayTM Routes 
			Route::post("/paytm/submit", "Payment\PaytmController@store")->name( "front.paytm.submit" ); 
			Route::post("/paytm/notify", "Payment\PaytmController@notify")->name( "front.paytm.notify" ); 
			//Flutterwave Routes 
			Route::post( "/flutterwave/submit", "Payment\FlutterWaveController@store" )->name("front.flutterwave.submit"); 
			Route::post( "/flutterwave/notify", "Payment\FlutterWaveController@notify" )->name("front.flutterwave.notify"); 
			 //Instamojo Routes 
			Route::post("/instamojo/submit", "Payment\InstamojoController@store")->name( "front.instamojo.submit" ); 
			Route::get("/instamojo/notify", "Payment\InstamojoController@notify")->name( "front.instamojo.notify" ); 
			//Mollie Routes 
			Route::post("/mollie/submit", "Payment\MollieController@store")->name( "front.mollie.submit" ); 
			Route::get("/mollie/notify", "Payment\MollieController@notify")->name( "front.mollie.notify" ); 
			// RazorPay 
			Route::post("razorpay/submit", "Payment\RazorpayController@store")->name( "front.razorpay.submit" ); 
			Route::post("razorpay/notify", "Payment\RazorpayController@notify")->name( "front.razorpay.notify" ); 
			// Mercado Pago 
			Route::post( "mercadopago/submit", "Payment\MercadopagoController@store" )->name("front.mercadopago.submit"); 
			Route::post( "mercadopago/notify", "Payment\MercadopagoController@notify" )->name("front.mercadopago.notify"); 
			// Payu 
			Route::post("/payumoney/submit", "Payment\PayumoneyController@store")->name( "front.payumoney.submit" ); 
			Route::post( "/payumoney/notify", "Payment\PayumoneyController@notify" )->name("front.payumoney.notify"); 
			//Offline Routes
			Route::post( "/offline/{oid}/submit", "Payment\OfflineController@store" )->name("front.offline.submit"); 
			Route::get("/team", "Front\FrontendController@team")->name("front.team"); 
			Route::get("/gallery", "Front\FrontendController@gallery")->name( "front.gallery" ); 
			Route::get("/faq", "Front\FrontendController@faq")->name("front.faq"); 
			// change language routes 
			Route::get( "/changelanguage/{lang}", "Front\FrontendController@changeLanguage")->name("changeLanguage");
			// change language routes 
			Route::post( "/change_language", "Front\FrontendController@change_language" )->name("change_language"); 
			// Product 
			Route::get("/cart", "Front\ProductController@cart")->name("front.cart"); 
			Route::get("/add-to-cart/{id}", "Front\ProductController@addToCart")->name( "add.cart" ); 
			Route::post("/cart/update", "Front\ProductController@updatecart")->name( "cart.update" ); 
			Route::get( "/cart/item/remove/{id}", "Front\ProductController@cartitemremove")->name("cart.item.remove"); 
			Route::get("/checkout", "Front\ProductController@checkout")->name( "front.checkout" ); 
			Route::get("/checkout/{slug}","Front\ProductController@Prdouctcheckout")->name("front.product.checkout");
			Route::post("/coupon", "Front\ProductController@coupon")->name( "front.coupon" ); 
			// review 
			Route::post( "product/review/submit", "Front\ReviewController@reviewsubmit" )->name("product.review.submit"); 
			// CHECKOUT SECTION 
			Route::get( "/product/payment/return", "Payment\product\PaymentController@payreturn" )->name("product.payment.return"); 
			Route::get( "/product/payment/cancle", "Payment\product\PaymentController@paycancle" )->name("product.payment.cancle"); 
			Route::get( "/product/paypal/notify", "Payment\product\PaypalController@notify" )->name("product.paypal.notify"); 
			// paypal routes 
			Route::post( "/product/paypal/submit", "Payment\product\PaypalController@store" )->name("product.paypal.submit"); 
			// stripe routes 
			Route::post( "/product/stripe/submit", "Payment\product\StripeController@store" )->name("product.stripe.submit"); 
			Route::post( "/product/offline/{gatewayid}/submit", "Payment\product\OfflineController@store" )->name("product.offline.submit"); 
			//Flutterwave Routes 
			Route::post( "/product/flutterwave/submit", "Payment\product\FlutterWaveController@store" )->name("product.flutterwave.submit"); 
			Route::post( "/product/flutterwave/notify", "Payment\product\FlutterWaveController@notify" )->name("product.flutterwave.notify"); 
			Route::get( "/product/flutterwave/notify", "Payment\product\FlutterWaveController@success" )->name("product.flutterwave.success"); 
			//Paystack Routes 
			Route::post( "/product/paystack/submit", "Payment\product\PaystackController@store" )->name("product.paystack.submit"); 
			// RazorPay 
			Route::post( "/product/razorpay/submit", "Payment\product\RazorpayController@store" )->name("product.razorpay.submit"); 
			Route::post( "/product/razorpay/notify", "Payment\product\RazorpayController@notify" )->name("product.razorpay.notify"); 
			//Instamojo Routes 
			Route::post( "/product/instamojo/submit", "Payment\product\InstamojoController@store" )->name("product.instamojo.submit"); 
			Route::get( "/product/instamojo/notify", "Payment\product\InstamojoController@notify" )->name("product.instamojo.notify"); 
			//PayTM Routes 
			Route::post( "/product/paytm/submit", "Payment\product\PaytmController@store" )->name("product.paytm.submit"); 
			Route::post( "/product/paytm/notify", "Payment\product\PaytmController@notify" )->name("product.paytm.notify"); 
			//Mollie Routes
			Route::post( "/product/mollie/submit", "Payment\product\MollieController@store" )->name("product.mollie.submit"); 
			Route::get( "/product/mollie/notify", "Payment\product\MollieController@notify" )->name("product.mollie.notify"); 
			// Mercado Pago 
			Route::post( "/product/mercadopago/submit", "Payment\product\MercadopagoController@store" )->name("product.mercadopago.submit"); 
			Route::post( "/product/mercadopago/notify", "Payment\product\MercadopagoController@notify" )->name("product.mercadopago.notify"); 
			// PayUmoney 
			Route::post( "/product/payumoney/submit", "Payment\product\PayumoneyController@store" )->name("product.payumoney.submit"); 
			Route::post( "/product/payumoney/notify", "Payment\product\PayumoneyController@notify" )->name("product.payumoney.notify"); 
			// CHECKOUT SECTION ENDS 

			// client feedback route 
			Route::get("/feedback", "Front\FeedbackController@feedback")->name( "feedback" ); 
			Route::post( "/store_feedback", "Front\FeedbackController@storeFeedback" )->name("store_feedback"); 
	}); 

	Route::group(["middleware" => ["web", "setlang"]], function () { 
			Route::post("/login", "User\LoginController@login")->name( "user.login.submit" ); 
			Route::get( "/login/facebook", "User\LoginController@redirectToFacebook" )->name("front.facebook.login"); 
			Route::get( "/login/facebook/callback", "User\LoginController@handleFacebookCallback" )->name("front.facebook.callback"); 
			Route::get("/login/google", "User\LoginController@redirectToGoogle")->name( "front.google.login" ); 
			Route::get( "/login/google/callback", "User\LoginController@handleGoogleCallback" )->name("front.google.callback"); 
			Route::get("/register", "User\RegisterController@registerPage")->name( "user-register" ); 
			Route::post("/register/submit", "User\RegisterController@register")->name( "user-register-submit" ); 
			Route::get( "/register/verify/{token}", "User\RegisterController@token" )->name("user-register-token"); 
			Route::get("/forgot", "User\ForgotController@showforgotform")->name( "user-forgot" ); 
			Route::post("/forgot", "User\ForgotController@forgot")->name( "user-forgot-submit" ); 
			// Course Route For Front-End 
			Route::post("/course/review", "Front\CourseController@giveReview")->name( "course.review" ); 
	}); 

	/** Route For Enroll In Free Courses **/ 
	Route::post( "/free_course/enroll", "Front\FreeCourseEnrollController@enroll" )->name("free_course.enroll"); 
	Route::get( "/free_course/enroll/complete", "Front\FreeCourseEnrollController@complete" )->name("course.enroll.complete"); 
	/** End Of Route For Enroll In Free Courses **/ 

	/** Route For PayPal Payment To Sell The Courses **/ 
	Route::post( "/course/payment/paypal", "Payment\Course\PayPalGatewayController@redirectToPayPal" )->name("course.payment.paypal"); 
	Route::get( "/course/payment/paypal/notify", "Payment\Course\PayPalGatewayController@notify" )->name("course.paypal.notify"); 
	Route::get( "/course/payment/paypal/complete", "Payment\Course\PayPalGatewayController@complete" )->name("course.paypal.complete"); 
	Route::get( "/course/payment/paypal/cancel", "Payment\Course\PayPalGatewayController@cancel" )->name("course.paypal.cancel"); 
	/** End Of Route For PayPal Payment To Sell The Courses **/

	/** Route For Stripe Payment To Sell The Courses **/ 
	Route::post( "/course/payment/stripe", "Payment\Course\StripeGatewayController@redirectToStripe" )->name("course.payment.stripe");
	Route::get( "/course/payment/stripe/complete", "Payment\Course\StripeGatewayController@complete" )->name("course.stripe.complete"); 
	/** End Of Route For Stripe Payment To Sell The Courses **/

	/** Route For Paytm Payment To Sell The Courses **/ 
	Route::post( "/course/payment/paytm", "Payment\Course\PaytmGatewayController@redirectToPaytm" )->name("course.payment.paytm"); 
	Route::post( "/course/payment/paytm/notify", "Payment\Course\PaytmGatewayController@notify" )->name("course.paytm.notify"); 
	Route::get( "/course/payment/paytm/complete", "Payment\Course\PaytmGatewayController@complete" )->name("course.paytm.complete"); 
	Route::get( "/course/payment/paytm/cancel", "Payment\Course\PaytmGatewayController@cancel" )->name("course.paytm.cancel"); 
	/** End Of Route For Paytm Payment To Sell The Courses **/ 

	/** Route For Razorpay Payment To Sell The Courses **/ 
	Route::post( "/course/payment/razorpay", "Payment\Course\RazorpayGatewayController@redirectToRazorpay" )->name("course.payment.razorpay"); 
	Route::post( "/course/payment/razorpay/notify", "Payment\Course\RazorpayGatewayController@notify" )->name("course.razorpay.notify"); 
	Route::get( "/course/payment/razorpay/complete", "Payment\Course\RazorpayGatewayController@complete" )->name("course.razorpay.complete"); 
	Route::get( "/course/payment/razorpay/cancel", "Payment\Course\RazorpayGatewayController@cancel" )->name("course.razorpay.cancel"); 
	/** End Of Route For Razorpay Payment To Sell The Courses **/ 

	/** Route For Instamojo Payment To Sell The Courses **/ 
	Route::post( "/course/payment/instamojo", "Payment\Course\InstamojoGatewayController@redirectToInstamojo" )->name("course.payment.instamojo"); 
	Route::get( "/course/payment/instamojo/notify", "Payment\Course\InstamojoGatewayController@notify" )->name("course.instamojo.notify"); 
	Route::get( "/course/payment/instamojo/complete", "Payment\Course\InstamojoGatewayController@complete" )->name("course.instamojo.complete"); 
	Route::get( "/course/payment/instamojo/cancel", "Payment\Course\InstamojoGatewayController@cancel" )->name("course.instamojo.cancel"); 
	/** End Of Route For Instamojo Payment To Sell The Courses **/ 

	/** Route For Mollie Payment To Sell The Courses **/ 
	Route::post( "/course/payment/mollie", "Payment\Course\MollieGatewayController@redirectToMollie" )->name("course.payment.mollie"); 
	Route::get( "/course/payment/mollie/notify", "Payment\Course\MollieGatewayController@notify" )->name("course.mollie.notify"); 
	Route::get( "/course/payment/mollie/complete", "Payment\Course\MollieGatewayController@complete" )->name("course.mollie.complete"); 
	Route::get( "/course/payment/mollie/cancel", "Payment\Course\MollieGatewayController@cancel" )->name("course.mollie.cancel"); 
	/** End Of Route For Mollie Payment To Sell The Courses **/ 
	
	/** Route For Mollie Payment To Sell The Courses **/ 
	Route::post( "/course/payment/payumoney", "Payment\Course\PayuMoneyController@redirectToPayumoney" )->name("course.payment.payumoney"); 
	Route::post( "/course/payment/payumoney/notify", "Payment\Course\PayuMoneyController@notify" )->name("course.payumoney.notify"); 
	Route::get( "/course/payment/payumoney/complete", "Payment\Course\PayuMoneyController@complete" )->name("course.payumoney.complete"); 
	Route::get( "/course/payment/payumoney/cancel", "Payment\Course\PayuMoneyController@cancel" )->name("course.payumoney.cancel"); 
	/** End Of Route For Mollie Payment To Sell The Courses **/ 
	/** Route For Flutterwave Payment To Sell The Courses **/ 
	Route::post( "/course/payment/flutterwave", "Payment\Course\FlutterwaveGatewayController@redirectToFlutterwave" )->name("course.payment.flutterwave"); 
	Route::post( "/course/payment/flutterwave/notify", "Payment\Course\FlutterwaveGatewayController@notify" )->name("course.flutterwave.notify"); 
	// this route have to be post method 
	// in Flutterwave the complete url have to be same as the notify url, otherwise it will not work 
	Route::get( "/course/payment/flutterwave/notify", "Payment\Course\FlutterwaveGatewayController@complete" )->name("course.flutterwave.complete"); 
	Route::get( "/course/payment/flutterwave/notify_cancel", "Payment\Course\FlutterwaveGatewayController@cancel" )->name("course.flutterwave.cancel"); 
	/** End Of Route For Flutterwave Payment To Sell The Courses **/ 
	/** Route For MercadoPago Payment To Sell The Courses **/ 
	Route::post( "/course/payment/mercadopago", "Payment\Course\MercadoPagoGatewayController@redirectToMercadoPago" )->name("course.payment.mercadopago"); 
	Route::post( "/course/payment/mercadopago/notify", "Payment\Course\MercadoPagoGatewayController@notify" )->name("course.mercadopago.notify"); 
	Route::get( "/course/payment/mercadopago/complete", "Payment\Course\MercadoPagoGatewayController@complete" )->name("course.mercadopago.complete"); 
	Route::get( "/course/payment/mercadopago/cancel", "Payment\Course\MercadoPagoGatewayController@cancel" )->name("course.mercadopago.cancel"); 
	/** End Of Route For MercadoPago Payment To Sell The Courses **/ 
	/** Route For Paystack Payment To Sell The Courses **/ 
	Route::post( "/course/payment/paystack", "Payment\Course\PaystackGatewayController@redirectToPaystack" )->name("course.payment.paystack"); 
	Route::get( "/course/payment/paystack/notify", "Payment\Course\PaystackGatewayController@notify" )->name("course.paystack.notify"); 
	Route::get( "/course/payment/paystack/complete", "Payment\Course\PaystackGatewayController@complete" )->name("course.paystack.complete"); 
	Route::get( "/course/payment/paystack/cancel", "Payment\Course\PaystackGatewayController@cancel" )->name("course.paystack.cancel"); 
	/** End Of Route For Paystack Payment To Sell The Courses **/ 
	/** Route For Offline Payment To Sell The Courses **/ 
	Route::post( "/course/offline/{gatewayid}/submit", "Payment\Course\OfflineController@store" )->name("course.offline.submit"); 
	/** End Of Route For Offline Payment To Sell The Courses **/ 
	Route::group(["middleware" => ["web", "setlang"]], function () { 
			Route::get("/login", "User\LoginController@showLoginForm")->name( "user.login" ); 
			Route::post("/login", "User\LoginController@login")->name( "user.login.submit" ); 
			Route::get("/register", "User\RegisterController@registerPage")->name( "user-register" ); 
			Route::post("/register/submit", "User\RegisterController@register")->name( "user-register-submit" ); 
			Route::get( "/register/verify/{token}", "User\RegisterController@token" )->name("user-register-token"); 
			Route::get("/forgot", "User\ForgotController@showforgotform")->name( "user-forgot" ); 
			Route::post("/forgot", "User\ForgotController@forgot")->name( "user-forgot-submit" ); 
	}); 
	Route::post("/front/test_api", "Admin\PageBuilderController@test_api")->name( "front.test_api" ); 
	Route::group( ["prefix" => "user", "middleware" => ["auth", "userstatus", "setlang"]], function () { 
			// Summernote image upload 
		Route::post( "/summernote/upload", "User\SummernoteController@upload" )->name("user.summernote.upload");
		Route::get("/dashboard", "User\UserController@index")->name( "user-dashboard" ); 
		Route::get("/reset", "User\UserController@resetform")->name( "user-reset" ); 
		Route::post("/reset", "User\UserController@reset")->name( "user-reset-submit" ); 
		Route::get("/profile", "User\UserController@profile")->name( "user-profile" ); 
		Route::post("/profile", "User\UserController@profileupdate")->name( "user-profile-update" ); 
		Route::get("/logout", "User\LoginController@logout")->name( "user-logout" ); 
		Route::get( "/shipping/details", "User\UserController@shippingdetails" )->name("shpping-details"); 
		Route::post( "/shipping/details/update", "User\UserController@shippingupdate" )->name("user-shipping-update"); 
		Route::get( "/billing/details", "User\UserController@billingdetails" )->name("billing-details"); 
		Route::post( "/billing/details/update", "User\UserController@billingupdate" )->name("billing-update"); 
		Route::get("/orders", "User\OrderController@index")->name( "user-orders" ); 
		Route::get("/order/{id}", "User\OrderController@orderdetails")->name( "user-orders-details" ); 
		Route::get("/events", "User\EventController@index")->name( "user-events" ); 
		Route::get("/event/{id}", "User\EventController@eventdetails")->name( "user-event-details" ); 
		Route::get("/donations", "User\DonationController@index")->name( "user-donations" ); 
		Route::get("/course_orders", "User\CourseOrderController@index")->name( "user.course_orders" ); 
		Route::get( "/course/{id}/lessons", "User\CourseOrderController@courseLessons" )->name("user.course.lessons"); 
		Route::get("/tickets", "User\TicketController@index")->name( "user-tickets" ); 
		Route::get("/ticket/create", "User\TicketController@create")->name( "user-ticket-create" ); 
		Route::get( "/ticket/messages/{id}", "User\TicketController@messages" )->name("user-ticket-messages"); 
		Route::post( "/ticket/store/", "User\TicketController@ticketstore" )->name("user.ticket.store"); 
		Route::post( "/ticket/reply/{id}", "User\TicketController@ticketreply" )->name("user.ticket.reply"); 
		Route::post( "/zip-file/upload", "User\TicketController@zip_upload" )->name("zip.upload"); 
		Route::get("/packages", "User\UserController@packages")->name( "user-packages" ); 
		Route::post( "/digital/download", "User\OrderController@digitalDownload" )->name("user-digital-download"); 
		Route::get("/package/orders", "User\PackageController@index")->name( "user-package-orders" ); 
		Route::get( "/package/order/{id}", "User\PackageController@orderdetails" )->name("user-package-order-details"); 
	}); 


	/*======================================================= 
	******************** Admin Routes ********************** =======================================================*/ 
	Route::group(["prefix" => "admin", "middleware" => "guest:admin"], function () { 
			Route::post("/login", "Admin\LoginController@authenticate")->name( "admin.auth" ); 
			Route::get("/mail-form", "Admin\ForgetController@mailForm")->name( "admin.forget.form" ); 
			Route::post("/sendmail", "Admin\ForgetController@sendmail")->name( "admin.forget.mail" ); 
	}); 
		
	Route::group( [ "prefix" => "admin", "middleware" => ["auth:admin", "checkstatus", "setLfmPath"], ], function () { 
			// RTL check 
			Route::get("/rtlcheck/{langid}", "Admin\LanguageController@rtlcheck" )->name("admin.rtlcheck"); 
			// Summernote image upload 
			Route::post( "/summernote/upload", "Admin\SummernoteController@upload" )->name("admin.summernote.upload"); 
			// Admin logout Route 
			Route::get("/logout", "Admin\LoginController@logout")->name( "admin.logout" ); 
			// Admin Dashboard Routes 
			Route::get( "/dashboard", "Admin\DashboardController@dashboard" )->name("admin.dashboard")->middleware('can:dashboard'); 
			// Admin Profile Routes 
			Route::get( "/changePassword", "Admin\ProfileController@changePass" )->name("admin.changePass")->middleware('can:change-password'); 
			Route::post( "/profile/updatePassword", "Admin\ProfileController@updatePassword" )->name("admin.updatePassword")->middleware('can:change-password'); 
			Route::get( "/profile/edit", "Admin\ProfileController@editProfile" )->name("admin.editProfile")->middleware('can:profile'); 
			Route::post( "/propic/update", "Admin\ProfileController@updatePropic" )->name("admin.propic.update")->middleware('can:profile'); 
			Route::post( "/profile/update", "Admin\ProfileController@updateProfile" )->name("admin.updateProfile")->middleware('can:profile'); 
			// Admin Home Version Setting Routes 
			Route::get( "/home-settings", "Admin\BasicController@homeSettings" )->name("admin.homeSettings")->middleware('can:theme-setting'); 
			Route::post( "/homeSettings/post", "Admin\BasicController@updateHomeSettings" )->name("admin.homeSettings.update")->middleware('can:theme-setting'); 
			Route::get("/audit", "Admin\AuditReportController@index")->name( "audit-from" )->middleware('can:audit-trail'); 
			// Admin File Manager Routes 
			Route::get( "/file-manager", "Admin\BasicController@fileManager" )->name("admin.file-manager")->middleware('can:file-manager'); 
			// Admin Logo Routes 
			Route::get("/logo", "Admin\BasicController@logo")->name( "admin.logo" )->middleware('can:logo-text-header'); 
			Route::post("/logo/post", "Admin\BasicController@updatelogo")->name( "admin.logo.update" )->middleware('can:logo-text-header'); 
			// Admin preloader Routes 
			Route::get("/preloader", "Admin\BasicController@preloader")->name( "admin.preloader" )->middleware('can:preloader'); 
			Route::post( "/preloader/post", "Admin\BasicController@updatepreloader" )->name("admin.preloader.update")->middleware('can:preloader'); 
			// Admin Scripts Routes 
			Route::get( "/feature/settings", "Admin\BasicController@featuresettings" )->name("admin.featuresettings")->middleware('can:features'); 
			Route::post( "/feature/settings/update", "Admin\BasicController@updatefeatrue" )->name("admin.featuresettings.update")->middleware('can:features'); 
			// Admin Basic Information Routes 
			Route::get("/basicinfo", "Admin\BasicController@basicinfo")->name( "admin.basicinfo" )->middleware('can:general-settings'); 
			// Admin Basic Information Routes 
			Route::post( "/basicinfo/post", "Admin\BasicController@updatebasicinfo" )->name("admin.basicinfo.update")->middleware('can:general-settings'); 
			// Admin Email Settings Routes 
			Route::get( "/mail-from-admin", "Admin\EmailController@mailFromAdmin" )->name("admin.mailFromAdmin")->middleware('can:email-settings'); 
			Route::post( "/mail-from-admin/update", "Admin\EmailController@updateMailFromAdmin" )->name("admin.mailfromadmin.update")->middleware('can:email-settings');
			Route::get( "/mail-to-admin", "Admin\EmailController@mailToAdmin" )->name("admin.mailToAdmin")->middleware('can:email-settings'); 
			Route::post( "/mail-to-admin/update", "Admin\EmailController@updateMailToAdmin" )->name("admin.mailtoadmin.update")->middleware('can:email-settings'); 
			Route::get( "/email-templates", "Admin\EmailController@templates" )->name("admin.email.templates")->middleware('can:email-settings'); 
			Route::get( "/email-template/{id}/edit", "Admin\EmailController@editTemplate" )->name("admin.email.editTemplate")->middleware('can:email-settings'); 
			Route::post( "/emailtemplate/{id}/update", "Admin\EmailController@templateUpdate" )->name("admin.email.templateUpdate")->middleware('can:email-settings'); 
			// Admin Email Settings Routes 
			Route::get( "/mail-from-admin", "Admin\EmailController@mailFromAdmin" )->name("admin.mailFromAdmin")->middleware('can:email-settings'); 
			Route::post( "/mail-from-admin/update", "Admin\EmailController@updateMailFromAdmin" )->name("admin.mailfromadmin.update")->middleware('can:email-settings'); 
			Route::get( "/mail-to-admin", "Admin\EmailController@mailToAdmin" )->name("admin.mailToAdmin")->middleware('can:email-settings'); 
			Route::post( "/mail-to-admin/update", "Admin\EmailController@updateMailToAdmin" )->name("admin.mailtoadmin.update")->middleware('can:email-settings'); 
			// Admin Support Routes 
			Route::get("/support", "Admin\BasicController@support")->name( "admin.support" )->middleware('can:support-information'); 
			Route::post( "/support/{langid}/post", "Admin\BasicController@updatesupport" )->name("admin.support.update")->middleware('can:support-information'); 
			// Admin Page Heading Routes 
			Route::get("/heading", "Admin\BasicController@heading")->name( "admin.heading" )->middleware('can:page-headings'); 
			Route::post( "/heading/{langid}/update", "Admin\BasicController@updateheading" )->name("admin.heading.update")->middleware('can:page-headings'); 
			// Admin Scripts Routes 
			Route::get("/script", "Admin\BasicController@script")->name( "admin.script" )->middleware('can:plugins');
			Route::post( "/script/update", "Admin\BasicController@updatescript" )->name("admin.script.update")->middleware('can:plugins'); 
			// Admin Social Routes 
			Route::get("/social", "Admin\SocialController@index")->name( "admin.social.index" )->middleware('can:social-links'); 
			Route::post("/social/store", "Admin\SocialController@store")->name( "admin.social.store" )->middleware('can:social-links'); 
			Route::get( "/social/{id}/edit", "Admin\SocialController@edit" )->name("admin.social.edit")->middleware('can:social-links'); 
			Route::post( "/social/update", "Admin\SocialController@update" )->name("admin.social.update")->middleware('can:social-links'); 
			Route::post( "/social/delete", "Admin\SocialController@delete" )->name("admin.social.delete")->middleware('can:social-links'); 
			// Admin SEO Information Routes 
			Route::get("/seo", "Admin\BasicController@seo")->name("admin.seo")->middleware('can:seo-information');
			Route::post( "/seo/{langid}/update", "Admin\BasicController@updateseo" )->name("admin.seo.update")->middleware('can:seo-information'); 
			// Admin Maintanance Mode Routes 
			Route::get( "/maintainance", "Admin\BasicController@maintainance" )->name("admin.maintainance")->middleware('can:maintenance-mode'); 
			Route::post( "/maintainance/update", "Admin\BasicController@updatemaintainance" )->name("admin.maintainance.update")->middleware('can:maintenance-mode'); 
			// Admin Section Customization Routes 
			Route::get("/sections", "Admin\BasicController@sections")->name( "admin.sections.index" )->middleware('can:sections-customization'); 
			Route::post( "/sections/update", "Admin\BasicController@updatesections" )->name("admin.sections.update")->middleware('can:sections-customization'); 
			// Admin Offer Banner Routes 
			Route::get( "/announcement", "Admin\BasicController@announcement" )->name("admin.announcement")->middleware('can:announcement-popup'); 
			Route::post( "/announcement/{langid}/update", "Admin\BasicController@updateannouncement" )->name("admin.announcement.update")->middleware('can:announcement-popup'); 
			// Admin Cookie Alert Routes 
			Route::get( "/cookie-alert", "Admin\BasicController@cookiealert" )->name("admin.cookie.alert")->middleware('can:cookies-alert'); 
			Route::post( "/cookie-alert/{langid}/update", "Admin\BasicController@updatecookie" )->name("admin.cookie.update")->middleware('can:cookies-alert'); 
			// Admin Payment Gateways 
			Route::get("/gateways", "Admin\GatewayController@index")->name( "admin.gateway.index" )->middleware('can:payment-gateways'); 
			Route::post( "/stripe/update", "Admin\GatewayController@stripeUpdate" )->name("admin.stripe.update")->middleware('can:payment-gateways'); 
			Route::post( "/paypal/update", "Admin\GatewayController@paypalUpdate" )->name("admin.paypal.update")->middleware('can:payment-gateways'); 
			Route::post( "/paystack/update", "Admin\GatewayController@paystackUpdate" )->name("admin.paystack.update")->middleware('can:payment-gateways'); 
			Route::post( "/paytm/update", "Admin\GatewayController@paytmUpdate" )->name("admin.paytm.update")->middleware('can:payment-gateways'); 
			Route::post( "/flutterwave/update", "Admin\GatewayController@flutterwaveUpdate" )->name("admin.flutterwave.update")->middleware('can:payment-gateways'); 
			Route::post( "/instamojo/update", "Admin\GatewayController@instamojoUpdate" )->name("admin.instamojo.update")->middleware('can:payment-gateways'); 
			Route::post( "/mollie/update", "Admin\GatewayController@mollieUpdate" )->name("admin.mollie.update")->middleware('can:payment-gateways'); 
			Route::post( "/razorpay/update", "Admin\GatewayController@razorpayUpdate" )->name("admin.razorpay.update")->middleware('can:payment-gateways'); 
			Route::post( "/mercadopago/update", "Admin\GatewayController@mercadopagoUpdate" )->name("admin.mercadopago.update")->middleware('can:payment-gateways'); 
			Route::post( "/payumoney/update", "Admin\GatewayController@payumoneyUpdate" )->name("admin.payumoney.update")->middleware('can:payment-gateways'); 
			Route::get( "/offline/gateways", "Admin\GatewayController@offline" )->name("admin.gateway.offline")->middleware('can:payment-gateways'); 
			Route::post( "/offline/gateway/store", "Admin\GatewayController@store" )->name("admin.gateway.offline.store")->middleware('can:payment-gateways'); 
			Route::post( "/offline/gateway/update", "Admin\GatewayController@update" )->name("admin.gateway.offline.update")->middleware('can:payment-gateways'); 
			Route::post( "/offline/status", "Admin\GatewayController@status" )->name("admin.offline.status")->middleware('can:payment-gateways'); 
			Route::post( "/offline/gateway/delete", "Admin\GatewayController@delete" )->name("admin.offline.gateway.delete")->middleware('can:payment-gateways'); 
			// Admin Language Routes 
			Route::get("/languages", "Admin\LanguageController@index")->name( "admin.language.index" )->middleware('can:language'); 
			Route::get( "/language/{id}/edit", "Admin\LanguageController@edit" )->name("admin.language.edit")->middleware('can:language'); 
			Route::get( "/language/{id}/edit/keyword", "Admin\LanguageController@editKeyword" )->name("admin.language.editKeyword")->middleware('can:language'); 
			Route::post( "/language/store", "Admin\LanguageController@store" )->name("admin.language.store")->middleware('can:language'); 
			Route::post( "/language/upload", "Admin\LanguageController@upload" )->name("admin.language.upload")->middleware('can:language'); 
			Route::post( "/language/{id}/uploadUpdate", "Admin\LanguageController@uploadUpdate" )->name("admin.language.uploadUpdate")->middleware('can:language'); 
			Route::post( "/language/{id}/default", "Admin\LanguageController@default" )->name("admin.language.default")->middleware('can:language'); 
			Route::post( "/language/{id}/delete", "Admin\LanguageController@delete" )->name("admin.language.delete")->middleware('can:language'); 
			Route::post( "/language/update", "Admin\LanguageController@update" )->name("admin.language.update")->middleware('can:language'); 
			Route::post( "/language/{id}/update/keyword", "Admin\LanguageController@updateKeyword" )->name("admin.language.updateKeyword")->middleware('can:language'); 
			// Admin Sitemap Routes 
			Route::get("/sitemap", "Admin\SitemapController@index")->name( "admin.sitemap.index" )->middleware('can:misc'); 
			Route::post( "/sitemap/store", "Admin\SitemapController@store" )->name("admin.sitemap.store")->middleware('can:misc'); 
			Route::get( "/sitemap/{id}/update", "Admin\SitemapController@update" )->name("admin.sitemap.update")->middleware('can:misc'); 
			Route::post( "/sitemap/{id}/delete", "Admin\SitemapController@delete" )->name("admin.sitemap.delete")->middleware('can:misc'); 
			Route::post( "/sitemap/download", "Admin\SitemapController@download" )->name("admin.sitemap.download")->middleware('can:misc'); 
			// Admin Database Backup 
			Route::get("/backup", "Admin\BackupController@index")->name( "admin.backup.index" )->middleware('can:misc'); 
			Route::post("/backup/store", "Admin\BackupController@store")->name( "admin.backup.store" )->middleware('can:misc'); 
			Route::post( "/backup/{id}/delete", "Admin\BackupController@delete" )->name("admin.backup.delete")->middleware('can:misc'); 
			Route::post( "/backup/download", "Admin\BackupController@download" )->name("admin.backup.download")->middleware('can:misc'); 
			// Admin Cache Clear Routes 
			Route::get("/cache-clear", "Admin\CacheController@clear")->name( "admin.cache.clear" )->middleware('can:misc'); 
			// Admin Hero Section (Static Version) Routes 
			Route::get( "/herosection/static", "Admin\HerosectionController@static" )->name("admin.herosection.static")->middleware('can:hero-section');
			Route::post( "/herosection/{langid}/update", "Admin\HerosectionController@update" )->name("admin.herosection.update")->middleware('can:hero-section');
			// Admin Hero Section (Slider Version) Routes 
			Route::get( "/herosection/sliders", "Admin\SliderController@index" )->name("admin.slider.index")->middleware('can:hero-section'); 
			Route::post( "/herosection/slider/store", "Admin\SliderController@store" )->name("admin.slider.store")->middleware('can:hero-section');
			Route::get( "/herosection/slider/{id}/edit", "Admin\SliderController@edit" )->name("admin.slider.edit")->middleware('can:hero-section'); 
			Route::post( "/herosection/sliderupdate", "Admin\SliderController@update" )->name("admin.slider.update")->middleware('can:hero-section'); 
			Route::post( "/herosection/slider/delete", "Admin\SliderController@delete" )->name("admin.slider.delete"); 
			// Admin Hero Section (Video Version) Routes 
			Route::get( "/herosection/video", "Admin\HerosectionController@video" )->name("admin.herosection.video")->middleware('can:hero-section');

			Route::post( "/herosection/video/{langid}/update", "Admin\HerosectionController@videoupdate" )->name("admin.herosection.video.update")->middleware('can:hero-section'); 
			// Admin Hero Section (Parallax Version) Routes 
			Route::get( "/herosection/parallax", "Admin\HerosectionController@parallax" )->name("admin.herosection.parallax")->middleware('can:hero-section'); 
			Route::post( "/herosection/parallax/update", "Admin\HerosectionController@parallaxupdate" )->name("admin.herosection.parallax.update")->middleware('can:hero-section'); 
			// Admin Feature Routes 
			Route::get("/features", "Admin\FeatureController@index")->name( "admin.feature.index" )->middleware('can:features'); 
			Route::post( "/feature/store", "Admin\FeatureController@store" )->name("admin.feature.store")->middleware('can:features'); 
			Route::get( "/feature/{id}/edit", "Admin\FeatureController@edit" )->name("admin.feature.edit")->middleware('can:features'); 
			Route::post( "/feature/update", "Admin\FeatureController@update" )->name("admin.feature.update")->middleware('can:features'); 
			Route::post( "/feature/delete", "Admin\FeatureController@delete" )->name("admin.feature.delete")->middleware('can:features'); 
			// Admin Intro Section Routes 
			Route::get( "/introsection", "Admin\IntrosectionController@index" )->name("admin.introsection.index")->middleware('can:intro-section');
			Route::post( "/introsection/{langid}/update", "Admin\IntrosectionController@update" )->name("admin.introsection.update")->middleware('can:intro-section');
			// Admin Service Section Routes 
			Route::get( "/servicesection", "Admin\ServicesectionController@index" )->name("admin.servicesection.index")->middleware('can:service-section'); 
			Route::post( "/servicesection/{langid}/update", "Admin\ServicesectionController@update" )->name("admin.servicesection.update")->middleware('can:service-section'); 
			// Admin Approach Section Routes 
			Route::get("/approach", "Admin\ApproachController@index")->name( "admin.approach.index" )->middleware('can:approach-section'); 
			Route::post( "/approach/store", "Admin\ApproachController@store")->name("admin.approach.point.store")->middleware('can:approach-section');
			Route::get( "/approach/{id}/pointedit", "Admin\ApproachController@pointedit" )->name("admin.approach.point.edit")->middleware('can:approach-section'); 
			Route::post( "/approach/{langid}/update", "Admin\ApproachController@update" )->name("admin.approach.update")->middleware('can:approach-section');
			Route::post( "/approach/pointupdate", "Admin\ApproachController@pointupdate" )->name("admin.approach.point.update")->middleware('can:approach-section');
			Route::post( "/approach/pointdelete", "Admin\ApproachController@pointdelete" )->name("admin.approach.pointdelete")->middleware('can:approach-section');
			// Admin Statistic Section Routes 
			Route::get("/statistics", "Admin\StatisticsController@index")->name( "admin.statistics.index" )->middleware('can:statistics-section');
			Route::post( "/statistics/{langid}/upload", "Admin\StatisticsController@upload" )->name("admin.statistics.upload")->middleware('can:statistics-section'); 
			Route::post( "/statistics/store", "Admin\StatisticsController@store")->name("admin.statistics.store")->middleware('can:statistics-section');
			Route::get( "/statistics/{id}/edit", "Admin\StatisticsController@edit" )->name("admin.statistics.edit")->middleware('can:statistics-section'); 
			Route::post( "/statistics/update", "Admin\StatisticsController@update" )->name("admin.statistics.update")->middleware('can:statistics-section'); 
			Route::post( "/statistics/delete", "Admin\StatisticsController@delete" )->name("admin.statistics.delete")->middleware('can:statistics-section');

			// Admin Call to Action Section Routes 
			Route::get("/cta", "Admin\CtaController@index")->name( "admin.cta.index" )->middleware('can:call-to-action-section'); 
			Route::post( "/cta/{langid}/update", "Admin\CtaController@update" )->name("admin.cta.update")->middleware('can:call-to-action-section');
			// Admin Portfolio Section Routes 
			Route::get( "/portfoliosection", "Admin\PortfoliosectionController@index" )->name("admin.portfoliosection.index")->middleware('can:portfolio-section'); 
			Route::post( "/portfoliosection/{langid}/update", "Admin\PortfoliosectionController@update" )->name("admin.portfoliosection.update")->middleware('can:portfolio-section'); 
			// Admin Testimonial Routes 
			Route::get( "/testimonials", "Admin\TestimonialController@index" )->name("admin.testimonial.index")->middleware('can:testimonials-section'); 
			Route::get( "/testimonial/create", "Admin\TestimonialController@create" )->name("admin.testimonial.create")->middleware('can:testimonials-section'); 
			Route::post( "/testimonial/store", "Admin\TestimonialController@store" )->name("admin.testimonial.store")->middleware('can:testimonials-section'); 
			Route::get( "/testimonial/{id}/edit", "Admin\TestimonialController@edit" )->name("admin.testimonial.edit")->middleware('can:testimonials-section'); 
			Route::post( "/testimonial/update", "Admin\TestimonialController@update" )->name("admin.testimonial.update")->middleware('can:testimonials-section');
			Route::post( "/testimonial/delete", "Admin\TestimonialController@delete" )->name("admin.testimonial.delete")->middleware('can:testimonials-section');
			Route::post( "/testimonialtext/{langid}/update", "Admin\TestimonialController@textupdate" )->name("admin.testimonialtext.update")->middleware('can:testimonials-section');
			// Admin Blog Section Routes 
			Route::get( "/blogsection", "Admin\BlogsectionController@index" )->name("admin.blogsection.index")->middleware('can:blog-section'); 
			Route::post( "/blogsection/{langid}/update", "Admin\BlogsectionController@update" )->name("admin.blogsection.update")->middleware('can:blog-section');
			// Admin Partner Routes 
			Route::get("/partners", "Admin\PartnerController@index")->name( "admin.partner.index" )->middleware('can:shareholder-section'); 
			Route::post( "/partner/store", "Admin\PartnerController@store" )->name("admin.partner.store")->middleware('can:shareholder-section');  
			Route::get( "/partner/{id}/edit", "Admin\PartnerController@edit" )->name("admin.partner.edit")->middleware('can:shareholder-section');  
			Route::post( "/partner/update", "Admin\PartnerController@update" )->name("admin.partner.update")->middleware('can:shareholder-section');  
			Route::post( "/partner/delete", "Admin\PartnerController@delete" )->name("admin.partner.delete")->middleware('can:shareholder-section');  
			// Admin Member Routes 
			Route::get("/members", "Admin\MemberController@index")->name( "admin.member.index" )->middleware('can:team-section');  
			Route::get("/member/create", "Admin\MemberController@create")->name( "admin.member.create" )->middleware('can:team-section'); 
			Route::post("/member/store", "Admin\MemberController@store")->name( "admin.member.store" )->middleware('can:team-section'); 
			Route::get( "/member/{id}/edit", "Admin\MemberController@edit" )->name("admin.member.edit")->middleware('can:team-section'); 
			Route::post( "/member/update", "Admin\MemberController@update" )->name("admin.member.update")->middleware('can:team-section'); 
			Route::post( "/member/delete", "Admin\MemberController@delete" )->name("admin.member.delete")->middleware('can:team-section'); 
			Route::post( "/teamtext/{langid}/update", "Admin\MemberController@textupdate" )->name("admin.teamtext.update")->middleware('can:team-section'); 
			Route::post( "/member/feature", "Admin\MemberController@feature" )->name("admin.member.feature")->middleware('can:team-section'); 
			// Admin Package Background Routes 
			Route::get( "/package/background", "Admin\PackageController@background" )->name("admin.package.background")->middleware('can:package-background'); 
			Route::post( "/package/{langid}/background-upload", "Admin\PackageController@uploadBackground" )->name("admin.package.background.upload")->middleware('can:package-background'); 
			// Admin Footer Logo Text Routes 
			Route::get("/footers", "Admin\FooterController@index")->name( "admin.footer.index" )->middleware('can:logo-text'); 
			Route::post( "/footer/{langid}/update", "Admin\FooterController@update" )->name("admin.footer.update")->middleware('can:logo-text'); 
			// Admin Ulink Routes 
			Route::get("/ulinks", "Admin\UlinkController@index")->name( "admin.ulink.index" )->middleware('can:useful-links');
			Route::get("/ulink/create", "Admin\UlinkController@create")->name( "admin.ulink.create" )->middleware('can:useful-links'); 
			Route::post("/ulink/store", "Admin\UlinkController@store")->name( "admin.ulink.store" )->middleware('can:useful-links'); 
			Route::get("/ulink/{id}/edit", "Admin\UlinkController@edit")->name( "admin.ulink.edit" )->middleware('can:useful-links'); 
			Route::post("/ulink/update", "Admin\UlinkController@update")->name( "admin.ulink.update" )->middleware('can:useful-links'); 
			Route::post("/ulink/delete", "Admin\UlinkController@delete")->name( "admin.ulink.delete" )->middleware('can:useful-links'); 
			// Admin alink Routes 
			Route::get("/alinks", "Admin\AlinkController@index")->name( "admin.alink.index" )->middleware('can:about-us-links'); 
			Route::get("/alink/create", "Admin\AlinkController@create")->name( "admin.alink.create" )->middleware('can:about-us-links'); 
			Route::post("/alink/store", "Admin\AlinkController@store")->name( "admin.alink.store" )->middleware('can:about-us-links'); 
			Route::get("/alink/{id}/edit", "Admin\AlinkController@edit")->name( "admin.alink.edit" )->middleware('can:about-us-links'); 
			Route::post("/alink/update", "Admin\AlinkController@update")->name( "admin.alink.update" )->middleware('can:about-us-links'); 
			Route::post("/alink/delete", "Admin\AlinkController@delete")->name( "admin.alink.delete" )->middleware('can:about-us-links'); 

			
			// Admin dlink Routes 
			Route::get("/dlinks", "Admin\DlinkController@index")->name( "admin.dlink.index" )->middleware('can:department-links'); 
			Route::get("/dlink/create", "Admin\DlinkController@create")->name( "admin.dlink.create" )->middleware('can:department-links'); 
			Route::post("/dlink/store", "Admin\DlinkController@store")->name( "admin.dlink.store" )->middleware('can:department-links'); 
			Route::get("/dlink/{id}/edit", "Admin\DlinkController@edit")->name( "admin.dlink.edit" )->middleware('can:department-links'); 
			Route::post("/dlink/update", "Admin\DlinkController@update")->name( "admin.dlink.update" )->middleware('can:department-links'); 
			Route::post("/dlink/delete", "Admin\DlinkController@delete")->name( "admin.dlink.delete" )->middleware('can:department-links');
			// Service Settings Route 
			Route::get( "/service/settings", "Admin\ServiceController@settings" )->name("admin.service.settings")->middleware('can:settings-services'); 
			Route::post( "/service/updateSettings", "Admin\ServiceController@updateSettings" )->name("admin.service.updateSettings")->middleware('can:settings-services'); 
			// Admin Service Category Routes 
			Route::get("/scategorys", "Admin\ScategoryController@index")->name( "admin.scategory.index" )->middleware('can:category-services'); 
			Route::post( "/scategory/store", "Admin\ScategoryController@store" )->name("admin.scategory.store")->middleware('can:category-services');
			Route::get( "/scategory/{id}/edit", "Admin\ScategoryController@edit" )->name("admin.scategory.edit")->middleware('can:category-services');
			Route::post( "/scategory/update", "Admin\ScategoryController@update" )->name("admin.scategory.update")->middleware('can:category-services'); 
			Route::post( "/scategory/delete", "Admin\ScategoryController@delete" )->name("admin.scategory.delete")->middleware('can:category-services'); 
			Route::post( "/scategory/bulk-delete", "Admin\ScategoryController@bulkDelete" )->name("admin.scategory.bulk.delete")->middleware('can:category-services'); 
			Route::post( "/scategory/feature", "Admin\ScategoryController@feature" )->name("admin.scategory.feature")->middleware('can:category-services'); 

			// Admin Services Routes 
			Route::get("/services", "Admin\ServiceController@index")->name( "admin.service.index" )->middleware('can:services'); 
			Route::post( "/service/store", "Admin\ServiceController@store" )->name("admin.service.store")->middleware('can:services'); 
			Route::get( "/service/{id}/edit", "Admin\ServiceController@edit" )->name("admin.service.edit")->middleware('can:services'); 
			Route::post( "/service/update", "Admin\ServiceController@update" )->name("admin.service.update")->middleware('can:services'); 
			Route::post( "/service/delete", "Admin\ServiceController@delete" )->name("admin.service.delete")->middleware('can:services'); 
			Route::post( "/service/bulk-delete", "Admin\ServiceController@bulkDelete" )->name("admin.service.bulk.delete")->middleware('can:services'); 
			Route::get( "/service/{langid}/getcats", "Admin\ServiceController@getcats" )->name("admin.service.getcats")->middleware('can:services'); 
			Route::post( "/service/feature", "Admin\ServiceController@feature" )->name("admin.service.feature")->middleware('can:services');  
			Route::post( "/service/sidebar", "Admin\ServiceController@sidebar" )->name("admin.service.sidebar")->middleware('can:services'); 

			// Admin Portfolio Routes 
			Route::get("/portfolios", "Admin\PortfolioController@index")->name( "admin.portfolio.index" )->middleware('can:portfolios'); 
			Route::get( "/portfolio/create", "Admin\PortfolioController@create" )->name("admin.portfolio.create")->middleware('can:portfolios');
			Route::post( "/portfolio/sliderstore", "Admin\PortfolioController@sliderstore" )->name("admin.portfolio.sliderstore")->middleware('can:portfolios'); 
			Route::post( "/portfolio/sliderrmv", "Admin\PortfolioController@sliderrmv" )->name("admin.portfolio.sliderrmv")->middleware('can:portfolios'); 
			Route::post( "/portfolio/store", "Admin\PortfolioController@store" )->name("admin.portfolio.store")->middleware('can:portfolios'); 
			Route::get( "/portfolio/{id}/edit", "Admin\PortfolioController@edit" )->name("admin.portfolio.edit")->middleware('can:portfolios'); 
			Route::get( "/portfolio/{id}/images", "Admin\PortfolioController@images" )->name("admin.portfolio.images")->middleware('can:portfolios'); 
			Route::post( "/portfolio/sliderupdate", "Admin\PortfolioController@sliderupdate" )->name("admin.portfolio.sliderupdate")->middleware('can:portfolios'); 
			Route::post( "/portfolio/update", "Admin\PortfolioController@update" )->name("admin.portfolio.update")->middleware('can:portfolios'); 
			Route::post( "/portfolio/delete", "Admin\PortfolioController@delete" )->name("admin.portfolio.delete"); 
			Route::post( "/portfolio/bulk-delete", "Admin\PortfolioController@bulkDelete" )->name("admin.portfolio.bulk.delete")->middleware('can:portfolios'); 
			Route::get( "portfolio/{id}/getservices", "Admin\PortfolioController@getservices" )->name("admin.portfolio.getservices")->middleware('can:portfolios');
			Route::post( "/portfolio/feature", "Admin\PortfolioController@feature" )->name("admin.portfolio.feature")->middleware('can:portfolios');

			// Admin Document Category Routes 
			Route::get("/document_category", "Admin\DocumentController@category_index")->name( "admin.dcategory.index" )->middleware('can:categories-document'); 
			Route::post( "/document_category/store", "Admin\DocumentController@category_store" )->name("admin.dcategory.store")->middleware('can:categories-document'); 
			Route::post( "/document_category/update", "Admin\DocumentController@category_update" )->name("admin.dcategory.update")->middleware('can:categories-document'); 
			Route::post( "/document_category/delete", "Admin\DocumentController@category_delete" )->name("admin.dcategory.delete")->middleware('can:categories-document'); 
			Route::post( "/document_category/bulk-delete", "Admin\DocumentController@category_bulkDelete" )->name("admin.dcategory.bulk.delete")->middleware('can:categories-document'); 
			// Admin Documents Routes 
			Route::get("/documents", "Admin\DocumentController@index")->name( "admin.documents.index" )->middleware('can:documents'); 
			Route::get("/document/add", "Admin\DocumentController@add")->name( "admin.documents.add" )->middleware('can:documents'); 
			Route::get("/document/edit/{id}", "Admin\DocumentController@edit")->name( "admin.documents.edit" )->middleware('can:documents'); 
			Route::post( "/document/store", "Admin\DocumentController@store" )->name("admin.documents.store")->middleware('can:documents');  
			Route::post( "/document/update", "Admin\DocumentController@update" )->name("admin.documents.update")->middleware('can:documents'); 
			Route::post( "/document/delete", "Admin\DocumentController@delete" )->name("admin.documents.delete")->middleware('can:documents'); 
			Route::post( "/document/bulk-delete", "Admin\DocumentController@bulkDelete" )->name("admin.documents.bulk.delete")->middleware('can:documents'); 

			// Water Teriff
			Route::get("/water", "Admin\WaterController@index")->name("admin.water.index");
			Route::post("/water/store", "Admin\WaterController@store")->name("admin.water.store");
			Route::get("/water/{id}/edit", "Admin\WaterController@edit")->name("admin.water.edit");
			Route::post("/water/update", "Admin\WaterController@update")->name("admin.water.update");
			Route::post("/water/delete", "Admin\WaterController@delete")->name("admin.water.delete");
			Route::post("/water/apply", "Admin\WaterController@applyDate")->name("admin.water.apply");

			// Admin Tender Category Routes 
			Route::get("/tender_category", "Admin\TendersController@category_index")->name( "admin.tcategory.index" )->middleware('can:categories-tender'); 
			Route::post( "/tender_category/store", "Admin\TendersController@category_store" )->name("admin.tcategory.store")->middleware('can:categories-tender'); 
			Route::post( "/tender_category/update", "Admin\TendersController@category_update" )->name("admin.tcategory.update")->middleware('can:categories-tender'); 
			Route::post( "/tender_category/delete", "Admin\TendersController@category_delete" )->name("admin.tcategory.delete")->middleware('can:categories-tender'); 
			Route::post( "/tender_category/bulk-delete", "Admin\TendersController@category_bulkDelete" )->name("admin.tcategory.bulk.delete")->middleware('can:categories-tender'); // Admin Tender Routes 
			Route::get("/tenders", "Admin\TendersController@index")->name( "admin.tenders.index" )->middleware('can:tenders'); 
			Route::get("/tender/add", "Admin\TendersController@add")->name( "admin.tenders.add" )->middleware('can:tenders'); 
			Route::get("/tender/edit/{id}", "Admin\TendersController@edit")->name( "admin.tenders.edit" )->middleware('can:tenders'); 
			Route::post( "/tender/store", "Admin\TendersController@store" )->name("admin.tenders.store")->middleware('can:tenders'); 
			Route::post( "/tender/update", "Admin\TendersController@update" )->name("admin.tenders.update")->middleware('can:tenders'); 
			Route::post( "/tender/delete", "Admin\TendersController@delete" )->name("admin.tenders.delete")->middleware('can:tenders'); 
			Route::post( "/tender/bulk-delete", "Admin\TendersController@bulkDelete" )->name("admin.tenders.bulk.delete")->middleware('can:tenders'); 

			// Admin Blog Category Routes 
			Route::get("/bcategorys", "Admin\BcategoryController@index")->name( "admin.bcategory.index" )->middleware('can:category-blog'); 
			Route::post( "/bcategory/store", "Admin\BcategoryController@store" )->name("admin.bcategory.store")->middleware('can:category-blog'); 
			Route::post( "/bcategory/update", "Admin\BcategoryController@update" )->name("admin.bcategory.update")->middleware('can:category-blog'); 
			Route::post( "/bcategory/delete", "Admin\BcategoryController@delete" )->name("admin.bcategory.delete")->middleware('can:category-blog'); 
			Route::post( "/bcategory/bulk-delete", "Admin\BcategoryController@bulkDelete" )->name("admin.bcategory.bulk.delete")->middleware('can:category-blog'); 

			// Admin Blog Routes 
			Route::get("/blogs", "Admin\BlogController@index")->name( "admin.blog.index" )->middleware('can:blogs'); 
			Route::post("/blog/store", "Admin\BlogController@store")->name( "admin.blog.store" )->middleware('can:blogs');
			Route::get("/blog/{id}/edit", "Admin\BlogController@edit")->name( "admin.blog.edit" )->middleware('can:blogs');
			Route::post("/blog/update", "Admin\BlogController@update")->name( "admin.blog.update" )->middleware('can:blogs'); 
			Route::post("/blog/delete", "Admin\BlogController@delete")->name( "admin.blog.delete" )->middleware('can:blogs');
			Route::post( "/blog/bulk-delete", "Admin\BlogController@bulkDelete" )->name("admin.blog.bulk.delete")->middleware('can:blogs'); 
			Route::get( "/blog/{langid}/getcats", "Admin\BlogController@getcats" )->name("admin.blog.getcats")->middleware('can:blogs'); 
			Route::post("/blog/sidebar", "Admin\BlogController@sidebar")->name( "admin.blog.sidebar" )->middleware('can:blogs'); 

			// Admin Blog Archive Routes 
			Route::get("/archives", "Admin\ArchiveController@index")->name( "admin.archive.index" )->middleware('can:archives'); 
			Route::post( "/archive/store", "Admin\ArchiveController@store" )->name("admin.archive.store")->middleware('can:archives'); 
			Route::post( "/archive/update", "Admin\ArchiveController@update" )->name("admin.archive.update")->middleware('can:archives'); 
			Route::post( "/archive/delete", "Admin\ArchiveController@delete" )->name("admin.archive.delete")->middleware('can:archives'); 

			// Admin Gallery Settings Routes 
			Route::get( "/gallery/settings", "Admin\GalleryCategoryController@settings" )->name("admin.gallery.settings")->middleware('can:settings-gallery'); 
			Route::post( "/gallery/update_settings", "Admin\GalleryCategoryController@updateSettings" )->name("admin.gallery.update_settings")->middleware('can:settings-gallery'); 

			// Admin Gallery Category Routes 
			Route::get( "/gallery/categories", "Admin\GalleryCategoryController@index" )->name("admin.gallery.categories")->middleware('can:categories-gallery');  
			Route::post( "/gallery/store_category", "Admin\GalleryCategoryController@store" )->name("admin.gallery.store_category")->middleware('can:categories-gallery');  
			Route::post( "/gallery/update_category", "Admin\GalleryCategoryController@update" )->name("admin.gallery.update_category")->middleware('can:categories-gallery');  
			Route::post( "/gallery/delete_category", "Admin\GalleryCategoryController@delete" )->name("admin.gallery.delete_category")->middleware('can:categories-gallery');  
			Route::post( "/gallery/bulk_delete_category", "Admin\GalleryCategoryController@bulkDelete" )->name("admin.gallery.bulk_delete_category")->middleware('can:categories-gallery'); 

			// Admin Gallery Routes 
			Route::get('/gallerys', 'Admin\GalleryCategoryController@getdata')->name('admin.gallerys')->middleware('can:galleries'); 
			Route::get("/gallery", "Admin\GalleryController@index")->name( "admin.gallery.index" )->middleware('can:galleries'); 
			Route::get( "/gallery/{langId}/get_categories", "Admin\GalleryController@getCategories" )->middleware('can:galleries'); 
			Route::post( "/gallery/store", "Admin\GalleryController@store" )->name("admin.gallery.store"); 
			Route::get( "/gallery/{id}/edit", "Admin\GalleryController@edit" )->name("admin.gallery.edit")->middleware('can:galleries'); 
			Route::post( "/gallery/update", "Admin\GalleryController@update" )->name("admin.gallery.update")->middleware('can:galleries'); 
			Route::post( "/gallery/delete", "Admin\GalleryController@delete" )->name("admin.gallery.delete")->middleware('can:galleries'); 
			Route::post( "/gallery/bulk-delete", "Admin\GalleryController@bulkDelete" )->name("admin.gallery.bulk.delete")->middleware('can:galleries'); 

			// Admin Leadership Category Routes 
			Route::get('/leadership_categories', 'admin\LeadershipController@index')->name('admin.leadership_category.index')->middleware('can:categories-leadership'); 
			Route::post('/leadership_category/store', 'admin\LeadershipController@store')->name('admin.leadership_category.store')->middleware('can:categories-leadership'); 
			Route::post('/leadership_category/update', 'admin\LeadershipController@update')->name('admin.leadership_category.update')->middleware('can:categories-leadership'); 
			Route::post('/leadership_category/delete', 'admin\LeadershipController@delete')->name('admin.leadership_category.delete')->middleware('can:categories-leadership'); 
			Route::post('/leadership_category/bulk_delete', 'admin\LeadershipController@bulkdelete')->name('admin.leadership_category.bulk_delete')->middleware('can:categories-leadership'); 

			// Admin Leadership Routes /gallery/{langId}/get_categories
			Route::get('/leadership', 'admin\leadershipcontroller@leadIndex')->name('admin.leadership.index')->middleware('can:leadership');  
			Route::get('/leadership/{langId}/get_categories', 'Admin\LeadershipController@getCategories')->name('get_leadcategory')->middleware('can:leadership');  
			Route::post('/leadership/store', 'admin\LeadershipController@leadstore')->name('admin.leadership.store')->middleware('can:leadership');  
			Route::get('/leadership/{id}/edit', 'admin\LeadershipController@leadEdit')->name('admin.leadership.edit')->middleware('can:leadership'); 
			Route::post('/leadership/update', 'admin\LeadershipController@leadupdate')->name('admin.leadership.update')->middleware('can:leadership'); 
			Route::post('/leadership/delete', 'admin\LeadershipController@leaddelete')->name('admin.leadership.delete')->middleware('can:leadership'); 
			Route::post('/leadership/bulk_delete', 'admin\LeadershipController@leadbulkdelete')->name('admin.leadership.bulk_delete')->middleware('can:leadership'); 


			// Admin FAQ Settings Routes 
			Route::get( "/faq/settings", "Admin\FAQCategoryController@settings" )->name("admin.faq.settings")->middleware('can:settings-faq');  
			Route::post( "/faq/update_settings", "Admin\FAQCategoryController@updateSettings" )->name("admin.faq.update_settings")->middleware('can:settings-faq');  

			// Admin FAQ Category Routes 
			Route::get( "/faq/categories", "Admin\FAQCategoryController@index" )->name("admin.faq.categories")->middleware('can:categories-faq');   
			Route::post( "/faq/store_category", "Admin\FAQCategoryController@store" )->name("admin.faq.store_category")->middleware('can:categories-faq');   
			Route::post( "/faq/update_category", "Admin\FAQCategoryController@update" )->name("admin.faq.update_category")->middleware('can:categories-faq');   
			Route::post( "/faq/delete_category", "Admin\FAQCategoryController@delete" )->name("admin.faq.delete_category")->middleware('can:categories-faq');   
			Route::post( "/faq/bulk_delete_category", "Admin\FAQCategoryController@bulkDelete" )->name("admin.faq.bulk_delete_category")->middleware('can:categories-faq'); 

			// Admin FAQ Routes 
			Route::get("/faqs", "Admin\FaqController@index")->name( "admin.faq.index" )->middleware('can:faqs'); 
			Route::get("/faq/create", "Admin\FaqController@create")->name( "admin.faq.create" )->middleware('can:faqs');
			Route::get( "/faq/{langId}/get_categories", "Admin\FaqController@getCategories" )->middleware('can:faqs');
			Route::post("/faq/store", "Admin\FaqController@store")->name( "admin.faq.store" )->middleware('can:faqs');
			Route::get("/faq/{id}/edit", "Admin\FaqController@edit")->name( "admin.faq.edit" )->middleware('can:faqs');
			Route::post("/faq/update", "Admin\FaqController@update")->name( "admin.faq.update" )->middleware('can:faqs');
			Route::post("/faq/delete", "Admin\FaqController@delete")->name( "admin.faq.delete" )->middleware('can:faqs');
			Route::post( "/faq/bulk-delete", "Admin\FaqController@bulkDelete" )->name("admin.faq.bulk.delete")->middleware('can:faqs');

			// Admin Job Category Routes 
			Route::get("/jcategorys", "Admin\JcategoryController@index")->name( "admin.jcategory.index" )->middleware('can:categories-career'); 
			Route::post( "/jcategory/store", "Admin\JcategoryController@store" )->name("admin.jcategory.store")->middleware('can:categories-career'); 
			Route::get( "/jcategory/{id}/edit", "Admin\JcategoryController@edit" )->name("admin.jcategory.edit")->middleware('can:categories-career'); 
			Route::post( "/jcategory/update", "Admin\JcategoryController@update" )->name("admin.jcategory.update")->middleware('can:categories-career'); 
			Route::post( "/jcategory/delete", "Admin\JcategoryController@delete" )->name("admin.jcategory.delete")->middleware('can:categories-career'); 
			Route::post( "/jcategory/bulk-delete", "Admin\JcategoryController@bulkDelete" )->name("admin.jcategory.bulk.delete")->middleware('can:categories-career'); 

			// Admin Jobs Routes 
			Route::get("/jobs", "Admin\JobController@index")->name( "admin.job.index" )->middleware('can:job-management'); 
			Route::get("/job/create", "Admin\JobController@create")->name( "admin.job.create" )->middleware('can:post-job'); 
			Route::post("/job/store", "Admin\JobController@store")->name( "admin.job.store" )->middleware('can:post-job'); 
			Route::get("/job/{id}/edit", "Admin\JobController@edit")->name( "admin.job.edit" )->middleware('can:job-management'); 
			Route::post("/job/update", "Admin\JobController@update")->name( "admin.job.update" )->middleware('can:job-management'); 
			Route::post("/job/delete", "Admin\JobController@delete")->name( "admin.job.delete" )->middleware('can:job-management'); 
			Route::post( "/job/bulk-delete", "Admin\JobController@bulkDelete" )->name("admin.job.bulk.delete")->middleware('can:job-management'); 
			Route::get( "/job/{langid}/getcats", "Admin\JobController@getcats" )->name("admin.job.getcats")->middleware('can:job-management');

			// Admin Contact Routes 
			Route::get("/contact", "Admin\ContactController@index")->name( "admin.contact.index" )->middleware('can:contact'); 
			Route::post( "/contact/{langid}/post", "Admin\ContactController@update" )->name("admin.contact.update")->middleware('can:contact'); 
			
			// Mega Menus Management Routes 
			Route::get( "/megamenus", "Admin\MenuBuilderController@megamenus" )->name("admin.megamenus")->middleware('can:mega-menus'); 
			Route::get( "/megamenus/edit", "Admin\MenuBuilderController@megaMenuEdit" )->name("admin.megamenu.edit")->middleware('can:mega-menus'); 
			Route::post( "/megamenus/update", "Admin\MenuBuilderController@megaMenuUpdate" )->name("admin.megamenu.update")->middleware('can:mega-menus'); 

			// Menus Builder Management Routes 
			Route::get( "/menu-builder", "Admin\MenuBuilderController@index" )->name("admin.menu_builder.index")->middleware('can:main-menus'); 
			Route::post( "/menu-builder/update", "Admin\MenuBuilderController@update" )->name("admin.menu_builder.update")->middleware('can:main-menus'); 

			// Permalinks Routes 
			Route::get( "/permalinks", "Admin\MenuBuilderController@permalinks" )->name("admin.permalinks.index")->middleware('can:permalinks');  
			Route::post( "/permalinks/update", "Admin\MenuBuilderController@permalinksUpdate" )->name("admin.permalinks.update")->middleware('can:permalinks'); 

			Route::get("popups", "Admin\PopupController@index")->name( "admin.popup.index" )->middleware('can:popups');   
			Route::get("popup/types", "Admin\PopupController@types")->name( "admin.popup.types" )->middleware('can:popups');   
			Route::get("popup/{id}/edit", "Admin\PopupController@edit")->name( "admin.popup.edit" )->middleware('can:popups');   
			Route::get("popup/create", "Admin\PopupController@create")->name( "admin.popup.create" )->middleware('can:popups');   
			Route::post("popup/store", "Admin\PopupController@store")->name( "admin.popup.store" )->middleware('can:popups');   
			Route::post("popup/delete", "Admin\PopupController@delete")->name( "admin.popup.delete" )->middleware('can:popups');   
			Route::post( "popup/bulk-delete", "Admin\PopupController@bulkDelete" )->name("admin.popup.bulk.delete")->middleware('can:popups');   
			Route::post("popup/status", "Admin\PopupController@status")->name( "admin.popup.status" )->middleware('can:popups');   
			Route::post("popup/update", "Admin\PopupController@update")->name( "admin.popup.update" )->middleware('can:popups');  

			// Menu Manager Routes 
			Route::get("/page/settings", "Admin\PageController@settings")->name( "admin.page.settings" )->middleware('can:settings-page'); 
			Route::post( "/page/update-settings", "Admin\PageController@updateSettings" )->name("admin.page.updateSettings")->middleware('can:settings-page'); 
			Route::get("/pages", "Admin\PageController@index")->name( "admin.page.index" )->middleware('can:pages');  
			Route::get("/page/create", "Admin\PageController@create")->name( "admin.page.create" )->middleware('can:create-page');
			Route::post("/page/store", "Admin\PageController@store")->name( "admin.page.store" )->middleware('can:create-page');
			Route::get( "/page/{menuID}/edit", "Admin\PageController@edit" )->name("admin.page.edit")->middleware('can:pages'); 
			Route::post("/page/update", "Admin\PageController@update")->name( "admin.page.update" )->middleware('can:pages'); 
			Route::post("/page/delete", "Admin\PageController@delete")->name( "admin.page.delete" )->middleware('can:pages'); 
			Route::post( "/page/bulk-delete", "Admin\PageController@bulkDelete" )->name("admin.page.bulk.delete")->middleware('can:pages'); 
			Route::post( "/upload/pagebuilder", "Admin\PageController@uploadPbImage" )->name("admin.pb.upload")->middleware('can:pages'); 
			Route::post( "/remove/img/pagebuilder", "Admin\PageController@removePbImage" )->name("admin.pb.remove")->middleware('can:pages'); 
			Route::post( "/upload/tui/pagebuilder", "Admin\PageController@uploadPbTui")->name("admin.pb.tui.upload")->middleware('can:pages');
			// Page Builder Routes 
			Route::get( "/pagebuilder/content", "Admin\PageBuilderController@content" )->name("admin.pagebuilder.content")->middleware('can:pages'); 
			Route::post( "/pagebuilder/save", "Admin\PageBuilderController@save" )->name("admin.pagebuilder.save")->middleware('can:pages'); 

			Route::get("/category", "Admin\ProductCategory@index")->name( "admin.category.index" )->middleware('can:category-product'); 
			Route::post("/category/store", "Admin\ProductCategory@store")->name( "admin.category.store" )->middleware('can:category-product');  
			Route::get( "/category/{id}/edit", "Admin\ProductCategory@edit" )->name("admin.category.edit")->middleware('can:category-product');  
			Route::post( "/category/update", "Admin\ProductCategory@update" )->name("admin.category.update")->middleware('can:category-product');  
			Route::post( "/category/feature", "Admin\ProductCategory@feature" )->name("admin.category.feature")->middleware('can:category-product');  
			Route::post("/category/home", "Admin\ProductCategory@home")->name( "admin.category.home" )->middleware('can:category-product');  
			Route::post( "/category/delete", "Admin\ProductCategory@delete" )->name("admin.category.delete")->middleware('can:category-product');  
			Route::post( "/category/bulk-delete", "Admin\ProductCategory@bulkDelete" )->name("admin.pcategory.bulk.delete")->middleware('can:category-product');  

			Route::get("/shipping", "Admin\ShopSettingController@index")->name( "admin.shipping.index" )->middleware('can:shipping-charges');  
			Route::post( "/shipping/store", "Admin\ShopSettingController@store" )->name("admin.shipping.store")->middleware('can:shipping-charges');  
			Route::get( "/shipping/{id}/edit", "Admin\ShopSettingController@edit" )->name("admin.shipping.edit")->middleware('can:shipping-charges');  
			Route::post( "/shipping/update", "Admin\ShopSettingController@update" )->name("admin.shipping.update")->middleware('can:shipping-charges');  
			Route::post( "/shipping/delete", "Admin\ShopSettingController@delete" )->name("admin.shipping.delete")->middleware('can:shipping-charges');  

			Route::get("/product", "Admin\ProductController@index")->name( "admin.product.index" )->middleware('can:products');
			Route::get("/product/type", "Admin\ProductController@type")->name( "admin.product.type" )->middleware('can:products'); 
			Route::get( "/product/create", "Admin\ProductController@create" )->name("admin.product.create")->middleware('can:products'); 
			Route::post( "/product/store", "Admin\ProductController@store" )->name("admin.product.store")->middleware('can:products'); 
			Route::get( "/product/{id}/edit", "Admin\ProductController@edit" )->name("admin.product.edit")->middleware('can:products'); 
			Route::post( "/product/update", "Admin\ProductController@update" )->name("admin.product.update")->middleware('can:products'); 
			Route::post( "/product/feature", "Admin\ProductController@feature" )->name("admin.product.feature")->middleware('can:products'); 
			Route::post( "/product/delete", "Admin\ProductController@delete" )->name("admin.product.delete")->middleware('can:products'); 
			Route::get( "/product/populer/tags/", "Admin\ProductController@populerTag" )->name("admin.product.tags")->middleware('can:popular-tags');
			Route::post( "/product/populer/tags/update", "Admin\ProductController@populerTagupdate" )->name("admin.popular-tag.update")->middleware('can:popular-tags'); 
			Route::post( "/product/paymentStatus", "Admin\ProductController@paymentStatus" )->name("admin.product.paymentStatus")->middleware('can:products');  
			Route::get( "product/{id}/getcategory", "Admin\ProductController@getCategory" )->name("admin.product.getcategory")->middleware('can:products');  
			Route::post( "/product/bulk-delete", "Admin\ProductController@bulkDelete" )->name("admin.product.bulk.delete")->middleware('can:products');  
			Route::post( "/product/sliderupdate", "Admin\ProductController@sliderupdate" )->name("admin.product.sliderupdate")->middleware('can:products');  
			Route::post( "/product/{id}/uploadUpdate", "Admin\ProductController@uploadUpdate" )->name("admin.product.uploadUpdate")->middleware('can:products');  
			Route::get( "/product/{id}/images", "Admin\ProductController@images" )->name("admin.product.images")->middleware('can:products');  
			Route::get( "/product/settings", "Admin\ProductController@settings" )->name("admin.product.settings")->middleware('can:settings-shop');  
			Route::post( "/product/settings", "Admin\ProductController@updateSettings" )->name("admin.product.settings")->middleware('can:settings-shop');  

			// Admin Coupon Routes 
			Route::get("/coupon", "Admin\CouponController@index")->name( "admin.coupon.index" )->middleware('can:coupons');   
			Route::post("/coupon/store", "Admin\CouponController@store")->name( "admin.coupon.store" )->middleware('can:coupons');   
			Route::get( "/coupon/{id}/edit", "Admin\CouponController@edit" )->name("admin.coupon.edit")->middleware('can:coupons');   
			Route::post( "/coupon/update", "Admin\CouponController@update" )->name("admin.coupon.update")->middleware('can:coupons');   
			Route::post( "/coupon/delete", "Admin\CouponController@delete" )->name("admin.coupon.delete")->middleware('can:coupons');   
			// Admin Coupon Routes End 

			// Product Order 
			Route::get("/product/all/orders", "Admin\ProductOrderController@all" )->name("admin.all.product.orders")->middleware('can:products');  
			Route::get( "/product/pending/orders", "Admin\ProductOrderController@pending" )->name("admin.pending.product.orders")->middleware('can:products');   
			Route::get( "/product/processing/orders", "Admin\ProductOrderController@processing" )->name("admin.processing.product.orders")->middleware('can:products');   
			Route::get( "/product/completed/orders", "Admin\ProductOrderController@completed" )->name("admin.completed.product.orders")->middleware('can:products');   
			Route::get( "/product/rejected/orders", "Admin\ProductOrderController@rejected" )->name("admin.rejected.product.orders")->middleware('can:products');   
			Route::post( "/product/orders/status", "Admin\ProductOrderController@status" )->name("admin.product.orders.status")->middleware('can:products');   
			Route::get( "/product/orders/detais/{id}", "Admin\ProductOrderController@details" )->name("admin.product.details")->middleware('can:products');   
			Route::post( "/product/order/delete", "Admin\ProductOrderController@orderDelete" )->name("admin.product.order.delete")->middleware('can:products');   
			Route::post( "/product/order/bulk-delete", "Admin\ProductOrderController@bulkOrderDelete" )->name("admin.product.order.bulk.delete")->middleware('can:products');   
			Route::get("/product/orders/report", "Admin\ProductOrderController@report")->name("admin.orders.report")->middleware('can:products');  
			Route::get("/product/export/report", "Admin\ProductOrderController@exportReport")->name("admin.orders.export")->middleware('can:products');   

			// Product Order end//Event Manage Routes 
			Route::get( "/event/categories", "Admin\EventCategoryController@index" )->name("admin.event.category.index")->middleware('can:categories-event');   
			Route::post( "/event/category/store", "Admin\EventCategoryController@store" )->name("admin.event.category.store")->middleware('can:categories-event');    
			Route::post( "/event/category/update", "Admin\EventCategoryController@update" )->name("admin.event.category.update")->middleware('can:categories-event');    
			Route::post( "/event/category/delete", "Admin\EventCategoryController@delete" )->name("admin.event.category.delete")->middleware('can:categories-event');    
			Route::post( "/event/categories/bulk-delete", "Admin\EventCategoryController@bulkDelete" )->name("admin.event.category.bulk.delete")->middleware('can:categories-event');    

			// Admin Event Routes 
			Route::get( "/event/settings", "Admin\EventController@settings" )->name("admin.event.settings")->middleware('can:settings-event');  
			Route::post( "/event/settings", "Admin\EventController@updateSettings" )->name("admin.event.settings")->middleware('can:settings-event'); 

			Route::get("/events", "Admin\EventController@index")->name( "admin.event.index" )->middleware('can:all-events');  
			Route::post("/event/upload", "Admin\EventController@upload")->name( "admin.event.upload" )->middleware('can:all-events');   
			Route::post( "/event/slider/remove", "Admin\EventController@sliderRemove" )->name("admin.event.slider-remove")->middleware('can:all-events');   
			Route::post("/event/store", "Admin\EventController@store")->name( "admin.event.store" )->middleware('can:all-events');   
			Route::get("/event/{id}/edit", "Admin\EventController@edit")->name( "admin.event.edit" )->middleware('can:all-events');   
			Route::get( "/event/{id}/images", "Admin\EventController@images" )->name("admin.event.images")->middleware('can:all-events');   
			Route::post("/event/update", "Admin\EventController@update")->name( "admin.event.update" )->middleware('can:all-events');   
			Route::post( "/event/{id}/uploadUpdate", "Admin\EventController@uploadUpdate" )->name("admin.event.uploadUpdate")->middleware('can:all-events');   
			Route::post("/event/delete", "Admin\EventController@delete")->name( "admin.event.delete" )->middleware('can:all-events');   
			Route::post( "/event/bulk-delete", "Admin\EventController@bulkDelete" )->name("admin.event.bulk.delete")->middleware('can:all-events');  
			Route::get( "/event/{lang_id}/get-categories", "Admin\EventController@getCategories" )->name("admin.event.get-categories")->middleware('can:all-events');   
			Route::get("/events/payment-log", "Admin\EventController@paymentLog" )->name("admin.event.payment.log")->middleware('can:booking');   
			Route::post("/events/payment-log/delete", "Admin\EventController@paymentLogDelete" )->name("admin.event.payment.delete")->middleware('can:booking');   
			Route::post("/events/payment/bulk-delete", "Admin\EventController@paymentLogBulkDelete" )->name("admin.event.payment.bulk.delete")->middleware('can:booking');   
			Route::post( "/events/payment-log-update", "Admin\EventController@paymentLogUpdate" )->name("admin.event.payment.log.update")->middleware('can:booking');   
			Route::get("/events/report", "Admin\EventController@report")->name( "admin.event.report" )->middleware('can:report-event');   
			Route::get( "/events/export", "Admin\EventController@exportReport" )->name("admin.event.export")->middleware('can:report-event');   

			//Donation Manage Routes 
			Route::get("/donation/settings", "Admin\DonationController@settings" )->name("admin.donation.settings")->middleware('can:settings-donation');  
			Route::post( "/donation/settings", "Admin\DonationController@updateSettings")->name("admin.donation.settings")->middleware('can:settings-donation');  
			Route::get("/donations", "Admin\DonationController@index")->name( "admin.donation.index" )->middleware('can:donations');
			Route::post( "/donation/store", "Admin\DonationController@store" )->name("admin.donation.store")->middleware('can:donations'); 
			Route::get( "/donation/{id}/edit", "Admin\DonationController@edit" )->name("admin.donation.edit")->middleware('can:donations'); 
			Route::post( "/donation/update", "Admin\DonationController@update" )->name("admin.donation.update")->middleware('can:donations'); 
			Route::post( "/donation/{id}/uploadUpdate", "Admin\DonationController@uploadUpdate" )->name("admin.donation.uploadUpdate")->middleware('can:donations'); 
			Route::post( "/donation/delete", "Admin\DonationController@delete" )->name("admin.donation.delete")->middleware('can:donations'); 
			Route::post( "/donation/bulk-delete", "Admin\DonationController@bulkDelete" )->name("admin.donation.bulk.delete")->middleware('can:donations'); 
			Route::get( "/donations/payment-log", "Admin\DonationController@paymentLog" )->name("admin.donation.payment.log")->middleware('can:donations'); 
			Route::post( "/donations/payment/delete", "Admin\DonationController@paymentDelete" )->name("admin.donation.payment.delete")->middleware('can:donations'); 
			Route::post( "/donations/bulk/delete", "Admin\DonationController@bulkPaymentDelete" )->name("admin.donation.payment.bulk.delete")->middleware('can:donations'); 
			Route::post( "/donations/payment-log-update", "Admin\DonationController@paymentLogUpdate" )->name("admin.donation.payment.log.update")->middleware('can:donations'); 
			Route::get( "/donation/report", "Admin\DonationController@report" )->name("admin.donation.report")->middleware('can:report-donation'); 
			Route::get( "/donation/export", "Admin\DonationController@exportReport" )->name("admin.donation.export")->middleware('can:report-donation');

			// Admin Event Calendar Routes 
			Route::get("/news", "Admin\CalendarController@index")->name( "admin.news.index" )->middleware('can:news');    
			Route::post( "/news/store", "Admin\CalendarController@store" )->name("admin.news.store")->middleware('can:news');    
			Route::post( "/news/update", "Admin\CalendarController@update" )->name("admin.news.update")->middleware('can:news');    
			Route::get( "/news/{id}/edit", "Admin\CalendarController@edit" )->name("admin.news.edit")->middleware('can:news');    
			Route::post( "/news/delete", "Admin\CalendarController@delete" )->name("admin.news.delete")->middleware('can:news');    
			Route::post( "/news/bulk-delete", "Admin\CalendarController@bulkDelete" )->name("admin.news.bulk.delete")->middleware('can:news');

			Route::get("/news/img", "Admin\CalendarController@img")->name( "admin.news.img" )->middleware('can:news'); 

			// Admin Article Category Routes 
			Route::get( "/article_categories", "Admin\ArticleCategoryController@index" )->name("admin.article_category.index")->middleware('can:categories-acknowledged');  
			Route::post( "/article_category/store", "Admin\ArticleCategoryController@store" )->name("admin.article_category.store")->middleware('can:categories-acknowledged');   
			Route::post( "/article_category/update", "Admin\ArticleCategoryController@update" )->name("admin.article_category.update")->middleware('can:categories-acknowledged');   
			Route::post( "/article_category/delete", "Admin\ArticleCategoryController@delete" )->name("admin.article_category.delete")->middleware('can:categories-acknowledged');   
			Route::post( "/article_category/bulk_delete", "Admin\ArticleCategoryController@bulkDelete" )->name("admin.article_category.bulk_delete")->middleware('can:categories-acknowledged');  

			// Admin Article Routes 
			Route::get("/articles", "Admin\ArticleController@index")->name( "admin.article.index" )->middleware('can:articles');   
			Route::get( "/article/{langId}/get_categories", "Admin\ArticleController@getCategories" )->middleware('can:articles');   
			Route::post( "/article/store", "Admin\ArticleController@store" )->name("admin.article.store")->middleware('can:articles');   
			Route::get("/article/{id}/edit", "Admin\ArticleController@edit" )->name("admin.article.edit")->middleware('can:articles');   
			Route::post( "/article/update", "Admin\ArticleController@update" )->name("admin.article.update")->middleware('can:articles');   
			Route::post( "/article/delete", "Admin\ArticleController@delete" )->name("admin.article.delete")->middleware('can:articles');   
			Route::post( "/article/bulk_delete", "Admin\ArticleController@bulkDelete" )->name("admin.article.bulk_delete")->middleware('can:articles');  

			// Admin Course Category Routes 
			Route::get( "/course_categories", "Admin\CourseCategoryController@index" )->name("admin.course_category.index")->middleware('can:categories-course'); 
			Route::post( "/course_category/store", "Admin\CourseCategoryController@store" )->name("admin.course_category.store")->middleware('can:categories-course'); 
			Route::post( "/course_category/update", "Admin\CourseCategoryController@update" )->name("admin.course_category.update")->middleware('can:categories-course'); 
			Route::post( "/course_category/delete", "Admin\CourseCategoryController@delete" )->name("admin.course_category.delete")->middleware('can:categories-course'); 
			Route::post( "/course_category/bulk_delete", "Admin\CourseCategoryController@bulkDelete" )->name("admin.course_category.bulk_delete")->middleware('can:categories-course'); 

			// Admin Course Routes 
			Route::get("/courses", "Admin\CourseController@index")->name( "admin.course.index" )->middleware('can:courses');  
			Route::get("/course/create", "Admin\CourseController@create")->name( "admin.course.create" )->middleware('can:courses');  
			Route::get("/course/{langId}/get_categories", "Admin\CourseController@getCategories" )->middleware('can:courses');  
			Route::post("/course/store", "Admin\CourseController@store")->name( "admin.course.store" )->middleware('can:courses');  
			Route::get("/course/{id}/edit", "Admin\CourseController@edit" )->name("admin.course.edit")->middleware('can:courses');  
			Route::post("/course/update", "Admin\CourseController@update" )->name("admin.course.update")->middleware('can:courses');  
			Route::post("/course/delete", "Admin\CourseController@delete" )->name("admin.course.delete")->middleware('can:courses');  
			Route::post("/course/bulk_delete","Admin\CourseController@bulkDelete")->name("admin.course.bulk_delete")->middleware('can:courses'); 
			Route::post( "/course/featured", "Admin\CourseController@featured" )->name("admin.course.featured")->middleware('can:courses');  
			Route::get( "/course/purchase-log", "Admin\CourseController@purchaseLog" )->name("admin.course.purchaseLog")->middleware('can:courses');  
			Route::post( "/course/purchase/payment-status", "Admin\CourseController@purchasePaymentStatus" )->name("admin.course.purchasePaymentStatus")->middleware('can:courses');  
			Route::post( "/course/purchase/delete", "Admin\CourseController@purchaseDelete" )->name("admin.course.purchase.delete")->middleware('can:courses');  
			Route::post( "/course/purchase/delete", "Admin\CourseController@purchaseDelete" )->name("admin.course.purchaseDelete")->middleware('can:courses');  
			Route::post( "/course/purchase/bulk_delete", "Admin\CourseController@purchaseBulkOrderDelete" )->name("admin.course.purchaseBulkOrderDelete")->middleware('can:courses'); 

			// Admin Course Modules Routes 
			Route::get("/course/{id?}/modules", "Admin\ModuleController@index")->name("admin.course.module.index")->middleware('can:courses');
			Route::post("/course/module/store", "Admin\ModuleController@store")->name("admin.course.module.store")->middleware('can:courses');
			Route::post("/course/module/update", "Admin\ModuleController@update")->name("admin.course.module.update")->middleware('can:courses'); 
			Route::post("/course/module/delete", "Admin\ModuleController@delete")->name("admin.course.module.delete")->middleware('can:courses');
			Route::post( "/course/module/bulk_delete", "Admin\ModuleController@bulkDelete" )->name("admin.course.module.bulk_delete")->middleware('can:courses'); 

			// Admin Module Lessons Routes 
			Route::get( "/module/{id}/lessons", "Admin\LessonController@index" )->name("admin.module.lesson.index")->middleware('can:courses'); 
			Route::post( "/module/lesson/store", "Admin\LessonController@store" )->name("admin.module.lesson.store")->middleware('can:courses');
			Route::post("module/lesson/update", "Admin\LessonController@update")->name("admin.module.lesson.update")->middleware('can:courses');
			Route::post("/module/lesson/delete", "Admin\LessonController@delete")->name("admin.module.lesson.delete")->middleware('can:courses'); 
			Route::post( "/module/lesson/bulk_delete", "Admin\LessonController@bulkDelete" )->name("admin.module.lesson.bulk_delete")->middleware('can:courses'); 
			Route::get( "/course/settings", "Admin\CourseController@settings" )->name("admin.course.settings")->middleware('can:settings-course'); 
			Route::post("/course/settings", "Admin\CourseController@updateSettings")->name("admin.course.settings")->middleware('can:settings-course'); 

			// Admin Course Enroll Report Routes 
			Route::get( "/course/enrolls/report", "Admin\CourseController@report" )->name("admin.enrolls.report")->middleware('can:report-course');  
			Route::get("/course/export/report", "Admin\CourseController@exportReport")->name("admin.enrolls.export")->middleware('can:report-course');  

			// Admin RSS feed Routes 
			Route::get("/rss", "Admin\RssFeedsController@index")->name( "admin.rss.index" )->middleware('can:rss-feeds'); 
			Route::get("/rss/feeds", "Admin\RssFeedsController@feed")->name( "admin.rss.feed" )->middleware('can:rss-posts'); 
			Route::get("/rss/create", "Admin\RssFeedsController@create")->name( "admin.rss.create" )->middleware('can:import-rss'); 
			Route::post("/rss", "Admin\RssFeedsController@store")->name( "admin.rss.store" )->middleware('can:import-rss'); 
			Route::get("/rss/edit/{id}", "Admin\RssFeedsController@edit")->name( "admin.rss.edit" )->middleware('can:rss-feeds'); 
			Route::post("/rss/update", "Admin\RssFeedsController@update")->name( "admin.rss.update" )->middleware('can:rss-feeds'); 
			Route::post( "/rss/delete", "Admin\RssFeedsController@rssdelete" )->name("admin.rssfeed.delete")->middleware('can:rss-feeds'); 
			Route::post( "/rss/feed/delete", "Admin\RssFeedsController@delete" )->name("admin.rss.delete")->middleware('can:rss-feeds'); 
			Route::post( "/rss-posts/bulk/delete", "Admin\RssFeedsController@bulkDelete" )->name("admin.rss.bulk.delete")->middleware('can:rss-feeds'); 
			Route::get("rss-feed/update/{id}", "Admin\RssFeedsController@feedUpdate" )->name("admin.rss.feedUpdate")->middleware('can:rss-feeds'); 
			Route::get("rss-feed/cronJobUpdate", "Admin\RssFeedsController@cronJobUpdate")->name("rss.cronJobUpdate")->middleware('can:rss-feeds'); 

			// Register User start 
			Route::get( "register/users", "Admin\RegisterUserController@index" )->name("admin.register.user")->middleware('can:register-users'); 
			Route::post( "register/users/ban", "Admin\RegisterUserController@userban" )->name("register.user.ban")->middleware('can:register-users'); 
			Route::post( "register/users/email", "Admin\RegisterUserController@emailStatus" )->name("register.user.email")->middleware('can:register-users'); 
			Route::get("register/user/details/{id}", "Admin\RegisterUserController@view")->name("register.user.view")->middleware('can:register-users'); 
			Route::post("register/user/delete", "Admin\RegisterUserController@delete")->name("register.user.delete")->middleware('can:register-users');
			Route::post( "register/user/bulk-delete", "Admin\RegisterUserController@bulkDelete" )->name("register.user.bulk.delete")->middleware('can:register-users'); 
			Route::get( "register/user/{id}/changePassword", "Admin\RegisterUserController@changePass" )->name("register.user.changePass")->middleware('can:register-users'); 
			Route::post( "register/user/updatePassword", "Admin\RegisterUserController@updatePassword" )->name("register.user.updatePassword")->middleware('can:register-users'); 
			//Register User end 

			// Admin Push Notification Routes 
			Route::get( "/pushnotification/settings", "Admin\PushController@settings" )->name("admin.pushnotification.settings")->middleware('can:push-notification'); 
			Route::post( "/pushnotification/update/settings", "Admin\PushController@updateSettings" )->name("admin.pushnotification.updateSettings")->middleware('can:push-notification'); 
			Route::get( "/pushnotification/send", "Admin\PushController@send" )->name("admin.pushnotification.send")->middleware('can:push-notification');
			Route::post("/push", "Admin\PushController@push")->name( "admin.pushnotification.push" )->middleware('can:push-notification'); 

			// Admin Subscriber Routes 
			Route::get( "/subscribers", "Admin\SubscriberController@index" )->name("admin.subscriber.index")->middleware('can:subscribers'); 
			Route::get("/mailsubscriber", "Admin\SubscriberController@mailsubscriber")->name("admin.mailsubscriber")->middleware('can:subscribers');
			Route::post( "/subscribers/sendmail", "Admin\SubscriberController@subscsendmail" )->name("admin.subscribers.sendmail")->middleware('can:subscribers'); 
			Route::post("/subscriber/delete", "Admin\SubscriberController@delete")->name("admin.subscriber.delete")->middleware('can:subscribers'); 
			Route::post( "/subscriber/bulk-delete", "Admin\SubscriberController@bulkDelete" )->name("admin.subscriber.bulk.delete")->middleware('can:subscribers');

			// Admin Support Ticket Routes 
			Route::get("/all/tickets", "Admin\TicketController@all")->name( "admin.tickets.all" )->middleware('can:all-tickets'); 
			Route::get( "/pending/tickets", "Admin\TicketController@pending" )->name("admin.tickets.pending")->middleware('can:pending-tickets'); 
			Route::get("/open/tickets", "Admin\TicketController@open")->name( "admin.tickets.open" )->middleware('can:open-tickets'); 
			Route::get( "/closed/tickets", "Admin\TicketController@closed" )->name("admin.tickets.closed")->middleware('can:close-tickets'); 
			Route::get( "/ticket/messages/{id}", "Admin\TicketController@messages" )->name("admin.ticket.messages")->middleware('can:all-tickets'); 
			Route::post("/zip-file/upload/", "Admin\TicketController@zip_file_upload")->name("admin.zip_file.upload")->middleware('can:all-tickets'); 
			Route::post( "/ticket/reply/{id}", "Admin\TicketController@ticketReply" )->name("admin.ticket.reply")->middleware('can:all-tickets'); 
			Route::get( "/ticket/close/{id}", "Admin\TicketController@ticketclose" )->name("admin.ticket.close")->middleware('can:all-tickets'); 
			Route::post("/ticket/assign/staff", "Admin\TicketController@ticketAssign")->name("ticket.assign.staff")->middleware('can:all-tickets'); 
			Route::get( "/ticket/settings", "Admin\TicketController@settings" )->name("admin.ticket.settings")->middleware('can:settings-tickets'); 
			Route::post("/ticket/settings", "Admin\TicketController@updateSettings")->name("admin.ticket.settings")->middleware('can:settings-tickets');
			
			// Admin Package Form Builder Routes 
			Route::get( "/package/settings", "Admin\PackageController@settings" )->name("admin.package.settings")->middleware('can:settings-package'); 
			Route::post( "/package/settings", "Admin\PackageController@updateSettings" )->name("admin.package.settings")->middleware('can:settings-package'); 

			// Admin Package Category Routes 
			Route::get( "/package/categories", "Admin\PackageCategoryController@index" )->name("admin.package.categories")->middleware('can:categories-package'); 
			Route::post( "/package/store_category", "Admin\PackageCategoryController@store" )->name("admin.package.store_category")->middleware('can:categories-package'); 
			Route::post( "/package/update_category", "Admin\PackageCategoryController@update" )->name("admin.package.update_category")->middleware('can:categories-package'); 
			Route::post( "/package/delete_category", "Admin\PackageCategoryController@delete" )->name("admin.package.delete_category")->middleware('can:categories-package'); 
			Route::post( "/package/bulk_delete_category", "Admin\PackageCategoryController@bulkDelete" )->name("admin.package.bulk_delete_category")->middleware('can:categories-package'); 
			Route::get("/package/form", "Admin\PackageController@form")->name( "admin.package.form" )->middleware('can:form-builder-package'); 
			Route::post( "/package/form/store", "Admin\PackageController@formstore" )->name("admin.package.form.store")->middleware('can:form-builder-package'); 
			Route::post( "/package/inputDelete", "Admin\PackageController@inputDelete" )->name("admin.package.inputDelete")->middleware('can:form-builder-package'); 
			Route::get( "/package/{id}/inputEdit", "Admin\PackageController@inputEdit" )->name("admin.package.inputEdit")->middleware('can:form-builder-package'); 
			Route::get( "/package/{id}/options", "Admin\PackageController@options" )->name("admin.package.options")->middleware('can:form-builder-package'); 
			Route::post( "/package/inputUpdate", "Admin\PackageController@inputUpdate" )->name("admin.package.inputUpdate")->middleware('can:form-builder-package'); 
			Route::post( "/package/feature", "Admin\PackageController@feature" )->name("admin.package.feature")->middleware('can:form-builder-package'); 
			// Admin Packages Routes 
			Route::get("/packages", "Admin\PackageController@index")->name( "admin.package.index" )->middleware('can:packages');  
			Route::get( "/package/{langId}/get_categories", "Admin\PackageController@getCategories" )->middleware('can:packages');  
			Route::post( "/package/store", "Admin\PackageController@store" )->name("admin.package.store")->middleware('can:packages');  
			Route::get( "/package/{id}/edit", "Admin\PackageController@edit" )->name("admin.package.edit")->middleware('can:packages');  
			Route::post( "/package/update", "Admin\PackageController@update" )->name("admin.package.update")->middleware('can:packages');  
			Route::post( "/package/delete", "Admin\PackageController@delete" )->name("admin.package.delete")->middleware('can:packages');  
			Route::post( "/package/bulk-delete", "Admin\PackageController@bulkDelete" )->name("admin.package.bulk.delete")->middleware('can:packages');  
			Route::post( "/package/payment-status", "Admin\PackageController@paymentStatus" )->name("admin.package.paymentStatus")->middleware('can:packages');

			// Admin Package Orders Routes 
			Route::get("/all/orders", "Admin\PackageController@all")->name( "admin.all.orders" )->middleware('can:all-orders');   
			Route::get( "/pending/orders", "Admin\PackageController@pending" )->name("admin.pending.orders")->middleware('can:pending-orders');   
			Route::get("/processing/orders", "Admin\PackageController@processing")->name("admin.processing.orders")->middleware('can:processing-orders');   
			Route::get( "/completed/orders", "Admin\PackageController@completed" )->name("admin.completed.orders")->middleware('can:completed-orders');   
			Route::get( "/rejected/orders", "Admin\PackageController@rejected" )->name("admin.rejected.orders")->middleware('can:rejected-orders');   
			Route::post( "/orders/status", "Admin\PackageController@status" )->name("admin.orders.status")->middleware('can:all-orders');   
			Route::post("/orders/mail", "Admin\PackageController@mail")->name( "admin.orders.mail" )->middleware('can:all-orders');   
			Route::post( "/package/order/delete", "Admin\PackageController@orderDelete" )->name("admin.package.order.delete")->middleware('can:all-orders');   
			Route::post( "/order/bulk-delete", "Admin\PackageController@bulkOrderDelete" )->name("admin.order.bulk.delete")->middleware('can:all-orders');   
			Route::get( "/package/order/report", "Admin\PackageController@report" )->name("admin.package.report")->middleware('can:report-order');   
			Route::get( "/package/order/export", "Admin\PackageController@exportReport" )->name("admin.package.export")->middleware('can:report-order');   

			// Admin Subscription Routes 
			Route::get("/subscriptions", "Admin\SubscriptionController@subscriptions")->name("admin.subscriptions")->middleware('can:subscriptions');   
			Route::get( "/subscription/requests", "Admin\SubscriptionController@requests" )->name("admin.requests.subscriptions")->middleware('can:subscription-request');   
			Route::post("/subscription/mail", "Admin\SubscriptionController@mail")->name("admin.subscription.mail")->middleware('can:subscriptions');   
			Route::post( "/package/subscription/delete", "Admin\SubscriptionController@subDelete" )->name("admin.package.subDelete")->middleware('can:subscriptions');   
			Route::post( "/package/subscription/status", "Admin\SubscriptionController@status" )->name("admin.subscription.status")->middleware('can:subscriptions');   
			Route::post( "/sub/bulk-delete", "Admin\SubscriptionController@bulkSubDelete" )->name("admin.sub.bulk.delete")->middleware('can:subscriptions');  


			// Admin History Routes 

			Route::get("/history", "Admin\HistoryController@index")->name("admin.index");
			Route::post("/history/store", "Admin\HistoryController@store")->name("admin.history.store");
			Route::get("/history/{id}/edit", "Admin\HistoryController@edit")->name("admin.history.edit");
			Route::post("/history/update", "Admin\HistoryController@update")->name("admin.history.update");


			// Admin Quote Form Builder Routes 
			Route::get( "/quote/visibility", "Admin\QuoteController@visibility" )->name("admin.quote.visibility")->middleware('can:visibility');  
			Route::post( "/quote/visibility/update", "Admin\QuoteController@updateVisibility" )->name("admin.quote.visibility.update")->middleware('can:visibility');  
			Route::get("/quote/form", "Admin\QuoteController@form")->name( "admin.quote.form" )->middleware('can:form-builder-quote');  
			Route::post( "/quote/form/store", "Admin\QuoteController@formstore" )->name("admin.quote.form.store")->middleware('can:form-builder-quote');  
			Route::post("/quote/inputDelete", "Admin\QuoteController@inputDelete")->name("admin.quote.inputDelete")->middleware('can:form-builder-quote');  
			Route::get( "/quote/{id}/inputEdit", "Admin\QuoteController@inputEdit" )->name("admin.quote.inputEdit")->middleware('can:form-builder-quote');  
			Route::get( "/quote/{id}/options", "Admin\QuoteController@options" )->name("admin.quote.options")->middleware('can:form-builder-quote');  
			Route::post("/quote/inputUpdate", "Admin\QuoteController@inputUpdate")->name("admin.quote.inputUpdate")->middleware('can:form-builder-quote');  
			Route::post("/quote/delete", "Admin\QuoteController@delete")->name( "admin.quote.delete" )->middleware('can:form-builder-quote');  
			Route::post("/quote/bulk-delete", "Admin\QuoteController@bulkDelete")->name("admin.quote.bulk.delete")->middleware('can:form-builder-quote');  
			// Admin Quote Routes 
			Route::get("/all/quotes", "Admin\QuoteController@all")->name( "admin.all.quotes" )->middleware('can:all-quotes');  
			Route::get( "/pending/quotes", "Admin\QuoteController@pending" )->name("admin.pending.quotes")->middleware('can:pending-quotes');  
			Route::get( "/processing/quotes", "Admin\QuoteController@processing" )->name("admin.processing.quotes")->middleware('can:processing-quotes');  
			Route::get( "/completed/quotes", "Admin\QuoteController@completed" )->name("admin.completed.quotes")->middleware('can:completed-quotes');  
			Route::get( "/rejected/quotes", "Admin\QuoteController@rejected" )->name("admin.rejected.quotes")->middleware('can:rejected-quotes');  
			Route::post("/quotes/status", "Admin\QuoteController@status")->name( "admin.quotes.status" )->middleware('can:all-quotes');  
			Route::post("/quote/mail", "Admin\QuoteController@mail")->name( "admin.quotes.mail" )->middleware('can:all-quotes'); 
			

			// Admin Roles Routes 
			Route::get("/roles", "Admin\RoleController@index")->name( "admin.role.index" )->middleware('can:roles'); 
			Route::post("/role/store", "Admin\RoleController@store")->name( "admin.role.store" )->middleware('can:roles'); 
			Route::post("/role/update", "Admin\RoleController@update")->name( "admin.role.update" )->middleware('can:roles'); 
			Route::post("/role/delete", "Admin\RoleController@delete")->name( "admin.role.delete" )->middleware('can:roles'); 
			Route::get( "role/{id}/permissions/manage", "Admin\RoleController@managePermissions" )->name("admin.role.permissions.manage")->middleware('can:roles'); 
			Route::post( "role/permissions/update", "Admin\RoleController@updatePermissions" )->name("admin.role.permissions.update")->middleware('can:roles');

			// Admin Users Routes 
			Route::get("/users", "Admin\UserController@index")->name( "admin.user.index" )->middleware('can:admins');
			Route::post("/user/store", "Admin\UserController@store")->name( "admin.user.store" )->middleware('can:admins');  
			Route::get("/user/{id}/edit", "Admin\UserController@edit")->name( "admin.user.edit" )->middleware('can:admins');  
			Route::post("/user/update", "Admin\UserController@update")->name( "admin.user.update" )->middleware('can:admins');  
			Route::post("/user/delete", "Admin\UserController@delete")->name( "admin.user.delete" )->middleware('can:admins'); 

			// Admin Users Routes 
			Route::get("/e-governance", "Admin\EGovernanceController@index")->name( "admin.egovernance.index" )->middleware('can:e-governance'); 
			Route::post("/e-governance/store", "Admin\EGovernanceController@store")->name("admin.egovernance.store")->middleware('can:e-governance');
			Route::get("/e-governance/{id}/edit", "Admin\EGovernanceController@edit")->name("admin.egovernance.edit")->middleware('can:e-governance'); 
			Route::post("/egovernance/update", "Admin\EGovernanceController@update")->name("admin.egovernance.update" )->middleware('can:e-governance'); 
			Route::post("/egovernance/delete", "Admin\EGovernanceController@delete")->name( "admin.egovernance.delete" )->middleware('can:e-governance');

			// Admin profit Routes 
			Route::get("/profit", "Admin\ProfitController@index")->name( "admin.profit.index" )->middleware('can:profit-budget-chart'); 
			Route::post("/profit/store", "Admin\ProfitController@store")->name("admin.profit.store")->middleware('can:profit-budget-chart');
			Route::get("/profit/{id}/edit", "Admin\ProfitController@edit")->name("admin.profit.edit")->middleware('can:profit-budget-chart'); 
			Route::post("/profit/update", "Admin\ProfitController@update")->name("admin.profit.update" )->middleware('can:profit-budget-chart'); 
			Route::post("/profit/delete", "Admin\ProfitController@delete")->name( "admin.profit.delete" )->middleware('can:profit-budget-chart'); 

			// Admin View Client Feedbacks Routes 
			Route::get( "/feedbacks", "Admin\FeedbackController@feedbacks" )->name("admin.client_feedbacks")->middleware('can:client-feedback'); 
			Route::post("/delete_feedback", "Admin\FeedbackController@deleteFeedback")->name("admin.delete_feedback")->middleware('can:client-feedback'); 
			Route::post("/feedback/bulk-delete", "Admin\FeedbackController@bulkDelete" )->name("admin.feedback.bulk.delete")->middleware('can:client-feedback'); 
	});
			
	// Dynamic Routes 
	Route::group(["middleware" => ["setlang"]], function () { 
			$wdPermalinks = Permalink::where("details", 1)->get(); 
			foreach ($wdPermalinks as $pl) { 
				$type = $pl->type; $permalink = $pl->permalink; 
				if ($type == "package_order") { 
					Route::get( "$permalink/{id}", "Front\FrontendController@packageorder" )->name("front.packageorder.index"); 
				} elseif ($type == "service_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@servicedetails" )->name("front.servicedetails"); 
				} elseif ($type == "portfolio_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@portfoliodetails" )->name("front.portfoliodetails"); 
				} elseif ($type == "product_details") { 
					Route::get( "$permalink/{slug}", "Front\ProductController@productDetails" )->name("front.product.details"); 
				} elseif ($type == "course_details") { 
					Route::get( "$permalink/{slug}", "Front\CourseController@courseDetails" )->name("course_details"); 
				} elseif ($type == "cause_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@causeDetails" )->name("front.cause_details"); 
				} elseif ($type == "event_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@eventDetails" )->name("front.event_details"); 
				} elseif ($type == "career_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@careerdetails" )->name("front.careerdetails"); 
				} elseif ($type == "knowledgebase_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@knowledgebase_details" )->name("front.knowledgebase_details"); 
				} elseif ($type == "blog_details") { 
					Route::get( "$permalink/{slug}", "Front\FrontendController@blogdetails" )->name("front.blogdetails"); 
				} elseif ($type == "rss_details") { 
					Route::get( "$permalink/{slug}/{id}", "Front\FrontendController@rssdetails" )->name("front.rssdetails"); 
				} 
			} 
	}); 
	
	// Dynamic Routes 
	Route::group(["middleware" => ["setlang"]], function () { 
			$wdPermalinks = Permalink::where("details", 0)->get(); 
			foreach ($wdPermalinks as $pl) 
				{ 
					$type = $pl->type; $permalink = $pl->permalink; 
					if ($type == "packages") { 
						$action = "Front\FrontendController@packages"; 
						$routeName = "front.packages"; 
					} elseif ($type == "services") { 
						$action = "Front\FrontendController@services"; 
						$routeName = "front.services"; 
					} elseif ($type == "portfolios") { 
						$action = "Front\FrontendController@portfolios"; 
						$routeName = "front.portfolios"; 
					} elseif ($type == "products") { 
						$action = "Front\ProductController@product"; 
						$routeName = "front.product"; 
					} elseif ($type == "cart") { 
						$action = "Front\ProductController@cart"; 
						$routeName = "front.cart"; 
					} elseif ($type == "product_checkout") { 
						$action = "Front\ProductController@checkout"; 
						$routeName = "front.checkout"; 
					} elseif ($type == "team") { 
						$action = "Front\FrontendController@team"; 
						$routeName = "front.team"; 
					} elseif ($type == "courses") { 
						$action = "Front\CourseController@courses"; $routeName = "courses"; 
					} elseif ($type == "causes") { 
						$action = "Front\FrontendController@causes"; 
						$routeName = "front.causes"; 
					} elseif ($type == "events") { 
						$action = "Front\FrontendController@events"; 
						$routeName = "front.events"; 
					} elseif ($type == "career") { 
						$action = "Front\FrontendController@career"; 
						$routeName = "front.career"; 
					} elseif ($type == "event_calendar") { 
						$action = "Front\FrontendController@calendar"; 
						$routeName = "front.calendar"; 
					} elseif ($type == "knowledgebase") { 
						$action = "Front\FrontendController@knowledgebase"; 
						$routeName = "front.knowledgebase"; 
					} elseif ($type == "gallery") { 
						$action = "Front\FrontendController@gallery"; 
						$routeName = "front.gallery"; 
					} elseif ($type == "faq") { 
						$action = "Front\FrontendController@faq"; 
						$routeName = "front.faq"; 
					} elseif ($type == "blogs") { 
						$action = "Front\FrontendController@blogs"; 
						$routeName = "front.blogs"; 
					} elseif ($type == "rss") { 
						$action = "Front\FrontendController@rss"; 
						$routeName = "front.rss"; 
					} elseif ($type == "contact") { 
						$action = "Front\FrontendController@contact"; 
						$routeName = "front.contact"; 
					} elseif ($type == "quote") { 
						$action = "Front\FrontendController@quote"; 
						$routeName = "front.quote"; 
					} elseif ($type == "login") { 
						$action = "User\LoginController@showLoginForm"; 
						$routeName = "user.login"; 
					} elseif ($type == "register") { 
						$action = "User\RegisterController@registerPage"; 
						$routeName = "user-register"; 
					} elseif ($type == "forget_password") { 
						$action = "User\ForgotController@showforgotform"; 
						$routeName = "user-forgot"; 
					} elseif ($type == "admin_login") { 
						$action = "Admin\LoginController@login"; 
						$routeName = "admin.login"; 
						Route::get("$permalink", "$action") ->name("$routeName") ->middleware("guest:admin"); 
						continue; 
					} 
					Route::get("$permalink", "$action")->name("$routeName"); 
				} 
	}); 
	
	// Dynamic Page Routes 
	Route::group(["middleware" => "setlang"], function () { 
			Route::get("/{slug}", "Front\FrontendController@dynamicPage")->name( "front.dynamicPage" ); 
	});