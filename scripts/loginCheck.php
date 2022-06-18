<?php
    include("../scripts/connection.php");
    include("../scripts/routing.php");

    $postEmail = $_POST["email"];
    $postPassword = $_POST["password"];
    $rememberMe = isset($_POST["rememberMe"]) ? 1 : 0;

    $goPath = "../pages/login.php?";

    if(empty($postEmail) && empty($postPassword)){
        go($goPath."success=2");
        exit();
    }

    $sanitizedMail = filter_var($postEmail, FILTER_SANITIZE_EMAIL);

    if(!filter_var($sanitizedMail, FILTER_VALIDATE_EMAIL)){
        go($goPath."success=3");
        exit();
    }

    $userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$postEmail."'");
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
        $_SESSION['isAdmin'] = false;

        if($rememberMe == 1){
            setcookie( "userEmail", $postEmail, strtotime( '+30 days' ), '/' );
            setcookie( "rememberMe", $rememberMe, strtotime( '+30 days' ), '/' );
        }else{
            setcookie( "rememberMe", $rememberMe, strtotime( '+30 days' ), '/' );
        }

        go("../pages/index.php");

    }else{
        go($goPath."success=0");
    }
?>