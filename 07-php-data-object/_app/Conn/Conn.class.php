<?php

  /**
   *
   */
  class Conn
  {

    private static $host = HOST;
    private static $user = USER;
    private static $pass = PASS;
    private static $dbsa = DBSA;

    private static $connect = null;

    private static function conectar()
    {
      try {
        if (self::$connect == null) {
          $dsn = 'mysql:host='.self::$host.';dbname='.self::$dbsa;
          $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
          self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
        }
      } catch (PDOException $e) {
        PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        die;
      }

      self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return self::$connect;

    }

    public static function getConn()
    {
      return self::conectar();
    }
  }
