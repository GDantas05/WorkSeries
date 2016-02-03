<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require('./_app/Config.inc.php');

      $PDO = new Conn;
      $name = 'Chrome';
      $views = '250';

      try {
        $qRCreate = "INSERT INTO ws_siteviews_agent (agent_name, agent_views) VALUES (?, ?)";
        $create = $PDO->getConn()->prepare($qRCreate);

        $create->bindParam(1, $name, PDO::PARAM_STR, 15);
        $create->bindParam(2, $views, PDO::PARAM_INT, 5);

        $create->execute();

        if ($create->rowCount()) {
          echo "{$PDO->getConn()->lastInsertId()} - Cadastrado com sucesso <hr>";
        }

        $qRSelect = "SELECT * FROM ws_siteviews_agent WHERE agent_views >= :visitas";
        $select = $PDO->getConn()->prepare($qRSelect);

        $select->bindValue(':visitas', '7');
        $select->execute();

        if ($select->rowCount() >= 1) {
          echo "Pesquisa retornou {$select->rowCount()} resultado(s) <hr>";
          $resultado = $select->fetchAll(PDO::FETCH_ASSOC);
          var_dump($resultado);
        } else {
          echo "Nenhum resultado encontrado <hr>";
        }

      } catch (PDOException $e) {
        PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
      }

     ?>
  </body>
</html>
