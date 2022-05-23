<?php
include("../scripts/connection.php");
include("../helpers/swalHelper.php");
include("../scripts/routing.php");

session_start();

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
    $goPath = "../pages/postAdd.php?";

    $postTitle = $_POST["postTitle"];
    $postDate = $_POST["postDate"];
    $postUserId = $_SESSION["userId"];
    $postCategoryId = $_POST["postCategoryId"];
    $postDescription = $_POST["postDescription"];

    if(empty($postTitle) || empty($postDate) || empty($postCategoryId)|| empty($postDescription) || empty($_FILES["photo"]["tmp_name"])){
        go($goPath."success=0");
        exit();
    }

    if(!file_exists("../assets/post/images")){
        mkdir("images");
    }

    $selectquery="SELECT id FROM post ORDER BY id DESC LIMIT 1";
    $result = $connection->query($selectquery);
    $row = $result->fetch_assoc();
    $frominsert = $row['id'];

    $lastid = $frominsert + 1;

    $path = "../assets/post/images/$lastid";
    $photo = $path.".jpg";
    
    move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);

    $sqlStr = "INSERT INTO post(Title, Description, Date, image, user_id, categorie_id) VALUES(
        '".$connection->real_escape_string($postTitle)."', 
        '".$connection->real_escape_string($postDescription)."',
        '".$connection->real_escape_string($postDate)."',
        '".$connection->real_escape_string($lastid.".jpg")."',
        '".$connection->real_escape_string($postUserId)."',
        '".$connection->real_escape_string($postCategoryId)."'
        )";
        
}
else if ($getActionId == 1)
{
    $postId = $_POST["postId"];
    $postTitle = $_POST["postTitle"];
    $postDate = $_POST["postDate"];
    $postCategoryId = $_POST["postCategoryId"];
    $postDescription = $_POST["postDescription"];

    $goPath = "../pages/postEdit.php?postId=$postId&";

    if(empty($postId) || empty($postTitle) || empty($postDate)|| empty($postCategoryId) || empty($postDescription)){
        go($goPath."success=0");
        exit();
    }

    if(!empty($_FILES["photo"]["tmp_name"])){
        $path = "../assets/post/images/$postId";
        $photo = $path.".jpg";
    
        unlink($photo);
    
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
    }

    $selectUser="SELECT user_id FROM post WHERE id = '$postId'";
    $result = $connection->query($selectUser);
    $row = $result->fetch_assoc();
    $frominsert = $row['user_id'];

    $sqlStr = "UPDATE post SET 
    Title = '".$connection->real_escape_string($postTitle)."',
    Description = '".$connection->real_escape_string($postDescription)."',
    Date = '".$connection->real_escape_string($postDate)."',
    image = '".$connection->real_escape_string($postPhotoPath)."',
    user_id = '".$connection->real_escape_string($frominsert)."',
    categorie_id = '".$connection->real_escape_string($postCategoryId)."',
    image = '".$postId.".jpg'
    WHERE id = ".$connection->real_escape_string($postId);
}
else if ($getActionId == 2){
    $postId = $_POST["postId"];
    $sqlStr = "DELETE FROM post WHERE id = ".$postId."";

    $path = "../assets/post/images/$postId";
    $photo = $path.".jpg";

    unlink($photo);

    echo '<script>location.reload()</script>';
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