<?php
    include("../scripts/connection.php");
    include("../scripts/routing.php");

    $postEmail = $_POST["email"];
    $postPassword = $_POST["password"];
    
    $goPath = "../pages/panelLogin.php?";

    if(empty($postEmail) && empty($postPassword)){
        go($goPath."success=2");
        exit();
    }

    $adminRoleQuery = $connection->query("SELECT id FROM role WHERE Name='Yönetici'");
    $adminRoleId = $adminRoleQuery->fetch_assoc();

    $userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$postEmail."' AND RoleID = '".$adminRoleId['id']."'");
    $row = $userQuery->num_rows;
    $userDetails = $userQuery->fetch_assoc();

    if($row != 0 && password_verify($postPassword, $userDetails["Password"])){
        session_start();
        session_regenerate_id(true);

        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $userDetails['id'];
        $_SESSION['userEmail'] = $userDetails['Email'];
        $_SESSION['userName'] = $userDetails['Name'];
        $_SESSION['userSurname'] = $userDetails['Surname'];
        $_SESSION['userImage'] = $userDetails['image'];
        $_SESSION['isAdmin'] = true;
        
        go("../pages/panel.php");
    }else{
        go($goPath."success=0");
    }
?>