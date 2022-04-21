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
        function addPost() {
            var postTitle = document.getElementById("postTitle").value;
            var postDate = document.getElementById("postDate").value;
            var postPhotoPath = document.getElementById("postPhotoPath").value;
            var postUserId = document.getElementById("postUserId").value;
            var postCategoryId = document.getElementById("postCategoryId").value;
            var postDescription = document.getElementById("postDescription").value;

            console.log(postDescription);

            $.post("../scripts/panelPostActions.php", {
                postTitle: postTitle, 
                postDate: postDate, 
                postPhotoPath: postPhotoPath,
                postUserId: postUserId, 
                postCategoryId: postCategoryId, 
                postDescription: postDescription,
                actionId: 0}
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
        <h3>Yazı Ekle</h3>
        <label for="postTitle" class="inputLabel">Başlık</label>
        <input type="text" name="postTitle" id="postTitle" >
        <label for="postDate" class="inputLabel">Tarih</label>
        <input type="text" name="postDate" id="postDate">
        <label for="postPhotoPath" class="inputLabel">Fotoğraf</label>
        <input type="text" name="postPhotoPath" id="postPhotoPath">
        <label for="postUserId" class="inputLabel">Kullanıcı ID</label>
        <input type="text" name="postUserId" id="postUserId">
        <label for="postCategoryId" class="inputLabel">Kategori ID</label>
        <input type="text" name="postCategoryId" id="postCategoryId">
        <label for="postDescription" class="inputLabel">İçerik</label>
        <textarea name="postDescription" id="postDescription"></textarea>
        <button class="editButton" onclick="addPost()">Ekle</button>
    </div>
    <div id="results"></div>
</body>
</html>
