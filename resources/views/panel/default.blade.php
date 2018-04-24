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
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{$page["title"]}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="{{asset('@images/apple-touch-icon.png')}}">
        <link rel="stylesheet" href="{{asset('@css/fonticons.css')}}">
        <link rel="stylesheet" href="{{asset('@fonts/stylesheet.css')}}">
        <link rel="stylesheet" href="{{asset('@css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('@css/bootstrap.min.css')}}">


        <!--For Plugins external css-->
        <link rel="stylesheet" href="{{asset('@css/plugins.css')}}" />

        <!--Theme custom css -->
        <link rel="stylesheet" href="{{asset('@css/style.css')}}">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="{{asset('@css/responsive.css')}}" />

        <script src="{{asset('@js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
        <style>
        .text-color-black{
            color: black;
        }
        </style>
    </head>
    <body data-spy="scroll" data-target=".navbar-collapse">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <header id="main_menu" class="header navbar-fixed-top">            
            <div class="main_menu_bg">
                <div class="container">
                    <div class="row">
                        <div class="nave_menu">
                            <nav class="navbar navbar-default" id="navmenu">
                                <div class="container-fluid">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="#home">
                                            <img src="assets/images/logo.png"/>
                                        </a>
                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->



                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="#home">Home</a></li>
                                        </ul>    
                                    </div>

                                </div>
                            </nav>
                        </div>	
                    </div>

                </div>

            </div>
        </header> <!--End of header -->





        <section id="home" class="home">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="main_home_slider text-center">
                                <div class="single_home_slider">
                                    <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                        <h1>{{ $pageconfig['welcome']['title'] }}</h1>
                                        <p class="subtitle">{{ $pageconfig['welcome']['subtitle'] }}</p>

                                        <div class="home_btn">
                                            <a href="" class="btn btn-md">Invite it now!</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="single_home_slider">
                                    <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                        <h1>{{ $pageconfig['info']['title'] }}</h1>
                                        <p class="subtitle">{{ $pageconfig['info']['subtitle'] }}</p>

                                        <div class="home_btn">
                                            <a href="" class="btn btn-md">Learn More</a>
                                        </div>

                                    </div>
                                </div>                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<br />

	<div class="container">
        <div class="row">
            <div class="panel {{$page["class"]}}">
                <div class="panel-heading">{{ $page["text"] }}</div>

                <div class="panel-body">
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
                            <?php $service_nickname = true; ?>
                            <form id="service-nickname" action="{{ route('service.nickname', ["id"=>$placeholders['server.id']]) }}">
                                <input type="hidden" name="csrf-token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="nickname" class="col-md-4 control-label">Nickname</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nickname" value="" placeholder="Enter your nickname here!" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="{{$class}}">
                                            {{$text}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <{{$type}} id="{{$id}}" name="{{$name}}" class="{{$class}}" onclick="goto('{{$route}}')" {{$attribute}}>{{$text}}</{{$type}}>
                        <?php endif;?>
                    <?php endforeach; ?>
                    <hr />
                    <center>
                        <h3>
                            <span id="{{$default_status_id}}" class="label {{$default_status_class}}">
                            </span>
                        </h3>
                    </center>
                    <hr />
                </div>
            </div>
        </div>
    </div>

	<br />


        <footer id="footer" class="footer">
            <div class="container">
                <div class="main_footer">
                    <div class="row">

                        <div class="col-sm-6 col-xs-12">
                            <div class="copyright_text">
                                <p class=" wow fadeInRight" data-wow-duration="1s">Made with <i class="fa fa-heart"></i> by DaPanel Owner: <a href="http://ihdeveloper.tk">iHDeveloper</a>2018. All Rights Reserved</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="footer_socail">
                                <a href=""><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-google-plus"></i></a>
                                <a href=""><i class="fa fa-rss"></i></a>
                                <a href=""><i class="fa fa-instagram"></i></a>
                                <a href=""><i class="fa fa-dribbble"></i></a>
                                <a href=""><i class="fa fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



        <!-- START SCROLL TO TOP  -->

        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div>

        <script src="{{asset('@js/vendor/jquery-1.11.2.min.js')}}"></script>
        <script src="{{asset('@js/vendor/bootstrap.min.js')}}"></script>

        <script src="{{asset('@js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('@js/jquery.mixitup.min.js')}}"></script>
        <script src="{{asset('@js/jquery.easing.1.3.js')}}"></script>

        <script src="{{asset('@js/plugins.js')}}"></script>
        <script src="{{asset('@js/main.js')}}"></script>
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
        <?php if($service_nickname): ?>
        <script>
        $(document).ready(function(){
            $("#service-nickname").submit(function(event){
                event.preventDefault();
                var url = $(this).attr('action');
                var nickname = $("form#service-nickname>div>div>input[name=nickname]")[0].value;
                var token = $("form#service-nickname>input[name=csrf-token]")[0].value;
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nickname: nickname
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    beforeSend: function(){
                        setStatus("label-warning", "Loading...");
                    },
                    success: function(data){
                        if(data.code == 302){
                            setStatus("label-danger", "We can't change your nickname. Permission denied!");
                        } else if(data.code == 301){
                            setStatus("label-info", "Your nickname is the same");
                        } else if(data.code == 300){
                            setStatus("label-success", "Your nickname has been changed!");
                        }
                    }
                });
            });
        });
        </script>
        <?php endif; ?>

    </body>
</html>
