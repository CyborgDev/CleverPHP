<?php
    $session = Session::getInstance();
?>
<?php $title = 'Liste des collaborateurs'; ?>

<?php ob_start(); ?>
    <link rel="stylesheet" href="webroot/css/custom-style.css" />
    <link rel="stylesheet" href="webroot/css/sidenav.css" />
    <link rel="stylesheet" href="webroot/css/topnav.css" />
    <?= ConfigEC::INCLUDE_DATATABLES_CSS ?>
<?php $stylesheets = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php include_once 'view/menus.html.php'; ?>
<?php $menus = ob_get_clean(); ?>


<?php ob_start(); ?>
    <div class="container-fluid">
        <h1><span class="oi oi-list-rich"></span> Liste des collaborateurs</h1>
        <table class="table table-hover datatable" id="table-collaborators">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Adresse email</th>
                    <th scope="col">Profile</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($infos['collaborators'] as $collaborator): ?>
                    <tr class="row-link" onclick="window.location.href='index.php?op=User/viewProfile&user=<?= $collaborator['user_id'] ?>'">
                        <th scope="row"><?= $collaborator['name'] ?></th>
                        <th scope="row"><?= $collaborator['firstname'] ?></th>
                        <th scope="row"><?= $collaborator['mail'] ?></th>
                        <th scope="row"><?= $collaborator['profile_wording'] ?></th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?= ConfigEC::INCLUDE_DATATABLES_SCRIPT ?>
    <script src="webroot/js/datatable-init.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>