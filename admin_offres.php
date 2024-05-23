<?php
session_start();

// Afficher les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fonction pour vérifier si l'utilisateur est connecté
require_once 'functions/check.php';

// Vérifier si l'utilisateur est connecté
checkLogin();

// accès composants
require_once 'functions/login.php';
require_once 'functions/read_offres.php';
require_once 'functions/delete_offre.php';
require_once 'functions/update_offre.php';
require_once 'functions/create_offre.php';

$types_contrats = getTypesContrats();
$types_salaires = getTypesSalaires();
$offres = getOffres();  // Appel de la fonction pour récupérer les offres

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de validation CSRF");
    }

    // Validation du salaire uniquement s'il n'est pas vide
    if (!empty($_POST['salaire']) && !preg_match('/^[0-9-]+$/', $_POST['salaire'])) {
        $errors[] = "Le salaire doit uniquement contenir des chiffres et des tirets.";
    }

    if (empty($errors)) {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete' && isset($_POST['ID_Offre'])) {
                $id_offre = filter_var($_POST['ID_Offre'], FILTER_VALIDATE_INT);
                if ($id_offre !== false) {
                    $result = deleteOffre($id_offre);
                    echo $result > 0 ? "<script>alert('Offre supprimée avec succès');</script>" :
                        "<script>alert('Erreur lors de la suppression de l'offre');</script>";
                    header("Location: admin_offres.php");
                    exit;
                }
            } elseif ($_POST['action'] == 'addOrUpdate') {
                $titre = !empty($_POST['titre']) ? $_POST['titre'] : 'Non spécifié';
                $description = !empty($_POST['description']) ? $_POST['description'] : 'Non spécifié';
                $type = !empty($_POST['ID_Type']) ? $_POST['ID_Type'] : NULL;
                $type_salaire = !empty($_POST['ID_Type_Salaire']) ? $_POST['ID_Type_Salaire'] : NULL;
                $montant_salaire = !empty($_POST['salaire']) ? $_POST['salaire'] : NULL;
                $competences = !empty($_POST['competences']) ? $_POST['competences'] : 'Non spécifié';
                $niveau_etudes = !empty($_POST['niveau_etudes']) ? $_POST['niveau_etudes'] : 'Non spécifié';
                $localisation = !empty($_POST['localisation']) ? $_POST['localisation'] : 'Non spécifié';
                $id_offre = isset($_POST['ID_Offre']) ? filter_var($_POST['ID_Offre'], FILTER_VALIDATE_INT) : null;

                if ($id_offre !== false && $id_offre !== null) {
                    updateOffre($id_offre, $titre, $description, $type, $type_salaire, $montant_salaire, $competences, $niveau_etudes, $localisation);
                } else {
                    createOffre($titre, $description, $type, $type_salaire, $montant_salaire, $competences, $niveau_etudes, $localisation);
                }
                header("Location: admin_offres.php");
                exit;
            }
        }
    }
}

// Fonction pour afficher "Non spécifié" si une valeur est vide
function afficherOuNonSpecifie($valeur) {
    return !empty($valeur) ? htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8') : 'Non spécifié';
}

