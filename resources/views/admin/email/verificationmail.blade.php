<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Mail</title>
</head>

<body>
    <p>welcome</p>
    <p>Name:{{$user->name}}</p>
    <p>Email:{{$user->email}}</p>
    <p>Password:{{$password}}</p>
    <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"><a href="{{config('app.url')}}/admin/login-form-mail/{{$user->id}}">Sign In</a></button>


</body>