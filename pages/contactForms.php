<?php 

include('../scripts/connection.php');
$contact_query = $connection->query("SELECT * FROM contact");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("panelBaseStyles.php") ?>
    <link rel="stylesheet" href="../styles/contactForms.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletePost(contactId) {
            $.post("../scripts/panelContactFormActions.php", {contactId: contactId, actionId: 2},
                function(data) {
                    $('#results').html(data);
            });
        }
    </script>
</head>
<body>
    <?php include("../components/sideBar.php") ?>    
    <div class="content">
        <div class="contentHead">
            <h3>Mesaj Listesi.</h3>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Adı</th>
                <th>Başlık</th>
                <th>İleti</th>
                <th>E-Mail</th>
                <th>İşlem</th>
            </tr>
            <?php 
                while($row = $contact_query->fetch_assoc()){

                    $description = $row['Description'];
                    $description = (strlen($description) > 180) ? substr($description,0,180).'...' : $description;

                    echo '
                        <tr>
                            <td>
                                '.$row['id'].'
                            </td>
                            <td>
                                '.$row['Name'].'
                            </td>
                            <td>
                                '.$row['Subject'].'
                            </td>
                            <td width="700px">
                                '.$description.'
                            </td>
                            <td>
                                '.$row['Email'].'
                            </td>
                            <td>
                                <div class="iconGroup">
                                    <i class="fa-solid fa-search" onclick="location.href = \'seeContactForm.php?contactId='.$row['id'].'\'"></i>
                                    <i class="fa-solid fa-trash" onclick="deletePost('.$row['id'].')"></i>
                                </div>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </div>
    <div id="results"></div>
</body>
</html>
