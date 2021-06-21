<?php
$data_contact = $bdd->prepare('SELECT * FROM contactprospect as c, prospect as p WHERE c.IDPROS = p.idpros AND c.online=-1');
$data_contact->execute();

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
                            <th class="hidden-phone">Nom</th>
                            <th class="hidden-phone">Prenom</th>
                            <th class="hidden-phone">Entreprise</th>
                            <th class="hidden-phone">Poste</th>
                            <th class="hidden-phone">Adresse</th>
                            <th class="hidden-phone">Telephone</th>
                            <th class="hidden-phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $k = 1; ?>
                        <?php while ($data = $data_contact->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr class="gradeX">
                                <td><?= $k ?></td>
                                <td><?= $data['NOMCONT'] ?></td>
                                <td><?= $data['PRENOMCONT'] ?></td>
                                <td class="hidden-phone"><?= $data['nompros'] ?></td>
                                <td class="center hidden-phone"><?= $data['POSTECONT'] ?></td>
                                <td class="center hidden-phone"><?= $data['ADRESSECONT'] ?></td>
                                <td class="center hidden-phone"><?= $data['TELCONT'] ?></td>

                                <td class="center hidden-phone d-flex p-2">

                                    <a href="corbeilleController.php?action=Contacts&id=<?= $data['IDCONT'] ?>" class="btn btn-success" title="Restaurer"><span class="fa fa-repeat"></span></a>

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