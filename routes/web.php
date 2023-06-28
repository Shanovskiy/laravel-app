<?php

use App\Http\Controllers\AdminAuctionController;
use App\Http\Controllers\AdminCarsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BalanceUsersController;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderFeedController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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

    Route::get('/', function () {
    return view('welcome');
});
    Route::get("/home",[HomeController::class,"viewHome"])->name("root")->middleware('banned');
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password',[PasswordResetController::class,"forgotPassword"])->name('password.request');
    Route::post('/forgot-password',[PasswordResetController::class,"recoveryPin"])->name('password.reset');
    Route::get('/enter-recovery-pin',[PasswordResetController::class,"changePassword"])->name('enter.recovery.pin');
    Route::post('/enter-recovery-pin',[PasswordResetController::class,"validateRecoveryPin"])->name('recovery.pin');
    Route::get('/reset-password',[PasswordResetController::class,"passwordUpdate"])->name('password.update');
    Route::post('/reset-password',[PasswordResetController::class,"saveNewPassword"])->name('change.password');
    Route::get("/register",[RegisterController::class,"viewRegister"])->name("register");
    Route::post("/register",[RegisterController::class,"saveUser"])->name("saveUser");
    Route::get("/login",[LoginController::class,"viewLogin"])->name("login");
    Route::post("/login",[LoginController::class,"authenticate"])->name("auth");
});
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')->middleware('auth');
Route::middleware(['auth','banned'])->group(function () {
    Route::get("/order/{id}",[OrdersController::class,"orderCar"])->name("orderCar");
    Route::post("/order",[OrdersController::class,"saveOrderCar"])->name("saveOrder");
    Route::get("/add-car", [HomeController::class,"addCar"])->name('add-car');
    Route::post("/add-new-car",[HomeController::class,"saveCar"])->name("add-new-car");
    Route::post("/add-car-image",[HomeController::class,"saveCar"])->name("add-car-image");
    Route::get("/profile", [UserController::class,"editProfile"])->name('edit-profile');
    Route::put("/profile", [UserController::class,"saveProfile"])->name('save-profile');
    Route::put("/profile-image", [UserController::class,"addUserImage"])->name('add-user-image');
    Route::get("/my-orders", [UserOrdersController::class,"userOrders"])->name('user-orders');
    Route::post("/my-orders", [UserOrdersController::class,"refundRequest"])->name('refund-request');
    Route::get("/download-report",[ReportController::class,"downloadReport"])->name("download-report");
    Route::get("/balance",[BalanceUsersController::class,"balanceView"])->name("balance");
    Route::get("/insufficient-funds",[BalanceUsersController::class,"insufficientFunds"])->name("insufficient-funds");
    Route::get("/favorites",[FavoritesController::class,"viewFavorites"])->name("favorites");
    Route::post("/new-favorite",[FavoritesController::class,"saveNewFavorite"])->name("save-new-favorite");
    Route::post("/delete-favorite",[FavoritesController::class,"deleteFavorite"])->name("delete-favorite");
    Route::get("/auction",[AuctionController::class,"auctionView"])->name("auction");
    Route::put("/auction",[AuctionController::class,"newBet"])->name("new-bet");
    Route::get("/user-auction-orders",[AuctionController::class,"userAuctionOrdersView"])->name("users-auction-orders");


});
Route::middleware('role')->group(function () {
    Route::get('/admin-page',[AdminController::class,"adminView"])->name('admin.page');
    Route::get('/refund-requests',[AdminController::class,"refundRequests"])->name('refund-requests');
    Route::post('/return-funds',[AdminController::class,"returnFunds"])->name('return-funds');
    Route::post('/return-refusal',[AdminController::class,"returnRefusal"])->name('return-refusal');
    Route::get('/order-feed',[OrderFeedController::class,"orderFeedView"])->name('order.feed');
    Route::get('/users',[AdminController::class,"usersView"])->name('users');
    Route::get('/user-edit',[AdminController::class,"userEdit"])->name('user.edit');
    Route::put('/user-edit',[AdminController::class,"userEditSave"])->name('user.edit.save');
    Route::put('/user-edit-role',[AdminController::class,"userEditRoleSave"])->name('user.edit.role.save');
    Route::get('/cars',[AdminCarsController::class,"carsView"])->name('cars');
    Route::post('/cars',[AdminCarsController::class,"carDelete"])->name('car-delete');
    Route::get('/car-edit',[AdminCarsController::class,"carEdit"])->name('car.edit');
    Route::post('/car-edit',[AdminCarsController::class,"carEditSave"])->name('car.edit.save');
    Route::get('/auctionAdmin',[AdminAuctionController::class,"auctionView"])->name("admin-auction");
    Route::get("/create-a-lot/{id}",[AdminAuctionController::class,"createALotAuction"])->name("create-a-lot");
    Route::post("/create-a-lot",[AdminAuctionController::class,"putUpForAuction"])->name("putUpForAuction");
    Route::get("/view-auction",[AdminAuctionController::class,"viewAuction"])->name("view-auction");
    Route::put("/view-auction",[AdminAuctionController::class,"endAuction"])->name("end-auction");
    Route::get("/promocode",[PromocodeController::class,"promocodeView"])->name("view-promocode");
    Route::post("/promocode",[PromocodeController::class,"createPromoCode"])->name("create-promocode");

});
Route::get("/banned",[BannedController::class,"bannedView"])->name("banned");

