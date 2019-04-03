<?php
    interface Model{
        /**
         * Function GetAll(), this function will create an array with all data from the database in the table specified in the class.
         * **WARNING** it can slow down your computer if there are a lot of data in the database.
         * @return array $allObjects
         * @see http://CleverPHP/index.php?page=Documentation&sheet=Model&function=GetAll 
         */
        public static function GetAll();

        /**
         * Function fill($data), this function will fill the object $this with all data contained in the array type param $data.
         * **WARNING** $data need to be an specific array of the class.
         * @param array $data
         * @return boolean $allParamsAreOk
         * @see http://CleverPHP/index.php?page=Documentation&sheet=Model&function=fill 
         */
        public function fill($data);
    }
?>