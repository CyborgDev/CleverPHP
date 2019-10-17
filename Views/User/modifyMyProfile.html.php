<?php
    $session = Session::getInstance();
?>
<?php $title = 'Modification de mon profil'; ?>

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
<?php $readOnly = ($session->status == User::USER_STATUS_AGENT) ? 'readonly' : ''; ?>
<div class="container" id="alertsFromScript"></div>
<div class="container-fluid">
    <form action="index.php?op=User/modifyMyProfile" method="POST">
        <div class="container-fluid blue-container">
            <h3><span class="oi oi-person"></span> Mon profil</h3>
            <div class="form-group row">
                <div class="col-md-2">
                    <label class="col-form-label" for="gender" ><strong>Genre</strong></label>
                    <select class="custom-select form-control" id="gender" name="gender" aria-describedby="prepend-gender">
                        <option selected value="<?= $infos['user']['gender_id'] ?>"><?= $infos['user']['gender_wording'] ?></option>
                        <?php foreach($infos['genders'] as $gender): ?>
                            <?php if($gender['id'] != $infos['user']['gender_id']): ?>
                                <option value="<?= $gender['id'] ?>"><?= $gender['gender_wording'] ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class=" col-form-label" for="name" ><strong>Nom</strong></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $infos['user']['name'] ?>" <?= $readOnly ?> required>
                </div>

                <div class="col-md-5">
                    <label class="col-form-label" for="firstname" ><strong>Prénom</strong></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $infos['user']['firstname'] ?>" <?= $readOnly ?> required>
                </div>
            </div>     
            
            <div class="form-group row">
                <div class="col-md-5">
                    <label class="col-form-label" for="mail" ><strong>Adresse mail</strong></label>
                    <input type="text" class="form-control" id="mail" name="mail" value="<?= $infos['user']['mail'] ?>" required>
                </div>

                <div class="col-md-2">
                    <label class="col-form-label" for="phone" ><strong>Téléphone</strong></label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $infos['user']['phone'] ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-5">
                    <label class="col-form-label" for="password"><strong>Nouveau mot de passe</strong></label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-5">
                    <label class="col-form-label" for="password"><strong>Confirmer nouveau mot de passe</strong></label>
                    <input type="password" class="form-control" id="confirm-password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-5">
                    <label class="col-form-label" for="current-password"><strong>Mot de passe actuel</strong> <span class="oi oi-badge"></span> <small>Obligatoire pour enregistrer vos nouvelles informations</small></label>
                    <input type="password" class="form-control" id="current-password" name="current-password">
                </div>
            </div>            
        </div>
        <input type="submit" name="changesSubmitted" class="col-md-3 btn-success btn-full-width btn" value="Enregistrer les modifications"/>
        <br><br>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?= ConfigEC::INCLUDE_DATATABLES_SCRIPT ?>
<script type="text/javascript" src="webroot/js/datatable-init.js"></script>
<script>
    $(document).ready(function(){
        $('form').on('submit', checkInformations);
    });

    function checkInformations(){
        var login = $('#login').val();
        var pwd = $('#password').val();
        var confirm_pwd = $('#confirm-password').val();

        if(login.length === 0){
            $('#alertsFromScript').html('<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Erreur !</h4><p>Des informations n\'ont pas été transmises...</p><hr><p class="mb-0">Soyez sûr.e d\'avoir bien renseigné votre login.</p></div>');
            return false;
        } else if(pwd.length > 0 && (pwd !== confirm_pwd)){
            $('#alertsFromScript').html('<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Erreur !</h4><p>La confirmation du mot de passe est incorrecte...</p><hr><p class="mb-0">Soyez sûr.e d\'avoir que votre mot de passe et que la confirmation de ce dernier soient bien identiques.</p></div>');
            return false;
        } else if(pwd.length > 0 && (pwd.length < 8 || pwd.length > 244)){
            $('#alertsFromScript').html('<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Erreur !</h4><p>La longueure de votre mot de passe n\'est pas suffisante...</p><hr><p class="mb-0">Votre mot de passe doit contenir au minimum 8 caractères et maximum 244 caractères.</p></div>');
            return false;
        }
    };
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>