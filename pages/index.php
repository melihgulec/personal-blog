<?php
include("../components/header.php");
include('../scripts/connection.php');
$post_query = $connection->query("SELECT * FROM post");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/index.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php includeHeader($pageIndexes['indexPage']); ?>
    <div class="content">
        <div class="posts">
            <?php 
                if($post_query->num_rows === 0){
                    echo 'Henüz gönderi paylaşılmamış!';
                }

                while($row = $post_query->fetch_assoc()){
                    $user_query = $connection->query("SELECT * FROM user WHERE id = '".$row['user_id']."'");
                    $userRow = $user_query->fetch_assoc();

                    $categorie_query = $connection->query("SELECT * FROM categories WHERE id = '".$row['categorie_id']."'");
                    $categorieRow = $categorie_query->fetch_assoc();

                    $description = $row['Description'];
                    $description = (strlen($description) > 180) ? substr($description,0,180).'...' : $description;

                    echo '
                    <div class="post-container">
                    <div class="post-header">
                        <img class="post-pp" src="../assets/user/images/'.$userRow['image'].'" alt="" srcset="">
                        <div class="post-header-info">
                            <span class="name">'.$userRow['Name']." ".$userRow['Surname'].'</span>
                            <div class="post-header-about">
                                <span class="date"><i class="fa-solid fa-calendar-week"></i>&nbsp;&nbsp;&nbsp;'.date('F d, Y', strtotime($row['Date'])).'</span>
                                <i class="fa-solid fa-folder"></i>&nbsp;&nbsp;&nbsp;<span class="post-categorie-text">'.$categorieRow['Name'].'</span>
                            </div>
                        </div>
                    </div>
                    <div class="post-image">
                        <img src="../assets/post/images/'.$row['image'].'" alt="" srcset="">
                    </div>
                    <div class="post-content-info">
                        <h2>'.$row['Title'].'</h2>
                        <p>'.$description.'</p>
                    </div>
                    <div class="button-container">
                        <button type="button" class="continue-read-btn" onclick="location.href=\'post.php?post_id='.$row['id'].'\'">OKUMAYA DEVAM ET</button>
                    </div>
                    <div class="post-share-container">
                        <span class="share-text">Paylaş</span>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
                    ';
                };
                
            ?>
        </div>
        <div class="right-side">
            <div class="menu-item-container">
                <div class="menu-item-head">
                    <h3>Hakkımda</h3>
                </div>
                <div class="menu-item-content">
                    <div class="about-me-container">
                        <?php

                            $adminQuery = $connection->query("SELECT * FROM user WHERE RoleID=1");
                            $adminRow = $adminQuery->fetch_assoc();

                            $adminInfoQuery = $connection->query("SELECT * FROM admininfo WHERE user_id = ".$adminRow['id']." ");
                            $adminInfoRow = $adminInfoQuery->fetch_assoc();

                        
                            $imread = "../assets/user/images/".$adminRow["image"];

                            echo '<img class="about-me-pp" src="'.$imread.'" alt="" srcset="">';

                            echo '
                            <h3>'.$adminRow['Name']." ".$adminRow['Surname'].'</h3>
                            <p>'.$adminInfoRow['Description'].'</p>
                            ';

                        ?>
                    </div>
                </div>
            </div>
            <div class="menu-item-container">
                <div class="search-container">
                    <input type="text" name="search" id="search" placeholder="Enter Keywords..." />
                </div>
            </div>
            <div class="menu-item-container">
                <div class="menu-item-head">
                    <h3>Kategoriler</h3>
                </div>
                <div class="menu-item-content">
                <?php
                        $categoriesQuery = $connection->query("SELECT * FROM categories");

                        while($categorieRow = $categoriesQuery->fetch_assoc()){
                            $categoriePostCountQuery = $connection->query("SELECT COUNT(*) as totalCount FROM post WHERE categorie_id = ".$categorieRow['id']."");
                            $result = $categoriePostCountQuery->fetch_assoc();

                            echo '
                        
                            <div class="categories-item-container" onclick="location.href=\'categorie.php?categorie_id='.$categorieRow['id'].'\'">
                            <div class="categories-item-head">
                                <i class="fa-solid fa-chevron-right"></i>&emsp;'.$categorieRow['Name'].'
                            </div>
                            <div class="categories-item-counter">'.$result['totalCount'].'</div>
                            </div>
    
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="menu-item-container">
                <div class="menu-item-head">
                    <h3>Sosyal Medya</h3>
                </div>
                <div class="menu-item-content">
                    <div class="social-media-container">
                        <div class="social-media-btn-container"><i class="fa-brands fa-facebook-square" style="color:blue"></i></div>
                        <div class="social-media-btn-container"><i class="fa-brands fa-youtube" style="color:red"></i></div>
                        <div class="social-media-btn-container"><i class="fa-brands fa-pinterest" style="color:red"></i></div>
                        <div class="social-media-btn-container"><i class="fa-brands fa-twitter" style="color:cornflowerblue;"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../components/footer.php") ?>
</body>
</html>