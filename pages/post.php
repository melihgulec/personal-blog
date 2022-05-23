<?php
include("../components/header.php");
include '../scripts/connection.php';
$postId = $_GET['post_id'];
$post_query = $connection->query("SELECT * FROM post WHERE id = ".$postId." ");

$isLogged = false;

if(isset($_SESSION['loggedIn'])) 
{ 
    if($_SESSION['loggedIn'] === true)
    {
        $isLogged = true; 
    } 
    else 
    {
        $isLogged = false; 
    } 
}
else
{ 
    $isLogged = false;
}

$postLikeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE post_id = ".$postId." AND type = 1");
$postLikeRow = $postLikeQuery->fetch_assoc();

$postDislikeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE post_id = ".$postId." AND type = 0");
$postDislikeRow = $postDislikeQuery->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazı</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/post.css">
    <link rel="stylesheet" href="../styles/global.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php
        if($isLogged === true){
            echo '
            <script>
                function SubmitFormData() {
                    var commentVal = $("#comment").val();
                    var userId = '.$_SESSION['userId'].';
                    var postId = '.$postId.';
                    const d = new Date();
                    var date = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
                    $.post("../scripts/addPostComment.php", { commentVal: commentVal, userId: userId, postId: postId, date: date},
                        function(data) {
                            $("#results").html(data);
                    });
                }
            </script>
            ';
        }
    ?>
    <script>
        function SubmitLike(likeType) {
            let userId = <?php echo $_SESSION['userId']; ?>;
            let postId = <?php echo $postId; ?>;

            $.post("../scripts/likePost.php", { postId: postId, userId: userId, likeType: likeType},
                function(data) {
                    $("#results").html(data);
            });
        }
    </script>
</head>
<body>
    <?php includeHeader($pageIndexes['categoriesPage']) ?>
    <div class="content">
        <div class="post-content">
            <div class="post-container">
                <?php

                    $row = $post_query->fetch_assoc();

                    if($post_query -> num_rows === 0){
                        echo 'Gönderi bulunamadı.';
                        exit();
                    }else{
                        $viewQuery = $connection->query("UPDATE post SET views = ".(++$row["views"])." WHERE id = $postId");

                        $user_query = $connection->query("SELECT * FROM user WHERE id = '".$row['user_id']."'");
                        $userRow = $user_query->fetch_assoc();

                        $categorie_query = $connection->query("SELECT * FROM categories WHERE id = '".$row['categorie_id']."'");
                        $categorieRow = $categorie_query->fetch_assoc();

                        if($isLogged){
                            $likeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE post_id = $postId AND type = 1 AND user_id =".$_SESSION["userId"]);
                            $result = $likeQuery->fetch_assoc();
                            $likeCount = $result["count"];
                            $isLiked = $likeCount == 0 ? false: true;

                            $dislikeQuery = $connection->query("SELECT COUNT(*) as count FROM user_likes WHERE post_id = $postId AND type = 0 AND user_id =".$_SESSION["userId"]);
                            $result = $dislikeQuery->fetch_assoc();
                            $dislikeCount = $result["count"];
                            $isDisliked = $dislikeCount == 0 ? false: true;

                            $like = $isLiked ? 'style="color: #36d889"' : ""; 
                            $dislike = $isDisliked ? 'style="color: red"' : ""; 

                            $likeOnclick = "";

                            if($isLiked){
                                $likeOnclick = 'onclick="SubmitLike(-1)"';
                            }
                            else{
                                if($isDisliked){
                                    $likeOnclick = "";
                                }else{
                                    $likeOnclick = 'onclick="SubmitLike(1)"';
                                }
                            }

                            
                            $dislikeOnclick = "";

                            if($isDisliked){
                                $dislikeOnclick = 'onclick="SubmitLike(-2)"';
                            }
                            else{
                                    if($isLiked){
                                        $dislikeOnclick = "";
                                    }else{
                                        $dislikeOnclick = 'onclick="SubmitLike(0)"';
                                    }
                                }
                            }else{
                                $likeOnclick = "";
                                $like = "";
                                $dislikeOnclick = "";
                                $dislike = "";
                            }


                        echo '
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
                            <p>
                                '.nl2br($row['Description']).'
                            </p>
                        </div>
                        <div class="post-share-container" onclick="navigator.clipboard.writeText(window.location)">
                            <span class="share-text">Paylaş</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                        <form action="../scripts/likePost.php" method="post">
                            <div class="likeContainer">
                                <div class="likes">
                                    <i class=\'fa-solid fa-thumbs-up\' '.$likeOnclick.' '.$like.'></i>
                                    <span class="likeCount">'.$postLikeRow["count"].'</span>
                                    <i class="fa-solid fa-thumbs-down" '.$dislikeOnclick.' '.$dislike.'></i>
                                    <span class="dislikeCount">'.$postDislikeRow["count"].'</span>
                                </div>
                            </div>
                        </form> 
                        ';
                    }
                ?>
            </div>
            <h1>Yorumlar.</h1>
            <div class="comment-container">
                <form action="../scripts/addPostComment.php" method="post">
                    <div class="comment-section">
                        <div class="user-pp">
                            <?php echo $isLogged === true ? '<img src="../assets/user/images/'.$_SESSION['userImage'].'" alt="" srcset="">' : '<i class="fa-solid fa-user"></i>' ?>
                        </div>
                        <div class="comment-input-container">
                            <textarea name="comment" id="comment" <?php echo $isLogged === true ? 'placeholder="Yorum yaz."' : 'placeholder="Yorum yapabilmek için giriş yapmalısın." readonly' ?> ></textarea>
                        </div>
                    </div>
                    <div class="send-btn-container">
                        <input type="button" value="Gönder" class="send-comment-btn" <?php echo $isLogged === true ? 'onclick="SubmitFormData()"' : 'disabled' ?>>
                    </div>
                </form>
                <h3>Tüm yorumlar</h3>
                <hr width="100%" color="#e2e2e2">
                <div class="user-comments">
                    <?php
                        $commentQuery = $connection->query("SELECT * FROM comment WHERE post_id = ".$postId." ");
                        $commentUserQuery = $connection->query("SELECT * FROM user INNER JOIN comment ON user.id = comment.user_id WHERE post_id = ".$postId." ");
                        
                        if($commentQuery->num_rows === 0){
                            echo 'Bu gönderiye hiçbir yorum yapılmamış.';
                        }

                        while($user = $commentUserQuery->fetch_assoc()){

                            $commentRow = $commentQuery->fetch_assoc();
                            
                            echo '
                            <div class="user-comment-container">
                                <div class="user-comment-pp">
                                    <img src="../assets/user/images/'.$user['image'].'" alt="" srcset="">
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
    <div id="results"></div>
    <?php include("../components/footer.php") ?>
</body>
</html>