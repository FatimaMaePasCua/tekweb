<?php
/**
 * Created by PhpStorm.
 * User: yanzk
 * Date: 25/06/2018
 * Time: 11:30 AM
 */

session_start();
session_destroy();
header('Location:index.php');