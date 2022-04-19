<?php

            $userId = $_POST["userId"];
            $postId = $_POST["postId"];
            $commentVal = $_POST["commentVal"];
            $date = $_POST["date"];

            include("../scripts/connection.php");

            if($commentVal === ""){
                echo '<script>
                Swal.fire({
                    heightAuto: false,
                    title: "Hata!",
                    text: "Yorum alanı doldurulmalıdır.",
                    icon: "error"
                });
                </script>';

                exit();
            }

            $sqlStr = "INSERT INTO comment(user_id, post_id, comment, date) VALUES
                (
                    ".$userId.",
                    ".$postId.",
                    '".$commentVal."',
                    '".$date."'
                )
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
            }

?>