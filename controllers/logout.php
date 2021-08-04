<?php
$_SESSION['username'] = null ;
session_destroy();
header('Location:../views/login.php');
