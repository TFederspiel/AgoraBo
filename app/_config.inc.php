<?php

/**
 * paramètres de configuration de l'application AgoraBo
 * 
 * @package default
 * @author md
 * @version    1.0
 */

// gestion d'erreur 
ini_set('error_reporting', E_ALL);      // en phase de développement
//ini_set('error_reporting', 0);  		// en phase de production 

// constantes pour l'accès à la base de données
define('DB_SERVER', 'localhost');    // serveur MySql
define('DB_DATABASE', 'jeux_e4');        // nom de la base de données
define('DB_USER', 'root');            // nom d'utilisateur
define('DB_PWD', '');                  // mot de passe
define('DSN', 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_SERVER);

// constantes pour twig
define('TWIG_CACHE', false);          // mise en cache, en production à remplacer par  '/path/to/compilation_cache'
define('TWIG_DEBUG', true);           // mode debug

function afficherListe($tbObjets, $name, $size, $idSelect)
{
    // si $tbObjets est non vide et $idSelect est vide
    if (
        count($tbObjets) && (empty($idSelect))
    ) {
        $idSelect = $tbObjets[0]->identifiant; // alors $idSelect est l'identifiant du premier objet du tableau
    }
    echo '<select name="' . $name . '"id="' . $name . '"size="' . $size . '">';
    foreach ($tbObjets as $objet) {
        // l'élément en paramètre est présélectionné
        if ($objet->identifiant != $idSelect) { // si l'identifiant de l'objet n'est pas l'identifiant présélectionné
            echo '<option value="' . $objet->identifiant . '">' . $objet->libelle . '</option>';
        } else {
            echo '<option selected value="' . $objet->identifiant . '">' . $objet->libelle . '</option>';
        }
    }
    echo '</select>';
    return ($idSelect);
}
