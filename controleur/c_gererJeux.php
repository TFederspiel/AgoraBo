	<?php
    // si le paramètre action n'est pas positionné alors
    //		si aucun bouton "action" n'a été envoyé alors par défaut on affiche les Jeux
    //		sinon l'action est celle indiquée par le bouton

    if (!isset($_POST['cmdAction'])) {
        $action = 'afficherJeux';
    } else {
        // par défaut
        $action = $_POST['cmdAction'];
    }

    $idJeuModif = -1;        // positionné si demande de modification
    $notification = 'rien';    // pour notifier la mise à jour dans la vue

    // selon l'action demandée on réalise l'action 
    switch ($action) {

        case 'ajouterNouveauJeu': {
                if (!empty($_POST['txtIdJeu'])) {
                    $idJeuNotif = $db->ajouterJeu($_POST['txtIdJeu'], $_POST['idSelectPlateforme'], $_POST['txtPegi'], $_POST['idSelectGenre'], $_POST['idSelectMarque'], $_POST['txtNom'], $_POST['prixJeu'], $_POST['dateParutionJeu']);
                    // $idJeuNotif est l'idJeu du Jeu ajouté
                    $notification = 'Ajouté';    // sert à afficher l'ajout réalisé dans la vue
                }
                break;
            }

        case 'demanderModifierJeu': {
                $idJeuModif = $_POST['txtIdJeu']; // sert à créer un formulaire de modification pour ce Jeu
                break;
            }

        case 'validerModifierJeu': {
                $idJeuNotif = $db->modifierJeu($_POST['txtIdJeu'], $_POST['libPlateforme'], $_POST['libPegi'], $_POST['libGenre'], $_POST['libMarque'], $_POST['txtLibJeu'], $_POST['txtPrix'], $_POST['txtDateParution']);; // $idJeuNotif est l'idJeu du Jeu modifié
                $notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
                break;
            }

        case 'supprimerJeu': {
                $idJeu = $_POST['txtIdJeu'];
                $db->supprimerJeu($idJeu);
                break;
            }
    }

    // l' affichage des Jeux se fait dans tous les cas	
    $tbJeux  = $db->getLesJeux();
    require 'vue/v_lesJeux.php';

    ?>
