<?php
    include_once 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $nom = $_POST['nom'];

        $sql = "INSERT INTO appointments (date, time, nom) VALUES ('$date', '$time', '$nom')";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success" role="alert">
                    Le rendez-vous a été ajouté avec succès.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Erreur : ' . mysqli_error($conn) . '
                  </div>';
        }
    }
  
?>
