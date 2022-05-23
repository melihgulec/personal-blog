<?php
session_start();
include("../scripts/panelAdminCheck.php");

include("../scripts/connection.php");

$success = isset($_GET["success"]) == false ? -1 : $_GET['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazı Ekle</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/postEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(()=>{
            let d = new Date();
            $("#postDate").val(d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay());

            <?php
                if($success != -1){
                    if($success){
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarılı.",
                                text: "Kayıt oluşturuldu",
                                icon: "success"
                            });
                        ';
                    }else{
                        echo '
                            Swal.fire({
                                heightAuto: false,
                                title: "Başarısız.",
                                text: "Kayıt oluşturulamadı",
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
        <h3>Yazı Ekle</h3>
        <form action="../scripts/panelPostActions.php" method="POST" enctype="multipart/form-data">
            <label for="postTitle" class="inputLabel">Başlık</label>
            <input type="text" name="postTitle" id="postTitle" >
            <br>
            <br>
            <label for="postDate" class="inputLabel">Tarih</label>
            <input type="date" name="postDate" id="postDate">
            <br>
            <br>
            <label for="postPhotoPath" class="inputLabel">Fotoğraf</label>
            <br>
            <input type="file" name="photo" id="photo" />
            <br>
            <br>
            <label for="postCategoryId" class="inputLabel">Kategori</label>
            <select name="postCategoryId" id="postCategoryId">
                <?php 
                    $categoryFetchQuery = $connection->query("SELECT * FROM categories");

                    while($row = $categoryFetchQuery->fetch_assoc()){
                        echo '
                            <option value="'.$row['id'].'">
                                '.$row['Name'].'
                            </option>
                        ';
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="postDescription" class="inputLabel">İçerik</label>
            <textarea name="postDescription" id="postDescription"></textarea>
            <button type="submit" name="actionId" value="0" class="editButton">Gönder</button>
        </form>
    </div>
    <div id="results"></div>
</body>
</html>
