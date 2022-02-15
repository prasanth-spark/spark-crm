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
                            <a class="text-gray-500 ml-4 2xl:ml-16" href="">
                                    <i data-feather="refresh-ccw" class="w-4 h-4"></i>
                            </a>
                    </div>
                </div>
                <div class="mt-14 mb-3 grid grid-cols-12 sm:gap-10 intro-y">
                    <div class="col-span-12 sm:col-span-6 md:col-span-6py-6 sm:pl-5 md:pl-0 lg:pl-5 relative text-center sm:text-left">
                        <!-- <div class="absolute pt-0.5 2xl:pt-0 mt-5 2xl:mt-6 top-0 right-0 dropdown">
                            <a class="dropdown-toggle block" href="javascript:;" aria-expanded="false">
                                <i data-feather="more-vertical" class="w-5 h-5 text-theme-34"></i>
                            </a>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Monthly Report
                                    </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Annual Report
                                    </a>
                                </div>
                            </div>
                        </div> -->
                        <div class="text-white text-sm 2xl:text-base font-medium -mb-1">
                            Hi ,<span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
                        </div>
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24">
                            Today's Attendance :
                            <!-- <i data-feather="alert-circle" class="tooltip w-5 h-5 ml-1.5 mt-0.5" title="Total value of your sales: $158.409.416"></i> -->
                        </div>
                        <div class="2xl:flex mt-5 mb-3">
                            <div class="flex items-center justify-center sm:justify-start">
                            <div class="boxed-tabs nav nav-tabs justify-center w-3/4 2xl:w-4/6 bg-theme-27 text-white dark:bg-dark-2 dark:text-gray-500 rounded-md p-1 mx-auto" role="tablist">
                              <a data-toggle="tab" data-target="#active-users" href="javascript:;" class="btn flex-1 border-0 shadow-none py-1.5 px-2 active" id="active-users-tab" role="tab" aria-controls="active-users" aria-selected="true">Present</a>
                               <a data-toggle="tab" data-target="#inactive-users" href="javascript:;" class="btn flex-1 border-0 shadow-none py-1.5 px-2" id="inactive-users-tab" role="tab" aria-selected="false">Leave</a>
                            </div>
                            </div>
                        </div>
                        <div class="text-theme-34 mt-5">Update Regularly</div>
                        <!-- <div class="2xl:text-base text-theme-34 mt-6 -mb-1">
                            Avoid Taking leave 
                        </div> -->
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
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                        <i data-feather="portal-exit" class="w-4 h-4 mr-2"></i>Permission 
                                    </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md">
                                        <i data-feather="user-minus" class="w-4 h-4 mr-2"></i> Leave
                                    </a>
                                </div>
                                <!-- <i class="fas fa-portal-exit"></i> -->
                            </div>
                        </div>
                               <div class="w-2 h-2 bg-theme-24 rounded-full -mt-4"></div>
                                <div class="ml-3.5">
                                    <!-- <div class="relative text-white text-xl 2xl:text-2xl font-medium leading-6 2xl:leading-5 pl-3.5 2xl:pl-4">
                                        <span class="absolute text-base 2xl:text-xl top-0 left-0 2xl:-mt-1.5">$</span> 47,578.77
                                    </div> -->
                                  
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
                            <option value="daily">Daily</option>
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