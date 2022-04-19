<?php

            $postEmail = $_POST["email"];
            $postPassword = $_POST["password"];
            
            include("../scripts/connection.php");

            if($postEmail === "" || $postPassword === ""){
                echo '<script>
                Swal.fire({
                    heightAuto: false,
                    title: "Hata!",
                    text: "Formdaki tüm alanlar doldurulmalıdır.",
                    icon: "error"
                });
                </script>';

                exit();
            }


            $userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$postEmail."' AND password = '".$postPassword."'");
            $row = $userQuery->num_rows;
            $userDetails = $userQuery->fetch_assoc();

            if($row == 0){
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Giriş başarısız.",
                        text: "Kullanıcı bulunamadı.",
                        icon: "error"
                    });
                </script>';
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Giriş başarılı.",
                        text: "Hoş geldin '.$userDetails['Name'].'. Sayfaya yönlendiriliyorsunuz.",
                        icon: "success"
                    });
                </script>';
            }

?>