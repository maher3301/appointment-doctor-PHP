<?php
include_once 'db_connection.php';
if(isset($_POST['id']) && !empty($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)) {
            echo "Le rendez-vous a été supprimé avec succès.";
        } else {
            echo "Erreur lors de l'exécution de la requête de suppression : " . mysqli_error($conn);
        }
    } else {
        echo "Erreur lors de la préparation de la requête de suppression : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Identifiant du rendez-vous non spécifié.";
}
?>
