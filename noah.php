<?php
session_start();

// Tableau de mots
$trouverMot = array(
    'SEMILLANT', 'COLLINAIRE', 'DAMASQUINE', 'CHASUBLE', 'HIEMALE',
    'EXHAUSTEUR', 'PERCLUS', 'PETRICHOR', 'IMMARCESCIBLE', 'CALLIPYGE',
    'OBJURGATION', 'DYSTOPIE', 'PENDRILLON', 'ASSUETUDE', 'VERBATIM',
    'BERGAMASQUE', 'ANONCHALIR', 'COMPENDIEUX'
);

// Initialisation des variables de session au début du jeu
if (!isset($_SESSION['mot']) || isset($_POST['restart'])) {
    // Choisir un mot au hasard
    $_SESSION['mot'] = $trouverMot[array_rand($trouverMot)];
    $_SESSION['motCache'] = str_repeat('_', strlen($_SESSION['mot']));
    $_SESSION['erreurs'] = 0;
    $_SESSION['tentativesRestantes'] = 4; // nombre maximum de tentatives
    $_SESSION['lettresTrouvees'] = [];
}

$mot = $_SESSION['mot'];
$motCache = $_SESSION['motCache'];
$tentativesRestantes = $_SESSION['tentativesRestantes'];
$lettresTrouvees = $_SESSION['lettresTrouvees'];

// Afficher la première et la dernière lettre dès le début
$motCache[0] = $mot[0];
$motCache[strlen($mot) - 1] = $mot[strlen($mot) - 1];

// Gérer la proposition de lettre
if (isset($_POST['lettre'])) {
    $lettre = strtoupper($_POST['lettre']);
    
    if (!in_array($lettre, $lettresTrouvees)) {
        $lettresTrouvees[] = $lettre;
        $_SESSION['lettresTrouvees'] = $lettresTrouvees;
        
        // Vérifier si la lettre est dans le mot
        if (strpos($mot, $lettre) !== false) {
            // Remplacer les caractères masqués par la lettre trouvée
            for ($i = 0; $i < strlen($mot); $i++) {
                if ($mot[$i] === $lettre) {
                    $motCache[$i] = $lettre;
                }
            }
            $_SESSION['motCache'] = $motCache;
        } else {
            // Lettre incorrecte : augmenter le nombre d'erreurs et diminuer les tentatives restantes
            $_SESSION['erreurs']++;
            $_SESSION['tentativesRestantes']--;
        }
    }
}

// Vérifier si la partie est gagnée ou perdue
$partieGagnee = ($motCache === $mot);
$partiePerdue = ($tentativesRestantes <= 0);

function afficherMotCache($mot, $motCache, $lettresTrouvees) {
    $motAffiche = '';
    for ($i = 0; $i < strlen($mot); $i++) {
        $lettre = $mot[$i];
        if ($i == 0 || $i == strlen($mot) - 1 || in_array($lettre, $lettresTrouvees)) {
            // Afficher la première et la dernière lettre en noir, les lettres trouvées en orange
            $couleur = ($i == 0 || $i == strlen($mot) - 1) ? 'black' : 'orange';
            $motAffiche .= "<span style='color: $couleur;'>$lettre</span>";
        } else {
            $motAffiche .= '_ ';
        }
    }
    return $motAffiche;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="p-3">

<div class="container">
    <h2>Jeu du Pendu (sans pendu)</h2>
    
    <?php if ($partieGagnee): ?>
        <div class="alert alert-success">Bravo t'es un bg ! T'as trouvé le mot : <strong><?= $mot ?></strong></div>
        <form method="post">
            <button type="submit" name="restart" class="btn btn-info">Nouveau mot</button>
        </form>
    
    <?php elseif ($partiePerdue): ?>
        <div class="alert alert-danger">T'es claqué au sol wesh ! C'était ca le mot : <strong><?= $mot ?></strong></div>
        <form method="post">
            <button type="submit" name="restart" class="btn btn-info">Nouveau mot</button>
        </form>
    
    <?php else: ?>
        <div>
            <?= afficherMotCache($mot, $motCache, $lettresTrouvees) ?><br>
        </div>
        
        <?php if ($_SESSION['tentativesRestantes'] < 4): ?>
            <div class="alert alert-danger">
                Il vous reste <?= $tentativesRestantes ?> essais
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <input type="text" name="lettre" maxlength="1" required class="form-control" placeholder="Entrez une lettre ici" style="width: 20; display: inline;">
                <button type="submit" class="btn btn-success w-100 p-2">Tester</button>
                <button type="submit" name="restart" class="btn btn-info w-100 p-3">Nouveau mot</button>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
