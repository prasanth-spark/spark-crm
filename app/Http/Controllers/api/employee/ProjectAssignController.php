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

    public function projectList(Request $request)
    {
        $projectids = Project::where('user_id',$request->user_id)->pluck('id');
        $projectLists = Project::where('user_id',$request->user_id)->whereIn('id',$projectids)->with('users')->get();
        return response()->json(['status'=>true,'message'=>'Project Details','Project Details'=>$projectLists]);
    }

    /*
     Team Member List for Project Drop Down API
    */

    public function projectForm()
    {
        $users = User::whereNotIn('role_id', [1,2,3,4,5])->get();
        return response()->json(['status'=>true,'message'=>'Team Members Drop Down for Project','Team Members'=>$users]);
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
        foreach($request->user_ids as $user_ids)
        {
            $project->users()->attach($user_ids);
        }
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
