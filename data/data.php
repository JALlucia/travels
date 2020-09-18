<?php

/* 

$cities=['Logroño','Zaragoza','Teruel','Madrid','Lleida','Alicante','Castellón','Segovia','Ciudad Real'];
$connections=[[0,4,6,8,0,0,0,0,0],
        [4,0,2,0,2,0,0,0,0],
        [6,2,0,3,5,7,0,0,0],
        [8,0,3,0,0,0,0,0,0],
        [0,2,5,0,0,0,4,8,0],
        [0,0,7,0,0,0,3,0,7],
        [0,0,0,0,4,3,0,0,6],
        [0,0,0,0,8,0,0,0,4],
        [0,0,0,0,0,7,6,4,0]]; 
        
        */

/******************************************************
 * 
 *         He preferido trabajar en el siguiente formato.
 * 
 *         Aqui tambien se puede convertir cualquier dato recibido de una BBDD, API, o de donde sea y se adapta al siguiente formato:
 * 
 */


        $allCities=array('Logroño','Zaragoza','Teruel','Madrid','Lleida','Alicante','Castellón','Segovia','Ciudad Real');

        $allTravels = array(
            'Logroño' => array('Zaragoza' => 4, 'Teruel' => 6, 'Madrid' => 8),
            'Zaragoza' => array('Logroño' => 4, 'Lleida' => 2, 'Teruel' => 2),
            'Teruel' => array('Logroño' => 6, 'Zaragoza' =>2, 'Madrid' => 3, 'Lleida' => 5, 'Alicante' => 7),
            'Madrid' => array('Logroño' => 8, 'Teruel' => 3),
            'Lleida' => array('Zaragoza' => 2, 'Teruel' =>  5, 'Castellón' => 4, 'Segovia' => 8),
            'Alicante' => array('Teruel' => 7, 'Castellón' => 3, 'Ciudad Real' => 7),
            'Segovia' => array('Ciudad Real' => 6, 'Lleida' => 8),
            'Castellón' => array('Lleida' => 4, 'Alicante' => 3, 'Ciudad Real' => 6),
            'Ciudad Real' => array('Alicante' => 7, 'Castellón' => 6, 'Segovia' => 4)
        );




