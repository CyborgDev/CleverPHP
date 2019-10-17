<?php
    class AlertMessage {
        const BOOSTRAP_V4_ENABLED = TRUE;
        const BOOSTRAP_PRIMARY = 'alert alert-primary';
        const BOOSTRAP_SECONDARY = 'alert alert-secondary';
        const BOOSTRAP_SUCCESS = 'alert alert-success';
        const BOOSTRAP_DANGER = 'alert alert-danger';
        const BOOSTRAP_WARNING = 'alert alert-warning';
        const BOOSTRAP_INFO = 'alert alert-info';
        const BOOSTRAP_LIGHT = 'alert alert-light';
        const BOOSTRAP_DARK = 'alert alert-dark';
        const BOOSTRAP_ALERT_DISMISSIBLE = 'alert-dismissible fade show';

        private $messagesList = array();

        private static $instance;

        private function __construct(){}
        
        public static function getInstance(){
            if (!isset(self::$instance)) {
                self::$instance = new self;
            }
            
            return self::$instance;
        }

        public function createAlertMessage(string $title, string $content, string $alertType, bool $isDismissible = false){
            if($isDismissible){
                $messageDivClass = $alertType.' '.self::BOOSTRAP_ALERT_DISMISSIBLE;
            } else {
                $messageDivClass = $alertType;
            }

            $newAlertMessage = array(
                'title' => $title,
                'content' => $content,
                'class' => $messageDivClass
            );

            $this->messagesList[] = $newAlertMessage;
        }

        public function saveMessages(){
            $serializedMessages = serialize($this->messagesList);
            $session = Session::getInstance();
            $session->messages = $serializedMessages;
        }

        public function loadMessages(){
            $session = Session::getInstance();
            if(isset($session->messages)){
                $serializedMessages =  $session->messages;
                unset($session->messages);
                $this->messagesList = unserialize($serializedMessages);
            }
        }

        public function getMessagesList(){
            return $this->messagesList;
        }
    }
?>