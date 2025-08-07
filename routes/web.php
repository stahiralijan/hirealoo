<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::resource('/', ScheduleController::class)->names('schedules');
