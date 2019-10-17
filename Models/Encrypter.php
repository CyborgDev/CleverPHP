<?php
    class Encrypter{
        const MIN_LENGTH_KEY = 5;
        const MAX_LENGHT_KEY = 25;
        const SEPARATOR = '§';
        /**
         * strstr compare
         * str_split bah ça split
         */

        /**
         * /!\ THESE ARRAY SHOULD NOT BE MODFIED /!\
         */
        private static $alphanumeric = array('x','y','C','r','Z','w','B','U','p','N','F','g','8','k','R','o','9','E','L','b','i','2','X','z','c','j','\'','m','J','A','W',' ','I','S','T','u','/','"','l','7','n','1','t','@','G','\\','h','q','_','4','-','f','.','D','P','Q','3','K','d','a','s','M','O','H','Y','V','0','5','e','v','6');//array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '\\', '\'', '/', '"', ' ');//array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'À', 'Á', 'Â',	'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê',	'Ë', 'Ì', 'Í', 'Î',	'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Œ', 'Š', 'þ', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Ÿ', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'œ', 'š', 'Þ', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        private static $randomThingsForKey = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

        private static $boringSpecialsChar = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Œ','Š','Ù','Ú','Û','Ü','Ý','Ÿ','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','ø','œ','š','ù','ú','û','ü','ý','ÿ');
        private static $normalCharReplacement = array('A','A','A','A','A','A','Ae','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','Oe','S','U','U','U','U','Y','Y','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','o','n','o','o','o','o','o','oe','s','u','u','u','u','y','y');

        public static function encrypt($data){
            $key = self::generateKey();
            $keySize = strlen($key); // real key
            $data = str_replace(self::$boringSpecialsChar, self::$normalCharReplacement, $data);
            $splitedData = str_split($data);
            $splitedDataKeys = array();
            $encryptedData = array();
            
            if(count($splitedData) > 0){
                foreach($splitedData as $char){
                    $charKey = self::get_char_key_in_alphanumeric($char);
                    $splitedDataKeys[] = $charKey;
                }
                foreach($splitedDataKeys as $splitedDataKey){
                    if(((int)$splitedDataKey + $keySize) < count(self::$alphanumeric)){
                        $index = (int)$splitedDataKey + $keySize;
                        $encryptedData[] = self::$alphanumeric[$index];
                    } else {
                        $remainingValuesInAlphanum = count(self::$alphanumeric) - (int)$splitedDataKey;
                        $newIndex = $keySize - $remainingValuesInAlphanum;
                        $encryptedData[] = self::$alphanumeric[$newIndex];
                    }
                }
                $encryptedData = $key.self::SEPARATOR.implode('', $encryptedData).self::SEPARATOR.date('Ymd');
                return $encryptedData;
            }
        }

        public static function decrypt($data){
            $encryptedData = explode(self::SEPARATOR, $data);
            if(count($encryptedData) == 3){
                $keySize = strlen($encryptedData[0]);
                //$dateCrypting = $encryptedData[2];
                $encryptedData = $encryptedData[1];

                $splitedEncryptedData = str_split($encryptedData);
                $splitedEncryptedDataKeys = array();
                $decryptedData = array();
                
                foreach($splitedEncryptedData as $char){
                    $charKey = self::get_char_key_in_alphanumeric($char);
                    $splitedEncryptedDataKeys[] = $charKey;
                }
                foreach($splitedEncryptedDataKeys as $splitedEncryptedDataKey){
                    if(((int)$splitedEncryptedDataKey - $keySize) >= 0){
                        $index = (int)$splitedEncryptedDataKey - $keySize;
                        $decryptedData[] = self::$alphanumeric[$index];
                    } else {
                        $remainingIndex = abs((int)$splitedEncryptedDataKey - $keySize);
                        $newIndex = count(self::$alphanumeric) - $remainingIndex;
                        $decryptedData[] = self::$alphanumeric[$newIndex];
                    }
                }
                $decryptedData = implode('', $decryptedData);
                return $decryptedData;
            } else {
                return FALSE;
            }
        }

        /* INTERNAL FUNCTIONS */
            private static function generateKey(){
                $keySize = random_int(self::MIN_LENGTH_KEY, self::MAX_LENGHT_KEY);
                $rand_keys = array_rand(self::$randomThingsForKey, $keySize);
                $alphanumericKey = '';
                foreach($rand_keys as $key){
                    $alphanumericKey = $alphanumericKey.self::$randomThingsForKey[$key];
                }
                return $alphanumericKey;
            }

            private static function get_char_key_in_alphanumeric($char){
                $key = 'N/A';
                for($i = 0; $i < count(self::$alphanumeric); $i++){
                    if(strstr('0'.self::$alphanumeric[$i], '0'.$char) !== FALSE){ // '0' is here in order to find all single '0'
                        $key = $i;
                        break;
                    }
                }
                if($key != 'N/A'){
                    return $key;
                } else {
                    return FALSE;
                }
            }

            public static function melangeArray(){
                shuffle(self::$alphanumeric);
                foreach(self::$alphanumeric as $num){
                    echo "'".$num."',";
                }
            }
        /* END INTERNAL FUNCTIONS */
    }
?> 