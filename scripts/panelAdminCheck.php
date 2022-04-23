<?php
include("../scripts/routing.php");


$isLogged = false;

if(isset($_SESSION['loggedIn']) && isset($_SESSION['isAdmin'])){
    if($_SESSION['loggedIn'] === true && $_SESSION['isAdmin'] === true){
        $isLogged = true;
    }
    else
    {
        $isLogged = false;
        go('../pages/panelLogin.php');
    }
}else{
    go('../pages/panelLogin.php');
}

?>