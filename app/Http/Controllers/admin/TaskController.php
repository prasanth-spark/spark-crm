<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\TaskSheet;


use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user, TaskSheet $tasksheet)
     {
          $this->userdetails      = $userdetails;
          $this->accountType      = $accountType;
          $this->bankdetails      = $bankdetails;
          $this->rolemodel        = $rolemodel;
          $this->teammodel        = $teammodel;
          $this->user             = $user;
          $this->tasksheet        = $tasksheet;
     }
     /**
      * Show specified view.
      *
      * @return \Illuminate\Http\Response
      */
     public function taskList()
     {
          $teamList = $this->teammodel->get();
          return view('admin/task/task-list', compact('teamList'));
     }

     /**
      * Task Details view.
      *
      * @return \Illuminate\Http\Response
      */
     public function taskDetails(TaskSheet $taskList)
     {
          // $taskList = $this->tasksheet->where('id', $id)->with('taskToUser', 'taskToUserDetails.teamToUserDetails', 'taskToUser.roleToUser')->first();
          return view('admin/task/task-details', compact('taskList'));
     }

     /**
      * Task List Pagination.
      *
      * @return \Illuminate\Http\Response
      */
     public function taskListPagination(Request $request)
     {
          $fromdate = str_replace('/', '-', $request->from_date);
          $fromdateFormatChange = date("Y-m-d", strtotime($fromdate));

          $todate = str_replace('/', '-', $request->to_date);
          $todateFormatChange = date("Y-m-d", strtotime($todate));
          $team       =   $request->team_name;

          $taskList = $this->tasksheet->with('taskToUser', 'taskToUserDetails.teamToUserDetails', 'taskToUser.roleToUser');

          $limit = $request->iDisplayLength;
          $offset = $request->iDisplayStart;


          if ($request->sSearch != '') {
               $keyword = $request->sSearch;
               $taskList->whereHas('taskToUser', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
               });
               $taskList->orwhereHas('taskToUserDetails.teamToUserDetails', function ($q) use ($keyword) {
                    $q->where('team', 'like', '%' . $keyword . '%');
               });
               $taskList->orwhereHas('taskToUser.roleToUser', function ($q) use ($keyword) {
                    return $q->where('name', 'like', '%' . $keyword . '%');
               });
               $taskList->orwhereHas('projects', function ($q) use ($keyword) {
                    return $q->where('title', 'like', '%' . $keyword . '%');
               });
          }

          $total_data = $taskList->count();
          $taskList = $taskList->when(($limit != '-1' && isset($offset)),
               function ($q) use ($limit, $offset) {
                    return $q->offset($offset)->limit($limit);
               }
          );

          if ($fromdateFormatChange && $todateFormatChange && $team) {
               $taskList = $taskList->whereBetween('date', [$fromdateFormatChange, $todateFormatChange])->whereHas('taskToUserDetails.teamToUserDetails', function ($query) use ($team) {
                    $query->where('team_id', '=', $team);
               });
          } elseif ($team) {
               $taskList = $taskList->whereHas('taskToUserDetails.teamToUserDetails', function ($query) use ($team) {
                    $query->where('team_id', '=', $team);
               });
          }
          $List = $taskList->get();
          $column = array();
          foreach ($List as $value) {


               $col['id'] = $offset + 1;
               $col['date'] = $value->date;
               $col['name'] = $value->taskToUser->name;
               $col['role'] = $value->taskToUser->roleToUser->name;
               $col['team'] = $value->taskToUserDetails->teamToUserDetails->team;
               $col['project_name'] = isset($value->projects['title']) ? $value->projects['title'] : 'general';
               $col['leave_status'] = ($value->status == 1) ? "pending" : "completed";
               $col['action'] = ' <a class="flex items-center mr-3" href="' . url('/') . '/admin/task-details/' . $value->id . '">
                               <i data-feather="eye" class="w-4 h-4 mr-1"></i> view
                               </a>';


               array_push($column, $col);
               $offset++;
          }
          $List['sEcho'] = $request->sEcho;
          $List['aaData'] = $column;
          $List['iTotalRecords'] = $total_data;
          $List['iTotalDisplayRecords'] = $total_data;


          return json_encode($List);
     }
}
