<!-- Modal -->
<div class="modal fade" id="myModalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Formulaire d'enregistrement des contacts</h4>
            </div>
            <form action="contact_insert.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nom du contact</label>
                            <div>
                                <input type="text" class="form-control" name="nom">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Prenom </label>
                            <div>
                                <input type="text" class="form-control" name="prenom">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Entreprise</label>
                            <div>
                                <select class="form-control" name="idpros">
                                    <option value="<?= $idprosp ?>"><?= $entreprise['nompros'] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Poste </label>
                            <div>
                                <input type="text" class="form-control" name="poste">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Adresse</label>
                            <div>
                                <input type="text" class="form-control" name="adresse">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telephone </label>
                            <div>
                                <input type="text" class="form-control" name="tel">
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