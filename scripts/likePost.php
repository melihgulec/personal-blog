<?php
$postId = $_POST["postId"];
$userId = $_POST["userId"];
$type = $_POST["likeType"];
include("../scripts/connection.php");

$sqlStr = "";

if($type == -1){
    $sqlStr = "

    DELETE FROM user_likes WHERE post_id = $postId AND user_id = $userId AND type = 1
    
    ";
}
else if($type == -2){
    $sqlStr = "

    DELETE FROM user_likes WHERE post_id = $postId AND user_id = $userId AND type = 0
    
    ";
}
else{
    $sqlStr = "
    INSERT INTO user_likes(user_id, post_id, type)
    VALUES
    (
    ".$userId.",
    ".$postId.",
    ".$type."
    )
    ";
}


if($connection -> query($sqlStr) === TRUE){
    echo '<script>location.reload();</script>';
}else{
    echo '<script>
        Swal.fire({
            heightAuto: false,
            title: "Hata!.",
            text: "Yorum oluşturulurken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
            icon: "error"
        });
    </script>';
}

            /*
            $postId = $_POST["postId"];
            $type = $_POST["type"];

            include("../scripts/connection.php");

            $selectquery="SELECT post_like, post_dislike FROM post WHERE id = $postId";
            $result = $connection->query($selectquery);
            $row = $result->fetch_assoc();
            $likeCount = $row["post_like"];
            $dislikeCount = $row["post_dislike"];

            $selectedTable = $type == 1 ? "post_like" : "post_dislike";
            $selectedField = $type == 1 ? (++$likeCount) : (++$dislikeCount);

            $sqlStr = "UPDATE post SET 
                ".$selectedTable."
                =  ".$selectedField."
                WHERE id = $postId
            ";


            if($connection -> query($sqlStr) === TRUE){
                echo '<script>location.reload();</script>';
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Hata!.",
                        text: "Yorum oluşturulurken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
                        icon: "error"
                    });
                </script>';
            }*/

?>