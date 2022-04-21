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
    $postTitle = $_POST["postTitle"];
    $postDate = $_POST["postDate"];
    $postPhotoPath = $_POST["postPhotoPath"];
    $postUserId = $_POST["postUserId"];
    $postCategoryId = $_POST["postCategoryId"];
    $postDescription = $_POST["postDescription"];

    $sqlStr = "INSERT INTO post(Title, Description, Date, image, user_id, categorie_id) VALUES(
        '".$postTitle."', 
        '".$postDescription."',
        '".$postDate."',
        '".$postPhotoPath."',
        '".$postUserId."',
        '".$postCategoryId."'
        )";
}
else if ($getActionId == 1)
{
    $postId = $_POST["postId"];
    $postTitle = $_POST["postTitle"];
    $postDate = $_POST["postDate"];
    $postPhotoPath = $_POST["postPhotoPath"];
    $postUserId = $_POST["postUserId"];
    $postCategoryId = $_POST["postCategoryId"];
    $postDescription = $_POST["postDescription"];

    $sqlStr = "UPDATE post SET 
    Title = '".$postTitle."',
    Description = '".$postDescription."',
    Date = '".$postDate."',
    image = '".$postPhotoPath."',
    user_id = '".$postUserId."',
    categorie_id = '".$postCategoryId."' 
    WHERE id = ".$postId;
}
else if ($getActionId == 2){
    $postId = $_POST["postId"];
    $sqlStr = "DELETE FROM post WHERE id = ".$postId."";
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