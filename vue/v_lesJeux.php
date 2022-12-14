<!-- page start-->
<div class="col-sm-auto">
    <section class="panel">
        <div class="chat-room-head">
            <h3><i class="fa fa-angle-right"></i> Gérer les Jeux</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr class="tableau-entete">
                        <th><i class="fa fa-bullhorn"></i> Reférence</th>
                        <th><i class="fa fa-bookmark"></i> Plateforme</th>
                        <th><i class="fa fa-bookmark"></i> Pegi</th>
                        <th><i class="fa fa-bookmark"></i> Genre</th>
                        <th><i class="fa fa-bookmark"></i> Marque</th>
                        <th><i class="fa fa-bookmark"></i> Nom</th>
                        <th><i class="fa fa-bookmark"></i> Prix</th>
                        <th><i class="fa fa-bookmark"></i> Date de parution</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- formulaire pour ajouter un nouveau Jeu-->
                    <tr>
                        <form action="index.php?uc=gererJeux" method="post">
                            <td>
                                <input type="text" id="txtIdJeu" name="txtIdJeu" size="24" required minlength="4" maxlength="24" placeholder="Nouvelle référence" title="De 4 à 24 caractères" />
                            </td>
                            <td>
                                <?php
                                require_once('./app/_config.inc.php');
                                afficherListe($db->getLesPlateformes(), "idSelectPlateforme", 1, 0);
                                ?>
                            </td>
                            <td>
                                <?php afficherListe($db->getLesPegis(), "txtPegi", 1, 0); ?>
                            </td>
                            <td>
                                <?php
                                require_once('./app/_config.inc.php');
                                afficherListe($db->getLesGenres(), "idSelectGenre", 1, 0);
                                ?>
                            </td>
                            <td>
                                <?php
                                require_once('./app/_config.inc.php');
                                afficherListe($db->getLesMarques(), "idSelectMarque", 1, 0);
                                ?>
                            </td>
                            <td>
                                <input type="text" id="txtNom" name="txtNom" size="24" required minlength="4" maxlength="24" placeholder="Nom" title="De 4 à 24 caractères" />
                            </td>
                            <td>
                                <input type="number" id="prixJeu" name="prixJeu" size="24" step="any" required placeholder="Prix" title="De 4 à 24 caractères" />
                            </td>
                            <td>
                                <input type="date" id="dateParutionJeu" name="dateParutionJeu" size="24" required minlength="4" maxlength="24" placeholder="Date de Parution" title="De 4 à 24 caractères" />
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="ajouterNouveauJeu" title="Enregistrer nouveau Jeu"><i class="fa fa-save"></i></button>
                                <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                            </td>
                        </form>
                    </tr>

                    <?php
                    foreach ($tbJeux as $jeu) {
                    ?>
                        <tr>

                            <!-- formulaire pour modifier et supprimer les Jeux-->
                            <form action="index.php?uc=gererJeux" method="post">
                                <td><?php echo $jeu->identifiant; ?><input type="hidden" id="txtIdJeu" name="txtIdJeu" value="<?php echo $jeu->identifiant; ?>" /></td>
                                <td><?php
                                    if ($jeu->identifiant != $idJeuModif) {
                                        echo $jeu->libPlateforme;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->ageLimite;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->libGenre;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->nomMarque;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->nom;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->prix;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $jeu->dateParution;
                                    ?>
                                </td>
                                <td>
                                    <?php if ($notification != 'rien' && $jeu->identifiant == $idJeuNotif) {
                                            echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i>' . $notification . '</button>';
                                        } ?>
                                    <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="demanderModifierJeu" title="Modifier"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs" type="submit" name="cmdAction" value="supprimerJeu" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce Jeu?');"><i class="fa fa-trash-o "></i></button>
                                </td>
                            <?php
                                    } else {
                                        afficherListe($db->getLesPlateformes(), "libPlateforme", 1, $jeu->idPlateforme);
                            ?>
                                </td>
                                <td>
                                    <?php afficherListe($db->getLesPegis(), "libPegi", 1, $jeu->idPegi); ?>
                                </td>
                                <td>
                                    <?php afficherListe($db->getLesGenres(), "libGenre", 1, $jeu->idGenre); ?>
                                </td>
                                <td>
                                    <?php afficherListe($db->getLesMarques(), "libMarque", 1, $jeu->idMarque); ?>
                                </td>
                                <td>
                                    <input type="text" id="txtLibJeu" name="txtLibJeu" size="24" required minlength="4" maxlength="24" value="<?php echo $jeu->nom; ?>" />
                                </td>
                                <td>
                                    <input type="number" id="txtPrix" name="txtPrix" size="24" required step="any" value="<?php echo $jeu->prix; ?>" />
                                </td>
                                <td>
                                    <input type="date" id="txtDateParution" name="txtDateParution" size="24" required minlength="4" maxlength="24" value="<?php echo $jeu->dateParution; ?>" />
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="validerModifierJeu" title="Enregistrer"><i class="fa fa-save"></i></button>
                                    <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                                    <button class="btn btn-warning btn-xs" type="submit" name="cmdAction" value="annulerModifierJeu" title="Annuler"><i class="fa fa-undo"></i></button>
                                </td>
                            <?php
                                    }
                            ?>
                            </form>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div><!-- fin div panel-body-->
    </section><!-- fin section Jeux-->
</div>
<!--fin div col-sm-6-->