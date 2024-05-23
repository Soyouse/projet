<?php
require_once 'sanitize.php';

function updateOffre($id, $titre, $description, $type, $type_salaire, $salaire, $competences, $niveau_etudes, $localisation) {
    $pdo = getPDO();
    $sql = "UPDATE Offres SET 
            Titre = :titre, 
            Description = :description, 
            ID_Type = :type, 
            ID_Type_Salaire = :type_salaire, 
            Salaire = :salaire, 
            Competences = :competences, 
            Niveau_Etudes = :niveau_etudes, 
            Localisation = :localisation 
            WHERE ID_Offre = :id";
    $stmt = $pdo->prepare($sql);

    // Remplacer les valeurs vides par NULL pour les clés étrangères
    $type = !empty($type) ? $type : NULL;
    $type_salaire = !empty($type_salaire) ? $type_salaire : NULL;

    $stmt->execute([
        'titre' => sanitizeInput($titre),
        'description' => sanitizeInput($description),
        'type' => $type,
        'type_salaire' => $type_salaire,
        'salaire' => sanitizeInput($salaire),
        'competences' => sanitizeInput($competences),
        'niveau_etudes' => sanitizeInput($niveau_etudes),
        'localisation' => sanitizeInput($localisation),
        'id' => filter_var($id, FILTER_VALIDATE_INT)
    ]);

    return $stmt->rowCount();
}
?>