
<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Login funktion im authController -> Email/PW korrekt?
Route::post('auth/login', [AuthController::class, 'login']);

Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class,'index']);
Route::get('/comments', [\App\Http\Controllers\CommentController::class,'index']);
Route::get('/users', [\App\Http\Controllers\UserController::class,'index']);
Route::get('/offers', [\App\Http\Controllers\OfferController::class,'index']);
Route::get('/courses', [\App\Http\Controllers\CourseController::class,'index']);

Route::get('/courses/{id}', [\App\Http\Controllers\CourseController::class,'getById']);
Route::get('/offers/{id}', [\App\Http\Controllers\OfferController::class,'getById']);
Route::get('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class,'getById']);
Route::get('/comments/{id}', [\App\Http\Controllers\CommentController::class,'getById']);
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class,'getById']);
Route::get('/appointments/offers/{id}', [\App\Http\Controllers\AppointmentController::class,'getByOffer']);


//Routen die Authentifizierung brauchen über die Middleware(richtiger Token dabei?)/Aktionen die Anmeldung benötigen
Route::group(['middleware' => ['api','auth.jwt']], function() {
    Route::delete('/comments/{id}', [\App\Http\Controllers\CommentController::class,'delete']);
    Route::delete('/courses/{id}', [\App\Http\Controllers\CourseController::class,'delete']);
    Route::delete('/offers/{id}', [\App\Http\Controllers\OfferController::class,'delete']);
    Route::delete('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class,'delete']);
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class,'delete']);

    Route::post('/offers', [\App\Http\Controllers\OfferController::class,'save']);
    Route::put('/offers/{id}', [\App\Http\Controllers\OfferController::class,'update']);

    Route::put('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class,'update']);
    Route::post('/comments', [\App\Http\Controllers\CommentController::class,'save']);

});


