<?php
$data_prospect = $bdd->prepare('SELECT * FROM prospect, commercial WHERE prospect.idcom = commercial.IDCOM AND prospect.online=?');
$data_prospect->execute(array(-1));

?>

<section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Corbeille <i class="fa fa-angle-right"></i> <?= $_GET['action'] ?></h3>

    <div class="row mb">
        <!-- page start-->
        <div class="content-panel">

            <?php if (isset($_GET['msg'])) : ?>
                <?php if ($_GET['msg'] == 1) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Opération effectuée avec succès !
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-info-circle"></span> <strong>Attention!</strong> Echec de restauration !
                    </div>
                <?php } ?>
            <?php endif; ?>

            <div class="adv-table">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th class="hidden-phone">Logo</th>
                            <th class="hidden-phone">Photo DG</th>
                            <th class="hidden-phone">Domaine</th>
                            <th class="hidden-phone">Commercial en Charge</th>
                            <th class="hidden-phone">Secteur d'activité</th>
                            <th class="hidden-phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $k = 1; ?>
                        <?php while ($data = $data_prospect->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr class="gradeX">
                                <td><?= $k ?></td>

                                <td>
                                    <img src="images/<?= $data['photo'] ?>" class="img-thumbnail" width="100" height="100">
                                </td>
                                <td>
                                    <img src="images/<?= $data['photo_dg'] ?>" class="img-thumbnail" width="100" height="100">
                                </td>
                                <td><?= $data['nompros'] ?></td>
                                <td><?= $data['NOMCOM'] ?></td>
                                <td class="center hidden-phone"><?= $data['secteur'] ?></td>

                                <td class="center hidden-phone d-flex p-2">

                                    <a href="corbeilleController.php?action=Prospects&id=<?= $data['idpros'] ?>" class="btn btn-success" title="Restaurer"><span class="fa fa-repeat"></span></a>

                                </td>
                            </tr>
                            <?php $k++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- page end-->
    </div>
    <!-- /row -->
</section>