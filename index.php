<?php

    require_once ('tools/travels.php');

    $cities = new Cities($allCities);
    $travels = new Travels($allTravels);
    $rutas = new ToolsTravels($travels->all);

    $cities_array = get_object_vars($cities);
    $cities_array = $cities_array['cities'];

    function viewTour($ruta)
    {
        foreach ($ruta as $key => $val) {
            echo "- $key  ";
        }
    }

    $citySelected = 'Logroño';
    if (isset($_POST['citySelect']))
        $citySelected = $_POST['citySelect'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Generation Transport Service - TRAVELS</title>
</head>
<body>
        <h1>Next Generation Transport Service</h1>
        Ruta más económica desde <b>LOGROÑO</b> y <b>CIUDAD REAL</b>
        <br>
        <?php
            
                $fromLogroToCiud = $rutas->minCostRouteTwoCities('Logroño', "Ciudad Real");

                echo '<br>Recorrido Minimo total: <b>'; 
                viewTour($fromLogroToCiud);
                echo '</b>';

                echo '<br> Coste total del Viaje: <b>'.array_sum ( $fromLogroToCiud ).'</b><br>';  

                unset($rutas);

        ?>
        <br><br><br><br><br>
        <hr>
        <br><br><br><br><br>


        <b>Selecciona una ciudad para ver todos sus viajes con recorrido minimos: </b>
        <form action="index.php" method="post" target="_self" name="formSelectCity">
        <p>
          <select name="citySelect">
            <?php 
                        foreach ($cities_array as $key) {

            ?>
            <option <?php 
                if ( $citySelected == $key) echo 'selected';
                echo '>'.$key.'' ?></option>
            <?php } ?>

          </select>

          <input type="submit" value="Enviar">

        </p>

        </form>

        <?php


            

            echo '<h3>'.$citySelected.'</h3>';

            foreach ($cities_array as $key) {
                if ($citySelected != $key)
                {
                        $rutas = new ToolsTravels($travels->all);

                        echo '> Salida: <b>'.$citySelected.'</b> - Llegada: <b>'.$key.'</b>';

                        $fromLogroToCiud = $rutas->minCostRouteTwoCities($citySelected, $key);

                        echo '<br>Recorrido Minimo total: <b>'; 
                        viewTour($fromLogroToCiud);
                        echo '</b>';

                        echo '<br> Coste total del Viaje: <b>'.array_sum ( $fromLogroToCiud ).'</b><br><br><br>';

                        unset($rutas);
                }

            } 
        ?>

</body>
</html>