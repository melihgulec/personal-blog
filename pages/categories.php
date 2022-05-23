<?php
include("../components/header.php");
include '../scripts/connection.php';
$categoriesQuery = $connection->query("SELECT * FROM categories");
$categoriesQueryCount = $connection->query("SELECT COUNT(*) as totalCount FROM categories");
$allCategoryCount=$categoriesQueryCount->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriler</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/categories.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php includeHeader($pageIndexes['categoriesPage']) ?>
    <div class="content">
        <div class="categories-container">
            <h1>Kategoriler.</h1>
            <small id="categorie-counter"><?php echo $allCategoryCount['totalCount'] ?> kategori listelenmektedir.</small>
            <div class="categories-list">
                <?php
                if($categoriesQuery->num_rows === 0){
                    echo 'Henüz kategori eklenmemiş!';
                }

                while($row = $categoriesQuery->fetch_assoc())
                {
                    echo '
                    <div class="categorie-container" onclick="location.href=\'categorie.php?categorie_id='.$row['id'].'\'">
                        <div class="categorie-icon-container">
                            <i class="fa-solid fa-asterisk"></i>
                        </div>
                        <span class="categorie-name">'.$row['Name'].'</span>
                    </div>
                    ';
                }
                ?>
            </div>
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
                <form action="../pages/search.php" method="GET">
                    <div class="search-container">
                        <input type="text" name="keyword" id="keyword" placeholder="Ara..." />
                        <input type="submit" class="search-btn" value="ARA"/>
                    </div>
                </form>
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
                <?php include('../components/socialMediaList.php') ?>
            </div>
        </div>
    </div>
    <?php include("../components/footer.php") ?>
</body>
</html>