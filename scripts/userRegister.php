<?php
//userName: userName, userSurname: userSurname, userMail: userMail, password: password, dateOfBirth: dateOfBirth

            $userName = $_POST["userName"];
            $userSurname = $_POST["userSurname"];
            $userMail = $_POST["userMail"];
            $password = $_POST["password"];
            $dateOfBirth = $_POST["dateOfBirth"];
            
            include("../scripts/connection.php");

            if($userName === "" || $userSurname === "" || $userMail === "" || $password === "" || $dateOfBirth === "" ){
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


            $userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$userMail."' AND password = '".$password."'");
            $row = $userQuery->num_rows;
            $userDetails = $userQuery->fetch_assoc();

            if($row == 0){

                $sqlStr = "INSERT INTO user(Name, Surname, Email,  Password, DateOfBirth, RoleID, image) 
                VALUES(
                    '".$userName."',
                    '".$userSurname."',
                    '".$userMail."',
                    '".$password."',
                    '".$dateOfBirth."',
                    '2',
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1200px-User_icon_2.svg.png'
                    )
                ";

                if($connection -> query($sqlStr) === TRUE){
                    echo '<script>
                        Swal.fire({
                            heightAuto: false,
                            title: "Tamam!",
                            text: "Kayıt başarıyla oluşturuldu.",
                            icon: "success"
                        });
                    </script>';
                }
                else{
                    echo '<script>
                        Swal.fire({
                            heightAuto: false,
                            title: "Hata!.",
                            text: "Kayıt oluşturulurken bir sorunla karşılaşıldı.\nHata:\n'.$connection->error.'",
                            icon: "error"
                        });
                    </script>';
                }

                
                
            }else{
                echo '<script>
                    Swal.fire({
                        heightAuto: false,
                        title: "Hata!",
                        text: "Böyle bir e-postaya sahip kullanıcı bulunmaktadır. Lütfen başka bir e-posta deneyiniz.",
                        icon: "error"
                    });
                </script>';
            }

?>