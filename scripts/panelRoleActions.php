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
    $roleName = $_POST["roleName"];
    $sqlStr = "INSERT INTO role(Name) VALUES('".$roleName."')";
}
else if ($getActionId == 1){

    $roleId = $_POST["roleId"];
    $roleName = $_POST["roleName"];
    $sqlStr = "UPDATE role SET Name = '".$roleName."' WHERE id = ".$roleId;
}
else if ($getActionId == 2){
    $roleId = $_POST["roleId"];
    $sqlStr = "DELETE FROM role WHERE id = ".$roleId."";
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