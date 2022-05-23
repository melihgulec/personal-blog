<?php
include("../scripts/connection.php");
include("../helpers/swalHelper.php");
include("../scripts/routing.php");

$actionIds = array(
    "add"    => 0,
    "update" => 1,
    "delete" => 2
);

$getActionId = $_POST['actionId'];

$sqlStr = "";

$goPath = "";

if ($getActionId == 0)
{
    $goPath = "../pages/userAdd.php?";

    $userName = $_POST["userName"];
    $userSurname = $_POST["userSurname"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $roleid = $_POST["roleId"];

    if(empty($userName) || empty($userSurname) || empty($dateOfBirth)|| empty($email) || empty($_FILES["photo"]["tmp_name"]) || empty($password) || empty($roleid)){
        go($goPath."success=0");
        exit();
    }

    if(!file_exists("../assets/user/images")){
        mkdir("images");
    }

    $selectquery="SELECT id FROM user ORDER BY id DESC LIMIT 1";
    $result = $connection->query($selectquery);
    $row = $result->fetch_assoc();
    $frominsert = $row['id'];

    $lastid = $frominsert + 1;

    $path = "../assets/user/images/$lastid";
    $photo = $path.".jpg";

    move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);

    $sqlStr = "INSERT INTO user(Name, Surname, DateOfBirth, Password, Email, RoleID, image) VALUES(
        '".$userName."', 
        '".$userSurname."',
        '".$dateOfBirth."',
        '".password_hash($password, PASSWORD_DEFAULT)."',
        '".$email."',
        '".$roleid."',
        '".$lastid.".jpg"."'
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
    $roleid = $_POST["roleId"];

    $goPath = "../pages/userEdit.php?userId=$userId&";

    if(empty($userName) || empty($userSurname) || empty($dateOfBirth)|| empty($email) || empty($password) || empty($roleid)){
        go($goPath."success=0");
        exit();
    }

    $selectUser="SELECT * FROM user WHERE id = '$userId'";
    $result = $connection->query($selectUser);
    $row = $result->fetch_assoc();
    $frominsert = $row['id'];

    if(!empty($_FILES["photo"]["tmp_name"])){
        $path = "../assets/user/images/$userId";
        $photo = $path.".jpg";
    
        unlink($photo);
    
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
    }

    $updatePass = $password == $row["Password"] ? $password : password_hash($password, PASSWORD_DEFAULT);

    $sqlStr = "UPDATE user SET 
    Name = '".$userName."',
    Surname = '".$userSurname."',
    DateOfBirth = '".$dateOfBirth."',
    Password = '".$updatePass."',
    Email = '".$email."',
    RoleID = '".$roleid."',
    image = '".$userId.".jpg' 
    WHERE id = ".$userId;
}
else if ($getActionId == 2){
    $userId = $_POST["userId"];
    $sqlStr = "DELETE FROM user WHERE id = ".$userId."";

    $path = "../assets/user/images/$userId";
    $photo = $path.".jpg";

    unlink($photo);

    echo'<script>location.reload()</script>';
}


if($connection -> query($sqlStr) === TRUE){
    if($goPath != ""){
        makeSuccessAlert("Değişiklikler kaydedildi.");
        go($goPath."success=1");
    }
}
else
{
    if($goPath != ""){
        makeErrorAlert("Bir hatayla karşılaşıldı. Hata: ".$connection->error);
        go($goPath."success=0");
    } 
}

?>