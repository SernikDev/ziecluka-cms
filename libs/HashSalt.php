<?php


class HashSalt {

    /**
     * Function that generates unique salt and hash for password
     * @param mixed $password - user password
     * @return mixed - salt and hash for password
     */
    public static function create($password){ 
        
      $bytes = openssl_random_pseudo_bytes(80);
      $salt = bin2hex($bytes);
      
      $pass = $password . $salt;
      
      $passhash = password_hash($pass, PASSWORD_BCRYPT);
           
      return array("salt" => $salt, "hash" => $passhash);
        
    }

}