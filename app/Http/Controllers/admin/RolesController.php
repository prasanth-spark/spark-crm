<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\TeamModel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
use DB;

class RolesController extends Controller
{
    public function __construct(UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, Role $rolemodel, TeamModel $teammodel, User $user ,Permission $permission)
    {
        $this->userdetails = $userdetails;
        $this->accountType = $accountType;
        $this->bankdetails = $bankdetails;
        $this->rolemodel   = $rolemodel;
        $this->teammodel   = $teammodel;
        $this->user        = $user;
        $this->permission  = $permission;

    }

    public function roleList()
    {
        $roles = $this->rolemodel->all()->except(1);
        return view('admin/employee/employee-role',compact('roles'));
    }

    public function rolesPermissionlist(Request $request)
    {
       $id = $request->id;
       $permissionLists = $this->permission->with('roles')->get();
       $role_permissions = DB::table('role_has_permissions')->where('role_id',$id)->get();
       return view('admin/employee/roles-permission-list',compact('permissionLists','id','role_permissions'));
    }

    public function addRole(Request $request)
    {
        $web = "web";
        $this->rolemodel->create([
         'name' => $request->name,
         'guard_name' => $web,
        ]);
        return redirect('admin/employee-role'); 
    }

    public function addPermissionrole(Request $request)
    {
        $role_id = $request->role_id;
        $permission_ids = $request->permission_ids;
        $role = Role::find($role_id);
        $permission = Permission::find($permission_ids);
        $role->syncPermissions($permission);
        return redirect('admin/employee-role');
    }

    public function roleDelete(Request $request)
    {
        $this->rolemodel->where('id', $request->role_id)->delete();
        return redirect('admin/employee-role');
    }
}

