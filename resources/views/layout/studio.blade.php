<?php
use App\Http\Controllers\Settings;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DaPanel: Studio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @extends('layout.og')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">DaPanel: Studio</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Editor</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(session()->has(Settings::discord_session()))
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Welcome back!</a></li>
                @else
                    <li><a href=""><span class="glyphicon glyphicon-log-in"></span> Login with discord</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>DaPanel: Studio</h1> 
            <p>Welcome to DaPanel Studio where you can make your panel cool and beautiful to your clients!</p> 
        </div> 
    </div>
</body>
</html>    
