<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use Spatie\Permission\Models\Role;
use App\Models\TeamModel;
use App\Models\User;
use App\Models\CsvData;
use App\Jobs\VerfyUserEmailJob;
use App\Jobs\UpdateUserEmailJob;
use App\Jobs\AdminApproved;
use App\Http\Request\EmployeeValidationRequest;
use App\Http\Request\EmployeeUpdateValidationRequest;
use Illuminate\Support\Arr;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use  App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Helper\ImageUpload;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    use ImageUpload;
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
        $this->middleware('permission:employee-list', ['only' => ['employeeList','employeeListPagination']]);
        $this->middleware('permission:employee-add', ['only' => ['employeeForm','employeeAdd']]);
        $this->middleware('permission:employee-detail', ['only' => ['employeeDetails']]);
        $this->middleware('permission:employee-edit', ['only' => ['employeeEdit','employeeUpdate']]);
        $this->middleware('permission:employee-delete', ['only' => ['employeeDelete']]);
    }
    public function employeeList()
    {
        try {
            $employeeList = $this->user->where('status', 1)->with('userDetail', 'teamToUser', 'roleToUser')->get();
            return view('employee/employee-list', compact('employeeList'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }
    public function employeeListPagination(Request $request)
    {
        $employeeList = $this->user->where('status', 1)->with('userDetail', 'teamToUser', 'roleToUser');
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $employeeList->where('name', 'like', '%' . $keyword . '%');

            $employeeList->orwhereHas('teamToUser', function ($q) use ($keyword) {
                $q->where('team', 'like', '%' . $keyword . '%');
            });
            $employeeList->orwhereHas('roleToUser', function ($q) use ($keyword) {
                return $q->where('name', 'like', '%' . $keyword . '%');
            });
        }       
        $total_data = $employeeList->count();
        $employeeList = $employeeList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );
        $employeeLists = $employeeList->latest()->get();
        $column = array();
        $employeeListData = [];
        foreach ($employeeLists as $employeeList) {
            $col['id'] = $offset + 1;
            $col['employee_id'] = isset($employeeList->userDetail->employee_id) ? $employeeList->userDetail->employee_id : '';
            $col['name'] = $employeeList->name;
            $col['phone_number'] = isset($employeeList->userDetail->phone_number) ? $employeeList->userDetail->phone_number : '';
            $col['role_id'] = isset($employeeList->roleToUser->name) ? $employeeList->roleToUser->name : '';
            $col['team_id'] = isset($employeeList->teamToUser->team) ? $employeeList->teamToUser->team : '';
            $col['action'] = '';
            if(Auth::user()->hasPermissionTo('employee-detail'))
            {
                $col['action'] .= '<a class="flex items-center mr-3" href="' . url('/') . '/employee/employee-details/' . $employeeList->id . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye w-4 h-4 mr-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>view
                             </a>';
            }      
            if(Auth::user()->hasPermissionTo('employee-edit'))
            {          
                $col['action'] .= '<a class="flex items-center mr-3" href="' . url('/') . '/employee/employee-edit/' . $employeeList->id . '">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4 mr-1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit
                            </a>';
            }         
            if(Auth::user()->hasPermissionTo('employee-delete'))
            {          
                $col['action'] .= '<a class="flex items-center text-theme-21" data-toggle="modal" data-target="#delete-confirmation-modal-' . $employeeList->id . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete
                            </a>
                            <div id="delete-confirmation-modal-' . $employeeList->id . '" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="' . route('employeedelete') . '" method="post">
                                <input type="hidden" name="_token" id="csrf-token" value="' . Session::token() . '"/>
                                <input type="hidden" name="id" value="' . $employeeList->id . '">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <em data-feather="x-circle" class="w-16 h-16 text-theme-21 mx-auto mt-3"></em>
                                                <div class="text-3xl mt-5">Are you sure?</div>
                                                <div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                                <button type="submit" class="btn btn-danger w-24">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>';
            }     
            array_push($column, $col);
            $offset++;
        }      
        $employeeListData['sEcho'] = $request->sEcho;
        $employeeListData['aaData'] = $column;
        $employeeListData['iTotalRecords'] = $total_data;
        $employeeListData['iTotalDisplayRecords'] = $total_data;
        return json_encode($employeeListData);
    }
    public function employeeForm()
    {
        try {
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id', '!=', 1)->get();
            $team = $this->teammodel->whereNotIn('id', ['1','9'])->get();
            return view('employee/employee-form', compact('bankName', 'accountType', 'role', 'team'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }
    public function employeeAdd(EmployeeValidationRequest $request)
    {
            if($request->team_name == null)
            {
             if($request->role == 3||$request->role == 4||$request->role == 5)
             {
                $request->team_name = "10";

             }elseif($request->role == 2){

                $request->team_name = "1";
             } 
             else{
                $request->team_name;
             }
            }
        $userCredentials = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => '1',
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'team_id' => $request->team_name,
        ]);

        if ($request->hasFile('photos')) {
            $photos = $this->commonImageUpload($request->photos, 'photos');
            $userCredentials->update(['photo' => $photos]);
        }
        $password = $request->password;
        dispatch(new VerfyUserEmailJob($userCredentials, $password));

        $userCredentials->assignRole([$request->role]);
        $count = User::count();

        switch($userCredentials->role_id)
        {
        case $userCredentials->role_id==2:
        $designation = "Human Resources";
        break;
        case $userCredentials->role_id==3:
        $designation = "Deploy Head";
        break;
        case $userCredentials->role_id==4:
        $designation = "Development Head";
        break;
        case $userCredentials->role_id==5:
        $designation = "Project Manager";
        break;
        case $userCredentials->role_id==6:
        $designation = "Team Head";
        break; 
        case $userCredentials->role_id==8:
        $designation = "Intenship";
        break;
        default:
        $designation = $request->desigination;
        }

        $this->userdetails->create([
            'user_id' => $userCredentials->id,
            'employee_id' => 'SOT-' . ($count),
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone_number' => $request->phone_number,
            'emergency_contact_number' => $request->emergency_contact_number,
            'official_email' => $request->official_email,
            'joined_date' => $request->joined_date,
            'home_address' => $request->home_address,
            'date_of_birth' => $request->date_of_birth,
            'certificate_date_of_birth' => $request->certificate_date_of_birth,
            'designation' => $designation,
            'blood_group' => $request->blood_group,
            'pan_number' => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'bank_id' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch_name' => $request->branch_name,
            'account_type_id' => $request->account_type,
        ]);
        return redirect('employee/employee-list');
    }
    public function employeeDetails($id)
    {
        
        try {
            $employeeView = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'user.roleToUser', 'user.teamToUser')->first();
            return view('employee/employee-view', compact('employeeView'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
        
    }

    public function employeeEdit($id)
    {
        
        try {
            $employeeEdit = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'user.roleToUser', 'user.teamToUser')->first();
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id', '!=', 1)->get();
            $team = $this->teammodel->get();
            return view('employee/employee-edit', compact('employeeEdit', 'bankName', 'accountType', 'role', 'team'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }
    public function employeeUpdate(EmployeeUpdateValidationRequest $request)
    {
        $oldUser = $this->user->getSingleUser($request->id);

        $this->user->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' =>$request->role,
            'team_id'=>$request->team_name,
        ]);
        if ($request->hasFile('photos')) {
            $photos = $this->commonImageUpload($request->photos, 'photos');
            $this->user->where('id', $request->id)->update(['photo' => $photos]);
        }
        $user = $this->user->getSingleUser($request->id);

        if ($oldUser->email != $user->email) {
            dispatch(new UpdateUserEmailJob($user));
        }
        $this->userdetails->where('user_id', $request->id)->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone_number' => $request->phone_number,
            'emergency_contact_number' => $request->emergency_contact_number,
            'official_email' => $request->official_email,
            'joined_date' => $request->joined_date,
            'home_address' => $request->home_address,
            'date_of_birth' => $request->date_of_birth,
            'certificate_date_of_birth' => $request->certificate_date_of_birth,
            'blood_group' => $request->blood_group,
            'pan_number' => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'bank_id' => $request->bank_name,
            'account_holder_name'    => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch_name' => $request->branch_name,
            'account_type_id' => $request->account_type,
            'designation' => $request->desigination,
        ]);
        return redirect('/employee/employee-list');
    }
    public function employeeDelete(Request $request)
    {
        try {
            $this->user->where('id', $request->id)->delete();
            $this->userdetails->where('user_id', $request->id)->delete();
            return back();
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

}
