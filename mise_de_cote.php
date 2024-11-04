<?php

// echo '<pre>';
// print_r($lettres);
// echo '</pre>';

// echo strlen($numeroMotAleatoire) . '<br>';
// echo strlen($motAleatoire) . '<br>';
// echo strlen($motAleatoire) - 1 . '<br>';


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