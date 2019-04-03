<?php
    //On démarre la session
    session_start();

    spl_autoload_register(function ($class_name) {
        include_once 'Models/' . $class_name . '.php';
    });

    include_once 'conf/Config.php';
    include_once 'conf/DatabaseConnection.php';

    //Attribution des variables de session
    $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:-1;
    $qualification=(isset($_SESSION['qualification']))?$_SESSION['qualification']:''; //Agent ou Collaborateur
    $profile = (isset($_SESSION['profile']))?(int)$_SESSION['profile']:0; //1 ou 2 pour Agent et 3, 4, 5, 6, 7, 8, 9 ou 10 pour Collaborateur
    $login = (isset($_SESSION['login']))?$_SESSION['login']:''; // login du compte de l'utilisateur
    $name = (isset($_SESSION['name']))?$_SESSION['name']:''; // name de l'utilisateur
    $firstname = (isset($_SESSION['firstname']))?$_SESSION['firstname']:''; // firstname de l'utilisateur

    $message = array(); // Variable utilisee pour les messages d'alerte (succes ou echec)

    if ($login == ''){
        if(isset($_GET['page']) && $_GET['page'] == 'user/ForgotPassword'){
            include_once 'controller/user/ForgotPasswordController.php';
        } else {
            include_once 'controller/user/LoginController.php';
        }
    } else {
        //On inclut le contrôleur s'il existe et s'il est spécifié
        if (isset($_GET['page']) && file_exists('controller/'.$_GET['page'].'Controller.php')){

            if($_GET['page'] != 'user/Login' && $_GET['page'] != 'user/Disconnect'){
                include_once 'view/components/head.php';
            }
            include_once 'controller/'.$_GET['page'].'Controller.php';

        } else {
            if(isset($_GET['page'])){
                $message = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Erreur 404</strong><br>La page que vous avez demandé n\'éxiste pas, vous avez été renvoyé sur votre tableau de bord.</div>';
            }
            include_once 'view/components/head.php';
            include_once 'controller/user/DashboardController.php';
        }
    }

    //On inclut le pied de page
    include_once 'view/components/foot.php';
?>