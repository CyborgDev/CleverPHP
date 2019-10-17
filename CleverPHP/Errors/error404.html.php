<?php
    $title = 'Erreur 404';
    $menus = '';
    $stylesheets = '<link rel="stylesheet" href="webroot/css/custom-style.css">';
    $scripts = '';
?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="jumbotron">
        <h1 class="display-4"><span class="badge badge-danger"><strong>Erreur 404 !</strong></span></h1>
        <p class="lead">
            La page que vous recherchez n'éxiste pas ou alors elle n'est pas accéssible pour le moment.    
        </p>
        <hr class="my-4">
        <p>
            Si vous avez essayé d'accéder à une page via son URL et que vous lisez ceci, c'est que l'adresse que vous avez tapé est érronée.
            Pour naviguer correctement sur l'Espace Client de <strong>CEGAPE</strong>, merci d'utiliser les boutons présents sur les pages du site.
            <br>
            Si vous lisez ceci alors que vous avez cliqué sur l'un des boutons du site, c'est que la page n'est pas disponible pour le moment.
            <br>
            Veuillez nous excuser pour le désagrément.
            </p>
        <p class="lead">
            <a class="btn btn-success btn-lg" href="./" role="button">Retourner sur l'Espace Client</a>
            <a class="btn btn-dark btn-lg" href="https://www.cegape.fr" role="button">Site de CEGAPE</a>
        </p>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/base.html.php'; ?>