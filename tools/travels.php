<?php

require_once ('data/data.php');

/***********************
 * 
 *  class Cities
 *  Conjunto total de ciudades 
 * 
 */
class Cities {

    public $cities = array();

    public function __construct($allCities)
    {
        $this->cities = $allCities;
    }

}  

/**************************
 * 
 *   Class Travels
 *   Conjunto total de viajes.
 *    
 */
class Travels {

    public $all = array();

    public function __construct($travels)
    {
        $this->all = $travels;
    }
}

/*****************
 * 
 *  class ToolsTravels
 *  Herramientas sobre los viajes entre ciudades
 *  Extiende de Travels.
 *  Primero recoge todas las combinaciones de viajes entre ciudades.
 * 
 */
class ToolsTravels extends Travels {

    /*************
     *  public $travelAll = array();
     *  Conjunto de Ciudades que se pueden recorrer entre ellas.
     *  Este array puede ser variable en funcion al viaje que se realize.
     *  Se pueden eliminar ciudades del conjunto para evitar ciclos dentro del grafo.
     */
    public $travelAll = array();

    public function __construct($travels)
    {
        $this->travelAll = $travels; 
    }

    

    /**********************************
     * public function minCostCityNearest($cities)
     * Recibe un array de Ciudades, en Clave => Valor.
     * Siendo: Clave = Nombre Ciudad  y  Valor = Coste
     * 
     * Devuelve: En Clave Valor la ciudad con el menor coste del array de ciudades recibido
     * ********************************/
    public function minCostCityNearest($cities)
    {
        $min = min($cities);
        foreach($cities as $key => $val) {    
            if($val === $min) $b = array ($key => $val);
        }
        return $b;
    }




    /**********************
     * private function deleteFisrtCity($origin)
     * Elimina la primera ciudad que se visito en el array public $travelAll.  
     * Esta operacion se realiza porque existe un ciclo cerrado en el grafo.
     */
    private function deleteFisrtCity($origin)
    {
        $nextCities = $this->cityNearest($origin);
        $deletetCity = $this->minCostCityNearest($nextCities);  


        unset($nextCities[array_key_last($deletetCity)]);
        unset($this->travelAll[$origin]);


        $this->travelAll[$origin] = $nextCities;
    }



    /*******************
     * public function cityNearest($nameCity)
     * Devuelve: El conjunto de ciudades mas proximas que tiene una ciudad.
     */
    public function cityNearest($nameCity)
    {
        if (array_key_exists($nameCity, $this->travelAll))
            return $this->travelAll[$nameCity];  
    }



    /************************
     * public function addCanNotVisit($nextCities, $cantNot) 
     * Devuelve: Las en un array las ciudades que no se pueden visitar, para buscar el camino mas corto.
     */
    public function addCanNotVisit($nextCities, $cantNot)
    {
        $cantNot = array_merge($nextCities, $cantNot);
        return $cantNot;
    }



    /*************************
     * private function deleteCities($nextCities, $cantNot)
     * Elimina las ciudades que no se pueden visitar.
     */
    private function deleteCities($nextCities, $cantNot)
    {
        foreach($cantNot as $key => $val) {    
            unset($nextCities[$key]);
        }
        return $nextCities;
    }


    /***********************************
     * public function nextStop($toursMinTotal, $nextCities, $cantNot)
     * Funcion recursiva para evitar ciclos cerrados en el grafo.
     * Devuelve: La ciudad proxima que tiene que visitar.
     */
    public function nextStop($toursMinTotal, $nextCities, $cantNot)
    {
        $nextCities = $this->deleteCities($nextCities, $cantNot);

        if (count($nextCities) == 0)
            return false;

            
        $nextCity = $this->minCostCityNearest($nextCities);

        if (array_key_exists(array_key_last($nextCity), $toursMinTotal)) 
        {
            unset($nextCities[array_key_last($nextCity)]);
            return $this->nextStop($toursMinTotal, $nextCities, $cantNot);
        }   

        return $nextCity;
    }

    /***************************************************
     * public function minCostRouteTwoCities($origin, $end)
     * Devuelve el recorrido con coste minimo entre dos ciudades.
     */
    public function minCostRouteTwoCities($origin, $end) 
    {

        $cantNot = array($origin => 0);
        $toursMinTotal = array($origin => 0);

        if ($origin == $end)
            return $toursMinTotal;

        $cityVisited = $origin;


        $endTravel = false;
        while (!$endTravel)
        {

            $nextCities = $this->cityNearest($cityVisited);

            if (array_key_exists($end, $nextCities)) 
            {
                $toursMinTotal[$end] = $nextCities[$end];
                $endTravel = true;
            }
            else
            {

                $nextCity = $this->nextStop($toursMinTotal, $nextCities, $cantNot);

                if (!$nextCity)
                {
                    $this->deleteFisrtCity($origin);
                    return $this->minCostRouteTwoCities($origin, $end);
                }

                $cantNot = $this->addCanNotVisit($nextCities, $cantNot);

                $cityVisited = array_key_last( $nextCity );
                $cost = current( $nextCity );
    
                $toursMinTotal[$cityVisited]= $cost;

            }

        }

        return $toursMinTotal;
    }
    



}
