<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
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

class EmployeeController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
    }
    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeForm()
    {
        try {
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id', '!=', 1)->get();
            $team = $this->teammodel->get();
            return view('admin/employee/employee-form', compact('bankName', 'accountType', 'role', 'team'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Add Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function employeeAdd(EmployeeValidationRequest $request)
    {
        try {
            $userCredentials = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'status' => '1',
                'password' => Hash::make($request->password),
                'role_id' => $request->role,

            ]);
            dispatch(new VerfyUserEmailJob($userCredentials));

            $this->userdetails->create([
                'user_id' => $userCredentials->id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'phone_number' => $request->phone_number,
                'emergency_contact_number' => $request->emergency_contact_number,
                'official_email' => $request->official_email,
                'joined_date' => $request->joined_date,
                'home_address' => $request->home_address,
                'date_of_birth' => $request->date_of_birth,
                'blood_group' => $request->blood_group,
                'pan_number' => $request->pan_number,
                'aadhar_number' => $request->aadhar_number,
                'bank_id' => $request->bank_name,
                'account_holder_name'    => $request->account_holder_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'branch_name' => $request->branch_name,
                'account_type_id' => $request->account_type,
                'role_id' => $userCredentials->role_id,
                'team_id' => $request->team_name,
            ]);
            return redirect('/admin/employee-list');
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Employee List .
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeList()
    {
        try {

            $employeeList = $this->user->where('status', 1)->with('userDetail', 'userDetail.teamToUserDetails', 'userDetail.roleToUserDetails')->get();
            return view('admin/employee/employee-list', compact('employeeList'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     *  Employee Details
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function employeeDetails($id)
    {
        try {
            $employeeView = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'roleToUserDetails', 'teamToUserDetails')->first();
            return view('admin/employee/employee-view', compact('employeeView'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Edit Employee.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function employeeEdit($id)
    {
        try {
            $employeeEdit = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'roleToUserDetails', 'teamToUserDetails')->first();
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id', '!=', 1)->get();
            $team = $this->teammodel->get();
            return view('admin/employee/employee-edit', compact('employeeEdit', 'bankName', 'accountType', 'role', 'team'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Update Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function employeeUpdate(EmployeeUpdateValidationRequest $request)
    {
        // try{ 
        $oldUser = $this->user->getSingleUser($request->id);
        $this->user->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
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
            'blood_group' => $request->blood_group,
            'pan_number' => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'bank_id' => $request->bank_name,
            'account_holder_name'    => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch_name' => $request->branch_name,
            'account_type_id' => $request->account_type,
            'role_id' => $request->role,
            'team_id' => $request->team_name,
        ]);
        return redirect('/admin/employee-list');

        // } catch (\Throwable $exception) {
        //     Log::info($exception->getMessage());
        //     } 
    }

    /**
     * Delete Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function newRegisterList()
    {
        try {
            $newRegisterList = $this->user->whereIn('status', [2, 3])->with('roleToUser')->get();
            return view('admin/employee/new-register-form', compact('newRegisterList'));
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Approved status .
     *
     * @return \Illuminate\Http\Response
     */
    public function adminApproved($id)
    {
        try {
            $adminApprovedMail = $this->user->where('id', $id)->first();
            $adminApprovedMail->update(['status' => '3']);
            dispatch(new AdminApproved($adminApprovedMail));
            return back();
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * Rejected status .
     *
     * @return \Illuminate\Http\Response
     */
    public function adminRejected($id)
    {
        try {
            $this->user->where('id', $id)->update(['status' => 2]);
            return back();
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }




    /**
     * file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('admin/employee/file-upload');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function employeeListExport()
    {
        return Excel::download(new UsersExport(), 'SampleExport.xlsx');

        // $userDetails = $this->user->where('role_id', '!=', 1)->with('userDetail', 'teamToUser', 'roleToUser')->first();
        // $a = array();
        // foreach ($userDetails as $user) {
        //     $array = [
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         'team' => ($user->teamToUser) ? $user->teamToUser->team : "",
        //         'role' => $user->roleToUser->role,
        //         'employee_id' => ($user->userDetail) ? $user->userDetail->employee_id : "",
        //         'father_name' => ($user->userDetail) ? $user->userDetail->father_name : "",
        //         'mother_name' => ($user->userDetail) ? $user->userDetail->mother_name : "",
        //         'phone_number' => ($user->userDetail) ? $user->userDetail->phone_number : "",
        //         'emergency_contact_number' => ($user->userDetail) ? $user->userDetail->emergency_contact_number : "",
        //         'official_email' => ($user->userDetail) ? $user->userDetail->official_email : "",
        //         'joined_date' => ($user->userDetail) ? $user->userDetail->joined_date : "",
        //         'home_address' => ($user->userDetail) ? $user->userDetail->home_address : "",
        //         'date_of_birth' => ($user->userDetail) ? $user->userDetail->date_of_birth : "",
        //         'blood_group' => ($user->userDetail) ? $user->userDetail->blood_group : "",
        //         'pan_number' => ($user->userDetail) ? $user->userDetail->pan_number : "",
        //         'aadhar_number' => ($user->userDetail) ? $user->userDetail->aadhar_number : "",
        //         'bank_id' => ($user->userDetail) ? $user->userDetail->bank_id : "",
        //         'account_holder_name' => ($user->userDetail) ? $user->userDetail->account_holder_name : "",
        //         'account_number' => ($user->userDetail) ? $user->userDetail->employee_id : "",
        //         'ifsc_code' => ($user->userDetail) ? $user->userDetail->ifsc_code : "",
        //         'branch_name' => ($user->userDetail) ? $user->userDetail->branch_name : "",
        //         'account_type_id' => ($user->userDetail) ? $user->userDetail->account_type_id : "",


        //     ];
        //     $a[] = $array;
        // }
        // return (new FastExcel($a))->download('file.csv');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function employeeListImport(Request $request)
    {
        if ($request->has('header')) {
            $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
            $data = Excel::toArray(new UsersImport, $request->file('csv_file'))[0];
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 5);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('admin/employee/import_fields',  [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file
        ]);
    }

    public function importProcess(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_all_data = json_decode($data->csv_data, true);
        unset($csv_all_data[0]);
        $config = config('app.db_fields');
        foreach ($csv_all_data as $key => $row) {
            $csv = array_combine(array_slice($config, 0, 6),  array_slice($row, 0, 6));
            $request1 = array_slice($request->fields, 0, 6);
            $userCredentials = new User();
            foreach (array_slice($config, 0, 6) as $key => $field) {
                $ab = $request1[$key];
                if ($ab == 'password') {
                    $hashPassword = Hash::make($csv[$field]);
                    $userCredentials->$ab = $hashPassword;
                } else {
                    $userCredentials->$ab = $csv[$field];
                }
            }

            $userCredentials->save();
            dispatch(new VerfyUserEmailJob($userCredentials));

            $csv1 = array_combine(array_slice($config, 6, 24),  array_slice($row, 6, 24));
            $request2 = array_slice($request->fields, 6, 24);
            $UserDetails = new UserDetails();
            foreach (array_slice($config, 6, 24) as $key => $field) {
                $ab = $request2[$key];
                if ($ab == 'user_id') {
                    $user_id = $userCredentials->id;
                    $UserDetails->$ab = $user_id;
                } elseif ($ab == 'role_id') {
                    $role_id = $userCredentials->role_id;
                    $UserDetails->$ab = $role_id;
                } elseif ($ab == 'team_id') {
                    $team_id = $userCredentials->team_id;
                    $UserDetails->$ab = $team_id;
                } else {
                    $UserDetails->$ab = $csv1[$field];
                }
            }

            $UserDetails->save();
        }
        return redirect()->route('file-upload');
    }
}
