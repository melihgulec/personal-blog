<?php
    $postEmail = $_POST["email"];
    $postPassword = $_POST["password"];
    
    include("../scripts/connection.php");
    include("../scripts/routing.php");

    if(empty($postEmail) && empty($postPassword)){

        $arr = array(
            'status' => false,
            'data'   => '<script>
                            Swal.fire({
                                heightAuto: false,
                                title: "Hata!",
                                text: "Formdaki tüm alanlar doldurulmalıdır.",
                                icon: "error"
                            });
                        </script>'
        );
        
        echo json_encode($arr);
    }

    $userQuery = $connection->query("SELECT * FROM user WHERE Email = '".$postEmail."' AND password = '".$postPassword."'");
    $row = $userQuery->num_rows;
    $userDetails = $userQuery->fetch_assoc();

    if($row == 0){
        $arr = array(
            'status' => false,
            'data'   => '<script>
                            Swal.fire({
                                heightAuto: false,
                                title: "Giriş başarısız.",
                                text: "Kullanıcı bulunamadı.",
                                icon: "error"
                            });
                        </script>'
        );
        
        echo json_encode($arr);
    }else{
        session_start();
        session_regenerate_id(true);

        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $userDetails['id'];
        $_SESSION['userEmail'] = $userDetails['Email'];
        $_SESSION['userName'] = $userDetails['Name'];
        $_SESSION['userSurname'] = $userDetails['Surname'];
        $_SESSION['userImage'] = $userDetails['image'];
        $_SESSION['isAdmin'] = false;
        
        $arr = array(
            'status' => true,
            'data'   => '<script>
                            Swal.fire({
                                heightAuto: false,
                                title: "Giriş başarılı.",
                                text: "Hoş geldin '.$userDetails['Name'].'. Sayfaya yönlendiriliyorsunuz.",
                                icon: "success"
                            });
                        </script>'
        );
        
        echo json_encode($arr);
    }
?>