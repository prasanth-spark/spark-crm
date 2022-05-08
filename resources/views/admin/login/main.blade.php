<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/spark.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="/dist/css/app.css" />
        <!-- END: CSS Assets-->
       
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/dist/images/spark1.svg">
                        <span class="text-white text-lg ml-3"> Sparkout </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Tinker Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/dist/images/spark.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Sign in to your account.
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form action="{{route('login')}}" method="post" id="myForm">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" id="Email" placeholder="Email" name="email" onchange="myFunction1()">
                            @error('email')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" id="Password" placeholder="Password" name="password"onchange="myFunction2()">
                            @error('password')
                            <span style="color:red">{{$message}}</span>
                            @enderror

                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        function myFunction1() {
        $("#Email").css("border-color",'unset');
        }function myFunction2() {
        $("#Password").css("border-color",'unset');
        }
        $(document).ready(function() {
        $("#myForm").submit(function(e)
        {
            var Email = $("#Email").val();
            var Password = $("#Password").val();
            if(Email == null || Email == ""){
                $("#Email").css("border-color",'red');
                e.preventDefault();
             }else{
                $("#Email").css("border-color",'unset');
             } 
            if(Password == null || Password == ""){
                $("#Password").css("border-color",'red');
                e.preventDefault();
             }else{
                $("#Password").css("border-color",'unset');
             } 
            });
            });
        </script>
        <!-- END: JS Assets-->
    </body>
</html>