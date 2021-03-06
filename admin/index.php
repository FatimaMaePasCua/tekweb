<?php
session_start();
if(!isset($_SESSION['username'])){
    $m = "Please Login first!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}
if($_SESSION['type'] != 'admin' ){
    $m = "Unauthorize Success!";
    echo "
                <script type = 'text/javascript'>
                    alert('$m');
                    window.location.replace('../index.php');
                </script>
             ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Now UI Dashboard by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="orange">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo">
            <a  class="simple-text logo-normal text-center">
                <?php
                    echo strtoupper($_SESSION['username']);
                ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">

                <li class="active">
                    <a href="index.php">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href="transactions.php">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Transactions</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="../logout.php">Logout</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header">
                            <br>
                            <h4 class="card-title text-center"> New Accounts</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table">
                                    <thead class="">
                                    <th>
                                        ID NUMBER
                                    </th>
                                    <th>
                                        FIRST NAME
                                    </th>
                                    <th>
                                        LAST NAME
                                    </th>
                                    <th>
                                        TYPE
                                    </th>
                                    <th>

                                    </th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        require 'db.php';

                                        $sql = "SELECT * FROM users WHERE status = 'pending' ";
                                        $res = $conn->query($sql);
                                        while ($row = $res->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>" . $row['idnumber'] . "</td>";
                                            echo "<td>" . $row['firstname'] . "</td>";
                                            echo "<td>" . $row['lastname'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . "<a href=" . 'accept.php?num=' . $row['userID'] . "  " . " >Accept</a>" . "    " . "<a href=" . 'reject.php?num=' . $row['userID'] . " " . " >Reject</a>" . "</td>";
                                            echo "</tr>";
                                        }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header">
                            <br>
                            <h4 class="card-title text-center"> Active Accounts</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table">
                                    <thead class="">
                                    <th>
                                        ID NUMBER
                                    </th>
                                    <th>
                                        FIRST NAME
                                    </th>
                                    <th>
                                        LAST NAME
                                    </th>
                                    <th>
                                        TYPE
                                    </th>
                                    <th>

                                    </th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require 'db.php';

                                    $sql = "SELECT * FROM users WHERE status = 'active' AND type != 'admin'";
                                    $res = $conn->query($sql);
                                    while ($row = $res->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $row['idnumber'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . "<a href=" . 'deactivate.php?num=' . $row['userID'] . "  " . " >Deactivate</a>" . "</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header">
                            <br>
                            <h4 class="card-title text-center"> Inactive Accounts</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table">
                                    <thead class="">
                                    <th>
                                        ID NUMBER
                                    </th>
                                    <th>
                                        FIRST NAME
                                    </th>
                                    <th>
                                        LAST NAME
                                    </th>
                                    <th>
                                        TYPE
                                    </th>
                                    <th>

                                    </th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require 'db.php';

                                    $sql = "SELECT * FROM users WHERE status = 'inactive'";
                                    $res = $conn->query($sql);
                                    while ($row = $res->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $row['idnumber'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['lastname'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . "<a href=" . 'activate.php?num=' . $row['userID'] . "  " . " >Activate</a>" . "</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
</body>

</html>