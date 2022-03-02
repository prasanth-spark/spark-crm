<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\TaskSheet;
use Illuminate\Support\Facades\Session;
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
       
        return view('employee/task/task-form'); 
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
       
        return view('employee/task/task-list');
    }


    public function taskPagination(Request $request)
    {
        $userId=Session::get('id');
        $tasks=$this->taskSheet->where('user_id',$userId);
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        $tasks = $tasks->when(($limit!='-1' && isset($offset)),
            function($q) use($limit, $offset){
                return $q->offset($offset)->limit($limit);
            });
        if($request->sSearch!='')
        {
            $keyword = $request->sSearch;
            $tasks = $tasks->when($keyword!='',
                function($q) use($keyword){
                    return $q->where('date','like','%'.$keyword.'%')->orWhere('project_name','like','%'.$keyword.'%')->orWhere('task_module','like','%'.$keyword.'%');
                });
        }
      
        $data = $tasks->get();
        $total_data = $tasks->count();
        $column=array();
        foreach ($data as $value){

            $col['id'] = $offset+1;
            $col['date'] = ($value->date) ? $value->date : "";
            $col['project_name'] = ($value->project_name) ? $value->project_name : "";
            $col['task_module'] = ($value->task_module) ? $value->task_module : "";
            $col['estimated_hours'] = ($value->estimated_hours) ? $value->estimated_hours :"";
            $col['worked_hours'] = ($value->worked_hours) ? $value->worked_hours : "";
            $col['task_status'] = ($value->task_status==1) ? 'pending' : 'completed';
            $col['actions'] = '<a class="flex items-center mr-3" href="'.url('/').'/employee/task-details/'.$value->id.'">
            <em data-feather="check-square" class="w-4 h-4 mr-1"></em> View
            </a>
            <a class="flex items-center mr-3" href="'.url('/').'/employee/task-edit/'.$value->id.'">
            <em data-feather="check-square" class="w-4 h-4 mr-1"></em> Edit
            </a>';

            array_push($column, $col);
            $offset++;
        }
        $data['sEcho']=$request->sEcho;
        $data['aaData']=$column;
        $data['iTotalRecords']=$total_data;
        $data['iTotalDisplayRecords']=$total_data;

         return json_encode($data);
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
    public function taskUpdate(Request $request)
    {
       $this->taskSheet->where('id',$request->id)->update([
        'worked_hours' => $request->worked_hours,
        'task_status' => $request->task_status
        ]);
        return redirect('/employee/task-list');
    }
}
