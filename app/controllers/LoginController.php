<?php

require_once('vendor/autoload.php');

use Firebase\JWT\JWT;

class LoginController {
    function index($f3) {
        echo Template::instance()->render('login.htm');
    }

    function login($f3) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;
        $expire     = $notBefore + 60;
        $serverName = $f3->get('servername');

        $data = [
            'iat'  => $issuedAt,
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => $notBefore,
            'exp'  => $expire,
            'data' => [
                'userId'   => 1,
                'userName' => $username
            ]
        ];

        $secretKey = $f3->get('jwt.secretkey');
        $algorithm = $f3->get('jwt.algorithm');
        $jwt = JWT::encode($data, $secretKey, $algorithm);

        header('Content-type: application/json');
        echo json_encode(['jwt' => $jwt]);
    }
}