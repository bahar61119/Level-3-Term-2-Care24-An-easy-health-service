<?php

/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data

  /**
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include db handler
    require_once 'include/DB_Functions.php';
    require_once 'include/GCM.php';
    $db = new DB_Functions();
    $gcm = new GCM();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);

    // check for tag type
    if ($tag == 'hospital_info') {
		 // check for user
        $res = $db->getHospitals();
        if ($res != false) {
            // echo json with success = 1
            $response["success"] = 1;
            $response["hospital"] = array();
            foreach($res as $hospital){
				array_push($response['hospital'], $hospital);
			}
            echo json_encode($response);
		} 
		else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect Username or Password!";
            echo json_encode($response);
        }
	}
    else if ($tag == 'login') {
        // Request type is check Login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // check for user
        $user = $db->getUserByUsernameAndPassword($username, $password);
        if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            $response["id"] = $user["id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["phone"] = $user["phone"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["username"] = $user["username"];
            $response["user"]["age"] = $user["age"];
            $response["user"]["sex"] = $user["sex"];
            $response["user"]["weight"] = $user["weight"];
			$response["user"]["gcm_regid"] = $user["gcm_regid"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect Username or Password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $weight = $_POST['weight'];
        $gcm_regid = $_POST['gcm_regid'];

        // check if user is already existed
        if ($db->isUserExisted($username)) {
            // user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "Username already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($name, $phone, $address, $email, $username, $password, $age, $sex, $weight, $gcm_regid);
            if ($user) {
                // user stored successfully
                $response["success"] = 1;
                $response["id"] = $user["id"];
				$response["user"]["name"] = $user["name"];
				$response["user"]["phone"] = $user["phone"];
				$response["user"]["address"] = $user["address"];
				$response["user"]["email"] = $user["email"];
				$response["user"]["username"] = $user["username"];
				$response["user"]["age"] = $user["age"];
				$response["user"]["sex"] = $user["sex"];
				$response["user"]["weight"] = $user["weight"];
				$response["user"]["gcm_regid"] = $user["gcm_regid"];
				//$registatoin_ids = array($gcm_regid);
				//$message = array("signup" => "Hello "+ $user["name"] + ", Registration Successful");
				//$result = $gcm->send_notification($registatoin_ids, $message);
				//$response["result"] = $result;
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Registartion unsuccessful";
                echo json_encode($response);
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Access Denied";
}
?>
