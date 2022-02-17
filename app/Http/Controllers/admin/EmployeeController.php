<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Http\Request\EmployeeValidationRequest;
use Rap2hpoutre\FastExcel\FastExcel;


class EmployeeController extends Controller
{
    public function __construct(Employee $employee,AccountType $accountType,BankDetails $bankdetails)
    {
        $this->employee = $employee;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
    }
    /**
     * Show specified view.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeForm()
    {
        $bankName=$this->bankdetails->get();
        $accountType=$this->accountType->get();
        return view('admin/employee/employee-form',compact('bankName','accountType')); 
    }

     /**
     * Add Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function employeeAdd(Request $request)
    {
       $this->employee->create([
          'name'=>$request->name,
          'father_name'=>$request->father_name,
          'mother_name'=>$request->mother_name,
          'phone_number'=>$request->phone_number,
          'emergency_contact_number'=>$request->emergency_contact_number,
          'email'=>$request->email,
          'official_email'=>$request->official_email,
          'joined_date'=>$request->joined_date,
          'home_address'=>$request->home_address,
          'data_of_birth'=>$request->data_of_birth,
          'blood_group'=>$request->blood_group,
          'pan_number'=>$request->pan_number,
          'aadhar_number'=>$request->aadhar_number,
          'bank_id'=>$request->bank_name,
          'account_holder_name'	=>$request->account_holder_name,
          'account_number'=>$request->account_number,
          'ifsc_code'=>$request->ifsc_code,
          'branch_name'=>$request->branch_name,
          'account_type_id'=>$request->account_type,
        ]);
        return redirect('/employee-list');
    }

    /**
     * List Employee.
     *
     * @return \Illuminate\Http\Response
     */
     public function employeeList()
     {
         $employeeList=$this->employee->tobase()->get();
         return view('admin/employee/employee-list',compact('employeeList'));
       
     }
     
    /**
     *  Employee Details
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function employeeDetails($id)
    {
        $employeeView=$this->employee->where('id',$id)->with('bankNameToEmployee','accountTypeToEmployee') ->first(); 
        return view('admin/employee/employee-view',compact('employeeView'));
    }

    /**
     * Edit Employee.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function employeeEdit($id)
    {
        $employeeEdit=$this->employee->where('id',$id)->with('bankNameToEmployee','accountTypeToEmployee')->first();
        $bankName=$this->bankdetails->get();
        $accountType=$this->accountType->get();
        return view('admin/employee/employee-edit',compact('employeeEdit','bankName','accountType'));
    }
       /**
     * Update Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function employeeUpdate(Request $request)
     {
        $this->employee->where('id',$request->id)->update([
            'name'=>$request->name,
            'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,
            'phone_number'=>$request->phone_number,
            'emergency_contact_number'=>$request->emergency_contact_number,
            'email'=>$request->email,
            'official_email'=>$request->official_email,
            'joined_date'=>$request->joined_date,
            'home_address'=>$request->home_address,
            'data_of_birth'=>$request->data_of_birth,
            'blood_group'=>$request->blood_group,
            'pan_number'=>$request->pan_number,
            'aadhar_number'=>$request->aadhar_number,
            'bank_id'=>$request->bank_name,
            'account_holder_name'	=>$request->account_holder_name,
            'account_number'=>$request->account_number,
            'ifsc_code'=>$request->ifsc_code,
            'branch_name'=>$request->branch_name,
            'account_type_id'=>$request->account_type,
         ]);
         return redirect('/employee-list');
     }

     /**
     * Delete Employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function employeeDelete(Request $request)
     {
         $this->employee->where('id',$request->id)->delete();
         return back();
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
        return (new FastExcel(Employee::all()))->download('file.xlsx');
    
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function employeeListImport(Request $request) 
    {
        if($request->file){
        $fileType= $request->file->getClientOriginalExtension();
        $fileName = time().'.'.$fileType;
        $request->file->move(public_path('uploads'), $fileName);
        $fileData = public_path('uploads/').$fileName;

        (new FastExcel)->import($fileData, function ($reader) {
            $list = array(
                 'id' => $reader['id'],
                 'name' => $reader['name'] ,
                 'father_name' => $reader['father_name'],
                 'mother_name' => $reader['mother_name'],
                 'phone_number' => $reader['phone_number'],
                 'emergency_contact_number' => $reader['emergency_contact_number'],
                 'email' => $reader['email'],
                 'official_email' => $reader['official_email'],
                 'joined_date' => $reader['joined_date'],
                 'home_address' => $reader['home_address'],
                 'data_of_birth' => $reader['data_of_birth'],
                 'blood_group' => $reader['blood_group'],
                 'pan_number' => $reader['pan_number'],
                 'aadhar_number' => $reader['aadhar_number'],
                 'account_holder_name' => $reader['account_holder_name'],
                 'account_number' => $reader['account_number'],
                 'ifsc_code' => $reader['ifsc_code'],
                 'branch_name' => $reader['branch_name'] ,
                 'account_type_id' => $reader['account_type_id'],
                 'created_at' => now(),
                 'updated_at' => now(),
            );
            Employee::insert($list);
            return back();   
        });
    }else{
        return back();
    }
    }

    public function adminAttendance(){
      return view('admin/employee/employee-attendance');
    
    }
}
