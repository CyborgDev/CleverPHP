<?php
    $session = Session::getInstance();
?>
<?php $title = 'Ajout d\'un collaborateur'; ?>

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
        <h1><span class="oi oi-script"></span> Ajouter un nouveau collaborateur</h1>
        <form action="index.php?op=User/registerCollorator" method="POST">
            <div>
                <div class="container-fluid grey-container">
                    <h3>Informations utilisateur</h3>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="gender"><strong>Genre <span class="oi oi-badge"></strong></label>
                            <select class="custom-select" name="gender" id="gender">
                                <option value="0" selected disabled>Choisir...</option>
                                <?php foreach($infos['genders'] as $gender): ?>
                                    <option value="<?= $gender['gender_id'] ?>"><?= $gender['gender_wording'] ?></option>';
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name"><strong>Nom <span class="oi oi-badge"></strong></label>
                            <input type="text" class="form-control form-control" name="name" id="name" placeholder="NOM">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="firstname"><strong>Prénom <span class="oi oi-badge"></strong></label>
                            <input type="text" class="form-control form-control" name="firstname" id="firstname" placeholder="Prénom">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="phone"><strong>Téléphone</strong></label>
                            <input type="text" class="form-control form-control" name="phone" id="phone" placeholder="0122334455">
                        </div>
                    </div>
                </div>

                <div class="container-fluid grey-container">
                    <h3>Informations du compte</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mail"><strong>Adresse mail <span class="oi oi-badge"></strong></label>
                            <input type="email" class="form-control form-control" name="mail" id="mail" placeholder="exemple@cegape.fr">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="profile"><strong>Profil <span class="oi oi-badge"></strong></label>
                            <select class="custom-select" name="profile" id="profile">
                                <option value="0" selected disabled>Choisir...</option>
                                <?php foreach($infos['profiles'] as $profile): ?>
                                    <option value="<?= $profile['profile_id'] ?>"><?= $profile['profile_wording'] ?></option>';
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="group"><strong>Groupe <span class="oi oi-badge"></strong></label>
                            <select class="custom-select" name="group" id="group">
                                <option value="0" selected disabled>Choisir...</option>
                                <?php foreach($infos['groups'] as $group): ?>
                                    <option value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>';
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <small style="color:black;"><span class="oi oi-badge"></span> Informations obligatoires pour la création d'un collaborateur.</small>
            </div>
            <button type="submit" class="col-3 btn-success btn-full-width btn">Créer nouveau collaborateur</button>
        </form>
        
        <hr>

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