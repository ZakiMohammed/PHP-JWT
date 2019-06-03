<?php

    // show error reporting
    error_reporting(E_ALL);

    // set your default time-zone
    date_default_timezone_set('Asia/Kolkata');

    // variables used for jwt
    $key = "jwt_key";           // key's value must be your own and unique secret key
    $iss = "http://jwt.org";    // (issuer) claim identifies the principal that issued the JWT
    $aud = "http://jwt.com";    // (audience) claim identifies the recipients that the JWT is intended for
    $iat = 1356999524;          // (issued at) claim identifies the time at which the JWT was issued
    $nbf = 1357000000;          // (not before) claim identifies the time before which the JWT MUST NOT be accepted for processing

?>