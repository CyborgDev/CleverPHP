<?php
    class DatabaseEC {
        const DATABASE_CONNECTED = TRUE;
        const DATABASE_NOT_CONNECTED = FALSE;

        const ONE_RESULT = TRUE;

        const QUERY_TYPE_SELECT = 1;
        const QUERY_TYPE_UPDATE = 2;
        const QUERY_TYPE_INSERT = 3;
        const QUERY_TYPE_DELETE = 4;

        private $databaseState = self::DATABASE_NOT_CONNECTED;
        private $pdo_connector;

        private static $instance;

        private function __construct(){}

        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new self;
            }
            self::$instance->startConnection();

            return self::$instance;
        }

        public function startConnection(){
            if($this->databaseState == self::DATABASE_NOT_CONNECTED){
                try{
                    if(CleverConfiguration::EXEC_MOD == CleverConfiguration::MOD_DEV){
                        $dsn =  CleverConfiguration::DATABASE_DRIVER_DEV.':'
                                .'host='.CleverConfiguration::DATABASE_HOST_DEV.';'
                                .'dbname='.CleverConfiguration::DATABASE_NAME_DEV.';'
                                .'charset='.CleverConfiguration::DATABASE_CHARSET_DEV;
                        $this->pdo_connector = new PDO($dsn, CleverConfiguration::DATABASE_USERNAME_DEV, CleverConfiguration::DATABASE_PASSWORD_DEV);
                        $this->databaseState = self::DATABASE_CONNECTED;
                    } elseif(CleverConfiguration::EXEC_MOD == CleverConfiguration::MOD_PROD){
                        $dsn =  CleverConfiguration::DATABASE_DRIVER_PROD.':'
                                .'host='.CleverConfiguration::DATABASE_HOST_PROD.';'
                                .'dbname='.CleverConfiguration::DATABASE_NAME_PROD.';'
                                .'charset='.CleverConfiguration::DATABASE_CHARSET_PROD;
                        $this->pdo_connector = new PDO($dsn, CleverConfiguration::DATABASE_USERNAME_PROD, CleverConfiguration::DATABASE_PASSWORD_PROD);
                        $this->databaseState = self::DATABASE_CONNECTED;
                    }                    
                } catch (PDOException $e){
                    die('Error DatabaseEC::startConnection() : ' . $e->getMessage());
                }
            }
            return $this->databaseState;
        }

        public function runSQL(string $query, array $args = array(), int $queryType, bool $unique_result = false){
            if($this->databaseState == self::DATABASE_CONNECTED){
                try{
                    $nbArgs = mb_substr_count($query , '?');
                    if($nbArgs != count($args)) throw new Exception('Error DatabaseEC::runSQL() : Number of `?` must be the same as the number of arguments in $args');
                    $result = $this->pdo_connector->prepare($query);

                    switch($queryType){
                        case self::QUERY_TYPE_SELECT:
                            $result->execute($args);
                            $result = $result->fetchAll();
                            if($unique_result && count($result) > 0) $result = $result[0];
                            return $result;
                            break;
                        case self::QUERY_TYPE_UPDATE:
                            $result->execute($args);
                            return $result->rowCount();
                            break;
                        case self::QUERY_TYPE_INSERT:
                            if($result->execute($args)){
                                return $this->pdo_connector->lastInsertId();
                            } else {
                                return FALSE;
                            }
                            break;
                        case self::QUERY_TYPE_DELETE:
                            $result->execute($args);
                            break;
                        default:
                            throw new Exception('Error DatabaseEC::runSQL() : Unknown query type.');
                            break;
                    }
                } catch(Exception $e){
                    if(CleverConfiguration::GLOBAL_DEATH_ENABLED){
                        die($e->getMessage());
                    } else {
                        return FALSE;
                    }
                }
            } else {
                throw new Exception('Error DatabaseEC::runSQL() : The database is not connected');
            }
        }
    }
?>