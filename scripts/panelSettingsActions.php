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
    // Ekle
}
else if ($getActionId == 1)
{
    $socialMediaId = $_POST['socialMediaId'];
    $socialMediaLink = $_POST['socialMediaLink'];

    $sqlStr = "UPDATE socialmedia SET 
    Link = '".$socialMediaLink."'
    WHERE id = ".$socialMediaId;
}
else if ($getActionId == 3){
    $infoId = $_POST['infoId'];
    $description = $_POST['description'];

    $sqlStr = "UPDATE adminInfo SET 
    Description = '".$description."'
    WHERE id = ".$infoId;
}


if($connection -> query($sqlStr) === TRUE){
    makeSuccessAlert("Değişiklikler kaydedildi.");
}
else
{
    makeErrorAlert("Bir hatayla karşılaşıldı. Hata: ".$connection->error);
}

?>