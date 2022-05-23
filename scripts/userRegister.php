<?php
include("../scripts/connection.php");
include("../scripts/routing.php");

$userName = $_POST["userName"];
$userSurname = $_POST["userSurname"];
$userMail = $_POST["userMail"];
$userPassword = $_POST["userPassword"];
$dateOfBirth = $_POST["dateOfBirth"];

$selectquery="SELECT id FROM user ORDER BY id DESC LIMIT 1";
$result = $connection->query($selectquery);
$row = $result->fetch_assoc();
$frominsert = $row['id'];

$lastid = $frominsert + 1;

$goPath = "../pages/register.php?";


if( empty($userName) || empty($userSurname) || empty($userMail) || empty($userPassword) || empty($dateOfBirth) || empty($_FILES["photo"]["tmp_name"])){
    go($goPath."success=2");

    exit();
}


$userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$userMail."'");
$row = $userQuery->num_rows;
$userDetails = $userQuery->fetch_assoc();

if($row == 0){

    $sqlStr = "INSERT INTO user(Name, Surname, Email,  Password, DateOfBirth, RoleID, image) 
    VALUES(
        '".$userName."',
        '".$userSurname."',
        '".$userMail."',
        '".password_hash($userPassword, PASSWORD_DEFAULT)."',
        '".$dateOfBirth."',
        '3',
        '$lastid.jpg'
        )
    ";

    if($connection -> query($sqlStr) === TRUE){
    
        $path = "../assets/user/images/$lastid";
        $photo = $path.".jpg";
        
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);

        go($goPath."success=1");

    }
    else{
        go($goPath."success=0");

    }

    
    
}else{
    go($goPath."success=3");
}

?>