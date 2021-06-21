<!-- Modal -->
<!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" /> -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Formulaire d'enregistrement du Prospect</h4>
            </div>
            <form action="insertProspect.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label for="photo"> Logo de l'entreprise </label>
                            <div>
                                <input type="file" name="photo" id="photo" class="form-control" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nom du Prospect</label>
                            <div>
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Equipe Dirigeante </label>
                            <div>
                                <input type="text" class="form-control" name="equipe_dirigeante">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Secteur d'activités   <span style="color:red"> *-3pts</span></label>
                            <div>
                                <?php $secteur = [
                                    "Agroalimentaire",
                                    "Banque / Assurance",
                                    "Bois / Papier / Carton / Imprimerie",
                                    "BTP / Matériaux de construction",
                                    "Chimie / Parachimie",
                                    "Commerce / Négoce / Distribution",
                                    "Édition / Communication / Multimédia",
                                    "Électronique / Électricité",
                                    "Études et conseils",
                                    "Energie électrique",
                                    "Industrie pharmaceutique",
                                    "Insdutrie de Pétrole",
                                    "Industrie de Savonerie",
                                    "Industrie de Raffinerie",
                                    "Informatique / Télécoms",
                                    "Machines et équipements / Automobile",
                                    "Métallurgie / Travail du métal",
                                    "Plastique / Caoutchouc",
                                    "Services aux entreprises",
                                    "Textile / Habillement / Chaussure",
                                    "Transports / Logistique"
                                ]; ?>
                                <select name="secteur" id="" class="form-control custom-select">
                                    <?php for ($i = 0; $i < count($secteur); $i++) : ?>
                                        <option value="<?= $secteur[$i] ?>"><?= $secteur[$i] ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ville </label>
                            <div>
                                <input type="text" class="form-control" name="ville">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="photo_dg"> Photo du DG  <span style="color:red"> *-5pts </label>
                            <div>
                                <input type="file" name="photo_dg" id="photo_dg" class="form-control" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>Capital  <span style="color:red"> *-3pts</span></label>
                            <div>
                                <input type="text" class="form-control" name="capital">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Site Web  <span style="color:red"> *-3pts</span></label>
                            <div>
                                <input type="text" class="form-control" name="siteweb">
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label>Adresse </label>
                            <div>
                                <input type="text" class="form-control" name="adresse">
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>Vision <span style="color:red"> *-5pts</span></label>
                            <div>

                                <textarea name="vision" id="vision" class="form-control" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Valeur  <span style="color:red"> *-5pts</span> </label>
                            <div>

                                <textarea name="valeur" id="valeur" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>Mission  <span style="color:red"> *-5pts</span></label>
                            <div>

                                <textarea name="mission" id="mission" class="form-control" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Conviction  <span style="color:red"> *-5pts</span> </label>
                            <div>
                                <textarea name="conviction" id="input" class="form-control" rows="3" name="conviction"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>Activites et Produits  <span style="color:red"> *-3pts</span></label>
                            <div>

                                <textarea name="activite_produit" id="activite_produit" class="form-control" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Concurents   <span style="color:red"> *-3pts</span></label>
                            <div>

                                <textarea name="concurent" id="concurent" class="form-control" rows="3"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>