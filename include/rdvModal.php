<div class="modal fade" id="rdvzModal" tabindex="-1" role="dialog" aria-labelledby="rdvModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Initiation de RDV</h4>
            </div>
            <form action="init_rdv.php" method="POST">
                <div class="modal-body">
                    <div class="row">
                    <div class="form-group col-md-6">
                            <label>Objet du RDV</label>
                            <div>
                                <input type="text" class="form-control" name="objet">
                            </div>
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                            <label>Lieu du RDV </label>
                            <div>
                                <input type="text" class="form-control" name="lieu">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="idcont" value="<?= $data['IDCONT'] ?>">
                    <input type="hidden" name="idcom" value="<?= $_GET['id_client'] ?>">

                    <div class="row">
                    <div class="form-group col-md-6">
                            <label>Date du RDV</label>
                            <div>
                                <input type="date" class="form-control" name="date">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Heure du RDV</label>
                            <div>
                                <input type="time" class="form-control" name="date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Description</label>
                            <div>
                                <textarea name="description" id="" cols="50" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href class="btn btn-primary" title="Imprimer" onclick="window.print();"><span class="fa fa-print"></span></a>
                </div>
            </form>
        </div>
    </div>
</div>