// Générer un token CSRF unique
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Offres</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <main class="mt-4">
        <div class="container-a1 container">
            <div class="mb-3 d-flex justify-content-between">
                <a href="manage_users.php" class="btn btn-primary">Gérer les Utilisateurs</a>
                <a href="logout.php" class="btn btn-danger">Déconnexion</a>
            </div>
            <h1>Gérer les offres d'emploi</h1>
            <!-- Affichage des erreurs -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!-- Formulaire pour ajouter ou mettre à jour une offre -->
            <form action="admin_offres.php" method="post">
                <input type="hidden" name="action" value="addOrUpdate">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="ID_Offre" value="<?php echo htmlspecialchars($id_offre ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre:</label>
                    <input type="text" class="form-control" id="titre" name="titre" required value="<?php echo htmlspecialchars($titre ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="ID_Type" class="form-label">Type de contrat:</label>
                    <select class="form-control" id="ID_Type" name="ID_Type">
                        <option value="">Non spécifié</option>
                        <?php foreach ($types_contrats as $type_contrat) {
                            echo "<option value='" . htmlspecialchars($type_contrat['ID_Type'], ENT_QUOTES, 'UTF-8') . "'" . ($type_contrat['ID_Type'] == ($type ?? '') ? ' selected' : '') . ">" . htmlspecialchars($type_contrat['Nom'], ENT_QUOTES, 'UTF-8') . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ID_Type_Salaire" class="form-label">Type de salaire:</label>
                    <select class="form-control" id="ID_Type_Salaire" name="ID_Type_Salaire">
                        <option value="">Non spécifié</option>
                        <?php foreach ($types_salaires as $type_salaire) {
                            echo "<option value='" . htmlspecialchars($type_salaire['ID_Type_Salaire'], ENT_QUOTES, 'UTF-8') . "'" . ($type_salaire['ID_Type_Salaire'] == ($type_salaire ?? '') ? ' selected' : '') . ">" . htmlspecialchars($type_salaire['Type'], ENT_QUOTES, 'UTF-8') . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="salaire" class="form-label">Salaire:</label>
                    <input type="text" class="form-control" id="salaire" name="salaire" value="<?php echo htmlspecialchars($montant_salaire ?? '', ENT_QUOTES, 'UTF-8'); ?>" pattern="^[0-9-]*$" title="Le salaire doit uniquement contenir des chiffres et des tirets.">
                </div>
                <div class="mb-3">
                    <label for="competences" class="form-label">Compétences:</label>
                    <textarea class="form-control" id="competences" name="competences"><?php echo htmlspecialchars($competences ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="niveau_etudes" class="form-label">Niveau d'études:</label>
                    <input type="text" class="form-control" id="niveau_etudes" name="niveau_etudes" value="<?php echo htmlspecialchars($niveau_etudes ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="mb-3">
                    <label for="localisation" class="form-label">Localisation:</label>
                    <input type="text" class="form-control" id="localisation" name="localisation" value="<?php echo htmlspecialchars($localisation ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
        <div class="mt-5">
            <h2>Liste des offres</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Type de contrat</th>
                        <th>Salaire</th>
                        <th class="d-none d-lg-table-cell">Compétences</th>
                        <th class="d-none d-lg-table-cell">Niveau d'études</th>
                        <th class="d-none d-lg-table-cell">Localisation</th>
                        <th>Date de publication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($offres as $offre) {
                    echo "<tr>";
                    echo "<td>" . afficherOuNonSpecifie($offre['Titre']) . "</td>";
                    echo "<td class='d-none d-lg-table-cell'>" . afficherOuNonSpecifie($offre['Description']) . "</td>";
                    echo "<td>" . afficherOuNonSpecifie($offre['NomTypeContrat']) . "</td>";
                    // pour le salaire
                    if (!empty($offre['Salaire']) && !empty($offre['NomTypeSalaire'])) {
                        $salaire = htmlspecialchars($offre['Salaire'], ENT_QUOTES, 'UTF-8') . " euros " . htmlspecialchars($offre['NomTypeSalaire'], ENT_QUOTES, 'UTF-8');
                    } elseif (!empty($offre['Salaire'])) {
                        $salaire = htmlspecialchars($offre['Salaire'], ENT_QUOTES, 'UTF-8') . " euros";
                    } else {
                        $salaire = 'Non spécifié';
                    }
                    echo "<td>" . $salaire . "</td>";
                    echo "<td class='d-none d-lg-table-cell'>" . afficherOuNonSpecifie($offre['Competences']) . "</td>";
                    echo "<td class='d-none d-lg-table-cell'>" . afficherOuNonSpecifie($offre['Niveau_Etudes']) . "</td>";
                    echo "<td class='d-none d-lg-table-cell'>" . afficherOuNonSpecifie($offre['Localisation']) . "</td>";
                    echo "<td>" . afficherOuNonSpecifie($offre['Date_Publication'] ? date("Y-m-d", strtotime($offre['Date_Publication'])) : null) . "</td>";
                    echo "<td>
                        <a href='edit_offre_form.php?id=" . htmlspecialchars($offre['ID_Offre'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-secondary btn-sm'><i class='bi bi-pencil'></i></a>
                        <form action='admin_offres.php' method='post' style='display:inline;'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='csrf_token' value='" . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') . "'>
                            <input type='hidden' name='ID_Offre' value='" . htmlspecialchars($offre['ID_Offre'], ENT_QUOTES, 'UTF-8') . "'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette offre?\");'><i class='bi bi-trash'></i></button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>


