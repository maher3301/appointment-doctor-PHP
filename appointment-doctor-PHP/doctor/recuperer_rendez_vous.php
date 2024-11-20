<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "docteur";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$sql = "SELECT id ,date, time, nom FROM appointments"; 
$result = $conn->query($sql);

if ($result === false) {
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='rendezvous-item mb-2'>";
        echo "<p>Date: " . $row["date"]. " - Heure: " . $row["time"]. " - Nom et Prénom: " . $row["nom"]. "</p>";
        echo "<button class='btn-edit' data-id='" . $row["id"]. "'>Modifier</button>";
        echo "<button class='btn-delete' data-id='" . $row["id"]. "'>Supprimer</button>";
        echo "</div>";
    }
} else {
    echo "Aucun rendez-vous trouvé";
}

$conn->close();
?>
