<?php
include './scripts/connection.php';
$postId = $_GET['post_id'];
$post_query = $connection->query("SELECT * FROM post WHERE id = ".$postId." ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazı</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/post.css">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <ul>
            <a href="/personalblog/index.php"><li>Ana Sayfa</li></a>
            <a href="/personalblog/categories.php"><li>Kategoriler</li></a>
            <a href="/personalblog/contact.php"><li>İletişim</li></a>
        </ul>
    </div>
    <div class="content">
        <div class="post-content">
            <div class="post-container">
                <?php

                    $row = $post_query->fetch_assoc();

                    $user_query = $connection->query("SELECT * FROM user WHERE id = '".$row['user_id']."'");
                    $userRow = $user_query->fetch_assoc();

                    $categorie_query = $connection->query("SELECT * FROM categories WHERE id = '".$row['categorie_id']."'");
                    $categorieRow = $categorie_query->fetch_assoc();

                    echo '

                    <div class="post-header">
                    <div class="post-pp" style="background-image: url(\'https://playtusu.com/wp-content/uploads/2021/11/avatar-the-last-airbender.jpg\');">

                    </div>
                    <div class="post-header-info">
                        <span class="name">'.$userRow['Name']." ".$userRow['Surname'].'</span>
                        <div class="post-header-about">
                            <span class="date"><i class="fa-solid fa-calendar-week"></i>&nbsp;&nbsp;&nbsp;'.date('F d, Y', strtotime($row['Date'])).'</span>
                            <i class="fa-solid fa-folder"></i>&nbsp;&nbsp;&nbsp;<span class="post-categorie-text">'.$categorieRow['Name'].'</span>
                        </div>
                    </div>
                    </div>
                    <div class="post-image">
                        <img src="'.$row['image'].'" alt="" srcset="">
                    </div>
                    <div class="post-content-info">
                        <h2>'.$row['Title'].'</h2>
                        <p>
                            '.$row['Description'].'
                        </p>
                    </div>
                    <div class="post-share-container">
                        <span class="share-text">Paylaş</span>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                    
                    ';

                ?>
            </div>
            <h1>Yorumlar.</h1>
            <div class="comment-container">
                <div class="comment-section">
                    <div class="user-pp">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="comment-input-container">
                        <textarea name="comment" id="comment" placeholder="Enter your comment."></textarea>
                    </div>
                </div>
                <div class="send-btn-container">
                    <button class="send-comment-btn">Send</button>
                </div>
                <h3>Tüm yorumlar</h3>
                <hr width="100%" color="#e2e2e2">
                <div class="user-comments">
                    <?php
                        $commentQuery = $connection->query("SELECT * FROM comment WHERE post_id = ".$postId." ");
                        $commentUserQuery = $connection->query("SELECT * FROM user INNER JOIN comment ON user.id = comment.user_id WHERE post_id = ".$postId." ");
                        
                        while($user = $commentUserQuery->fetch_assoc()){

                            $commentRow = $commentQuery->fetch_assoc();
                            
                            echo '
                            <div class="user-comment-container">
                                <div class="user-comment-pp">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="user-comment-details">
                                    <div class="user-info">
                                        <h4>'.$user['Name']." ".$user['Surname'].'</h4>
                                        <label>&nbsp;- '.$commentRow['date'].'</label>
                                    </div>
                                    <p>'.$commentRow['comment'].'</p>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="right-side">
            <div class="menu-item-container">
                <div class="menu-item-head">
                    <h3>Hakkımda</h3>
                </div>
                <div class="menu-item-content">
                    <div class="about-me-container">
                        <div class="about-me-pp" style="background-image: url('https://playtusu.com/wp-content/uploads/2021/11/avatar-the-last-airbender.jpg');"></div>
                        <?php

                            $adminQuery = $connection->query("SELECT * FROM user WHERE RoleID=1");
                            $adminRow = $adminQuery->fetch_assoc();

                            $adminInfoQuery = $connection->query("SELECT * FROM admininfo WHERE user_id = ".$adminRow['id']." ");
                            $adminInfoRow = $adminInfoQuery->fetch_assoc();

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
    <div class="footer">
        <p>2022 Tüm hakları saklıdır. Melih GÜLEÇ tarafından oluşturulmuştur.</p>
        <div class="social-media-container">
            <div class="social-media-btn-container"><i class="fa-brands fa-facebook"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-youtube"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-pinterest"></i></div>
            <div class="social-media-btn-container"><i class="fa-brands fa-twitter"></i></div>
        </div>
    </div>
</body>
</html>