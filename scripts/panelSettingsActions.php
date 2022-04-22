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
else if ($getActionId == 2){
    // Sil
}


if($connection -> query($sqlStr) === TRUE){
    makeSuccessAlert("Değişiklikler kaydedildi.");
}
else
{
    makeErrorAlert("Bir hatayla karşılaşıldı. Hata: ".$connection->error);
}

?>