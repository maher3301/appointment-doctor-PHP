<?php
include_once 'db_connection.php';
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $rendezVousId = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $nom = $_POST['nom'];

        $sql = "UPDATE appointments SET date = ?, time = ?, nom = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $date, $time, $nom, $rendezVousId);

        if ($stmt->execute()) {
            echo "Le rendez-vous a été modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du rendez-vous : " . $conn->error;
        }
    }

    $sql = "SELECT date, time, nom FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rendezVousId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $date = $row['date'];
        $time = $row['time'];
        $nom = $row['nom'];
    } else {
        echo "Aucun rendez-vous trouvé avec l'identifiant spécifié.";
    }
} else {
    echo "Identifiant du rendez-vous non spécifié.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rendez-vous</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .background-container {
            background-image: url('oip.jpg'); 
            background-size: cover;
            background-position: center 20%; 
            height: 60vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #21618C;
            text-align: center;
        }

        .descriptive-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Cabinet Médical</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="background-container">
        <div class="ligne-horizontal"></div>
    </div>

    <div class="container mt-5">
        <div class="descriptive-container">
            <h1 class="mb-2">Modifier Rendez-vous</h1>
            <form action="modifier_rendez_vous.php?id=<?php echo $rendezVousId; ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                    <input type="date" id="date" name="date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $date; ?>">
                </div>
                <div class="mb-4">
                    <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Heure:</label>
                    <input type="time" id="time" name="time" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $time; ?>">
                </div>
                <div class="mb-6">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom et Prénom:</label>
                    <input type="text" id="nom" name="nom" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $nom; ?>">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier Rendez-vous</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-4 fixed-bottom">
        <div class="container">
        © Maher -2024 Cabinet Médical. Tous droits réservés.
        </div>
    </footer>
</body>
</html>
