@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Attendance-Report</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 ">
            <span class="show box bg-theme-25 text-white flex items-center">
                <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Attendance Detail</button>
            </span>
            <div class="text-black text-sm 2xl:text-base font-medium mt-4">
                    Hi {{$user['name']}} ,
                    <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
            </div>
        </div>   
    <div class="intro-y col-span-12 lg:col-span-6 text-white text-sm p-4">
        <div class="intro-y">
         </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6  p-4">
        <div class="intro-y"> 

        </div>
    </div>
</div>

@endsection
   

        

   