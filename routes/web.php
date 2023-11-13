<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationStatusController;
use App\Http\Controllers\FullCalendarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CalendarController;


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

Route::view('/', 'landing');

Auth::routes();
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{plant}/show',[ReservationController::class, 'show'])->name('reservation.show');
Route::get('/reservation/{reservation_id}/edit',[ReservationController::class, 'edit'])->name('reservation.edit');
Route::put('/reservation/{reservation_id}/update', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/reservation/{reservation_id}/destroy', [ReservationController::class, 'destroy'])->name('reservation.destroy');
Route::get('/sse', [ReservationController::class, 'sse'])->name('reservation.sse');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/meetings/{meeting_id}', [CalendarController::class, 'getMeetingsByMeetingId'])->name('meetings.by.meeting_id');
