<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="" rel="stylesheet">
        <link href="" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
       <div id="app">
           <example-component/>
           <second/>
       </div>
       <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
