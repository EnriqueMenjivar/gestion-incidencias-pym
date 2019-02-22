<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Project;
use App\ProjectUser;

class IncidentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $categories = Category::where('project_id', 1)->get();
        return view('incidents.create')->with(compact('categories'));
    }

    public function store(Request $request){
        //Incident::create($request->all());
        //dd($request->all());
        //dd($request->input('category_id') ?: null);

        $this->validate($request, Incident::$rules, Incident::$messages);
        $user = auth()->user();

        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');


        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;

        $incident->save();

        return back();
        
    }

    public function show($id){
    	$incident = Incident::findOrFail($id);
        $messages = $incident->messages; 
        
    	return view('incidents.show')->with(compact('incident', 'messages'));
    }

    public function take($id){
        $user = auth()->user();
        $incident = Incident::findOrFail($id);
        $project_user = ProjectUser::where('project_id', $incident->project_id)->where('user_id',$user->id)->first();

        if (!$user->is_support || !$project_user || $project_user->level_id != $incident->level_id) {
            return back();
        }

        
        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    public function solve($id){
        $incident = Incident::findOrFail($id);

        if($incident->client_id != auth()->user()->id)
            return back();

        $incident->active = 0; //false
        $incident->save();

        return back();
    }

    public function open($id){
        $incident = Incident::findOrFail($id);

        if($incident->client_id != auth()->user()->id)
            return back();

        $incident->active = 1; //true
        $incident->save();

        return back();
    }

    public function edit($id){
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        return view('incidents.edit')->with(compact('incident', 'categories'));
    }

    public function update(Request $request, $id){
        $this->validate($request, Incident::$rules, Incident::$messages);

        $incident = Incident::findOrFail($id);
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        $incident->save();

        return redirect("/ver/$id");
    }

    public function nextLevel($id){
        $incident = Incident::findOrFail($id);
        $project = $incident->project;
        $levels = $project->levels;
        $level_id = $incident->level_id;

        $next_level_id = $this->getNextLevelId($level_id, $levels);
        
        if($next_level_id){
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }

        return back()->with('notification', 'No es posible derivar porque no hay otro nivel superior al actual');
    }

    public function getNextLevelId($level_id, $levels){
        if(sizeof($levels) <= 1)
            return null;

        $position = -1;
        for ($i=0; $i < sizeof($levels)-1; $i++) { 
            if($levels[$i]->id == $level_id){
                $position = $i;
                break;

            }
        }

        if($position == -1)
            return null;

        return $levels[$position+1]->id;
    }

}
