<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\TaskSheet;
use App\Models\TaskStatus;

class TaskController extends Controller
{

    public function __construct(TaskSheet $taskSheet,TaskStatus $taskStatus)
    {
        $this->taskSheet = $taskSheet;
        $this->taskStatus = $taskStatus;

    }

    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskForm()
    {
        $tasks = $this->taskStatus->get();
        return view('employee/task/task-form',compact('tasks')); 
    }

   
    /**
     * Add Task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function taskAdd(TaskRequest $request){
        $this->taskSheet->create([
          'user_id' => $request->session()->get('id'),
          'date' => $request->date,
          'project_name' => $request->project_name,
          'task_module' => $request->task_module,
          'estimated_hours' => $request->estimated_hours,
          'worked_hours' => $request->worked_hours,
          'task_status' => $request->task_status,
          'status' => '1'
        ]);

        return redirect('/employee/task-list');
    }
    
    /**
     * List Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskList(){
        $tasks=$this->taskSheet->tobase()->get();
        return view('employee/task/task-list',compact('tasks'));
    }

    /**
     *  Task Details
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function taskDetails($id)
    {
        $taskView=$this->taskSheet->find($id);
        return view('employee/task/task-view',compact('taskView'));
    }

    /**
     * Edit Task.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function taskEdit($id)
    {
        $taskEdit=$this->taskSheet->find($id);
        $tasks = $this->taskStatus->get();
        return view('employee/task/task-edit',compact('taskEdit','tasks'));
    }

    /**
     * Update Task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function taskUpdate(TaskRequest $request)
    {
       $this->taskSheet->where('id',$request->id)->update([
        'user_id' => $request->session()->get('id'),
        'date' => $request->date,
        'project_name' => $request->project_name,
        'task_module' => $request->task_module,
        'estimated_hours' => $request->estimated_hours,
        'worked_hours' => $request->worked_hours,
        'task_status' => $request->task_status
        ]);
        return redirect('/employee/task-list');
    }
}
