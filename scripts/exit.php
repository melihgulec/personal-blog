<?php

include("../scripts/routing.php");

session_start();
session_unset();
session_destroy();

$fromPanel = $_GET['fromPanel'];

if($fromPanel == 1){
    go('../pages/panelLogin.php');

}else{
    go('../pages/login.php');
}

?>