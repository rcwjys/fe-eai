<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\AddTokenMiddleware;
use App\Http\Middleware\GuestMiddleware;





Route::middleware([AddTokenMiddleware::class])->group(function () {
  Route::get('/user/dashboard', [UserController::class, 'show_home']);

  Route::get('/register', [AuthController::class, 'show_register_form']);
  Route::post('/register', [AuthController::class, 'store_register_form']);

  Route::post('/logout', [AuthController::class, 'logout']);

  Route::get('/create-candidate', [CandidateController::class, 'show_create_candidate_form']);
  Route::post('/candidate', [CandidateController::class, 'store_candidate_data']);

  Route::get('/edit-candidate/{candidate_slug}', [CandidateController::class, 'show_candidate_edit_form']);
  Route::patch('/edit-candidate/{candidate_id}', [CandidateController::class, 'update_candidate']);

  Route::delete('/candidate/{candidate_id}/delete', [CandidateController::class, 'delete_candidate']);

  Route::get('/votes', [VoteController::class, 'get_all_vote']);
});


// Route::middleware([GuestMiddleware::class])->group(function() {
  Route::get('/login', [AuthController::class, 'show_login_form']);
  Route::post('/login', [AuthController::class, 'store_login_credentials']);

  // Route::get('/user/token', [AuthController::class, 'store_token']);  

  Route::get('/candidates', [CandidateController::class, 'get_all_candidate']);
  Route::get('/candidates/{candidate_slug}', [CandidateController::class, 'get_details_candidate']);
// });


Route::get('/', [UserController::class, 'show_entry_point']);