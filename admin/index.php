<!DOCTYPE html>
<html lang="en">
<head>
    <title>Maruti Admin</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/fullcalendar.css"/>
    <link rel="stylesheet" href="css/maruti-style.css"/>
    <link rel="stylesheet" href="css/maruti-media.css" class="skin-color"/>
</head>
<body>


<div id="content">
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <h1><a href="#">
                        <?php
                        session_start();
                        echo strtoupper($_SESSION['username']);
                        ?>
                    </a></h1>
                <li><a href="#"> <i class="icon-dashboard"></i> Users </a></li>
                <li><a href="#"> <i class="icon-calendar"></i> Transactions </a></li>
                <li><a href="#"> <i class="icon-people"></i> Logout </a></li>
            </ul>
        </div>


        <hr>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title text-center">
                            <h3>New Accounts</h3>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="width: 20%">ID NUMBER</th>
                                    <th style="width: 20%">FIRST NAME</th>
                                    <th style="width: 20%">LAST NAME</th>
                                    <th style="width: 20%">TYPE</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require 'db.php';

                                $sql = "SELECT * FROM users WHERE status = 'pending'";
                                $res = $conn->query($sql);
                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>
                                                 <td>" . $row['idnumber'] . "</td>" .
                                        "<td>" . $row['firstname'] . "</td>" .
                                        "<td>" . $row['lastname'] . "</td>" .
                                        "<td>" . $row['type'] . "</td>" .
                                        "<td>" . "<a href=" . '../php/admin/modal/editAccount.php?num=' . $row['userID'] . "  " . " class='material-icons' data-toggle='modal' data-target='#edit_account'>mode_edit</a>" . "    " . "<a href=" . '../php/admin/modal/enableAccount.php?num=' . $row['userID'] . " " . " class='material-icons' data-toggle='modal' data-target='#del_account'>add</a>" . "</td></tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title text-center">
                            <h3>Active Accounts</h3>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="width: 20%">ID NUMBER</th>
                                    <th style="width: 20%">FIRST NAME</th>
                                    <th style="width: 20%">LAST NAME</th>
                                    <th style="width: 20%">TYPE</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require 'db.php';

                                $sql = "SELECT * FROM users WHERE status = 'active'";
                                $res = $conn->query($sql);
                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>
                                                 <td>" . $row['idnumber'] . "</td>" .
                                        "<td>" . $row['firstname'] . "</td>" .
                                        "<td>" . $row['lastname'] . "</td>" .
                                        "<td>" . $row['type'] . "</td>" .
                                        "<td>" . $row['type'] . "</td></tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title text-center">
                            <h3>Inactive Accounts</h3>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="width: 20%">ID NUMBER</th>
                                    <th style="width: 20%">FIRST NAME</th>
                                    <th style="width: 20%">LAST NAME</th>
                                    <th style="width: 20%">TYPE</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require 'db.php';

                                $sql = "SELECT * FROM users WHERE status = 'inactive'";
                                $res = $conn->query($sql);
                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row['idnumber'] . "</td>" .
                                        "<td>" . $row['firstname'] . "</td>" .
                                        "<td>" . $row['lastname'] . "</td>" .
                                        "<td>" . $row['type'] . "</td>" .
                                        "<td>" . "<a href=" . '../php/admin/modal/editAccount.php?num=' . $row['accountID'] . "  " . " class='material-icons' data-toggle='modal' data-target='#edit_account'>mode_edit</a>" . "    " . "<a href=" . '../php/admin/modal/enableAccount.php?num=' . $row['accountID'] . " " . " class='material-icons' data-toggle='modal' data-target='#del_account'>add</a>"  . "</td></tr>";
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
</div>
<div class="row-fluid">
    <div id="footer" class="span12"> </a>
    </div>
</div>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/maruti.js"></script>
<script src="js/maruti.dashboard.js"></script>
<script src="js/maruti.chat.js"></script>


<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-") {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
</body>
</html>
