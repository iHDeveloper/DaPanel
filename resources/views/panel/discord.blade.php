<?php

$pageconfig = array();
foreach ($config as $key => $value) {
    $c = $value;
    foreach ($placeholders as $k => $val) {
        #$if($key == "welcome.title") dd($c);
        $pl = str_replace('.', '_', $k);
        $placeholder = '%'  . $pl . '%';
        $c = str_replace($placeholder, $val, $c);
    }
    $pageconfig[$key] = $c;
}

# services
$service_nickname = false;

# DONT TOUCH THIS
$default_status_id = "status";
$default_status_class = "label-warning";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$page["title"]}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    @font-face {
        font-family: DiscordFont;
        src url({{asset('fonts/Whitney-BlackItalic.otf')}})
    }
    </style>
    <link rel="stylesheet" href="{{asset('css/discord.css')}}">
</head>
<body class="layout">
    <div class="info">
        <h1 class="info-title">{{$pageconfig['info']['title']}}</h1>
        <h4 class="info-subtitle">{{$pageconfig['info']['subtitle']}}</h4>
    </div>
    
    <div class="container">
        <div class="panel">
            <div class="panel-header">Panel</div>
            <div class="panel-content">
                <p>- Text 1</p>
                <p>- Text 2</p>
                <button class="button">Test</button>
            </div>
        </div>
    </div>
    
</body>
</html>