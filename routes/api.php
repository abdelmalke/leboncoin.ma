<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\StripeController;



Route::post('/create-payment-intent', [StripeController::class, 'createPaymentIntent']);
// Route::post('/payment-success', [StripeController::class, 'handlePaymentSuccess'])->middleware('auth:sanctum');
Route::post('/payment-success', [StripeController::class, 'handlePaymentSuccess']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
});


Route::post('/posts', [PostController::class, 'store']);
    

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'indexByPostOwner']);
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::put('/appointments/{id}/accept', [AppointmentController::class, 'accept']);
    Route::put('/appointments/{id}/reject', [AppointmentController::class, 'reject']);
});
Route::get('/appointments/owner', [AppointmentController::class, 'fetchAppointmentsForPostOwner'])->middleware('auth');

// Route::middleware('auth:sanctum')->get('/appointments/{id}', [AppointmentController::class, 'show']);


// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/appointments', [AppointmentController::class, 'index']);
//     Route::post('/appointments', [AppointmentController::class, 'store']);
//     Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
//     Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);
//     Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);
// });
// Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
// Route::middleware('auth:sanctum')->group(function() {
//     Route::post('/appointments', [AppointmentController::class, 'store']);
//     Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
// });
// Route::put('/appointments/{appointment}/accept', [AppointmentController::class, 'accept']);
// Route::put('/appointments/{appointment}/reject', [AppointmentController::class, 'reject']);

// Route::post('/appointments', [AppointmentController::class, 'createAppointment']);

// Route::put('/appointments/{id}/accept', [AppointmentController::class, 'accept']);
// Route::put('/appointments/{id}/reject', [AppointmentController::class, 'reject']);
// Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);



// Route::middleware('auth:sanctum')->post('/appointments', [AppointmentController::class, 'store']);
