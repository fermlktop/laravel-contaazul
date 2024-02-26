<?php

use Illuminate\Support\Facades\Route;

Route::get('contaazul-authorization', 'ContaAzulController@authorization');
Route::get('contaazul-authentication', 'ContaAzulController@authentication');
