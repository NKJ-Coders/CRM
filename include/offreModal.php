<div class="modal fade" id="modalOffre<?= $data['idpros'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">INFORMATIONS SUR L'OFFRE</h4>
            </div>
            <form action="offreController.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Montant première année</label>
                            <div>
                                <input type="text" class="form-control" name="firstyear" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Montant 2ième, 3ième & 4ième année </label>
                            <div>
                                <input type="text" class="form-control" name="montant" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-10">
                            <label>Date de dépot</label>
                            <div>
                                <input type="date" name="dateoffre" class="form-control" id="" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idpros" value="<?= $data['idpros'] ?>">
                    <input type="hidden" name="action" value="add">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Description de l'offre</label>
                            <div>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10" required></textarea>
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