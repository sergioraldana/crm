<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    redirect()->route('filament.admin.login');
});
