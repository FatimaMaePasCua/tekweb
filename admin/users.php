    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dashboard - Bootstrap Admin Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
              rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/pages/dashboard.css" rel="stylesheet">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                            class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a
                        class="brand" href="users.php">Bootstrap Admin Template </a>

                <!--/.nav-collapse -->
            </div>
            <!-- /container -->
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    <li class="active"><a href="users.php"><i class="icon-dashboard"></i><span>Users</span> </a></li>
                    <li class="active"><a href="transactions.php.php"><i
                                    class="icon-dashboard"></i><span>Transactions</span> </a></li>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /subnavbar-inner -->
    </div>
    <!-- /subnavbar -->
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span6">


                        <!-- /widget -->
                        <div class="widget">

                            <!-- /widget-header -->

                            <!-- /widget-content -->
                        </div>
                        <!-- /widget -->
                    </div>
                    <!-- /span6 -->
                    <div>
                        <!-- /widget -->

                        <!-- /widget -->
                        <div class="widget widget-table action-table">
                            <div class="widget-header"><i class="icon-th-list"></i>
                                <h3>New Accounts</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID #</th>
                                        <th>FIRST NAME</th>
                                        <th>CATEGORY</th>
                                        <th class="td-actions"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> Fresh Web Development Resources</td>
                                        <td> http://www.egrappler.com/</td>
                                        <td> http://www.egrappler.com/</td>
                                        <td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i
                                                        class="btn-icon-only icon-ok"> </i></a><a href="javascript:;"
                                                                                                  class="btn btn-danger btn-small"><i
                                                        class="btn-icon-only icon-remove"> </i></a></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /widget-content -->

                            <!-- /widget -->
                        </div>
                        <!-- /span6 -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /main-inner -->
        </div>
    </div>
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/excanvas.min.js"></script>
        <script src="js/chart.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js"></script>
        <script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

        <script src="js/base.js"></script>

    </body>
    </html>
