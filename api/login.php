<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        die();
    }

    include_once '../lib/BeforeValidException.php';
    include_once '../lib/ExpiredException.php';
    include_once '../lib/SignatureInvalidException.php';
    include_once '../lib/JWT.php';
    use \Firebase\JWT\JWT;

    include_once 'config.php';
    include_once 'data.php';

    $data = json_decode(file_get_contents('php://input'));
    $user = getUser('user_name', $data->user_name);

    if ($user != null) {

        if ($user['password'] != $data->password) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid Credentials'
            ]);
            die();
        }

        $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "data" => [
                "user_id" => $user['user_id'],
                "user_name" => $user['user_name']
            ]
         );
         $jwt = JWT::encode($token, $key);
         echo json_encode([
            'status' => true,
            'message' => 'Successfully Logged In',
            'jwt' => $jwt
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid Credentials'
        ]);
    }

?>