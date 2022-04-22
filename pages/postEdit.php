<?php 

include('../scripts/connection.php');

$postId = $_GET['postId'];

$getPostData = $connection->query("SELECT * FROM post WHERE id = '".$postId."'");
$post = $getPostData->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/panel.css">
    <link rel="stylesheet" href="../styles/postEdit.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function editPost() {
            var postTitle = document.getElementById("postTitle").value;
            var postDate = document.getElementById("postDate").value;
            var postPhotoPath = document.getElementById("postPhotoPath").value;
            var postUserId = document.getElementById("postUserId").value;
            var postCategoryId = document.getElementById("postCategoryId").value;
            var postDescription = document.getElementById("postDescription").value;

            console.log(postDescription);

            $.post("../scripts/panelPostActions.php", {
                postId: <?php echo $post['id'] ?>, 
                postTitle: postTitle, 
                postDate: postDate, 
                postPhotoPath: postPhotoPath,
                postUserId: postUserId, 
                postCategoryId: postCategoryId, 
                postDescription: postDescription,
                actionId: 1}
                ,
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Yazı Düzenle</h3>
        <label for="postId" class="inputLabel">Post ID</label>
        <input type="text" name="postId" id="postId" value="<?php echo $post['id']; ?>" readonly>
        <label for="postTitle" class="inputLabel">Başlık</label>
        <input type="text" name="postTitle" id="postTitle" value="<?php echo $post['Title']; ?>">
        <label for="postDate" class="inputLabel">Tarih</label>
        <input type="text" name="postDate" id="postDate" value="<?php echo $post['Date']; ?>">
        <label for="postPhotoPath" class="inputLabel">Fotoğraf</label>
        <input type="text" name="postPhotoPath" id="postPhotoPath" value="<?php echo $post['image']; ?>">
        <label for="postUserId" class="inputLabel">Kullanıcı ID</label>
        <input type="text" name="postUserId" id="postUserId" value="<?php echo $post['user_id']; ?>">
        <label for="postCategoryId" class="inputLabel">Kategori</label>
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
        <label for="postDescription" class="inputLabel">İçerik</label>
        <textarea name="postDescription" id="postDescription"><?php echo $post['Description']; ?></textarea>
        <button class="editButton" onclick="editPost()">Düzenle</button>
    </div>
    <div id="results"></div>
</body>
</html>