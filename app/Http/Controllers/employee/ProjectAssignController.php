<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Projecthas;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectAssignController extends Controller
{

    /**
     * Project List .
     *
     * @return \Illuminate\Http\Response
     */
    public function ProjectList()
    { 
        $projects = Project::all();
        return view('employee/project-assign/project-list',compact('projects'));
    }
    /**
     * Show  Project Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function ProjectForm()
    {
        $users=User::all();
        return view('employee/project-assign/project-assign-form',compact('users'));
    }

     /**
     * add  Project Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProject(Request $request)
    {
       
        $project = new Project();
        $project->user_id = auth()->user()->id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();
        
        $projectHasUser = new Projecthas();
        $projectHasUser->user_id = $request->team_id;
        $projectHasUser->project_id = $project->id;
        $projectHasUser->save();
        return redirect()->route('project-assign-form')->with('success', 'Project Added Successfully');
    }
}
