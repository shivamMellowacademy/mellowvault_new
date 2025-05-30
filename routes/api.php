<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeveloperProfileController;
use App\Http\Controllers\API\EmployerController;
use App\Http\Controllers\API\DeveloperProjectController;
use App\Http\Controllers\API\DeveloperInterviewController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// developer's routes 
Route::post('/developer-login', [DeveloperProfileController::class, 'developerLogin']);
Route::get('/developer-profile', [DeveloperProfileController::class, 'developerProfile']);
Route::get('/developer-kyc', [DeveloperProfileController::class, 'developerKyc']);
Route::get('/developer-wallet-details', [DeveloperProfileController::class, 'developerWalletDetails']);
Route::post('/developer-profile-update', [DeveloperProfileController::class, 'developerProfileUpdate']);
Route::post('/developer-change-password', [DeveloperProfileController::class, 'updatePassword']);
Route::apiResource('developer-projects', DeveloperProjectController::class);
Route::post('developer-projects/update/{id}', [DeveloperProjectController::class, 'updateProject']);
Route::post('/developer/bank-details', [DeveloperProfileController::class, 'addBankDetailsApi']);
Route::get('/developers/list', [DeveloperProfileController::class, 'developersList']);

// Empoyer's routes 
Route::get('/employer-register', [EmployerController::class, 'employerRegister']);
Route::post('/employer-login', [EmployerController::class, 'employerLogin']);
Route::get('/employer-profile', [EmployerController::class, 'employerProfile']);
Route::get('/employer-resources', [EmployerController::class, 'employerResource']);
Route::get('/employer-on-going-resources', [EmployerController::class, 'employerOngoingResource']);
Route::get('/employer-completed-resources', [EmployerController::class, 'employerCompletedResource']);
Route::post('/employer-reset-password', [EmployerController::class, 'employerUpdatePassword']);
Route::post('/employer-profile-update', [EmployerController::class, 'employerProfileUpdate']);
Route::get('/employer/resource-list', [EmployerController::class, 'resource']);


Route::post('employer/interview/schedule', [DeveloperInterviewController::class, 'scheduleInterview']);
Route::post('employer/interview-feedback', [DeveloperInterviewController::class, 'InterviewFeedback']);





