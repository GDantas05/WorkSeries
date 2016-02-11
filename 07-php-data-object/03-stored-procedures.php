<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require('./_app/Config.inc.php');

      $conn = new Conn;

      try {

        $query = "SELECT * FROM ws_siteviews_agent WHERE agent_name = :name";
        $exe = $conn->getConn()->prepare($query);

        $exe->bindValue(":name", 'Chrome');
        $exe->execute();

        $chrome = $exe->fetch(PDO::FETCH_ASSOC);

        $exe->bindValue(":name", 'Firefox');
        $exe->execute();

        $firefox = $exe->fetch(PDO::FETCH_ASSOC);

      } catch (PDOException $e) {
        PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
      }

      if ($chrome) {
        //var_dump($chrome);
        echo "{$chrome['agent_name']} tem {$chrome['agent_views']} visita(s) <hr>";
      }

      if ($firefox) {
        //var_dump($firefox);
        echo "{$firefox['agent_name']} tem {$firefox['agent_views']} visita(s) <hr>";
      }

    ?>
  </body>
</html>
