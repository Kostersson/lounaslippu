<?php
namespace Tsoha;

use Lounaslippu\Service\AuthenticationService;

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      return null;
    }

    public static function check_logged_in(){
      Redirect::to("/sisaankirjautuminen");
    }

  }
