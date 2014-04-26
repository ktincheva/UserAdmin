<!doctype html>
<html>
    <head>
        <title>Users Management</title>
        <meta charset="utf-8">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
        <style>

            table form { margin-bottom: 0; width: 80%;}
            table tr th, table tr td{
            }
            form ul { margin-left: 0; list-style: none; }
            .pagination ul { list-style: none; display: inline-block}
            .error { color: red; font-style: italic; }
            body { padding-top: 20px;  width: 100%; display: inline-block;}
        </style>
    </head>
    <body>
        <div class="container">
            @if (Session::has('message'))
            <div class="flash alert">
                <p>{{ Session::get('message') }}</p>
            </div>
            @endif
            @yield('content')
        </div>
    </body>
</html>