<?php

namespace Lounaslippu\Service;


/**
 * Class ErrorService
 * @package Lounaslippu\Service
 */
class ErrorService
{

    /**
     * @param array $error
     */
    public static function setErrors($error)
    {
        if (isset($_SESSION["flash_message"])) {
            $_SESSION["flash_message"] = json_decode($_SESSION["flash_message"]);
        } else {
            $_SESSION["flash_message"] = array();
        }
        $_SESSION["flash_message"] = json_encode(array_merge($_SESSION["flash_message"], $error));
    }
}