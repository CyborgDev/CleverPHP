<?php
    class Database{

        const DISCONNECTED = '0001';
        const CONNECTED = '0002';

        const ERR_ALREADY_DISCONNECTED = DISCONNECTED.'.01';
        const ERR_QUERY_FAILED = CONNECTED.'.01';
        const ERR_NOT_ENOUGH_ARGS = ERR_QUERY_FAILED.'.01';

        private $_host;
        private $_db_name;
        private $_charset;
        private $_user_name;
        private $_password;
        private $_pdo_object;
        private $_object_log;
        private $_status;

        public function __construct($host, $db_name, $user_name, $password, $charset = 'utf8'){
            $this->_host = $host;
            $this->_db_name = $db_name;
            $this->_user_name = $user_name;
            $this->_password = $password;
            $this->_charset = $charset;
            $this->_pdo_object = null;
            $this->_object_log = array();
            $this->_status = DISCONNECTED;
        }

        /**
         * Function connection(), this function will try to connect $this to the database.
         * 
         * @param boolean $persistenceEnabled default set to TRUE, the persistence is used to optimise the speed of your website.
         * @param boolean $debugEnabled default set to TRUE, the debug option is used to show or not errors on your pages.
         * @param boolean $deathEnabled default set to TRUE, the death option is used to kill your page in case of failure.
         * @return boolean true|false
         * 
         * @see http://CleverPHP/index.php?page=Documentation&sheet=Database&function=connection
         * @author 'Martin Crampon' aka 'CybDev'
         */
        public function connection($persistenceEnabled = true, $debugEnabled = true, $deathEnabled = true){
            try{
                $dsn = 'mysql:host='.$this->_host.';dbname='.$this->_db_name.'; charset='.$this->_charset.'';
                $this->_pdo_object = new PDO($dsn, $this->_user_name, $this->_password, array(PDO::ATTR_PERSISTENT => $persistenceEnabled));
                if($debugEnabled) $this->_pdo_object->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->_object_log[] = date('Y-m-d H:i:s').' - '.CONNECTED.' Connection established with the database "'.$this->_db_name.'"';
                return true;
            } catch(Exception $e){
                if($deathEnabled){
                    die('Error, failed to connect to database "'.$this->_db_name.'"<br>Error description : '. $e->getMessage());
                } else {
                    $this->_object_log[] = date('Y-m-d H:i:s').' - '.$e->getMessage();
                    return false;
                }
            }
        }

        /**
         * Function disconnect(), this function will destroy the connection to the database.
         * 
         * @return true|false
         * 
         * @see http://CleverPHP/index.php?page=Documentation&sheet=Database&function=disconnect
         * @author 'Martin Crampon' aka 'CybDev'
         */
        public function disconnect(){
            if($this->_status == DISCONNECTED){
                $this->_object_log[] = date('Y-m-d H:i:s').' - '.ERR_ALREADY_DISCONNECTED.' $this was already disconnected from his database "'.$this->_db_name.'"';

                return false;
            } else {
                $this->_pdo_object = null;
                $this->_object_log[] = date('Y-m-d H:i:s').' - '.DISCONNECTED.' Disconnection from the the database "'.$this->_db_name.'"';

                return true;
            }
        }

        /**
         * Function query(), this function will execute the query gived in param.
         * 
         * @param string $SQLquery Any type of query is accepted (SELECT | UPDATE | INSERT | DELETE).
         * @param array $clause All clauses needed in $SQLquery
         * 
         * @return array|boolean array|false
         * 
         * @see http://CleverPHP/index.php?page=Documentation&sheet=Database&function=query
         * @author 'Martin Crampon' aka 'CybDev'
         */
        public function query($SQLquery, $clause = array(), $deathEnabled = true){
            try{
                $nbClause = mb_substr_count($SQLquery , '?');

                if($nbClause > 0 && ($nbClause != count($clause))) throw new Exception(ERR_NOT_ENOUGH_ARGS.' Not enough arguments in $clause');

                $table  = $this->_pdo_object->prepare($SQLquery);
                $table->execute($clause);
                $table = $table->fetchAll();

                if(count($table) == 1) $table = $table[0];

                $this->_object_log[] = date('Y-m-d H:i:s').' - '.CONNECTED.' Connection established with the database "'.$this->_db_name.'"';

                return $table;
            } catch(Exception $e){
                if($deathEnabled){
                    die('Error, unsuccessful request"<br>Error description : '. $e->getMessage());
                } else {
                    $this->_object_log[] = date('Y-m-d H:i:s').' - '.$e->getMessage();
                    return false;
                }
            }
        }
    }
?>