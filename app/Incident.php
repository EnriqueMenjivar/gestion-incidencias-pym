<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //Relationships
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function project(){
    	return $this->belongsTo('App\Project');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function support(){
    	return $this->belongsTo('App\User', 'support_id');
    }

    public function client(){
    	return $this->belongsTo('App\User', 'client_id');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

	//Accessor
    public function getSeverityFullAttribute(){
    	switch ($this->severity) {
    		case 'M':
    			return 'Menor';
    			break;

    		case 'N':
    			return 'Normal';
    			break;
    		
    		default:
    			return 'Alta';
    			break;
    	}
    }

    // accessors
    public function getTitleShortAttribute(){
    	return mb_strimwidth($this->title, 0, 20, '...');
    }

    public function getCategoryNameAttribute(){
    	if($this->category)
    		return $this->category->name;
    	return 'General';
    }

    public function getSupportNameAttribute(){
    	if($this->support)
    		return $this->support->name;
    	
    	return 'Sin asignar';
    }

    public function getStateAttribute(){
    	if($this->active==0)
    		return 'Resuelto';
    	
    	if($this->support_id)
    		return 'Asignado';

    	return 'Pendiente';
    }

    //validation
    public static $rules = [
            'category_id' => 'sometimes|nullable|exists:categories,id',
            'severity' => 'required|in:M,N,A',
            'title' => 'required|min:5',
            'description' => 'required|min:15',
        ];
    public static $messages = [
            'category_id.exists' => 'La categoría seleccionada no existe en la base de datos.',
            'title.required' => 'Es necesario ingresar un título para registrar la incidencia.',
            'title.min' => 'El título debe tener al menos 5 caracteres.',
            'description.required' => 'Es necesario ingresar una descripción para registrar la incidencia.',  
            'description.min' => 'La descripción debe tener al menos 15 caracteres.',  
        ];
}
