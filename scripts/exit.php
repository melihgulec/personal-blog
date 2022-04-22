<?php

include("../scripts/routing.php");

session_start();
session_unset();
session_destroy();
go('../pages/login.php');


?>