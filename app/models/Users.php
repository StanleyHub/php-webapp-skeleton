<?php
/**
 * Created by PhpStorm.
 * User: xzhang
 * Date: 10/31/15
 * Time: 10:31 AM
 */

class Users extends \DB\SQL\Mapper {

    function __construct()
    {
        parent::__construct(\Base::instance()->get('DB'), 'users');
    }
}