<div class="modal fade" id="syntheseModal<?= $data['idpros'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajouter des pièces jointes</h4>
            </div>
            <form action="syntheseController.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Sélectionnez le type de fichier</label>
                            <div class="form-group">
                                <div>
                                    <select name="type" id="" class="form-control" required>
                                        <option value="Decharge">Décharge prise de contact</option>
                                        <option value="Offre technique">Offre technique</option>
                                        <option value="Offre financière">Offre financière</option>
                                        <option value="Lettre de mission">Lettre de mission</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Piece Jointe (uniquement des fichiers .PDF)</label>
                            <div>
                                <input type="file" class="form-control" name="piece" accept=".pdf" required>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id" value="<?= $data['idpros'] ?>">
                        <input type="hidden" class="form-control" name="action" value="add">
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