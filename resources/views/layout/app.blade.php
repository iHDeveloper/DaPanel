<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DaPanel</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ str_replace(view('layout.og'), '"') }}
        <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">
        <link rel="stylesheet" href="{{asset('css/fonticons.css')}}">
        <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">


        <!--For Plugins external css-->
        <link rel="stylesheet" href="{{asset('css/plugins.css')}}" />

        <!--Theme custom css -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />

        <script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
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
                                            <li><a href="#service">Service</a></li>
                                            <li><a href="#portfolio">portfolio</a></li>
                                            <li><a href="#counter">Counter Us</a></li>
                                            <li><a href="#contact">Contact</a></li>
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
                                        <h1>DaPanel: Web Panel</h1>
                                        <p class="subtitle">Do you wish a website panel for your discord server?</p>

                                        <div class="home_btn">
                                            <a href="" class="btn btn-md">Learn More</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="single_home_slider">
                                    <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                        <h1>DaPanel: Discord Bot</h1>
                                        <p class="subtitle">Do you want to invite our discord bot to your server ?</p>

                                        <div class="home_btn">
                                            <a href="https://discordapp.com/api/oauth2/authorize?client_id=398399718851346432&permissions=204696593&redirect_uri=http%3A%2F%2Fdapanel.tk%2F&scope=bot" class="btn btn-md">Invite it now!</a>
                                        </div>

                                    </div>
                                </div>                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <section id="service" class="service">
            <div class="container">
                <div class="row">
                    <div class="main_service_area sections"> 
                        <div class="col-sm-6">
                            <div class="signle_service_left">
                                <h2>What
                                    We 
                                    Do</h2>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="single_service_right">
                                <div class="single_service">
                                    <div class="single_service_icon">
                                        <i class="lnr lnr-laptop-phone"></i>
                                    </div>
                                    <div class="single_service_content">
                                        <h3>Discord Web Panel</h3>
                                        <p>We gave you a service between your hands to give something to your clients to control
                                        them futures in your discord server, </p>
                                    </div>
                                </div>
                                <div class="single_service">
                                    <div class="single_service_icon">
                                        <i class="lnr lnr-screen"></i>
                                    </div>
                                    <div class="single_service_content">
                                        <h3>Full Design in your panel</h3>
                                        <p>We are giving you a service into your panel to control your style of
                                        your panel and make your clients happy and feel okay with it, </p>
                                    </div>
                                </div>
                                <div class="single_service">
                                    <div class="single_service_icon">
                                        <i class="lnr lnr-picture"></i>
                                    </div>
                                    <div class="single_service_content">
                                        <h3>Placeholders</h3>
                                        <p>We gave you the best control to get client/server information
                                        using our placeholders system</p>
                                    </div>
                                </div>
                                <div class="single_service">
                                    <div class="single_service_icon">
                                        <i class="lnr lnr-laptop-phone"></i>
                                    </div>
                                    <div class="single_service_content">
                                        <h3>High level console</h3>
                                        <p>We gave a specail console to know about what's going on in your panel
                                        and control everything from it, </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="choose" class="choose">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_choose_area sections">
                        <div class="col-sm-7 col-sm-offset-1">
                            <div class="main_choose_content text-left">
                                <div class="single_choose_content">
                                    <h1>DaPanel: Discord Support Server</h1>
                                    <p>If you need support and fixing some issues you can find us
                                    in our support server, </p>

                                    <a href="" class="btn btn-larg">Our support server is coming soon <i class="lnr lnr-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


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

        <script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"></script>
        <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>

        <script src="{{asset('js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('js/jquery.mixitup.min.js')}}"></script>
        <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>

        <script src="{{asset('js/plugins.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

    </body>
</html>
