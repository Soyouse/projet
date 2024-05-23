<?php

function getOffres() {
    $pdo = getPDO();
    $sql = "SELECT o.ID_Offre, o.Titre, o.Description, o.Salaire, o.Competences, o.Niveau_Etudes, o.Localisation, o.Date_Publication,
                   tc.Type_Contrat AS NomTypeContrat, st.Type AS NomTypeSalaire
            FROM offres o
            LEFT JOIN types_contrats tc ON o.ID_Type = tc.ID_Type
            LEFT JOIN salaire_type st ON o.ID_Type_Salaire = st.ID_Type_Salaire";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getOffreById($id) {
    $pdo = getPDO();
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
        throw new InvalidArgumentException("Invalid ID");
    }
    $stmt = $pdo->prepare("SELECT * FROM Offres WHERE ID_Offre = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function getTypesContrats() {
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT ID_Type, Type_Contrat AS Nom FROM types_contrats");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTypesSalaires() {
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT ID_Type_Salaire, Type AS Nom FROM salaire_type");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>