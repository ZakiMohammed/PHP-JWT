<?php

    $header = apache_request_headers();
    $authorization = 'NA';
    
    if (array_key_exists('Authorization', $header)) {
        $authorization = $header['Authorization'];
    }

    echo $_SERVER['REQUEST_METHOD'];
?>