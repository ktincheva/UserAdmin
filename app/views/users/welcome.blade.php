<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Dear {{$user_details->firstname}}</h2>
        <p>{{$user_details->lastname}}</p>
        <p>{{$user_details->email}}</p>
        <p>{{$user_details->phone}}</p>
        <p>{{$user_details->address}}</p>
        <div>
            Welcome to the User Managment system
            <a href="http://useradmin.ktsoftware.net/public/users">See the demo</a>
        </div>
    </body>
</html>
