<?php

require_once('vendor/autoload.php');

use Firebase\JWT\JWT;

class LoginController {
    function index($f3) {

    }

    function login($f3) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;  //Adding 10 seconds
        $expire     = $notBefore + 60; // Adding 60 seconds
        $serverName = $f3->get('servername');

        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the signer user
                'userId'   => 1,         // userid from the users table
                'userName' => $username, // User name
            ]
        ];

        $secretKey = $f3->get('jwt.secretkey');
        $algorithm = $f3->get('jwt.algorithm');

        $jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            $secretKey, // The signing key
            $algorithm  // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
        $unEncodedArray = ['jwt' => $jwt, 'algorithm' => $algorithm];

        header('Content-type: application/json');
        echo json_encode($unEncodedArray);
    }
}