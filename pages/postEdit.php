<?php 
session_start();
include("../scripts/panelAdminCheck.php");

include('../scripts/connection.php');

$postId = $_GET['postId'];

$getPostData = $connection->query("SELECT * FROM post WHERE id = '".$postId."'");
$post = $getPostData->fetch_assoc();

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazı Düzenle</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/postEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       $(document).ready(()=>{
            let d = new Date();

            <?php
                if($success != -1){
                    if($success){
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarılı.",
                                text: "Kayıt düzenlendi.",
                                icon: "success"
                            });
                        ';
                    }else{
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Kayıt düzenlenemedi.",
                                icon: "error"
                            });
                        ';
                    }
                }
            ?>
        });
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Yazı Düzenle</h3>
        <form action="../scripts/panelPostActions.php" method="POST" enctype="multipart/form-data">
            <label for="postId" class="inputLabel">Post ID</label>
            <input type="text" name="postId" id="postId" value="<?php echo $post['id']; ?>" readonly>
            <br>
            <br>
            <label for="postTitle" class="inputLabel">Başlık</label>
            <input type="text" name="postTitle" id="postTitle" value="<?php echo $post['Title']; ?>">
            <br>
            <br>
            <label for="postDate" class="inputLabel">Tarih</label>
            <input type="date" name="postDate" id="postDate" value="<?php echo $post['Date']; ?>">
            <br>
            <br>
            <label for="postPhotoPath" class="inputLabel">Fotoğraf</label>
            <br>
            <input type="file" name="photo" id="photo" />
            <br>
            <br>
            <label for="postCategoryId" class="inputLabel">Kategori</label>
            <br>
            <select name="postCategoryId" id="postCategoryId">
                <?php 
                    $categoriesFetchQuery = $connection->query("SELECT * FROM categories");

                    while($row = $categoriesFetchQuery->fetch_assoc()){

                        $selectExpression = $row['id'] === $post['categorie_id'] ? 'selected' : '';

                        echo '
                            <option value="'.$row['id'].'" '.$selectExpression.'>
                                '.$row['Name'].'
                            </option>
                        ';
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="postDescription" class="inputLabel">İçerik</label>
            <textarea name="postDescription" id="postDescription"><?php echo $post['Description']; ?></textarea>
            <button class="editButton" name="actionId" value="1" class="editButton">Gönder</button>
        </form>
    </div>
    <div id="results"></div>
</body>
</html>