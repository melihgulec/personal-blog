<?php

            $postId = $_POST["postId"];

            include("../scripts/connection.php");

            $sqlStr = "DELETE FROM post WHERE id = ".$postId."";

            if($connection -> query($sqlStr) === TRUE){
                echo '<script>location.reload();</script>';
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Hata!.",
                        text: "Gönderi silinirken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
                        icon: "error"
                    });
                </script>';
            }

?>