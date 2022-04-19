<?php

            $userId = $_POST["userId"];

            include("../scripts/connection.php");

            $sqlStr = "DELETE FROM user WHERE id = ".$userId."";

            if($connection -> query($sqlStr) === TRUE){
                echo '<script>location.reload();</script>';
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Hata!.",
                        text: "Kullanıcı silinirken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
                        icon: "error"
                    });
                </script>';
            }

?>