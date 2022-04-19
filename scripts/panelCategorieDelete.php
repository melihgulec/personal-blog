<?php

            $categorieId = $_POST["categorieId"];

            include("../scripts/connection.php");

            $sqlStr = "DELETE FROM categories WHERE id = ".$categorieId."";

            if($connection -> query($sqlStr) === TRUE){
                echo '<script>location.reload();</script>';
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Hata!.",
                        text: "Kategori silinirken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
                        icon: "error"
                    });
                </script>';
            }

?>