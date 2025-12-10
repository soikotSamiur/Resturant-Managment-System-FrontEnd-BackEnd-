<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes (Public)
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

// Password Reset Routes (Public)
Route::post('/password/send-otp', [PasswordResetController::class, 'sendOTP']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);

// User CRUD - Only Admin can access
Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Menu Routes - Admin, Waiter, Chef, Employee can access
Route::middleware(['auth:sanctum', 'role:Admin,Waiter,Chef,Employee'])->group(function () {
    Route::get('/menu-items', [MenuController::class, 'getMenuItems']);
    Route::post('/menu-items', [MenuController::class, 'createMenuItem']);
    Route::put('/menu-items/{id}', [MenuController::class, 'updateMenuItem']);
    Route::delete('/menu-items/{id}', [MenuController::class, 'deleteMenuItem']);
    Route::patch('/menu-items/{id}/toggle-availability', [MenuController::class, 'toggleAvailability']);
});

// Category Routes - Admin, Waiter, Chef, Employee can access
Route::middleware(['auth:sanctum', 'role:Admin,Waiter,Chef,Employee'])->group(function () {
    Route::get('/categories', [MenuController::class, 'getCategories']);
});

// Order Routes - Admin, Waiter, Chef, Cashier, Employee can access
Route::middleware(['auth:sanctum', 'role:Admin,Waiter,Chef,Cashier,Employee'])->group(function () {
    Route::get('/orders', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Orders endpoint']);
    });
    Route::post('/orders', function () {
        return response()->json(['success' => true, 'message' => 'Order created']);
    });
    Route::get('/orders/{id}', function () {
        return response()->json(['success' => true, 'message' => 'Order details']);
    });
    Route::put('/orders/{id}', function () {
        return response()->json(['success' => true, 'message' => 'Order updated']);
    });
    Route::delete('/orders/{id}', function () {
        return response()->json(['success' => true, 'message' => 'Order deleted']);
    });
});

// Inventory Routes - Only Admin can access
Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/inventory', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Inventory endpoint']);
    });
    Route::post('/inventory', function () {
        return response()->json(['success' => true, 'message' => 'Inventory item created']);
    });
    Route::put('/inventory/{id}', function () {
        return response()->json(['success' => true, 'message' => 'Inventory item updated']);
    });
    Route::delete('/inventory/{id}', function () {
        return response()->json(['success' => true, 'message' => 'Inventory item deleted']);
    });
});

// Reports Routes - Only Admin can access
Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/reports/sales', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Sales reports endpoint']);
    });
    Route::get('/reports/revenue', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Revenue reports endpoint']);
    });
    Route::get('/reports/inventory', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Inventory reports endpoint']);
    });
});

// Settings Routes - Only Admin can access
Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/settings', function () {
        return response()->json(['success' => true, 'data' => [], 'message' => 'Settings endpoint']);
    });
    Route::put('/settings', function () {
        return response()->json(['success' => true, 'message' => 'Settings updated']);
    });
});

