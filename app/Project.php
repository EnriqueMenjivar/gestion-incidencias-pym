<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;
	
	protected $fillable = [
        'name', 'description', 'start',
    ];

    public static $rules = [
		'name' => 'required',
		'start' => 'date'
    ];
    public static $messages = [
		'name.required' => 'Es necesario ingresar el nombre del proyecto',
		'start.date' => 'La fecha no tiene el formato adecuado'
    ];

    // relationships
    public function categories(){
    	return $this->hasMany('App\Category');
    }

    public function levels(){
    	return $this->hasMany('App\Level');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    // accessors
    public function getFirstLevelIdAttribute(){
        return $this->levels->first()->id;
    }
}
