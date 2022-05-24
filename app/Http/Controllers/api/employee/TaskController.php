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

    /*
    Project Assign API
    */

    public function assignedProject(Request $request)
    {
        $user = User::find($request->user_id);
        $projectName = $user->projects->pluck('title');
        $projectId = $user->projects->pluck('id');
        $data = array();
        $data['projectId'] = $projectId;
        $data['projectName'] = $projectName;

        return response()->json(['status'=>true,'message'=>'User Project Details for Drop Down','project_details'=>$data]);
    }

    /*
    Task Add API
    */

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

    /*
    Task Details API
    */

    public function taskDetails(Request $request)
    {
        $userId = $request->user_id;
        $tasks = $this->taskSheet->where('user_id', $userId)->with('projects');
        $data = $tasks->get();
        return response()->json(['status'=>true,'message'=>'User Project Details','data'=>$data]);
    }

    /*
    Task Update API
    */

    public function taskUpdate(Request $request)
    {
        $this->taskSheet->where('id', $request->id)->where('user_id',$request->user_id)->update([
            'date' => $request->date,
            'project_id' => $request->project_id,
            'task_module' => $request->task_module,
            'estimated_hours' => $request->estimated_hours,
            'worked_hours' => $request->worked_hours,
            'status' => $request->task_status
        ]);
        return response()->json(['status'=>true,'message'=>'User project Details Updated']);
    }



}
