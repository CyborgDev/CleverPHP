<?php
    class UserController extends Controller {
        public function __construct(){}

        public static function dashboard(){
            $session = Session::getInstance();
            if($session->status == User::USER_STATUS_AGENT){
                UserController::print(array(), "view/User/dashboardAgent.html.php");
            } elseif($session->status == User::USER_STATUS_COLLABORATOR) {
                UserController::print(array(), "view/User/dashboardCollaborator.html.php");
            } else {
                UserController::print(array(), "view/Error/error403.html.php");
            }            
        }

        public static function connection(){
            $postList = UserController::getAllPosts();
            if($postList != FALSE){
                /* Captcha procedure */
                    // your secret key
                    $secret = "";
                    if(ConfigEC::EXEC_MOD == ConfigEC::MOD_PROD){
                        $secret = ConfigEC::SECRET_KEY_PROD;
                    } elseif(ConfigEC::EXEC_MOD == ConfigEC::MOD_DEV){
                        $secret = ConfigEC::SECRET_KEY_DEV;
                    }
                    
                    // empty response
                    $response = null;
                    
                    // check secret key
                    $reCaptcha = new ReCaptcha($secret);

                    // if submitted check response
                    if ($postList["g-recaptcha-response"]) {
                        $response = $reCaptcha->verifyResponse(
                            $_SERVER["REMOTE_ADDR"],
                            $postList["g-recaptcha-response"]
                        );
                    }
                /* ------------------ */

                if($response != null && $response->success) {
                    if(isset($postList['mail']) && isset($postList['password'])){
                        $postList['mail'] = strip_tags($postList['mail']);
                        $postList['password'] = strip_tags($postList['password']);
                        /*var_dump($postList['mail']);
                        var_dump($postList['password']);*/
                        
                        if(User::LoginUser($postList['mail'], $postList['password'])){
                            header('Location: index.php?op=User/dashboard');
                            exit();
                        } else {
                            $alertMessage = AlertMessage::getInstance();
                            $alertMessage->createAlertMessage('Erreur de connexion', 'Votre identifiant ou votre mot de passe est érroné, vérifiez si la touche MAJ n\'est pas vérrouillée ou si votre pavé numérique est bien activé si vous tapez des chiffres via ce moyen.<br>Notez que l\'identifiant et le mot de passe sont sensibles à la casse.', AlertMessage::BOOSTRAP_DANGER, TRUE);
                            UserController::print(array(), "view/User/connection.html.php");
                        }
                    } else {
                        $alertMessage = AlertMessage::getInstance();
                        $alertMessage->createAlertMessage('Erreur de connexion', 'Le couple login/mot de passe n\'a pas été reçu par le serveur, veuillez retenter de vous connecter.', AlertMessage::BOOSTRAP_DANGER, TRUE);
                        UserController::print(array(), "view/User/connection.html.php");
                    }
                } else{
                    $alertMessage = AlertMessage::getInstance();
                    $alertMessage->createAlertMessage('Erreur de connexion', 'Action potentiellement malveillante detectée, veuillez confirmer que vous n\'êtes pas un robot.', AlertMessage::BOOSTRAP_DANGER, TRUE);
                    UserController::print(array(), "view/User/connection.html.php");
                }
            } else {
                UserController::print(array(), "view/User/connection.html.php");
            }
        }

        public static function disconnection(){
            User::disconnect();
            header('Location: index.php');
            exit();
        }

        public static function viewProfile(){
            try{
                $argsGet = UserController::getAllGets();
                $session = Session::getInstance();
                if(isset($argsGet['user'])){
                    if($session->status == User::USER_STATUS_AGENT){
                        if(User::GetStatus($argsGet['user']) == User::USER_STATUS_AGENT){
                            $currentAgent = Agent::ConstructById($session->user_id);
                            $targetAgent = Agent::ConstructById($argsGet['user']);

                            if($targetAgent == NULL) throw new Exception("Error, target agent not found");

                            if(!$currentAgent->compareInstitution($argsGet['user'])){
                                UserController::print(array(), "view/Error/error403.html.php");
                                exit(403);
                            }
                            $institution = $targetAgent->getInstitution();
                            $institutionType = $institution->getTypeFunctionWording();
                            $requests = $targetAgent->getAllRequests();
                            $additionnalsWording = array(
                                "gender_wording" => $targetAgent->getGenderWording(),
                                "profile_wording" => $targetAgent->getProfileWording()
                            );
                            $institution = $institution->toArray($institutionType);
                            $targetAgent = $targetAgent->toArray($additionnalsWording);
                            $targetAgent['status'] = User::USER_STATUS_AGENT;
                            $targetAgent = User::DecrypteUserArray($targetAgent);
    
                            UserController::print(array(
                                "user" => $targetAgent,
                                "institution" => $institution,
                                "requests" => $requests
                            ), "view/User/viewProfile.html.php");
                        } elseif(User::GetStatus($argsGet['user']) == User::USER_STATUS_COLLABORATOR){
                            $targetCollaborator = Collaborator::ConstructById($argsGet['user']);
                            if($targetCollaborator == NULL) throw new Exception("User not found");

                            $requests = $targetCollaborator->getAllRequests();
                            $additionnalsWording = array(
                                "gender_wording" => $targetCollaborator->getGenderWording(),
                                "profile_wording" => $targetCollaborator->getProfileWording()
                            );
                            $targetCollaborator = $targetCollaborator->toArray($additionnalsWording);
                            $targetCollaborator['status'] = User::USER_STATUS_COLLABORATOR;
                            $targetCollaborator = User::DecrypteUserArray($targetCollaborator);

                            UserController::print(array(
                                "user" => $targetCollaborator,
                                "requests" => $requests
                            ), "view/User/viewProfile.html.php");
                        } else {
                            throw new Exception("User not found");
                        }
                    } elseif($session->status == User::USER_STATUS_COLLABORATOR){
                        if(User::GetStatus($argsGet['user']) == User::USER_STATUS_AGENT){
                            $targetAgent = Agent::ConstructById($argsGet['user']);
                            if($targetAgent == NULL) throw new Exception("Error/Error, target agent not found");

                            $institution = $targetAgent->getInstitution();
                            $institutionType = $institution->getTypeFunctionWording();
                            $requests = $targetAgent->getAllRequests();
                            $additionnalsWording = array(
                                "gender_wording" => $targetAgent->getGenderWording(),
                                "profile_wording" => $targetAgent->getProfileWording()
                            );
                            $institution = $institution->toArray($institutionType);
                            $targetAgent = $targetAgent->toArray($additionnalsWording);
                            $targetAgent['status'] = User::USER_STATUS_AGENT;
                            $targetAgent = User::DecrypteUserArray($targetAgent);
    
                            UserController::print(array(
                                "user" => $targetAgent,
                                "institution" => $institution,
                                "requests" => $requests
                            ), "view/User/viewProfile.html.php");
                        } elseif(User::GetStatus($argsGet['user']) == User::USER_STATUS_COLLABORATOR){
                            $targetCollaborator = Collaborator::ConstructById($argsGet['user']);
                            if($targetCollaborator == NULL) throw new Exception("User not found");

                            $requests = $targetCollaborator->getAllRequests();
                            $additionnalsWording = array(
                                "gender_wording" => $targetCollaborator->getGenderWording(),
                                "profile_wording" => $targetCollaborator->getProfileWording()
                            );
                            $targetCollaborator = $targetCollaborator->toArray($additionnalsWording);
                            $targetCollaborator['status'] = User::USER_STATUS_COLLABORATOR;
                            $targetCollaborator = User::DecrypteUserArray($targetCollaborator);

                            UserController::print(array(
                                "user" => $targetCollaborator,
                                "requests" => $requests
                            ), "view/User/viewProfile.html.php");
                        } else {
                            throw new Exception("User not found");
                        }
                    }
                } else {
                    if($session->status == User::USER_STATUS_AGENT){
                        $currentAgent = Agent::ConstructById($session->user_id);
                        if($currentAgent == NULL) throw new Exception("User not found");
    
                        $institution = $currentAgent->getInstitution();
                        $institutionType = $institution->getTypeFunctionWording();
                        $requests = $currentAgent->getAllRequests();
                        $additionnalsWording = array(
                            "gender_wording" => $currentAgent->getGenderWording(),
                            "profile_wording" => $currentAgent->getProfileWording()
                        );
                        $institution = $institution->toArray($institutionType);
                        $currentAgent = $currentAgent->toArray($additionnalsWording);
                        $currentAgent['status'] = User::USER_STATUS_AGENT;
    
                        UserController::print(array(
                            "user" => $currentAgent,
                            "institution" => $institution,
                            "requests" => $requests
                        ), "view/User/viewMyProfile.html.php");
                    } elseif($session->status == User::USER_STATUS_COLLABORATOR){
                        $currentCollaborator = Collaborator::ConstructById($session->user_id);
                        if($currentCollaborator == NULL) throw new Exception("User not found");

                        $requests = $currentCollaborator->getAllRequests();
                        $additionnalsWording = array(
                            "gender_wording" => $currentCollaborator->getGenderWording(),
                            "profile_wording" => $currentCollaborator->getProfileWording()
                        );
                        $currentCollaborator = $currentCollaborator->toArray($additionnalsWording);
                        $currentCollaborator['status'] = User::USER_STATUS_COLLABORATOR;

                        UserController::print(array(
                            "user" => $currentCollaborator,
                            "requests" => $requests
                        ), "view/User/viewMyProfile.html.php");
                    }
                }
            } catch(Exception $e){
                echo $e->getMessage();
                UserController::print(array(), "view/Error/error404.html.php");
                exit(404);
            }
        }

        public static function modifyMyProfile(){
            $argsPost = self::getAllPosts();
            $database = DatabaseEC::getInstance();
            $session = Session::getInstance();
            if(isset($argsPost['changesSubmitted'])){
                $mailIsUnique = "SELECT COUNT(*) FROM user WHERE user_id <> ? AND mail = ?";
                $mailIsUnique = $database->runSQL($mailIsUnique, array($session->user_id, $argsPost['mail']), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
                $mailIsUnique = ($mailIsUnique[0] == 0) ? TRUE : FALSE;

                $passwordEncrypted = "SELECT password FROM user WHERE user_id = ?";
                $passwordEncrypted = $database->runSQL($passwordEncrypted, array($session->user_id), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
                $rightPassword = password_verify($argsPost['current-password'], $passwordEncrypted['password']);

                if($mailIsUnique && $rightPassword){
                    // --- REWORK TO DO
                    $query = "UPDATE user SET gender_id = ?, name = ?, firstname = ?, mail = ?, phone = ?";
                    $argsQuery[] = $argsPost['gender'];
                    $argsQuery[] = $argsPost['name'];
                    $argsQuery[] = $argsPost['firstname'];
                    $argsQuery[] = $argsPost['mail'];
                    $argsQuery[] = $argsPost['phone'];
                    if(strlen($argsPost['password']) > 8 && strlen($argsPost['password']) < 255){
                        $query = $query.", password = ?";
                        $argsQuery[] = password_hash($argsPost['password'], PASSWORD_DEFAULT);
                        $query = $query.", created_password = ?";
                        $argsQuery[] = date("Y-m-d H:i:s");
                    }
                    $query = $query." WHERE user_id = ?";
                    $argsQuery[] = $session->user_id;
                    $database->runSQL($query, $argsQuery, DatabaseEC::QUERY_TYPE_UPDATE);

                    // --- REWORK END

                    /* Envoi du mail */
                        $mailMessage = "
                            <p>Bonjour ".$session->name." ".$session->firstname.",<br>
                            Nous vous informons que vos modifications sur votre profil dans notre Espace Clients ont bien été prises en compte.<br>
                            Voici les informations enregistrées:</p>
                            <ul>
                                <li>Nom : ".$argsPost['name']."</li>
                                <li>Prénom : ".$argsPost['firstname']."</li>
                                <li>Adresse mail : ".$argsPost['mail']."</li>
                                <li>Téléphone : ".$argsPost['phone']."</li>
                            </ul>
                            <p><strong>&#x26a0; Si vous n'êtes pas à l'origine de ces modifications, contactez immédiatement <a href=\"mailto:infocegape@cegape.fr\">infocegape@cegape.fr</a> ! &#x26a0;</strong></p>
                            <p>Cordialement</p>";

                        $mail = new ECMailer();
                        $mail->setSubject('Profil modifié - EC CEGAPE');
                        $mail->setMessage($mailMessage);
                        $mail->setSender('no-reply@cegape.fr', 'Espace Client CEGAPE');
                        $mail->addNewRecipient($session->mail, $session->name." ".$session->firstname);

                        $mail->send();
                    /* Fin de l'envoi du mail */
                } else {
                    $messagesList = AlertMessage::getInstance();
                    $messagesList->createAlertMessage("Erreur dans vos modifications", "Votre votre adresse mail est déjà utilisée par un autre compte ou alors vous n'avez pas renseigné correctement votre mot de passe actuel.", AlertMessage::BOOSTRAP_DANGER, TRUE);
                    $messagesList->saveMessages();
                }
                header('Location: index.php?op=User/viewProfile');
                exit();
            } else {
                if($session->status == User::USER_STATUS_AGENT){
                    $currentAgent = Agent::ConstructById($session->user_id);
                    if($currentAgent == NULL) throw new Exception("User not found");

                    $institution = $currentAgent->getInstitution();
                    $requests = $currentAgent->getAllRequests();
                    $additionnalsWording = array(
                        "gender_wording" => $currentAgent->getGenderWording(),
                        "profile_wording" => $currentAgent->getProfileWording()
                    );
                    $currentAgent = $currentAgent->toArray($additionnalsWording);
                    $currentAgent['status'] = User::USER_STATUS_AGENT;

                    $genderList = "SELECT * FROM gender WHERE gender_id <> ?";
                    $genderList = $database->runSQL($genderList, array($currentAgent['gender_id']), DatabaseEC::QUERY_TYPE_SELECT);

                    UserController::print(array(
                        "user" => $currentAgent,
                        "genders" => $genderList,
                        "requests" => $requests
                    ), "view/User/modifyMyProfile.html.php");
                } elseif($session->status == User::USER_STATUS_COLLABORATOR){
                    $currentCollaborator = Collaborator::ConstructById($session->user_id);
                    if($currentCollaborator == NULL) throw new Exception("User not found");

                    $requests = $currentCollaborator->getAllRequests();
                    $additionnalsWording = array(
                        "gender_wording" => $currentCollaborator->getGenderWording(),
                        "profile_wording" => $currentCollaborator->getProfileWording()
                    );
                    $currentCollaborator = $currentCollaborator->toArray($additionnalsWording);
                    $currentCollaborator['status'] = User::USER_STATUS_COLLABORATOR;

                    $genderList = "SELECT * FROM gender WHERE gender_id <> ?";
                    $genderList = $database->runSQL($genderList, array($currentCollaborator['gender_id']), DatabaseEC::QUERY_TYPE_SELECT);

                    UserController::print(array(
                        "user" => $currentCollaborator,
                        "genders" => $genderList,
                        "requests" => $requests
                    ), "view/User/modifyMyProfile.html.php");
                }
            }
        }

        public static function addCollaborator(){
            $database = DatabaseEC::getInstance();
            $collaborators = "SELECT user.user_id, name, firstname, mail, profile_wording FROM user LEFT JOIN collaborator ON user.user_id = collaborator.user_id LEFT JOIN profile ON user.profile_id = profile.profile_id WHERE collaborator.group_id IS NOT NULL";
            $collaborators = $database->runSQL($collaborators, array(), DatabaseEC::QUERY_TYPE_SELECT);
            for($i = 0; $i < count($collaborators); $i++){
                $collaborators[$i]['name'] = Encrypter::decrypt($collaborators[$i]['name']);
                $collaborators[$i]['firstname'] = Encrypter::decrypt($collaborators[$i]['firstname']);
                $collaborators[$i]['mail'] = Encrypter::decrypt($collaborators[$i]['mail']);
            }

            $genders = "SELECT * FROM gender";
            $genders = $database->runSQL($genders, array(), DatabaseEC::QUERY_TYPE_SELECT);

            $profiles = "SELECT * FROM profile WHERE collaborator_profile = 1";
            $profiles = $database->runSQL($profiles, array(), DatabaseEC::QUERY_TYPE_SELECT);

            $groups = "SELECT * FROM group_collaborators";
            $groups = $database->runSQL($groups, array(), DatabaseEC::QUERY_TYPE_SELECT);

            self::print(array(
                "genders" => $genders,
                "profiles" => $profiles,
                "groups" => $groups,
                "collaborators" => $collaborators
            ), 'view/User/addCollaborator.html.php');
        }

        public static function registerCollorator(){
            $postList = self::getAllPosts();
            try{
                if(isset($postList['gender']) && $postList['gender'] != 0){
                    if(isset($postList['name']) && $postList['name'] != ''){
                        if(isset($postList['firstname']) && $postList['firstname'] != ''){
                            if(isset($postList['mail']) && $postList['mail'] != ''){
                                if(isset($postList['profile']) && $postList['profile'] != 0){
                                    if(isset($postList['group']) && $postList['group'] != 0){
                                        $stampPwd = uniqid();
                                        $collaborator = new Collaborator();
                                        $collaborator->setProfileId($postList['profile']);
                                        $collaborator->setGenderId($postList['gender']);
                                        $collaborator->setName(strtoupper($postList['name']));
                                        $collaborator->setFirstname($postList['firstname']);
                                        $collaborator->setMail($postList['mail']);
                                        $collaborator->setPassword($stampPwd);
                                        $collaborator->setGroupId($postList['group']);
                                        if($postList['phone'] == ''){
                                            $collaborator->setPhone('N/A');
                                        } else {
                                            $collaborator->setPhone($postList['phone']);
                                        }
                                        $collaborator->setFax('N/A');

                                        $collaborator->register();

                                        /* Envoi du mail */
                                            $mailMessage = "
                                                <p>Bonjour ".strtoupper($postList['name'])." ".$postList['firstname'].",<br>
                                                Nous vous informons que votre profil collaborateur CEGAPE a bien été créé dans l'Espace Clients.
                                                Voici vos identifiants:</p>
                                                <ul>
                                                    <li>Email : ".$postList['mail']."</li>
                                                    <li>Mot de passe : ".$stampPwd."</li>
                                                </ul>
                                                <p><strong>&#x26a0; Ne confiez jamais vos identitifiants à qui que ce soit. Pensez également à renouveler régulièrement votre mot de passe (pour cela allez dans votre profil et modifiez vos informations à votre guise). &#x26a0;</strong></p>
                                                <p>Cordialement,</p>";

                                            $mail = new ECMailer();
                                            $mail->setSubject('Profil créé - EC CEGAPE');
                                            $mail->setMessage($mailMessage);
                                            $mail->setSender('no-reply@cegape.fr', 'Espace Client CEGAPE');
                                            $mail->addNewRecipient($postList['mail'], strtoupper($postList['name'])." ".$postList['firstname']);

                                            $mail->send();
                                        /* Fin d'envoi du mail */

                                        header('Location: index.php?op=User/addCollaborator');
                                    } else {
                                        throw new Exception("Le groupe de la personne n'a pas été renseigné.");
                                    }
                                } else {
                                    throw new Exception("Le profil de la personne n'a pas été renseigné.");
                                }
                            } else {
                                throw new Exception("Le mail de la personne n'a pas été renseigné.");
                            }
                        } else {
                            throw new Exception("Le prénom de la personne n'a pas été renseigné.");
                        }
                    } else {
                        throw new Exception("Le nom de la personne n'a pas été renseigné.");
                    }
                } else {
                    throw new Exception("Le genre de la personne n'a pas été renseigné.");
                }
            } catch(Exception $e){
                $messages = AlertMessage::getInstance();
                $messages->createAlertMessage('Enregistrement annulé', $e->getMessage(), AlertMessage::BOOSTRAP_DANGER, TRUE);
                $messages->saveMessages();
                header('Location: index.php?op=User/addCollaborator');
            }
        }

        public static function listCollaborator(){
            $database = DatabaseEC::getInstance();
            $collaborators = "SELECT user.user_id, name, firstname, mail, profile_wording FROM user LEFT JOIN collaborator ON user.user_id = collaborator.user_id LEFT JOIN profile ON user.profile_id = profile.profile_id WHERE collaborator.group_id IS NOT NULL";
            $collaborators = $database->runSQL($collaborators, array(), DatabaseEC::QUERY_TYPE_SELECT);
            for($i = 0; $i < count($collaborators); $i++){
                $collaborators[$i]['name'] = Encrypter::decrypt($collaborators[$i]['name']);
                $collaborators[$i]['firstname'] = Encrypter::decrypt($collaborators[$i]['firstname']);
                $collaborators[$i]['mail'] = Encrypter::decrypt($collaborators[$i]['mail']);
            }

            self::print(array(
                "collaborators" => $collaborators
            ), 'view/User/listCollaborator.html.php');
        }

        public static function addTechRef(){
            $database = DatabaseEC::getInstance();
            $query = "SELECT DISTINCT company_name FROM institution";
            $institutions = $database->runSQL($query, array(), DatabaseEC::QUERY_TYPE_SELECT);

            $query = "SELECT * FROM gender";
            $genders = $database->runSQL($query, array(), DatabaseEC::QUERY_TYPE_SELECT);

            $query = "SELECT * profile";
            $profiles = $database->runSQL($query, array(), DatabaseEC::QUERY_TYPE_SELECT);

            $templateArgs['institutions'] = $institutions;
            $templateArgs['genders'] = $genders;
            $templateArgs['profiles'] = $profiles;
            
            self::print($templateArgs, 'view/User/addTechRef.html.php');
        }
    }
?>