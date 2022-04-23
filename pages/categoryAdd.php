<?php
session_start();
include("../scripts/panelAdminCheck.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../scripts/panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/categoryEdit.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function addCategory() {
            var categoryName = document.getElementById("categoryName").value;

            $.post("../scripts/panelCategoryActions.php", {categoryName: categoryName, actionId: 0},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Kategori Ekle</h3>
        <label for="categoryName" class="inputLabel">Kategori Adı</label>
        <input type="text" name="categoryName" id="categoryName">
        <button class="editButton" onclick="addCategory()">Ekle</button>
    </div>
    <div id="results"></div>
</body>
</html>
