<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

    	$rules = [
    		'message' => 'required|min:5|max:255'
    	];

    	$messages = [
    		'message.required' => 'Olvidó ingresar un mensaje',
    		'message.min' => 'El mensaje debe contener al menos 5 caracteres',
    		'message' => 'El mensaje no debe sobrepasar los 255 caracteres'
    	];

    	$this->validate($request, $rules, $messages);

    	$message = new Message();
    	$message->incident_id = $request->input('incident_id');
    	$message->user_id = auth()->user()->id;
    	$message->message = $request->input('message');
    	$message->save();

    	return back()->with('notification', 'Su mensaje se ha enviado con éxito');
    }
}
