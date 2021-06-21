<div class="modal fade" id="modalContrat<?= $data['idoffre'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">INITIATION DU CONTRAT</h4>
            </div>
            <form action="contratController.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Client</label>
                            <div>
                                <select name="idpros" id="" class="form-control" readonly>
                                    <option value="<?= $data['idpros'] ?>"><?= $data['nompros'] ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ecart</label>
                            <div>
                                <input type="text" name="ecart" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Validité</label>
                            <div>
                                <input type="text" name="validite" class="form-control" id="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idoffre" value="<?= $data['idoffre'] ?>">
                    <input type="hidden" name="action" value="add">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Proposition</label>
                            <div>
                                <textarea name="proposition" class="form-control" id="" cols="30" rows="10"></textarea>
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