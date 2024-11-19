<?php

// echo '<pre>';
// print_r($lettres);
// echo '</pre>';

// echo strlen($numeroMotAleatoire) . '<br>';
// echo strlen($motAleatoire) . '<br>';
// echo strlen($motAleatoire) - 1 . '<br>';

        // $_SESSION['lettresTrouvees'][] = $premiereLettre;
        // $_SESSION['lettresProposees'][] = $premiereLettre;
        // $_SESSION['lettresTrouvees'][] = $derniereLettre;
        // $_SESSION['lettresProposees'][] = $derniereLettre;

// if (isset($_POST['tester'])) {
//     extract($_POST);
//     echo '<pre>';
//     print_r($_POST);
//     echo '</pre>';
//     echo $proposition;
//     };

// for ($j = 0; $j < $motAleatoire; $j++) {
        //     if ($proposition === $lettres[$j]) {
        //         $solution = str_replace("_", $proposition, $motAffiche);
        //     }
        // }

// if (isset($_POST['nouveauMot']) || !isset($_SESSION['motAleatoire'])) {
//     $numeroMotAleatoire = array_rand($trouverMot);
//     $motAleatoire = $trouverMot[$numeroMotAleatoire];
//     $_SESSION['motAleatoire'] = $motAleatoire;
//     $_SESSION['essaisRestants'] = 5;
// } else {
//     $motAleatoire = $_SESSION['motAleatoire'];
// }

// $motAffiche = "";


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     extract($_POST);
//     if (isset($_POST['proposition'])) {
//         $proposition = strtoupper($_POST['proposition']);
//     } elseif (strlen($proposition) > 1) {
//         $error = "Veuillez n'entrer qu'une seule lettre à la fois.";
//     } elseif (strlen($proposition) === 0) {
//         $error = "Veuillez entrer votre proposition.";
//     } else {
//         for ($j = 0; $j < $motAleatoire; $j++) {
//             if ($proposition === $lettres[$j]) {
//                 $solution = str_replace("_", $proposition, $motAffiche);
//             }
//         }
//     }
// }

// ===== CHATGPT =====
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     extract($_POST);
//     $proposition = strtoupper($_POST['proposition']);
    
//     if (!in_array($proposition, $lettres)) {
//         $_SESSION['essaisRestants']--;
//     }
    
//     if ($_SESSION['essaisRestants'] <= 0) {
//         $error = "Vous avez perdu ! Le mot était : " . $_SESSION['motAleatoire'];
//         unset($_SESSION['motAleatoire'], $_SESSION['essaisRestants']); // Réinitialisation de la session
//     }
// }
// ==========
?>

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
<!-- </p> -->

<?php
// for ($i = 0; $i < strlen($motAleatoire); $i++) {
//     // Vérifie si c'est la première lettre, la dernière lettre ou une lettre trouvée
//     if (
//         ($i == 0 && $motAleatoire[$i] == $motAleatoire[0]) || // Première lettre
//         ($i == strlen($motAleatoire) - 1 && $motAleatoire[$i] == $motAleatoire[strlen($motAleatoire) - 1]) || // Dernière lettre
//         in_array($motAleatoire[$i], $_SESSION['lettresTrouvees']) // Lettre trouvée
//     ) {
//         // Vérifie si c'est la première ou la dernière lettre
//         if ($i == 0 || $i == strlen($motAleatoire) - 1) {
//             echo $motAleatoire[$i] . ' '; // Affiche la première ou dernière lettre sans couleur
//         } else {
//             // Affiche les lettres trouvées en jaune
//             echo '<span style="color: yellow;">' . $motAleatoire[$i] . '</span> ';
//         }
//     } else {
//         echo '_ ';
//     }
// }



// $lettres = str_split($motAleatoire);
// // if (count($lettres) >= 2) {
// //     $lettres[0] = null; // Remplace la première valeur par null
// //     $lettres[count($lettres) - 1] = null; // Remplace la dernière valeur par null
// // }
// if (count($lettres) >= 2) {
//     array_shift($lettres); // Supprime le premier élément
//     array_pop($lettres); // Supprime le dernier élément
// }
// if (count(array_diff(str_split($motAleatoire), $_SESSION['lettresTrouvees'])) === 0) {
//     $_SESSION['partieGagnee'] = true;
//     $success = "Bravo ! Vous avez trouvé toutes les lettres ! Le mot était bien : " . $motAleatoire;
// }

// echo '<pre>';
// print_r($lettres);
// echo '</pre>';

// echo '<pre>';
// print_r($_SESSION['lettresTrouvees']);
// echo '</pre>';