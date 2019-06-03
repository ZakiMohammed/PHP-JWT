<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

    $jwt = $authorization;

    if ($jwt) {
        try {
            
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            
            echo json_encode(array(
                'status' => true,
                "message" => "Valid Token",
                "data" => $decoded->data
            ));
     
        } catch (Exception $e){

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