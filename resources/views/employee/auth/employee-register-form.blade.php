<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="/dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Register</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="/dist/css/app.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">

    <div class="container sm:px-10">

        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/dist/images/spark1.svg">
                    <span class="text-white text-lg ml-3"> Sparkout</span>
                </a>
                <div class="my-auto">
                    <img alt="Tinker Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/dist/images/spark.svg">
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form action="{{route('user-dashboard')}}" method="post" id="myForm">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" id="Name"placeholder="Name" name="name" onchange="myFunction1()">
                            @error('name')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"id="Email" placeholder="Email" name="email" onchange="myFunction2()">
                            @error('email')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" id="Password" placeholder="Password" name="password" onchange="myFunction3()">
                            @error('password')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                            <div class="input-form  mt-4" style="background: transparent;">

                                 <select placeholder="Account Type" type="text" class="tom-select w-full border border-solid border-gray-300 rounded-lg py-3 px-4" id="Role" name='role' onchange="myFunction4()">
                                    <option value="Select Role" selected disabled>Select Role</option>
                                    @foreach($role as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>                             
                                @error('role')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                            <a href="{{ route('user-login-view')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>  
     function myFunction1() {
    $("#Name").css("border-color",'unset');
    }function myFunction2() {
    $("#Email").css("border-color",'unset');
    }function myFunction3() {
    $("#Password").css("border-color",'unset');
    }function myFunction4() {
    $("#Role").css("border-color",'unset');
    }
       toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };   
                @if(Session::has('success'))
                const toastHTML = '{{Session::get('success')}}';
                toastr["success"](toastHTML);
                @php Session::forget('success'); @endphp
                @endif
                @if(Session::has('error'))
                const toastHTML = '{{Session::get('error')}}';
                toastr["error"](toastHTML);
                @php Session::forget('error'); @endphp
                @endif
                $("#myForm").submit(function(e)
                {
                    var Name = $("#Name").val();
                    var Email = $("#Email").val();
                    var Password = $("#Password").val();
                    var Role = $("#Role").val();
             if(Name == null || Name == "")
             {
             $("#Name").css("border-color",'red');
             e.preventDefault();
             }
             else
             {
             $("#Name").css("border-color",'unset');
             }       
            if(Email == null || Email == "")
             {
             $("#Email").css("border-color",'red');
             e.preventDefault();
             }
             else
             {
             $("#Email").css("border-color",'unset');
             } 
            if(Password == null || Password == "")
             {
             $("#Password").css("border-color",'red');
             e.preventDefault();
             }
             else
             {
             $("#Password").css("border-color",'unset');
             } 
             if(Role == null || Role == "")
             {
             $("#Role").css("border-color",'red');
             e.preventDefault();
             }
             else
             {
             $("#Role").css("border-color",'unset');
             } 
            });

</script>
    <!-- END: JS Assets-->
</body>

</html>