<?php

namespace App\Http\Controllers\api\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\ProjecthasUser;
use App\Models\TaskSheet;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct(TaskSheet $taskSheet, TaskStatus $taskStatus, Project $project)
    {
        $this->taskSheet = $taskSheet;
        $this->taskStatus = $taskStatus;
        $this->project    = $project;
    }
    public function taskDropdetails(Request $request)
    {
        $user = User::find($request->user_id);
        $projectName = $user->projects->pluck('title');
        return response()->json(['status'=>true,'message'=>'User Project Details for Drop Down','projectName'=>$projectName]);
    }
    public function taskAdd(Request $request)
    {
        $this->taskSheet->create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'project_id' => $request->project_name,
            'task_module' => $request->task_module,
            'estimated_hours' => $request->estimated_hours,
            'status' => $request->task_status,
        ]);
        return response()->json(['status'=>true,'message'=>'User Add Task Successfull']);
    }
    public function taskDetails(Request $request)
    {
        $userId = $request->user_id;
        $tasks = $this->taskSheet->where('user_id', $userId)->with('projects');
        $data = $tasks->get();
        return response()->json(['status'=>true,'message'=>'User Project Details','data'=>$data]);
    }
   


}
