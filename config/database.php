<?php
namespace Tsoha;

  class DatabaseConfig{

    // Valitse käyttämäsi tietokantapalvelin - PostgreSQL (psql) tai MySQL (mysql)
    private static $use_database = 'mysql';

    // Muuta users-ympäristöä asettamalle oikeat arvot KAYTTAJATUNNUS-kohtaan (käyttäjätunnuksesi)
    // ja SALASANA-kohtaan (tietokantasi pääkäyttäjän salasana)
    private static $connection_config = array(
      'psql' => array(
        'resource' => 'pgsql:'
      ),
      'mysql' => array(
        //'resource' => 'mysql:unix_socket=/home/ppkostam/mysql/socket;dbname=mysql',
        'resource' => 'mysql:host=127.0.0.1;port=3306;dbname=lounaslippu',
        'username' => 'root',
        'password' => ''
      )
    );

    public static function connection_config(){
      $config = array(
        'db' => self::$use_database,
        'config' => self::$connection_config[self::$use_database]
      );

      return $config;
    }

  }
