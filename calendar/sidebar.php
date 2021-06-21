<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered"><a href="../accueil.php"><img src="../avatar/<?= (!empty($_SESSION['photo'])) ? $_SESSION['photo'] : 'avatar.jpg' ?>" class="img-circle" width="80"></a></p>
            <h5 class="centered"><?= $_SESSION['nom'] ?></h5>
            <?php if ($_SESSION['type'] == 'Commercial') { ?>
                <li class="mt">
                    <a class="active" href="../home.php?id=<?= $_SESSION['id'] ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($_SESSION['type'] == 'admin') { ?>

                <li class="sub-menu">
                    <a href="../listCommerciaux.php">
                        <i class="fa fa-desktop"></i>
                        <span>Lister les Commerciaux</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-briefcase"></i>
                        <span>Gestion des Entreprises</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../listClients.php">Lister les prospects</a></li>
                        <li><a href="../clients.php?">Lister les clients</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-file-text-o"></i>
                        <span>Gestion des Offres</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../offreController.php?action=list">Lister les offres</a></li>
                        <li><a href="../contratController.php?action=list">Contrats d'offres</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="../mesRdv.php">
                        <i class="fa fa-calendar"></i>
                        <span>Lister les rendez-vous</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="../repportController.php?action=all">
                        <i class="fa fa-pencil"></i>
                        <span>Rapports journaliers</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-trash"></i>
                        <span>Corbeile</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../corbeille.php?action=Commerciaux">Cormmerciaux</a></li>
                        <li><a href="../corbeille.php?action=Prospects">Prospects</a></li>
                        <li><a href="../corbeille.php?action=Contacts">Contacts</a></li>
                        <li><a href="../corbeille.php?action=Offres">Offres</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Gestion de comptes</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../inscription.php">Créer compte Commercial</a></li>
                        <li><a href="../inscription_partner.php">Créer compte Partenaire</a></li>
                        <!-- <li><a href="mesRdv.php">Mes Rendez-vous</a></li> -->
                    </ul>
                </li>
            <?php } ?>


            <?php if ($_SESSION['type'] == 'Commercial') { ?>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-briefcase"></i>
                        <span>Gestion des Entreprises</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../listClients.php">Lister les prospects</a></li>
                        <li><a href="../clients.php?">Lister les clients</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-file-text-o"></i>
                        <span>Gestion des Offres</span>
                    </a>
                    <ul class="sub">

                        <li><a href="../offreController.php?action=list">Lister les offres</a></li>
                        <li><a href="../contratController.php?action=list">Contrats d'offres</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="<?php if ($_SERVER['REQUEST_URI'] == '/calendar/' || $_SERVER['REQUEST_URI'] == '/mesRdv.php') {
                                    echo 'active';
                                } ?>" href="javascript:;">
                        <i class="fa fa-calendar"></i>
                        <span>Gestion des Rendez-vous</span>
                    </a>
                    <ul class="sub">

                        <li><a href="index.php">Calendrier</a></li>
                        <li><a href="../mesRdv.php">Mes Rendez-vous</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-pencil"></i>
                        <span>Rapport journalier</span>
                    </a>
                    <ul class="sub">
                        <li><a href="../repportController.php?action=edit">Rédiger</a></li>
                        <li><a href="../repportController.php?action=all">Consulter</a></li>
                    </ul>
                </li>


            <?php } ?>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cogs"></i>
                    <span>Paramètre</span>
                </a>
                <ul class="sub">

                    <li><a href="../profileController.php?action=detail">Mon profil</a></li>
                    <!-- <li><a href="mesRdv.php">Mes Rendez-vous</a></li> -->
                </ul>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>