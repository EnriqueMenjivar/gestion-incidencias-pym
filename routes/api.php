<?php

use Illuminate\Http\Request;

Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
