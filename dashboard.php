<?php
    session_start();

    if(!isset($_SESSION["user"]) || $_SESSION["user"] != 'admin'){
        header('Location: http://localhost:8080/');
    }

    $values = json_encode(
        $_SESSION['orders'] ?? [],
        JSON_NUMERIC_CHECK
    );
    $readed = json_encode(
        ['2022-01-14 01:20:50', '2022-01-14 01:20:53', '2022-01-14 01:20:56', '2022-01-14 01:20:59', '2022-01-14 01:21:02', '2022-01-14 01:21:05', '2022-01-14 01:21:08', '2022-01-14 01:21:11', '2022-01-14 01:21:16', '2022-01-14 01:21:19', '2022-01-14 01:21:22', '2022-01-14 01:21:25', '2022-01-14 01:21:31', '2022-01-14 01:21:34', '2022-01-14 01:21:39', '2022-01-14 01:21:42', '2022-01-14 01:21:45', '2022-01-14 01:21:48', '2022-01-14 01:21:51', '2022-01-14 01:21:54', '2022-01-14 01:21:58', '2022-01-14 01:22:02', '2022-01-14 01:22:05', '2022-01-14 01:22:08', '2022-01-14 01:22:18', '2022-01-14 01:22:21', '2022-01-14 01:22:24', '2022-01-14 01:22:27', '2022-01-14 01:22:30', '2022-01-14 01:22:33', '2022-01-14 01:22:36', '2022-01-14 01:22:39', '2022-01-14 01:22:42'],
        JSON_NUMERIC_CHECK
    );
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" http-equiv="refresh" content="10">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style>
            @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
            @media(min-width:768px) {
            body {
                margin-top: 50px;
            }
            /*html, body, #wrapper, #page-wrapper {height: 100%; overflow: hidden;}*/
            }

            #wrapper {
            padding-left: 0;
            }

            #page-wrapper {
            width: 100%;
            padding: 0;
            background-color: #fff;
            }

            @media(min-width:768px) {
            #wrapper {
                padding-left: 225px;
            }

            #page-wrapper {
                padding: 22px 10px;
            }
            }

            /* Top Navigation */

            .top-nav {
            padding: 0 15px;
            }

            .top-nav>li {
            display: inline-block;
            float: left;
            }

            .top-nav>li>a {
            padding-top: 20px;
            padding-bottom: 20px;
            line-height: 20px;
            color: #fff;
            }

            .top-nav>li>a:hover,
            .top-nav>li>a:focus,
            .top-nav>.open>a,
            .top-nav>.open>a:hover,
            .top-nav>.open>a:focus {
            color: #fff;
            background-color: #1a242f;
            }

            .top-nav>.open>.dropdown-menu {
            float: left;
            position: absolute;
            margin-top: 0;
            /*border: 1px solid rgba(0,0,0,.15);*/
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background-color: #fff;
            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            }

            .top-nav>.open>.dropdown-menu>li>a {
            white-space: normal;
            }

            /* Side Navigation */

            @media(min-width:768px) {
            .side-nav {
                position: fixed;
                top: 60px;
                left: 225px;
                width: 225px;
                margin-left: -225px;
                border: none;
                border-radius: 0;
                border-top: 1px rgba(0,0,0,.5) solid;
                overflow-y: auto;
                background-color: #222;
                /*background-color: #5A6B7D;*/
                bottom: 0;
                overflow-x: hidden;
                padding-bottom: 40px;
            }

            .side-nav>li>a {
                width: 225px;
                border-bottom: 1px rgba(0,0,0,.3) solid;
            }

            .side-nav li a:hover,
            .side-nav li a:focus {
                outline: none;
                background-color: #1a242f !important;
            }
            }

            .side-nav>li>ul {
            padding: 0;
            border-bottom: 1px rgba(0,0,0,.3) solid;
            }

            .side-nav>li>ul>li>a {
            display: block;
            padding: 10px 15px 10px 38px;
            text-decoration: none;
            /*color: #999;*/
            color: #fff;
            }

            .side-nav>li>ul>li>a:hover {
            color: #fff;
            }

            .navbar .nav > li > a > .label {
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            position: absolute;
            top: 14px;
            right: 6px;
            font-size: 10px;
            font-weight: normal;
            min-width: 15px;
            min-height: 15px;
            line-height: 1.0em;
            text-align: center;
            padding: 2px;
            }

            .navbar .nav > li > a:hover > .label {
            top: 10px;
            }

            .navbar-brand {
            padding: 5px 15px;
            }
        </style>
    </head>
    <body>
        <div id="throbber" style="display:none; min-height:120px;"></div>
        <div id="noty-holder"></div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b class="fa fa-angle-down"></b></a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                </ul>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row" id="main" >
                        <div class="col-sm-12 col-md-12 well" id="content">
                            <h1>Bienvenido Administrador!</h1>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <div id="chart" class="container"></div>
                <script>
                    var values = <?php echo $values; ?>;
                    var readed = <?php echo $readed; ?>;

                    var chart = new Highcharts.Chart({
                      chart:{ renderTo : 'chart' },
                      title: { text: 'Ventas' },
                      series: [{
                        showInLegend: false,
                        data: values
                      }],
                      plotOptions: {
                        line: { animation: false,
                          dataLabels: { enabled: true }
                        },
                        series: { color: '#059e8a' }
                      },
                      xAxis: {
                        type: 'datetime',
                        categories: readed
                      },
                      yAxis: {
                        title: { text: 'Ingresos' }
                      },
                      credits: { enabled: false }
                    });
                </script>
            </div>
            <!-- /#page-wrapper -->
        </div><!-- /#wrapper -->
    </body>
</html>
