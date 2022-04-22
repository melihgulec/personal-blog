<?php 

include('../scripts/connection.php');

$contactId = $_GET['contactId'];

$getContactData = $connection->query("SELECT * FROM contact WHERE id = '".$contactId."'");
$contact = $getContactData->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/panel.css">
    <link rel="stylesheet" href="../styles/seeContactForm.css">
    <script src="https://kit.fontawesome.com/b6283481d8.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <h3>Mesaja Gözat.</h3>
        <label for="contactId" class="inputLabel">Contact ID</label>
        <input type="text" name="contactId" id="contactId" value="<?php echo $contact['id']; ?>" readonly>
        <label for="name" class="inputLabel">Adı</label>
        <input type="text" name="name" id="name" value="<?php echo $contact['Name']; ?>" readonly>
        <label for="subject" class="inputLabel">Başlık</label>
        <input type="text" name="subject" id="subject" value="<?php echo $contact['Subject']; ?>" readonly>
        <label for="email" class="inputLabel">E-Mail</label>
        <input type="text" name="email" id="email" value="<?php echo $contact['Email']; ?>" readonly>
        <label for="description" class="inputLabel">İleti</label>
        <textarea id="description" name="description" readonly><?php echo $contact['Description'] ?></textarea>
    </div>
    <div id="results"></div>
</body>
</html>