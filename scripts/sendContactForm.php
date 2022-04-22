<?php
include("../scripts/connection.php");
include("../helpers/swalHelper.php");

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$description = $_POST["description"];

$sqlStr = "INSERT INTO contact(Name, Email, Subject, Description) 
    VALUES(
        '".$name."',
        '".$email."',
        '".$subject."',
        '".$description."'
    )
";

if($connection->query($sqlStr)){
    makeSuccessAlert("Kayıt başarıyla oluşturuldu.");
}else{
    makeErrorAlert("Kayıt oluşturulurken hatayla karşılaşıldı. Hata: ".$connection->error);
}

?>