<?php

class Controller {
    function beforeroute($f3)
    {
        //TODO:  check whether it login

    }

    function afterroute($f3)
    {
        if ($f3->get('content')) {
            echo Template::instance()->render('application.htm');
        } else if ($f3->get('jsonData')) {
            header('Content-type: text/json');
            echo json_encode($f3->get("jsonData"));
        }
    }
}