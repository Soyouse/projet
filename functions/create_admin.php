<?php
require_once 'functions/login.php';

function createAdmin($username, $password) {
    $pdo = getPDO();
    $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);

    // Hacher le mot de passe avant de le stocker
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password
    ]);

    echo "Administrateur créé avec succès.";
}

// Remplacez 'admin' et 'password' par vos propres valeurs
$username = 'admin';
$password = 'password';

createAdmin($username, $password);
?>