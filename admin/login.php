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



$sql = "SELECT userID,firstname,type FROM users WHERE idnumber = ? AND password = ?";
$st = $conn->prepare($sql);
$st->bind_param('is',$idnumber,$password);
$st->execute();
$res = $st->get_result();
$r = $res->fetch_row();
if($res->num_rows > 0){

    $_SESSION['userID'] = $r[0];
    $_SESSION['name'] = $r[1];
    if($r[2] == "admin"){
        header('Location:users.php');
    }elseif ($r[2] == "Teacher"){
        $m="Awan pay TEACHER!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }elseif ($r[2] == "Student"){
        $m="Awan pay STUDENT!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }else{
        $m="Who are you!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }
}else{
    $m="Wrong Credentials!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}