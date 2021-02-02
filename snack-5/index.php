<?php
  /*
  PHP Snack #5
  Partiamo da questo array di hotel.
  https://www.codepile.net/pile/OEWY7Q1G
  Stampare tutti i nostri hotel con tutti i dati disponibili.
  Avremo un file PHP con il nostro “database” e un file con tutta la logica.
  */

  /*
  Attraverso un parametro GET da inserire direttamente nell'url (uno alla
  volta), filtrare gli hotel che hanno un parcheggio, numero minimo di
  stelle o massima lontananza dal centro.
  Se non c'è un filtro, visualizzare come in precedenza tutti gli hotel.
  */

  include __DIR__ . "/database.php";


  $filteredHotels = [];


  if (isset($_GET["parking"])) {

    foreach ($hotels as $element) {
      if ($element["parking"] == true) {
        $filteredHotels[] = $element;
      }
    }

  } elseif ($_GET["vote"] == "1" || $_GET["vote"] == "2" || $_GET["vote"] == "3" || $_GET["vote"] == "4" || $_GET["vote"] == "5") {

    foreach ($hotels as $element) {
      if ($element["vote"] == $_GET["vote"]) {
        $filteredHotels[] = $element;
      }
    }

  } elseif (isset($_GET["distance"])) {

    foreach ($hotels as $element) {
      if ($element["distance_to_center"] <= $_GET["distance"]) {
        $filteredHotels[] = $element;
      }
    }

  } else {
    $filteredHotels = $hotels;
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Snack #5</title>
  </head>
  <body>

    <ul>
      <?php foreach ($filteredHotels as $hotel) { ?>
        <li>
          <h2><?php echo $hotel["name"]; ?></h2>
          <p>Descrizione: <?php echo $hotel["description"]; ?></p>
          <p>Parcheggio: <?php echo $hotel["parking"] ? "Sì" : "No"; ?></p>
          <p>Voto: <?php echo $hotel["vote"]; ?>/5</p>
          <p>Distanza dal centro: <?php echo $hotel["distance_to_center"]; ?> km</p>
        </li>
      <?php } ?>
    </ul>

  </body>
</html>
