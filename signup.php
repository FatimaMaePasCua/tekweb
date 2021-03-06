<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup - Bootstrap Admin Template</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>


<div class="account-container register">

    <div class="content clearfix">

        <form action="admin/signup.php" method="post">

            <h1>Signup</h1>

            <div class="login-fields">


                <div class="field">
                    <label for="firstname">First Name:</label>
                    <input required type="text" id="firstname" name="firstname" value="" placeholder="First Name"
                           class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="lastname">Last Name:</label>
                    <input required type="text" id="lastname" name="lastname" value="" placeholder="Last Name"
                           class="login"/>
                </div> <!-- /field -->


                <div class="field">
                    <label for="email">ID Number</label>
                    <input required type="text" id="email" name="idnumber" value="" placeholder="ID" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input required type="password" id="password" name="password" value="" placeholder="Password"
                           class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="confirm_password">Confirm Password:</label>
                    <input required type="password" id="confirm_password" name="confirm_password" value=""
                           placeholder="Confirm Password" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <select id="stu" required class="form-inline" name="type">
                        <option selected disabled>------</option>
                        <option>Teacher</option>
                        <option>Student</option>
                    </select>
                </div> <!-- /field -->

                <div id="this" hidden>
                    <div class="field">
                        <label for="confirm_password">Course:</label>
                        <input type="text" id="course" name="course" value=""
                               placeholder="Course" class="login"/>
                    </div> <!-- /field -->

                    <div class="field">
                        <label for="confirm_password">Year:</label>
                        <input type="number" id="year" name="year" value=""
                               placeholder="Year" class="login"/>
                    </div> <!-- /field -->
                </div>

                <div id="thas" hidden>
                    <div class="field">
                        <label for="confirm_password">Department:</label>
                        <input type="text" id="course" name="dpt" value=""
                               placeholder="Department" class="login"/>
                    </div> <!-- /field -->


                </div>

            </div> <!-- /login-fields -->

            <div class="pull-left">


                <a href="index.php" class="button btn btn-primary btn-large">Login</a>

            </div> <!-- .actions -->

            <div class="pull-right">
                <input type="submit" class="button btn btn-primary btn-large" value="Register">

            </div> <!-- .actions -->

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->


<script src="admin/js/jquery-1.7.2.min.js"></script>
<script src="admin/js/bootstrap.js"></script>

<script src="admin/js/signin.js"></script>

<script>


        $(document).ready(function () {
            $('#stu').change(function () {
                $val = $(this).val();
                if($val === "Student"){
                    $('#this').removeAttr('hidden');
                    $('#thas').attr('hidden','hidden');
                }else if ($val === "Teacher"){
                    $('#thas').removeAttr('hidden');
                    $('#this').attr('hidden','hidden');
                }
                else {
                    $('#this').attr('hidden','hidden');
                    $('#thas').attr('hidden','hidden');
                }

            });

        });

</script>

</body>

</html>
