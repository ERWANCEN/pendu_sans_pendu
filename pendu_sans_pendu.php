<?php
session_start();

$trouverMot = ['SEMILLANT', 'COLLINAIRE', 'DAMASQUINE', 'CHASUBLE', 'HIEMALE', 'EXHAUSTEUR', 'PERCLUS', 'PETRICHOR', 'IMMARCESCIBLE', 'CALLIPYGE', 'OBJURGATION', 'DYSTOPIE', 'PENDRILLON', 'ASSUETUDE', 'VERBATIM', 'BERGAMASQUE', 'ANONCHALIR', 'COMPENDIEUX'];

$nombreEssais = 5;
if (!isset($_SESSION['lettresProposees'])) {
    $_SESSION['lettresProposees'] = [];
}

if (!isset($_SESSION['lettresTrouvees'])) {
    $_SESSION['lettresTrouvees'] = [];
}

if (!isset($_SESSION['partieGagnee'])) {
    $_SESSION['partieGagnee'] = false;
}

if (isset($_POST['nouveauMot']) || !isset($_SESSION['motAleatoire'])) {
    $numeroMotAleatoire = array_rand($trouverMot);
    $motAleatoire = $trouverMot[$numeroMotAleatoire];
    $_SESSION['motAleatoire'] = $motAleatoire;
    $_SESSION['essaisRestants'] = $nombreEssais;
    $_SESSION['lettresProposees'] = [];
    $_SESSION['lettresTrouvees'] = [];
    
    $premiereLettre = $motAleatoire[0];
    $derniereLettre = $motAleatoire[strlen($motAleatoire) - 1];
    
        // $_SESSION['lettresTrouvees'][] = $premiereLettre;
        // $_SESSION['lettresProposees'][] = $premiereLettre;
        // $_SESSION['lettresTrouvees'][] = $derniereLettre;
        // $_SESSION['lettresProposees'][] = $derniereLettre;

    $_SESSION['partieGagnee'] = false;
} else {
    $motAleatoire = $_SESSION['motAleatoire'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proposition'])) {
        $proposition = strtoupper($_POST['proposition']);
    if (strlen($proposition) > 1) {
        // if ($proposition == $motAleatoire) {
        //     $_SESSION['partieGagnee'] = true;
        //     $success = "Bravo ! Vous avez trouvé le bon mot !";
        // } 
        if ($proposition == $motAleatoire) {
            $_SESSION['partieGagnee'] = true;
            $success = "Bravo ! Vous avez trouvé le bon mot !";
            $_SESSION['lettresTrouvees'] = str_split($motAleatoire);
        } else {
            $_SESSION['essaisRestants']--;
            $error = "Le mot proposé est incorrect. Il vous reste " . $_SESSION['essaisRestants'] . " essais.";
        }
    } elseif (strlen($proposition) === 0) {
        $error = "Veuillez entrer votre proposition.";
    } else {
        if (in_array($proposition, $_SESSION['lettresProposees'])) {
            $_SESSION['essaisRestants']--;
            $error = "Lettre déjà proposée. Vies restantes : " . $_SESSION['essaisRestants'];
        } else {
            $_SESSION['lettresProposees'][] = $proposition;
            if (strpos($motAleatoire, $proposition) !== false) {
                $_SESSION['lettresTrouvees'][] = $proposition;
            } else {
                $_SESSION['essaisRestants']--;
                $error = "La lettre proposée n'est pas dans le mot recherché. Il vous reste " . $_SESSION['essaisRestants'] . " essais.";
            }
        }
    }
}

$lettres = str_split($motAleatoire);
if (count(array_diff(str_split($motAleatoire), $_SESSION['lettresTrouvees'])) === 0) {
    $_SESSION['partieGagnee'] = true;
    $success = "Bravo ! Vous avez trouvé toutes les lettres ! Le mot était bien : " . $motAleatoire;
}

$partiePerdue = false;
if ($_SESSION['essaisRestants'] <= 0) {
    $partiePerdue = true;
    $error = "Perdu ! Vous n'avez plus de vies... Le mot était : " . $motAleatoire;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendu sans pendu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="d-flex justify-content-center">
        <h1>Jeu du pendu (sans pendu...)</h1>
    </div>
    <hr>
    <div class="d-grid justify-content-center">
    <!-- <p class="h2"> -->
        <?php
            // for ($i = 0; $i < strlen($motAleatoire); $i++) {
            //     if (in_array($motAleatoire[$i], $_SESSION['lettresTrouvees'])) {
            //         echo $motAleatoire[$i] . ' ';
            //     } else {
            //         echo '_ ';
            //     }
            //     if ($premiereLettre == "_ " && $derniereLettre == "_ ") {
            //         echo $motAleatoire[0];
            //         echo $motAleatoire[$motAleatoire[strlen($motAleatoire) - 1]];
            //     }
            // }
        ?>
        <p class="h2">
    <?php
        for ($i = 0; $i < strlen($motAleatoire); $i++) {
            if (
                ($i == 0 && $motAleatoire[$i] == $motAleatoire[0]) || // Première lettre
                ($i == strlen($motAleatoire) - 1 && $motAleatoire[$i] == $motAleatoire[strlen($motAleatoire) - 1]) || // Dernière lettre
                in_array($motAleatoire[$i], $_SESSION['lettresTrouvees']) // Lettre trouvée
            ) {
                echo $motAleatoire[$i] . ' ';
            } else {
                echo '_ ';
            }
        }
    ?>
</p>
    <!-- </p> -->
    </div>
    <div class="d-flex justify-content-center">
        <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
    </div>
    <form action="" method="post" class="w-75 d-grid mx-auto">
        <div class="mb-3">
            <input type="text" name="proposition" placeholder="Entrez une lettre ici ou le mot entier" 
                class="form-control" <?php echo ($partiePerdue || $_SESSION['partieGagnee']) ? 'disabled' : ''; ?>>
        </div>
        <div class="d-grid gap-3">
            <button type="submit" name="tester" class="btn btn-success" 
                    <?php echo ($partiePerdue || $_SESSION['partieGagnee']) ? 'disabled' : ''; ?>>Tester</button>
            <button type="submit" name="nouveauMot" class="btn btn-info">Nouveau Mot</button>
            <?php if ($partiePerdue || $_SESSION['partieGagnee'] == true) { session_destroy(); } ?>
        </div>       
    </form>
</body>
</html>