<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('meta-title','Dashboard')</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <!-- MetisMenu CSS -->
    {{ HTML::style('css/plugins/metisMenu/metisMenu.min.css') }}

    <!-- Social Buttons CSS -->
    {{ HTML::style('css/plugins/social-buttons.css') }}

    <!-- Timeline CSS -->
    {{ HTML::style('css/plugins/timeline.css') }}

    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin-2.css') }}

    <!-- Morris Charts CSS -->
    {{ HTML::style('css/plugins/morris.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->
    @yield('css','')

    @yield('scripts','')
</head>
<body>
    <div id="wrapper">
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('layouts.partials.navbarTop')
            @include('layouts.partials.navbarLeft')
        </nav>
            @yield('content')
       </div>
        <!-- /#wrapper -->


        <!-- jQuery Version 1.11.0 -->
        {{ HTML::script('js/jquery-1.11.0.js') }}

        <!-- Bootstrap Core JavaScript -->
        {{ HTML::script('js/bootstrap.min.js') }}

        <!-- Metis Menu Plugin JavaScript -->
        {{ HTML::script('js/plugins/metisMenu/metisMenu.min.js') }}

        <!-- Custom Theme JavaScript -->
        {{ HTML::script('js/sb-admin-2.js') }}

</body>