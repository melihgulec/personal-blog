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
}
else if ($getActionId == 1){
}
else if ($getActionId == 2){
    $commentId = $_POST["commentId"];
    $sqlStr = "DELETE FROM comment WHERE id = ".$commentId."";
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