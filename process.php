<?php
if (isset($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
        echo "Please provide all information.";
    } else {
        // Connexion à la base de données
        $link = mysqli_connect("localhost", "root", "", "register");

        // Vérification de la connexion
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Hashage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête SQL
        $sql = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);

        // Vérification de la préparation de la requête
        if ($stmt) {
            // Liaison des paramètres
            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $username, $email, $hashed_password);
            // Exécution de la requête
            if (mysqli_stmt_execute($stmt)) {
                echo "Record inserted successfully.";
            } else {
                echo "ERROR: Could not execute query. " . mysqli_error($link);
            }
            // Fermeture du statement
            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not prepare query. " . mysqli_error($link);
        }

        // Fermeture de la connexion
        mysqli_close($link);
    }
}
?>
