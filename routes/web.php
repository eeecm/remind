<?php

use Encore\Remind\Http\Controllers\RemindController;

Route::get('remind', RemindController::class.'@index');