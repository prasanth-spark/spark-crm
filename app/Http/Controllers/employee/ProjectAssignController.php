<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
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
        $projects = Project::with('users')->get();

        return view('employee/project-assign/project-list', compact('projects'));
    }

    /**
     * Show  Project Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function ProjectForm()
    {
        $users = User::whereNotIn('role_id', [1,2,3,4,5,6])->get();
        return view('employee/project-assign/project-assign-form', compact('users'));
    }

    /**
     * add  Project Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProject(ProjectRequest $request)
    {
        $project = new Project();
        $project->user_id = auth()->user()->id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        $project->users()->attach($request->user_ids);

        return redirect()->route('project-list')->with('success', 'Project Added Successfully');
    }

    /**
     * edit  Project 
     *
     * @return \Illuminate\Http\Response
     */
    public function editProject(Project $project)
    {
        $project = Project::with('users')->find($project->id);
        $users = User::whereNotIn('role_id', [1,2,7,8])->get();
        return view('employee/project-assign/project-edit-form', compact('project', 'users'));
    }

    /**
     * update  Project 
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProject(ProjectUpdateRequest $request, Project $project)
    {
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();
        $project->users()->sync($request->user_ids);
        return redirect()->route('project-list')->with('success', 'Project Updated Successfully');
    }


    /**
     * delete  Project 
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProject(Project $project)
    {
         $project->users()->detach();
         $project->delete();
        return redirect()->route('project-list')->with('success', 'Project Deleted Successfully');
    }
}
