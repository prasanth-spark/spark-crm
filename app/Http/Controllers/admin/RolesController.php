<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\AccountType;
use App\Models\BankDetails;
use App\Models\RoleModel;
use App\Models\TeamModel;
use App\Models\Permission;
use App\Models\RolehasPermission;
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

class RolesController extends Controller
{
    public function __construct(RolehasPermission $rolehaspermission,UserDetails $userdetails, AccountType $accountType, BankDetails $bankdetails, RoleModel $rolemodel, TeamModel $teammodel, User $user ,Permission $permission)
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
       $permissionLists = $this->permission->get();
       return view('admin/employee/roles-permission-list',compact('permissionLists','id'));
    }

    public function roleAddform(Request $request)
    {
        return view('admin/employee/add-role');
    }

    public function addPermissionrole(Request $request)
    {
        $rolehaspermission = new RolehasPermission();
        $rolehaspermission->permission()->sync($request->permission_ids);
        $rolehaspermission->role_id = $request->role_id;
        $rolehaspermission->save();
    }

    public function roleDelete(Request $request)
    {
        $this->rolemodel->where('id', $request->role_id)->delete();
        return redirect('admin/employee-role');
    }
}

