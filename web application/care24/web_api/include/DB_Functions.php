<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }
    
     /**
     * Getting all hospitals
     */
    public function getHospitals() {
        $result = mysql_query("select * FROM hospital") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        if($no_of_rows > 0){
			$hospitals=array();
			 while ($row = mysql_fetch_array($result)) {
				array_push($hospitals, $row);
			}
			return $hospitals;	
		}
        else return false;
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $phone, $address, $email, $username, $password, $age, $sex, $weight ,$gcm_regid) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO user(id, name, phone, address, email, username, password, salt, age, sex, weight, gcm_regid) VALUES( '', '$name', '$phone', '$address', '$email', '$username', '$encrypted_password', '$salt', '$age', '$sex', '$weight', '$gcm_regid')");
        // check for successful store
        if ($result) {
            // get user details 
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM user WHERE id = $id");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    /**
     * Get user by username and password
     */
    public function getUserByUsernameAndPassword($username, $password) {
        $result = mysql_query("SELECT * FROM user WHERE username = '$username'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }
    
    
    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM user");
        return $result;
    }


    /**
     * Check user is existed or not
     */
    public function isUserExisted($username) {
        $result = mysql_query("SELECT email from user WHERE username = '$username'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
