<?php
session_start();
unset($_SESSION['logged_in']);
unset($_SESSION['uname']);
header("location: login.php");
exit();