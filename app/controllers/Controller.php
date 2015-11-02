<?php

require_once('vendor/autoload.php');

use Firebase\JWT\JWT;

class Controller {
    function beforeroute($f3)
    {
        $headers = $f3->get('HEADERS');
        $authHeader = $headers['Authorization'];
        $token = null;
        if($authHeader) {
            list($jwt) = sscanf($authHeader, 'Authorization: Bearer %s');
            try {
                $secretKey = $f3->get('jwt.secretkey');
                $token = JWT::decode($jwt, $secretKey, [$f3->get('jwt.algorithm')]);
                echo json_encode($token);
            }catch (Exception $e) {
                header('HTTP/1.0 401 Unauthorized');
            }
        } else {
            header('HTTP/1.0 404 Bad Request');
        }
    }


    function afterroute($f3)
    {
        if ($f3->get('content')) {
            echo Template::instance()->render('application.htm');
        } else if ($f3->get('jsonData')) {
            header('Content-type: text/json');
            echo json_encode($f3->get("jsonData"));
        } else if ($f3->get('statusCode')) {
            header($f3->get('statusCode'));
        }
    }
}