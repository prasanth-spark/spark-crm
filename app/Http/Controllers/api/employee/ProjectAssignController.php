<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Http\Request;

class ProjectAssignController extends Controller
{

    public function __construct(Project $project)
    {
        $this->project    = $project;
    }

    /*
     Project List API
    */

    public function projectList()
    {
        $projects = Project::with('users')->get();
        return response()->json(['status'=>true,'message'=>'Project Details','data'=>$projects]);
    }

    /*
     Project List for Drop Down API
    */

    public function projectForm()
    {
        $users = User::whereNotIn('role_id', [1,2])->get();
        return response()->json(['status'=>true,'message'=>'Team Members for Project','data'=>$users]);
    }

    /*
    Project Add API
    */

    public function projectAdd(ProjectRequest $request)
    {
        $project = new Project();
        $project->user_id = $request->user_id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();
        $project->users()->attach(['user_id'=>$request->user_ids]);
        return response()->json(['status'=>true,'message'=>'Project Added Successfully']);
    }

    /*
    Project Update API
    */

    public function projectUpdate(Request $request,Project $project)
    {
       $projectQuery = $this->project->where('id', $request->id);
       $record = $projectQuery->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $project = $projectQuery->first();
        $project->users()->sync($request->user_ids);
        
        return response()->json(['status'=>true,'message'=>'Project Update Successfully']);
    }

    /*
    Project Delete API
    */

    public function projectDelete(Request $request,Project $project)
    {
        $projectQuery = $this->project->where('id', $request->id);
        $project = $projectQuery->first();
        $project->users()->detach();
        $project->delete();
        return response()->json(['status'=>true,'message'=>'Project Delete Successfully']);
    }
    
}
