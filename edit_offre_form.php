<?php
session_start();
require_once 'functions/login.php';
require_once 'functions/read_offres.php';
require_once 'functions/update_offre.php';

// Fonction pour vérifier si l'utilisateur est connecté
require_once 'functions/check.php';

// Vérifier si l'utilisateur est connecté
checkLogin();

// Vérifier si l'ID de l'offre est présent et valide
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id === false) {
        header("Location: admin_offres.php");
        exit;
    }
    $offre = getOffreById($id);
} else {
    header("Location: admin_offres.php");
    exit;
}

// Générer un token CSRF unique
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Vérifier le token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de validation CSRF");
    }

    // Valider les entrées
    $id = filter_var($_POST['ID_Offre'], FILTER_VALIDATE_INT);
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $type = !empty($_POST['ID_Type']) ? filter_var($_POST['ID_Type'], FILTER_VALIDATE_INT) : null;
    $type_salaire = !empty($_POST['ID_Type_Salaire']) ? filter_var($_POST['ID_Type_Salaire'], FILTER_VALIDATE_INT) : null;
    $salaire = $_POST['salaire'];
    $competences = $_POST['competences'];
    $niveau_etudes = $_POST['niveau_etudes'];
    $localisation = $_POST['localisation'];

    updateOffre($id, $titre, $description, $type, $type_salaire, $salaire, $competences, $niveau_etudes, $localisation);
    header("Location: admin_offres.php");
    exit;
}

$types_contrats = getTypesContrats();
$types_salaires = getTypesSalaires();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Édition de l'Offre</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container mt-4">
        <h1>Éditer l'Offre</h1>
        <?php if (isset($offre)): ?>
        <form method="post">
            <input type="hidden" name="ID_Offre" value="<?php echo htmlspecialchars($offre['ID_Offre'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre:</label>
                <input type="text" class="form-control" id="titre" name="titre" required value="<?php echo htmlspecialchars($offre['Titre'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($offre['Description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="ID_Type" class="form-label">Type de contrat:</label>
                <select class="form-control" id="ID_Type" name="ID_Type">
                    <option value="">Non spécifié</option>
                    <?php foreach ($types_contrats as $type_contrat) {
                        echo "<option value='" . htmlspecialchars($type_contrat['ID_Type'], ENT_QUOTES, 'UTF-8') . "'" . ($type_contrat['ID_Type'] == $offre['ID_Type'] ? ' selected' : '') . ">" . htmlspecialchars($type_contrat['Nom'], ENT_QUOTES, 'UTF-8') . "</option>";
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ID_Type_Salaire" class="form-label">Type de salaire:</label>
                <select class="form-control" id="ID_Type_Salaire" name="ID_Type_Salaire">
                    <option value="">Non spécifié</option>
                    <?php foreach ($types_salaires as $type_salaire) {
                        echo "<option value='" . htmlspecialchars($type_salaire['ID_Type_Salaire'], ENT_QUOTES, 'UTF-8') . "'" . ($type_salaire['ID_Type_Salaire'] == $offre['ID_Type_Salaire'] ? ' selected' : '') . ">" . htmlspecialchars($type_salaire['Type'], ENT_QUOTES, 'UTF-8') . "</option>";
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire:</label>
                <input type="text" class="form-control" id="salaire" name="salaire" value="<?php echo htmlspecialchars($offre['Salaire'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="mb-3">
                <label for="competences" class="form-label">Compétences:</label>
                <textarea class="form-control" id="competences" name="competences"><?php echo htmlspecialchars($offre['Competences'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="niveau_etudes" class="form-label">Niveau d'études:</label>
                <input type="text" class="form-control" id="niveau_etudes" name="niveau_etudes" value="<?php echo htmlspecialchars($offre['Niveau_Etudes'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="mb-3">
                <label for="localisation" class="form-label">Localisation:</label>
                <input type="text" class="form-control" id="localisation" name="localisation" value="<?php echo htmlspecialchars($offre['Localisation'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <button type="submit" name="save" class="btn btn-primary">Sauvegarder les Modifications</button>
            <a href="admin_offres.php" class="btn btn-secondary">Retour à la page principale</a>
        </form>
        <?php endif; ?>
    </main>
</body>
</html>