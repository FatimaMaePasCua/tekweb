<?php
/**
 * Created by PhpStorm.
 * User: yanzk
 * Date: 24/06/2018
 * Time: 7:55 PM
 */

require 'db.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$lastname = $_POST['lastname'];
$id = $_POST['idnumber'];
$pass = $_POST['password'];
$pass2 = $_POST['confirm_password'];
if ($pass != $pass2) {
    $m = "Error, Password do not match!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../signup.php');
            </script>
         ";
}
$type = $_POST['type'];
$course = $_POST['course'];
if (empty($course)) {
    $course = null;
}
$year = $_POST['year'];
if (empty($year)) {
    $year = null;
}
$s = "pending";

$dpt = $_POST['dpt'];
if (empty($dpt)) {
    $dpt = null;
}

$sql = "INSERT INTO users(firstname, lastname, idnumber,password, type,course,year,status,department) VALUES (?,?,?,?,?,?,?,?,?)";
$st = $conn->prepare($sql);
$st->bind_param('ssisssiss', $firstname, $lastname, $id, $pass, $type, $course, $year, $s, $dpt);

if ($st->execute()) {
    $m = "Registration Successful!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
} else {
    var_dump($conn->error);
}