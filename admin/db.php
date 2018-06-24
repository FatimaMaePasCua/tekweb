<?php
/**
 * Created by PhpStorm.
 * User: yanzk
 * Date: 24/06/2018
 * Time: 7:56 PM
 */


$conn = new mysqli("localhost","root","","tekweb");
if(!$conn){
    var_dump($conn->error);
}