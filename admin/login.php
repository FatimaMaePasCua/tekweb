<?php
/**
 * Created by PhpStorm.
 * User: yanzk
 * Date: 24/06/2018
 * Time: 7:55 PM
 */

require 'db.php';
session_start();

$idnumber = $_POST['idnumber'];
$password = $_POST['password'];


$sql = "SELECT userID,firstname,type,status FROM users WHERE idnumber = ? AND password = ?";
$st = $conn->prepare($sql);
$st->bind_param('is', $idnumber, $password);
$st->execute();
$res = $st->get_result();
$r = $res->fetch_row();
if ($res->num_rows > 0) {

    if ($r[3] == "active") {


        $_SESSION['userID'] = $r[0];
        $_SESSION['username'] = $r[1];
        $_SESSION['type'] = $r[2];
        if ($r[2] == "admin") {
            header('Location:index.php');
        } elseif ($r[2] == "Teacher") {
            header('Location: //192.168.22.3:3000/index/' . $r[0]);
        } elseif ($r[2] == "Student") {
            header('Location: //192.168.22.3:8080/student/classes.jsp?ayd=' . $r[0]);
        }else {
            $m = "Who are you!";
            echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
        }
    }else{
        $m = "Account not activated,Contact administrator!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }
} else {
    $m = "Wrong Credentials!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}