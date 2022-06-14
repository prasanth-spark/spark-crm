<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
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

        $this->middleware(['role:Employee|Team Leader|Others']);
    }

    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskForm()
    {
        $user = User::find(Auth::user()->id);

        $projectName = $user->projects;

        return view('employee/task/task-form', compact('projectName'));
    }


    /**
     * Add Task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function taskAdd(TaskRequest $request)
    {
        $this->taskSheet->create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
            'project_id' => $request->project_name,
            'task_module' => $request->task_module,
            'estimated_hours' => $request->estimated_hours,
            'status' => $request->task_status,
        ]);

        return redirect('/employee/task-list');
    }

    /**
     * List Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function taskList()
    {
        return view('employee/task/task-list');
    }


    public function taskPagination(Request $request)
    {
        $userId = Auth::user()->id;
        $tasks = $this->taskSheet->where('user_id', $userId)->with('projects');
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        $total_data = $tasks->count();
        $tasks = $tasks->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $tasks->whereHas('projects', function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')->orWhere('task_module', 'like', '%' . $keyword . '%')->orwhere('date', 'like', '%' . $keyword . '%');
            });
        }


        $data = $tasks->get();
        $column = array();
        foreach ($data as $value) {
            $col['id'] = $offset + 1;
            $col['date'] = ($value->date) ? $value->date : "";
            $col['project_id'] = isset($value->projects['title']) ? $value->projects['title'] : "general";
            $col['task_module'] = ($value->task_module) ? $value->task_module : "";
            $col['estimated_hours'] = ($value->estimated_hours) ? $value->estimated_hours : "";
            $col['worked_hours'] = ($value->worked_hours) ? $value->worked_hours : "-";
            $col['status'] = ($value->status == 1) ? 'pending' : 'completed';
            $col['actions'] = '<a class="flex items-center mr-3" href="' . url('/') . '/employee/task-details/' . $value->id . '">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye block mx-auto"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> View
            </a>
            <a class="flex items-center mr-3" href="' . url('/') . '/employee/task-edit/' . $value->id . '">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" class="lucide lucide-edit block mx-auto"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit
            </a>';

            array_push($column, $col);
            $offset++;
        }
        $data['sEcho'] = $request->sEcho;
        $data['aaData'] = $column;
        $data['iTotalRecords'] = $total_data;
        $data['iTotalDisplayRecords'] = $total_data;

        return json_encode($data);
    }

    /**
     *  Task Details
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function taskDetails(TaskSheet $taskView)
    {
        $this->authorize('view', $taskView);
        return view('employee/task/task-view', compact('taskView'));
    }

    /**
     * Edit Task.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function taskEdit(TaskSheet $taskEdit)
    {
        $this->authorize('update', $taskEdit);
        $tasks = $this->taskStatus->get();
        $user = User::find(Auth::user()->id);
        $projectName = $user->projects;
        return view('employee/task/task-edit', compact('taskEdit', 'tasks','projectName'));
    }

    /**
     * Update Task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function taskUpdate(TaskRequest $request)
    {
        $this->taskSheet->where('id', $request->id)->update([
            'date' => $request->date,
            'project_id' => $request->project_name,
            'task_module' => $request->task_module,
            'estimated_hours' => $request->estimated_hours,
            'worked_hours' => $request->worked_hours,
            'status' => $request->task_status
        ]);
        return redirect('/employee/task-list');
    }
}
