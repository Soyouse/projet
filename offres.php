<?php
require_once 'functions/login.php'; // Assurez-vous que ce fichier contient la fonction getPDO()
require_once 'functions/read_offres.php';

// Récupérer les offres d'emploi
$offres = getOffres();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Offres d'Emploi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="offres.css"> <!-- Ajoutez votre propre fichier CSS pour cette page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="assets/img/Logo_GMetiersdelamer_reduit-removebg-preview_1.png" alt="Logo de mon site" class="logo">
            <div class="social-links">
                <a href="lien-vers-reseau-social1" class="social-link-1"><img src="assets/img/linkedinicone_1.png" alt="Réseau Social 1"></a>
                <a href="lien-vers-reseau-social2" class="social-link-2"><img src="assets/img/instaicone_1.png" alt="Réseau Social 2"></a>
                <a href="lien-vers-reseau-social3" class="social-link-3"><img src="assets/img/email_1.png" alt="Réseau Social 3"></a>
            </div>
            <div class="custom-links">
                <a href="index.html" class="custom-link-1 catamaran-light mt-custom-font">Qui sommes nous ?</a>
                <a href="candidats.html" class="custom-link-2 catamaran-light mt-custom-font">Candidats</a>
                <a href="entreprises.html" class="custom-link-3 catamaran-light mt-custom-font">Entreprises</a>
                <a href="offres.php" class="custom-link-4 catamaran-bold-2 mt-custom-font">Nos offres</a>
                <a href="contact.html" class="custom-link-5 catamaran-light mt-custom-font">Contact</a>
            </div>
            <img src="assets/img/MENU_BURGER_1.png" alt="Menu" class="menu-burger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        
            <!-- Offcanvas menu -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width:66%;">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="custom-buger-links">
                        <a href="index.html" class="custom-link-1 d-block catamaran-light">Qui sommes nous ?</a>
                        <a href="candidats.html" class="custom-link-2 d-block catamaran-light">Candidats</a>
                        <a href="entreprises.html" class="custom-link-3 d-block catamaran-light">Entreprises</a>
                        <a href="offres.php" class="custom-link-4 d-block catamaran-bold-2">Actualités</a>
                        <a href="contact.html" class="custom-link-5 d-block catamaran-light">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 text-center mt-5">
                    <h1 class="title-font-size-ultra-xxl text-color-p catamaran-bold-3">Nos offres</h1>
                </div>
            </div>
            <div class="offres">
                <?php foreach ($offres as $offre): ?>
                <div class="offre">
                    <h2><?php echo htmlspecialchars($offre['Titre'] ?? ''); ?></h2>
                    <p><?php echo htmlspecialchars($offre['Description'] ?? ''); ?></p>
                    <div class="details">
                        <?php if (!empty($offre['NomTypeContrat']) && $offre['NomTypeContrat'] !== 'Non spécifié'): ?>
                        <p>Type de contrat: <?php echo htmlspecialchars($offre['NomTypeContrat']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($offre['Salaire']) && $offre['Salaire'] !== 'Non spécifié'): ?>
                        <p>Salaire: <?php echo htmlspecialchars($offre['Salaire']); ?> euros <?php echo htmlspecialchars($offre['NomTypeSalaire'] ?? ''); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($offre['Competences']) && $offre['Competences'] !== 'Non spécifié'): ?>
                        <p>Compétences: <?php echo htmlspecialchars($offre['Competences']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($offre['Niveau_Etudes']) && $offre['Niveau_Etudes'] !== 'Non spécifié'): ?>
                        <p>Niveau d'études: <?php echo htmlspecialchars($offre['Niveau_Etudes']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($offre['Localisation']) && $offre['Localisation'] !== 'Non spécifié'): ?>
                        <p>Localisation: <?php echo htmlspecialchars($offre['Localisation']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($offre['Date_Publication']) && $offre['Date_Publication'] !== 'Non spécifié'): ?>
                        <p>Date de publication: <?php echo htmlspecialchars(date("Y-m-d", strtotime($offre['Date_Publication']))); ?></p>
                        <?php endif; ?>
                    </div>
                    <button class="toggle-details">▼</button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <img src="assets/img/Group_13.png" class="img-fluid col-12 col-md-5 mb-4 partenaires-img" alt="Image de clôture">
        </div>
    </main>

    <footer>
        <div class="footer-bar">
            <div class="social-links-footer">
                <a href="lien-vers-reseau-social1" class="social-link-f1"><img src="assets/img/linkedinicone_1.png" alt="Réseau Social 1"></a>
                <a href="lien-vers-reseau-social2" class="social-link-f2"><img src="assets/img/instaicone_1.png" alt="Réseau Social 2"></a>
                <a href="lien-vers-reseau-social3" class="social-link-f3"><img src="assets/img/email_1.png" alt="Réseau Social 3"></a>
            </div>
        </div>
    </footer>
    <script src="assets/js/offres.js"></script> <!-- Ajoutez votre propre fichier JS pour cette page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>