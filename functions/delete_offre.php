<?php

function deleteOffre($id) {
    $pdo = getPDO();
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false) {
        throw new InvalidArgumentException("Invalid ID");
    }
    $stmt = $pdo->prepare("DELETE FROM Offres WHERE ID_Offre = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount();
}

?>