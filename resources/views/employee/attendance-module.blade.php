@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Dashboard Employee-CRM</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 lg:col-span-12">
            <!-- Attendance card -->
            <div class="relative">
        <div class="grid grid-cols-12">
         <div class="col-span-12 xl:col-span-12 2xl:col-span-12 z-12">
            <div class="intro-y box mt-5">
                    <div class="show box bg-theme-25 text-white flex items-center mb-12">
                        <span>
                            <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Attendance Detail</button>
                        </span>
                    </div>
            </div>
            <div class="mt-14 mb-3 grid grid-cols-12 sm:gap-10 intro-y">
                <div class="col-span-12 sm:col-span-6 md:col-span-6py-6 sm:pl-5 md:pl-0 lg:pl-5 relative text-center sm:text-left">
                    <div class="text-white text-sm 2xl:text-base font-medium -mb-1">
                          Hi {{$user['name']}} ,
                            <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
                    </div>
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24">
                            Today's Attendance :
                            <!-- <i data-feather="alert-circle" class="tooltip w-5 h-5 ml-1.5 mt-0.5" title="Total value of your sales: $158.409.416"></i> -->
                        </div>
                    <div class="2xl:flex mt-5 mb-3">
                        <div class="flex items-center justify-center sm:justify-start">
                            <div class="boxed-tabs nav nav-tabs justify-center w-3/4 2xl:w-4/6 bg-theme-27 text-white dark:bg-dark-2 dark:text-gray-500 rounded-md p-1 mx-auto" role="tablist">
                                    <a data-toggle="tab" data-target="#inactive-users" href="{{route('attendance-status',0)}}" class="btn flex-1 border-0 shadow-none py-1.5 px-2" id="inactive-users-tab" role="tab" name="inactive" value="0" aria-selected="false">Inactive</a>  
                                    <a data-toggle="tab" data-target="#active-users" href="{{route('attendance-status',1)}}" class="btn flex-1 border-0 shadow-none py-1.5 px-2 active" id="active-users-tab"  name="active" value="1" role="tab" aria-controls="active-users" aria-selected="true">Active</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-theme-34 mt-5">Update Regularly</div>
                </div>
                    <div class="row-start-2 md:row-start-auto col-span-12 md:col-span-6 py-6 border-theme-11 border-t md:border-t-0 md:border-l md:border-r border-dashed px-10 sm:px-28 md:px-5 -mx-5">
                        <div class="flex flex-wrap items-center">
                            <div class="flex items-center w-full sm:w-auto justify-center sm:justify-start mr-auto mb-5 2xl:mb-0">
                               <div class="mt-14 2xl:mt-24 dropdown">
                                     <button class="dropdown-toggle btn btn-rounded bg-theme-25 border-theme-25 text-white w-44 2xl:w-52 px-4 relative justify-start" aria-expanded="false">
                                        Leave Request
                                        <span class="w-8 h-8 absolute flex justify-center items-center right-0 top-0 bottom-0 my-auto ml-auto mr-1">
                                                         <i data-feather="chevron-down" class="w-4 h-4"></i>
                                        </span>
                                     </button>
                                    <div class="dropdown-menu w-44 2xl:w-52">
                                       <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                           <a href="{{route('leave-request',1)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check block mx-auto"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg> Permission 
                                           </a>
                                           <a href="{{route('leave-request',2)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x block mx-auto"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg>   Leave
                                           </a>
                                        </div>
                                    </div>
                                
                                        <div class="intro-y box mt-5">
                                            <div id="datepicker" class="p-5">
                                               <h2 class="font-medium text-base mr-auto">Select the Date</h2>
                                            </div>
                                        </div>
                                      <div class="col-span-12 sm:col-span-6">
                                         <label for="modal-datepicker-1" class="form-label" name="start_date" id="start_date">From</label>
                                            <input id="modal-datepicker-1" class="datepicker form-control" data-single-mode="true">
                                      </div>
                                      <div class="col-span-12 sm:col-span-6">
                                         <label for="modal-datepicker-2" class="form-label"name="end_date" id="end_date">To</label>
                                            <input id="modal-datepicker-2" class="datepicker form-control" data-single-mode="true">
                                      </div>
                                                               
                               </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
         </div>
        </div> 
        </div>
</div>
        <div class="intro-y box mt-5">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            
                <div class="flex flex-wrap items-center w-full justify-between">
                <div>
                <h2 class="font-medium text-base mr-auto">Attendance Report</h2> 
            </div>        
          
                        <!-- <div class="flex items-center w-full sm:w-auto justify-center sm:justify-start mr-auto mb-5 2xl:mb-0">
                            <div class="ml-3.5">
                                <div class="text-theme-34 mt-2">Attendance Report</div>
                            </div>
                        </div> -->
                        <select class="form-select  mx-auto sm:mx-0 py-1.7 px-3 w-auto -mt-2">
                            <option>...</option>
                            <option value="custom-date">Custom Date</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>                            
                        </select>
                </div>
                
            </div>
        </div> 
        </div>
    </div>

    

    @endsection