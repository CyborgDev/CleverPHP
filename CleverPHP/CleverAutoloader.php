<?php
    /**
     * CleverAutoloader
     * This file is use to autoload all of your Models and your Controllers
     * With this page, you don't need anymore to add some 'include(_once)' or 'require(_once)' at the top of your files.
     * *** /!\ The global variable PATH_TO_ROOT must been declared /!\ ***
     * 
     * @see https://github.com/CyborgDev/CleverPHP/blob/master/CleverPHP/CleverPHP.md
     * @author Martin Crampon
     */
    class CleverAutoloader{
        public static function EnvironmentIsReady(){
            defined(PATH_TO_ROOT);
        }

        public static function Load(string $classToLoad){
            try{
                if(!self::EnvironmentIsReady()) throw new Exception("Class ".$classToLoad." not found.", 1000);
                if(strpos($classToLoad, 'Clever') === FALSE){
                    if(file_exists(PATH_TO_ROOT.'CleverPHP/'.$classToLoad.'.php')){
                        require_once PATH_TO_ROOT.'CleverPHP/'.$classToLoad.'.php';
                    } else {
                        throw new Exception("Class ".$classToLoad." not found in CleverPHP. Do not named your class with the word 'Clever' inside the class name.", 1001);
                    }
                } elseif(file_exists(PATH_TO_ROOT.'Controllers/'.$classToLoad.'.php')){
                    require_once PATH_TO_ROOT.'Controllers/'.$classToLoad.'.php';
                } elseif(file_exists(PATH_TO_ROOT.'Models/'.$classToLoad.'.php')){
                    require_once PATH_TO_ROOT.'Models/'.$classToLoad.'.php';
                } else {
                    throw new Exception("Class ".$classToLoad." not found.", 1002);
                }
            } catch(Exception $e){
                $errorCode = $e->getCode();
                switch($errorCode){
                    case 1000:
                        die($e->getMessage());
                        break;
                    case 1001: 
                        if(CleverConfiguration::EXEC_MOD == CleverConfiguration::MOD_DEV){
                            $messageToShow = $e->getMessage();
                            require_once PATH_TO_ROOT.'CleverPHP/Errors/error404.html.php';
                        } elseif(CleverConfiguration::EXEC_MOD == CleverConfiguration::MOD_PROD){
                            if($_COOKIE['Clever.lang'] == CleverConfiguration::LANG_FR){
                                $messageToShow = "";// TODO
                            } else {

                            }
                        }
                        break;
                    case 1002:
                        break;
                    default:
                        break;
                }
            }
        }
    }

    spl_autoload_register();
?>