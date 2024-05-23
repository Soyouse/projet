<?php

require_once 'sanitize.php';

function createOffre($titre, $description, $type, $type_salaire, $salaire, $competences, $niveau_etudes, $localisation) {
    $pdo = getPDO();
    $sql = "INSERT INTO Offres (Titre, Description, ID_Type, ID_Type_Salaire, Salaire, Competences, Niveau_Etudes, Localisation) 
            VALUES (:titre, :description, :type, :type_salaire, :salaire, :competences, :niveau_etudes, :localisation)";
    $stmt = $pdo->prepare($sql);

    // Remplacer les valeurs vides par NULL pour les clés étrangères et le salaire
    $type = !empty($type) ? $type : NULL;
    $type_salaire = !empty($type_salaire) ? $type_salaire : NULL;
    $salaire = !empty($salaire) && $salaire !== 'Non spécifié' ? $salaire : NULL;

    $stmt->execute([
        ':titre' => sanitizeInput($titre),
        ':description' => sanitizeInput($description),
        ':type' => $type,
        ':type_salaire' => $type_salaire,
        ':salaire' => $salaire,
        ':competences' => sanitizeInput($competences),
        ':niveau_etudes' => sanitizeInput($niveau_etudes),
        ':localisation' => sanitizeInput($localisation)
    ]);
    return $pdo->lastInsertId();
}

?>