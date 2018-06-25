<?php
/**
 * Created by PhpStorm.
 * User: yanzk
 * Date: 25/06/2018
 * Time: 11:18 AM
 */
require 'db.php';
$num = $_GET['num'];

$sql = "UPDATE users SET status = 'active' WHERE userID = '$num'";
if($conn->query($sql)){
    header('Location:users.php');
}