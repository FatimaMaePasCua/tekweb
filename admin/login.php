<?php
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
            header('Location: //192.168.7.14:3000/index/' . $_SESSION['userID']);
        } elseif ($r[2] == "Student") {
            header('Location: //192.168.7.14:8080/classes.jsp?ayd=' . $_SESSION['userID']);
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


