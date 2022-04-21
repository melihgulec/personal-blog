<?php
include("../scripts/connection.php");
include("../helpers/swalHelper.php");

$actionIds = array(
    "add"    => 0,
    "update" => 1,
    "delete" => 2
);

$getActionId = $_POST['actionId'];

$sqlStr = "";

if ($getActionId == 0)
{
    $userName = $_POST["userName"];
    $userSurname = $_POST["userSurname"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $roleid = $_POST["roleid"];
    $photoPath = $_POST["photoPath"];

    $sqlStr = "INSERT INTO user(Name, Surname, DateOfBirth, Password, Email, RoleID, image) VALUES(
        '".$userName."', 
        '".$userSurname."',
        '".$dateOfBirth."',
        '".$password."',
        '".$email."',
        '".$roleid."',
        '".$photoPath."'
        )";
}
else if ($getActionId == 1)
{
    $userId = $_POST["userId"];
    $userName = $_POST["userName"];
    $userSurname = $_POST["userSurname"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $roleid = $_POST["roleid"];
    $photoPath = $_POST["photoPath"];

    $sqlStr = "UPDATE user SET 
    Name = '".$userName."',
    Surname = '".$userSurname."',
    DateOfBirth = '".$dateOfBirth."',
    Password = '".$password."',
    Email = '".$email."',
    RoleID = '".$roleid."',
    image = '".$photoPath."'  
    WHERE id = ".$userId;
}
else if ($getActionId == 2){
    $userId = $_POST["userId"];
    $sqlStr = "DELETE FROM user WHERE id = ".$userId."";
    echo '<script>location.reload()</script>';
}


if($connection -> query($sqlStr) === TRUE){
    makeSuccessAlert("Değişiklikler kaydedildi.");
}
else
{
    makeErrorAlert("Bir hatayla karşılaşıldı. Hata: ".$connection->error);
}

?>