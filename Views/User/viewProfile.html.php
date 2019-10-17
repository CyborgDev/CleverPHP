<?php
    $session = Session::getInstance();
?>
<?php $title = 'Mon profil'; ?>

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
        <div class="container-fluid blue-container">
            <h3><span class="oi oi-person"></span> Fiche profil</h3>
            <hr>
            <h5>Informations générales</h5>
            <div class="form-group row">
                <div class="col-md-1">
                    <label class="col-form-label" for="gender" ><strong>Genre</strong></label>
                    <input type="text" class="form-control" id="gender" value="<?= $infos['user']['gender_wording'] ?>" aria-describedby="prepend-gender" readonly>
                </div>
            
                <div class="col-md-4">
                    <label class=" col-form-label" for="name" ><strong>Nom</strong></label>
                    <input type="text" class="form-control" id="name" value="<?= $infos['user']['name'] ?>" aria-describedby="prepend-name" readonly>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label" for="firstname" ><strong>Prénom</strong></label>
                    <input type="text" class="form-control" id="firstname" value="<?= $infos['user']['firstname'] ?>" aria-describedby="prepend-firstname" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label class="col-form-label" for="profile" ><strong>Statut</strong></label>
                    <input type="text" class="form-control" id="profile" value="<?= $infos['user']['profile_wording'] ?>" aria-describedby="prepend-profile" readonly>                    
                </div>
            
                <div class="col-md-4">
                    <label class="col-form-label" for="mail" ><strong>Adresse mail</strong></label>
                    <input type="text" class="form-control" id="mail" value="<?= $infos['user']['mail'] ?>" aria-describedby="prepend-mail" readonly>
                </div>

                <div class="col-md-2">
                    <label class="col-form-label" for="phone" ><strong>Téléphone</strong></label>
                    <input type="text" class="form-control" id="phone" value="<?= $infos['user']['phone'] ?>" aria-describedby="prepend-phone" readonly>
                </div>
            </div>

            <?php if($infos['user']['status'] == User::USER_STATUS_AGENT): ?>
                <div class="form-group row">
                    <div class="col-md-5">
                        <label class="col-form-label" for="service" ><strong>Service</strong></label>
                        <input type="text" class="form-control-plaintext" id="service" value="<?= $infos['user']['service'] ?>" aria-describedby="prepend-service" readonly>                    
                    </div>
                    
                    <div class="col-md-5">
                        <label class="col-form-label" for="function" ><strong>Fonction</strong></label>
                        <input type="text" class="form-control-plaintext" id="function" value="<?= $infos['user']['function'] ?>" aria-describedby="prepend-function" readonly>
                    </div>
                </div>

                <hr>
                <a href="index.php?op=Institution/view&id=<?= $infos['institution']['institution_canopee_id'] ?>" class="text-black" data-toggle="tooltip" data-placement="left" title="Page descriptive de l'établissement"><h5>Informations sur l'établissement</h5></a>

                <div class="container-fluid">
                    <h6><span class="oi oi-tag"></span> Identification</h6>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="col-form-label" for="siret" ><strong>N°Siret</strong></label>
                            <input type="text" class="form-control" id="siret" value="<?= $infos['institution']['siret'] ?>" aria-describedby="prepend-siret" readonly>
                        </div>

                        <div class="col-md">
                            <label class="col-form-label" for="company-name" ><strong>Raison sociale</strong></label>
                            <input type="text" class="form-control" id="company-name" value="<?= $infos['institution']['company_name'] ?>" aria-describedby="prepend-company-name" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md">
                            <label class="col-form-label" for="complete-company-name" ><strong>Nom complet</strong></label>
                            <input type="text" class="form-control" id="complete-company-name" value="<?= $infos['institution']['complete_company_name'] ?>" aria-describedby="prepend-complete-company-name" readonly>
                        </div>
                    </div>

                    <h6><span class="oi oi-map"></span> Coordonnées</h6>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="col-form-label" for="city" ><strong>Ville</strong></label>
                            <input type="text" class="form-control" id="city" value="<?= $infos['institution']['city'] ?>" aria-describedby="prepend-city" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label" for="zip-code" ><strong>Code postal</strong></label>
                            <input type="text" class="form-control" id="zip-code" value="<?= $infos['institution']['zip_code'] ?>" aria-describedby="prepend-zip-code" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <label class="col-form-label" for="address" ><strong>Adresse</strong></label>
                            <input type="text" class="form-control" id="address" value="<?= $infos['institution']['address'] ?>" aria-describedby="prepend-address" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="col-form-label" for="institution-phone" ><strong>Téléphone</strong></label>
                            <input type="text" class="form-control" id="institution-phone" value="<?= $infos['institution']['phone'] ?>" aria-describedby="prepend-institution-phone" readonly>
                        </div>

                        <div class="col-md-2">
                            <label class="col-form-label" for="fax" ><strong>Fax</strong></label>
                            <input type="text" class="form-control" id="fax" value="<?= $infos['institution']['fax'] ?>" aria-describedby="prepend-fax" readonly>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <hr>
    <h3>Demandes d'intervention de l'utilisateur</h3>
    <div class="table-responsive">
        <table class="table table-hover datatable" id="table-intervention-requests">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Contrat</th>
                    <th scope="col">Sujet</th>
                    <th scope="col">Date dépot</th>
                    <th scope="col">Date cloture</th>
                    <th scope="col">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($infos['requests'] as $request): ?>
                    <tr class="row-link" onclick="window.location.href='index.php?op=request/answer&id=<?= $request['id'] ?>'">
                        <th scope="row"><?= $request['id'] ?></th>
                        <th scope="row"><?= $request['contract-wording'] ?></th>
                        <th scope="row"><?= $request['subject'] ?></th>
                        <?php
                            $request['deposit_date'] = explode(' ', $request['deposit_date'])[0];
                            $request['closure_date'] = ($request['closure_date'] != '0000-00-00 00:00:00') ? explode(' ', $request['closure_date'])[0] : ' - ';
                        ?>
                        <th scope="row"><?= $request['deposit_date'] ?></th>
                        <th scope="row"><?= $request['closure_date'] ?></th>
                        <?php
                            switch($request['badge_color']){
                                case 1:
                                    $request['status_wording'] = '<span class="badge badge-pill badge-danger">'.$request['status_wording'].'</span>';
                                    break;
                                case 2:
                                    $request['status_wording'] = '<span class="badge badge-pill badge-warning">'.$request['status_wording'].'</span>';
                                    break;
                                case 3:
                                    $request['status_wording'] = '<span class="badge badge-pill badge-secondary">'.$request['status_wording'].': '.$request['waiting-reason'].'</span>';
                                    break;
                                case 4:
                                    $request['status_wording'] = '<span class="badge badge-pill badge-success">'.$request['status_wording'].'</span>';
                                    break;
                                case 5:
                                    $request['status_wording'] = '<span class="badge badge-pill badge-light">'.$request['status_wording'].'</span>';
                                    break;
                            }
                        ?>
                        <th scope="row"><?= $request['status_wording'] ?></th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <span class="oi oi-warning"></span> A noter que les demandes d'intervention <strong>cloturées ou annulées</strong> depuis <strong>plus de 3 mois</strong> sont archivées et donc invisibles.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?= ConfigEC::INCLUDE_DATATABLES_SCRIPT ?>
<script type="text/javascript" src="webroot/js/datatable-init.js"></script>
<script type="text/javascript" src="webroot/js/tooltip-init.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>