<?php 

include('../scripts/connection.php');
$post_query = $connection->query("SELECT * FROM post");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/panel.css">
    <link rel="stylesheet" href="../styles/postList.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Yazı Listesi.</h3>
        <?php 
            while($post = $post_query->fetch_assoc()){

                $description = $post['Description'];
                $description = (strlen($description) > 180) ? substr($description,0,180).'...' : $description;

                echo '
                <div class="postContainer">
                    <div class="postInfo">
                        <label for="" class="title">'.$post['Title'].'</label>
                        <label for="" class="description">'.$description.'</label>
                    </div>
                    <div class="iconGroup">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-solid fa-trash"></i>
                    </div>
                </div>
                ';
            }
        ?>
        
    </div>
</body>
</html>
