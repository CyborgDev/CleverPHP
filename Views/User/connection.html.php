<?php
    $title = 'Connexion';
    $menus = '';
    $stylesheets = '<link rel="stylesheet" href="webroot/css/custom-style.css">';
    $scripts = '';
?>

<?php ob_start(); ?>
    <div class="container-fluid">
        <div class="centereddiv">
            <div class="container-fluid">
                <h1 class="text-center">ESPACE CLIENT CEGAPE</h1>
                <!-- Formulaire de connexion -->
                <form action="index.php?op=User/connection" method="POST">
                    <div class="form-group" id="group_pseudo">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="prepend-mail"><span class="oi oi-person"></span></span>
                            </div>
                            <input type="text" class="form-control form-control-lg" name="mail" id="mail" placeholder="Adresse mail..." aria-label="Adresse mail" aria-describedby="prepend-mail">
                        </div>
                    </div>

                    <div class="form-group" id="group_pwd">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="prepend-pwd"><span class="oi oi-lock-locked"></span></span>
                            </div>
                            <input type="password" class="form-control form-control-lg" name="password" id="pwd" placeholder="Mot de passe..." aria-label="Mot de passe..." aria-describedby="prepend-pwd">
                        </div>
                    </div>

                    <div class="captcha-centering">
                        <?php if(ConfigEC::EXEC_MOD == ConfigEC::MOD_PROD): ?>
                            <div class="g-recaptcha" data-sitekey="<?= ConfigEC::DATA_SITE_KEY_PROD ?>" data-size="normal"></div>
                        <?php elseif(ConfigEC::EXEC_MOD == ConfigEC::MOD_DEV): ?>
                            <div class="g-recaptcha" data-sitekey="<?= ConfigEC::DATA_SITE_KEY_DEV ?>" data-size="normal"></div>
                        <?php endif ?>
                    </div>

                    <div style="height:75px;"></div>

                    <div class="input-group mb-1">
                        <button type="submit" class="btn-success btn-full-width btn-lg">Se connecter</button>
                    </div>

                    <div class="input-group mb-1">
                        <button type="submit" class="btn-info btn-full-width btn-lg" onclick="window.location.href='index.php?page=User/forgottenPassword';">Mot de passe oublié ?</button>
                    </div>    
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function(){
            $('form').on('submit', checkInformations);
        });

        function checkInformations(e){
            var login = $('#login').val();
            var pwd = $('#pwd').val();
            var ok = true;

            if(login.length === 0 || pwd.length === 0){
                //$('#message').html('<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Erreur !</h4><p>Des informations n\'ont pas &eacute;t&eacute; transmises...</p><hr><p class="mb-0">Soyez sûr.e d\'avoir bien renseign&eacute; votre login et votre mot de passe.</p></div>');
                ok = false;
            }
            return ok;
        };
    </script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php';