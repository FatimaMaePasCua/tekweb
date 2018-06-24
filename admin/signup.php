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
if($pass != $pass2){
    $m="Error, Password do not match!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../signup.php');
            </script>
         ";
}
$type = $_POST['type'];



$sql = "INSERT INTO users(firstname, lastname, idnumber,password, type) VALUES (?,?,?,?,?)";
$st = $conn->prepare($sql);
$st->bind_param('ssiss',$firstname,$lastname,$id,$pass,$type);

if($st->execute()){
    $m="Registration Successful!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}else{
    var_dump($conn->error);
}