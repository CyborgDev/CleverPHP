<?php

class User {
    /* Section constantes */
        const USER_STATUS_AGENT = 'AGENT';
        const USER_STATUS_COLLABORATOR = 'COLLABORATOR';

        const TYPE_OBJECT = 'OBJECT';
        const TYPE_ARRAY = 'ARRAY';

        const ERR_NONEXISTENT_MAIL = 'USER-E001';
        const ERR_WRONG_PASSWORD = 'USER-E002';
        const ERR_SQL_QUERY_FAILED = 'USER-E003';
    /* ----------------- */

    /* Section variables */
        protected $_user_id;
        protected $_password;
        protected $_created_password;
        protected $_connection_tests;
        protected $_mail;
        protected $_name;
        protected $_firstname;
        protected $_gender_id;
        protected $_inactive;
        protected $_profile_id;
        protected $_phone;
        protected $_fax;
    /* ----------------- */

    public function __construct(){}

    public function setPassword(string $password){
        $this->_password = $password;
    }

    public function setMail(string $mail){
        $this->_mail = $mail;
    }

    public function setName(string $name){
        $this->_name = strtoupper($name);
    }

    public function setFirstname(string $firstname){
        $this->_firstname = $firstname;
    }

    public function setGenderId(int $genderId){
        $this->_gender_id = $genderId;
    }

    public function setProfileId(int $profileId){
        $this->_profile_id = $profileId;
    }

    public function setPhone(string $phone){
        $this->_phone = $phone;
    }

    public function setFax(string $fax){
        $this->_fax = $fax;
    }

    public function getGenderWording(){
        $query = "SELECT gender_wording FROM gender WHERE gender_id = ?";
        $database = DatabaseEC::getInstance();
        $wording = $database->runSQL($query, array($this->_gender_id), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
        return (count($wording) > 0) ? $wording['gender_wording'] : FALSE;
    }

    public function getProfileWording(){
        $query = "SELECT profile_wording FROM profile WHERE profile_id = ?";
        $database = DatabaseEC::getInstance();
        $wording = $database->runSQL($query, array($this->_profile_id), DatabaseEC::QUERY_TYPE_SELECT,TRUE);
        return (count($wording) > 0) ? $wording['profile_wording'] : FALSE;
    }

    public static function GeneratePassword(){
        return uniqid();
    }

    public static function DecrypteUserArray(array $userData){
        $userData['mail'] = Encrypter::decrypt($userData['mail']);
        $userData['name'] = Encrypter::decrypt($userData['name']);
        $userData['firstname'] = Encrypter::decrypt($userData['firstname']);
        $userData['phone'] = Encrypter::decrypt($userData['phone']);
        $userData['fax'] = Encrypter::decrypt($userData['fax']);

        return $userData;
    }

    /**
     * This function return a User class constant in order to indicate the type of user
     * This function ***throw Exception***
     * @param int $user_id
     * @return string **User::USER_STATUS_AGENT** _or_ **User::USER_STATUS_COLLABORATOR**
     */
    public static function GetStatus(int $user_id){
        
        $database = DatabaseEC::getInstance();
        $getNbAgentLines = "SELECT COUNT(*) FROM agent WHERE user_id = ?";
        $nbLines = $database->runSQL($getNbAgentLines, array($user_id), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
        if($nbLines[0] == 1){
            return self::USER_STATUS_AGENT;
        } elseif(($nbLines[0] > 1 || $nbLines[0] < 1) && $nbLines[0] != 0){
            throw new Exception("getStatus() : Error, aberrant number of lines in `agent`.");
        } else {
            $getNbCollabLines = "SELECT COUNT(*) FROM collaborator WHERE user_id = ?";
            $nbLines = $database->runSQL($getNbCollabLines, array($user_id), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
            if($nbLines[0] == 1){
                return self::USER_STATUS_COLLABORATOR;
            } else {
                throw new Exception("getStatus() : Error, aberrant number of lines in `collaborator`.");
            }
        }
    }

    public static function LoginUser(string $mail, string $password){
        try{
            $mail = strip_tags($mail);
            $password = strip_tags($password);
            $database = DatabaseEC::getInstance();
            $md5Mail = md5($mail);
            $isAgent = "SELECT COUNT(*) FROM user LEFT JOIN agent ON user.user_id = agent.user_id WHERE user.hashed_mail = ? AND agent.agent_canopee_id IS NOT NULL";
            $isAgent = $database->runSQL($isAgent, array($md5Mail), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
            if($isAgent[0] == '1'){
                return Agent::Login($mail, $password);
            } else {
                return Collaborator::Login($mail, $password);
            }
        } catch(Exception $e){
            // TO DO
        }
    }

    public static function disconnect(){
        $session = Session::getInstance();
        $session->destroy();
    }

    public function doesEmailExist(){
        $database = DatabaseEC::getInstance();
        $md5Mail = md5($this->_mail);
        $query = "SELECT COUNT(*) FROM user WHERE hashed_mail = ?";
        $nbMail = $database->runSQL($query, array($md5Mail), DatabaseEC::QUERY_TYPE_SELECT, DatabaseEC::ONE_RESULT);
        if($nbMail[0] > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * throw Exception
     */
    protected function registerUser(){
        if($this->doesEmailExist() == FALSE){
            $database = DatabaseEC::getInstance();    
            $insert = "INSERT INTO user (hashed_mail, password, mail, created_password, name, firstname, gender_id, profile_id, phone, fax) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $insert = $database->runSQL($insert, array(
                md5($this->_mail),
                password_hash($this->_password, PASSWORD_DEFAULT),
                Encrypter::encrypt($this->_mail),
                date('Y-m-d H:i:s'),
                Encrypter::encrypt($this->_name),
                Encrypter::encrypt($this->_firstname),
                $this->_gender_id,
                $this->_profile_id,
                Encrypter::encrypt($this->_phone),
                Encrypter::encrypt($this->_fax)
            ), DatabaseEC::QUERY_TYPE_INSERT);

            return $insert;
        } else {
            throw new Exception("L'adresse mail renseignée existe déjà.");
        }
    }
}