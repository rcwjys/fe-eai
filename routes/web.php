<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AspirationAddressController;
use App\Http\Middleware\AddTokenMiddleware;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\GuestMiddleware;






// Route::middleware([AddTokenMiddleware::class])->group(function () {

// });


// Route::middleware([GuestMiddleware::class])->group(function() {


  // Route::get('/user/token', [AuthController::class, 'store_token']);



// });



Route::get('/', [GuestController::class, 'show_entry_point']);

Route::get('/login', [AuthController::class, 'show_login_form']);
Route::post('/login', [AuthController::class, 'store_login_credentials']);

// Route::middleware([GuestMiddleware::class])->group(function() {




// });



Route::get('/candidates', [CandidateController::class, 'get_all_candidate']);

Route::get('/candidates/{candidate_slug}', [CandidateController::class, 'get_details_candidate']);



Route::middleware([Authenticate::class, AddTokenMiddleware::class,])->group(function() {

  // ! User Dashboard
  Route::get('/user/dashboard', [UserController::class, 'show_home']);



  Route::get('/create-votes', [VoteController::class, 'show_create_form']);
  Route::post('/create-votes', [VoteController::class, 'store_vote_data']);



  // ! Auth
  Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware([Authenticate::class, AdminOnly::class])->group(function () {

  Route::get('/admin/dashboard', [AdminController::class, 'show_index_page']);

  // ! Auth

  Route::get('/register', [AuthController::class, 'show_register_form']);
  Route::post('/register', [AuthController::class, 'store_register_form']);


  // ! Candidate Service

  Route::get('/create-candidate', [CandidateController::class, 'show_create_candidate_form']);
  Route::post('/candidate', [CandidateController::class, 'store_candidate_data']);

  Route::get('/edit-candidate/{candidate_slug}', [CandidateController::class, 'show_candidate_edit_form']);
  Route::patch('/edit-candidate/{candidate_id}', [CandidateController::class, 'update_candidate']);

  Route::delete('/candidate/{candidate_id}/delete', [CandidateController::class, 'delete_candidate']);


  // ! Vote Service

  Route::get('/votes', [VoteController::class, 'get_all_vote']);
  Route::get('/votes/{vote_id}', [VoteController::class, 'get_detail_votes']);


  Route::delete('/votes/delete/{vote_id}', [VoteController::class, 'delete_vote_data']);

  // ! Asspiration Address
  Route::get('/aspiration-address', [AspirationAddressController::class, 'get_all_aspiration_address']);
  Route::get('/create-aspiration-address', [AspirationAddressController::class, 'show_create_aspiration_address_form']);
  Route::post('/store-aspiration-address', [AspirationAddressController::class, 'store_aspiration_address_data']);
  Route::get('/edit-aspiration-address/{aspiration_address_id}', [AspirationAddressController::class, 'show_aspiration_address_edit_form']);
  Route::patch('/edit-aspiration-address/{aspiration_address_id}', [AspirationAddressController::class, 'update_aspiration_address']);
  Route::delete('/aspiration-address/{aspiration_address_id}/delete', [AspirationAddressController::class, 'delete_aspiration_address']);

  Route::get('/aspiration', [AspirationController::class, 'get_all_aspiration']);
  Route::get('/detail/aspiration/{aspiration_id}', [AspirationController::class, 'get_detail_aspiration']);

  Route::get('/aspiration/create', [AspirationController::class, 'show_create_aspiration_form']);
  Route::post('/store-aspiration', [AspirationController::class, 'store_aspiration_data']);

  Route::get('/edit-aspiration/{aspiration_id}', [AspirationController::class, 'show_aspiration_edit_form']);

  Route::patch('/edit-aspiration/{aspiration_id}', [AspirationController::class, 'update_aspiration']);


  Route::delete('/aspiration/{aspiration_id}/delete', [AspirationController::class, 'delete_aspiration']);










});