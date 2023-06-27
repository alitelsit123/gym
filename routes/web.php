<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  $role = auth()->user()->role;
  switch ($role) {
    case 'admin':
      return redirect('admin');
      break;
    case 'trainer':
      return redirect('trainer');
      break;
    case 'akuntan':
      return redirect('akuntan');
      break;
    default:
      return redirect('member');
      break;
  }
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('trainer')->middleware('auth.role')->group(function() {
  Route::get('/', [App\Http\Controllers\Trainer\DashboardController::class, 'index']);
  Route::post('update_attribute', [App\Http\Controllers\Controller::class,'updateAttribute']);

  Route::prefix('member')->group(function() {
    Route::get('/',[App\Http\Controllers\Trainer\MemberController::class, 'index']);

    Route::get('/schedule-nutrition/{id}',[App\Http\Controllers\Trainer\MemberController::class, 'scheduleNutrition']);
    Route::post('/store_nutrition',[App\Http\Controllers\Trainer\MemberController::class, 'storeNutrition']);
    Route::post('/update_nutrition',[App\Http\Controllers\Trainer\MemberController::class, 'updateNutrition']);
    Route::get('/destroy_nutrition',[App\Http\Controllers\Trainer\MemberController::class, 'destroyNutrition']);

    Route::get('/schedule-exercise/{id}',[App\Http\Controllers\Trainer\MemberController::class, 'scheduleExercise']);
    Route::post('/store_exercise',[App\Http\Controllers\Trainer\MemberController::class, 'storeexercise']);
    Route::post('/update_exercise',[App\Http\Controllers\Trainer\MemberController::class, 'updateexercise']);
    Route::get('/destroy_exercise',[App\Http\Controllers\Trainer\MemberController::class, 'destroyexercise']);
  });

  Route::prefix('specialist')->group(function() {
    Route::get('/',[App\Http\Controllers\Trainer\SpecialistController::class, 'index']);
    Route::post('/store',[App\Http\Controllers\Trainer\SpecialistController::class, 'store']);
    Route::post('/update/{id}',[App\Http\Controllers\Trainer\SpecialistController::class, 'update']);
    Route::get('destroy',[App\Http\Controllers\Trainer\SpecialistController::class, 'destroy']);
  });

  Route::prefix('packet')->group(function() {
    Route::get('/',[App\Http\Controllers\Trainer\PacketController::class, 'index']);
    Route::post('store',[App\Http\Controllers\Trainer\PacketController::class, 'store']);
    Route::post('update/{id}',[App\Http\Controllers\Trainer\PacketController::class, 'update']);
    Route::get('destroy',[App\Http\Controllers\Trainer\PacketController::class, 'destroy']);
  });

});

Route::prefix('admin')->middleware('auth.role')->group(function() {
  Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
  Route::post('update_attribute', [App\Http\Controllers\Controller::class,'updateAttribute']);

  Route::prefix('membership')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\MembershipController::class, 'index']);
    Route::post('store',[App\Http\Controllers\Admin\MembershipController::class, 'store']);
    Route::get('destroy',[App\Http\Controllers\Admin\MembershipController::class, 'destroy']);
    Route::post('update/{id}',[App\Http\Controllers\Admin\MembershipController::class, 'update']);
  });

  Route::prefix('user')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('store',[App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('destroy',[App\Http\Controllers\Admin\UserController::class, 'destroy']);
    Route::post('update/{id}',[App\Http\Controllers\Admin\UserController::class, 'update']);
  });

  Route::prefix('transaction')->group(function() {
    Route::get('/',[App\Http\Controllers\Admin\TransactionController::class, 'index']);
  });

});

Route::prefix('akuntan')->middleware('auth.role')->group(function() {
  Route::get('/', [App\Http\Controllers\Akuntan\TransactionController::class, 'index']);
  Route::get('/approved_payment', [App\Http\Controllers\Akuntan\TransactionController::class, 'approvedPayment']);
  Route::get('/approved_payment_packet', [App\Http\Controllers\Akuntan\TransactionController::class, 'approvedPaymentPacket']);
});

Route::prefix('member')->middleware('auth.role')->group(function() {
  Route::get('/', [App\Http\Controllers\Member\DashboardController::class, 'index']);
  Route::post('/absent_exercise',[App\Http\Controllers\Trainer\MemberController::class, 'absentExercise']);
  Route::prefix('trainer')->group(function() {
    Route::get('/', [App\Http\Controllers\Member\TrainerController::class, 'index']);
    Route::post('/store_payment', [App\Http\Controllers\Member\TrainerController::class, 'storePayment']);
  });

  Route::prefix('membership')->group(function() {
    Route::get('/', [App\Http\Controllers\Member\MembershipController::class, 'index']);
    Route::post('/store_payment', [App\Http\Controllers\Member\MembershipController::class, 'storePayment']);
  });

  Route::prefix('history')->group(function() {
    Route::get('/', [App\Http\Controllers\Member\HistoryController::class, 'index']);
  });

});