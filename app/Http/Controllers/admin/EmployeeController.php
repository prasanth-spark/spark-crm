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
use App\Jobs\VerfyUserEmailJob;
use App\Jobs\UpdateUserEmailJob;
use App\Jobs\AdminApproved;
use App\Http\Request\EmployeeValidationRequest;
use App\Http\Request\EmployeeUpdateValidationRequest;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



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
        try{
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id','!=',1)->get();
            $team = $this->teammodel->get();
            return view('admin/employee/employee-form', compact('bankName', 'accountType', 'role', 'team'));
        } 
        catch (\Throwable $exception) {
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
        try{
                $userCredentials = $this->user->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'status'=>'1',
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
        try{

                $employeeList = $this->user->where('status',1)->with('userDetail')->get();
                return view('admin/employee/employee-list', compact('employeeList'));

        }catch (\Throwable $exception) {
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
        try{
                $employeeView = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'roleToUserDetails', 'teamToUserDetails')->first();
                return view('admin/employee/employee-view', compact('employeeView'));

        }catch (\Throwable $exception) {
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
        try{
            $employeeEdit = $this->userdetails->where('user_id', $id)->with('bankNameToEmployee', 'accountTypeToEmployee', 'user', 'roleToUserDetails', 'teamToUserDetails')->first();
            $bankName = $this->bankdetails->get();
            $accountType = $this->accountType->get();
            $role = $this->rolemodel->where('id','!=',1)->get();
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
        try{
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
        try{
            $newRegisterList = $this->user->whereIn('status', [2, 3])->with('roleToUser')->get();
            return view('admin/employee/new-register-form', compact('newRegisterList'));
        } 
        catch (\Throwable $exception) {
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
        try{
            $adminApprovedMail= $this->user->where('id',$id)->first();
            $adminApprovedMail->update(['status'=>'3']);
            dispatch(new AdminApproved($adminApprovedMail));
             return back();
        } 
        catch (\Throwable $exception) {
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
        try{
             $this->user->where('id',$id)->update(['status'=>2]);
             return back();
        } 
        catch (\Throwable $exception) {
            Log::info($exception->getMessage());
        }
    }




    /**
     * file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function fileUpload()
    // {
    //     return view('admin/employee/file-upload');
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function employeeListExport()
    // {
    //     return (new FastExcel(UserDetails::all()))->download('file.xlsx');
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function employeeListImport(Request $request)
    // {
    //     if ($request->file) {
    //         $fileType = $request->file->getClientOriginalExtension();
    //         $fileName = time() . '.' . $fileType;
    //         $request->file->move(public_path('uploads'), $fileName);
    //         $fileData = public_path('uploads/') . $fileName;

    //         (new FastExcel)->import($fileData, function ($reader) {
    //             $list = array(
    //                 'id' => $reader['id'],
    //                 'name' => $reader['name'],
    //                 'father_name' => $reader['father_name'],
    //                 'mother_name' => $reader['mother_name'],
    //                 'phone_number' => $reader['phone_number'],
    //                 'emergency_contact_number' => $reader['emergency_contact_number'],
    //                 'email' => $reader['email'],
    //                 'official_email' => $reader['official_email'],
    //                 'joined_date' => $reader['joined_date'],
    //                 'home_address' => $reader['home_address'],
    //                 'date_of_birth' => $reader['date_of_birth'],
    //                 'blood_group' => $reader['blood_group'],
    //                 'pan_number' => $reader['pan_number'],
    //                 'aadhar_number' => $reader['aadhar_number'],
    //                 'account_holder_name' => $reader['account_holder_name'],
    //                 'account_number' => $reader['account_number'],
    //                 'ifsc_code' => $reader['ifsc_code'],
    //                 'branch_name' => $reader['branch_name'],
    //                 'account_type_id' => $reader['account_type_id'],
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             );
    //             UserDetails::insert($list);
    //             return back();
    //         });
    //     } else {
    //         return back();
    //     }
    // }
}
