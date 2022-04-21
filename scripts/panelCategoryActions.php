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
    $categoryName = $_POST["categoryName"];
    $sqlStr = "INSERT INTO categories(Name) VALUES('".$categoryName."')";
}
else if ($getActionId == 1){

    $categoryId = $_POST["categoryId"];
    $categoryName = $_POST["categoryName"];
    $sqlStr = "UPDATE categories SET Name = '".$categoryName."' WHERE id = ".$categoryId;
}
else if ($getActionId == 2){
    $categoryId = $_POST["categoryId"];
    $sqlStr = "DELETE FROM categories WHERE id = ".$categoryId."";
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