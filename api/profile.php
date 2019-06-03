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

    $header = apache_request_headers();
    $authorization = '';

    if (array_key_exists('Authorization', $header)) {
        $authorization = $header['Authorization'];
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Unauthorized'
        ]);
        die();
    }

    $data = json_decode(file_get_contents('php://input'));    
    $jwt = $authorization;

    if ($jwt) {
        try {
            
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $user = getUser('user_id', $decoded->data->user_id);

            if ($user != null) {
                echo json_encode(array(
                    'status' => true,
                    "message" => "Profile Data",
                    "data" => $user
                ));
            } else {
                echo json_encode(array(
                    'status' => false,
                    "message" => "Invalid User",
                    "error" => $e->getMessage()
                ));
            }
     
        } catch (Exception $e) {

            echo json_encode(array(
                'status' => false,
                "message" => "Invalid Token",
                "error" => $e->getMessage()
            ));
        }
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Unauthorized'
        ]);
    }

?>