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
        <?php foreach ($page["components"] as $id => $object): ?>
            <?php
                if(array_key_exists('name', $object)) 
                $name = $object["name"]; 
                else $name = "";
                if(array_key_exists('class', $object)) $class = $object["class"]; else $class = "";
                if(array_key_exists('type', $object)) $type = $object["type"]; else $type = "";
                if(array_key_exists('text', $object)) $text = $object["text"]; else $text = "";
                if(array_key_exists('parent', $object)) $parent = $object["parent"]; else $parent = "";
                if(array_key_exists('attribute', $object)) $attribute = $object["attribute"]; else $attribute = "";
                if(array_key_exists('route', $object)) $route = $object["route"]; else $route = "";
            ?>
            <?php if ($type == "form" && $route == "@service/nickname"): ?>
                <div class="panel">
                    <div class="panel-header">Nickname</div>
                    <div class="panel-content">
                        <form id="service-nickname" action="{{ route('service.nickname', ["id"=>$placeholders['server.id']]) }}">
                            <input type="hidden" name="csrf-token" value="{{csrf_token()}}">
                            <br>
                            <p>Nickname: </p>
                            <input type="text" class="input" name="nickname" value="" placeholder="{{$placeholders['client.name']}}" required autofocus>
                            <button type="submit" class="{{$class}}">
                                {{$text}}
                            </button>
                            <h3 class="status" id="service-nickname-status"></h3>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <{{$type}} id="{{$id}}" name="{{$name}}" class="{{$class}}" onclick="goto('{{$route}}')" {{$attribute}}>{{$text}}</{{$type}}>
                <?php if($parent != null): ?>
                <script>
                    if(document.getElementById({{$parent}}) != null || document.getElemenetById({{$id}}) != null) document.getElementById({{$parent}}).appendChild(document.getElemenetById({{$parent}}))
                </script>
                <?php endif; ?>    
            <?php endif;?>
        <?php endforeach; ?>
    </div>
    <script>
        function goto(name){
            var p = false;
            if(name == "") return;
            if(name.startsWith('#')) p = true;
            name = name.substring(1);
            var routeUrl = "{{route('panel.route', ['id'=>$server_id,'route'=>null])}}" + name;
            var pageUrl = "{{route('panel.page', ['id'=>$server_id,'page'=>null])}}" + name;
            if(p){
                window.location.assign(pageUrl);
            } else {
                window.location.assign(routeUrl);
            }
        }
    </script>
    <script>
        var old_status_class = "{{$default_status_class}}";
        function setStatus($class, text){
            var status = $("#{{$default_status_id}}")[0];
            status.classList.remove(old_status_class);
            status.classList.add($class);
            old_status_class = $class;
            status.innerText = text;
        }
    </script>
</body>
</html>