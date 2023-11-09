<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
// Sanchez, TOMAS. FAI-4494. TUDW. tomas.sanchez2004@est.fi.uncoma.edu.ar. tomisanchezz.

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ****COMPLETAR***** */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**1)Funcion cargarColeccionPalabras */
/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS", 
        "ARBOL", "MUNDO", "PERRO", "VACAS", "MOUSE"
        
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR CON TODAS LAS FUNCIONES***** */

/**
 * Este modulo va a funcionar para crear las 10 partidas minimas para el juego, donde partidas1-10 son las jugadas dentro de un array multidimensional $coleccionPartidas
 * @return array
 * */ 
function cargarPartidas(){
$partida1=["palabraWordix "=> "TINTO" , "jugador" => "Tomas", "intentos"=> 1, "puntaje" => 14];
$partida2=["palabraWordix "=> "MOUSE" , "jugador" => "Tomas", "intentos"=> 2, "puntaje" => 13];
$partida3=["palabraWordix "=> "PERRO" , "jugador" => "Tomas", "intentos"=> 4, "puntaje" => 13];
$partida4=["palabraWordix "=> "ARBOL" , "jugador" => "Tomas", "intentos"=> 3, "puntaje" => 13];
$partida5=["palabraWordix "=> "GATOS" , "jugador" => "Tomas", "intentos"=> 6, "puntaje" => 0];
$partida6=["palabraWordix "=> "VERDE" , "jugador" => "Tomas", "intentos"=> 3, "puntaje" => 14];
$partida7=["palabraWordix "=> "MELON" , "jugador" => "Tomas", "intentos"=> 2, "puntaje" => 15];
$partida8=["palabraWordix "=> "HUEVO" , "jugador" => "Tomas", "intentos"=> 5, "puntaje" => 9];
$partida9=["palabraWordix "=> "GOTAS" , "jugador" => "Tomas", "intentos"=> 2, "puntaje" => 15];
$partida10=["palabraWordix "=> "MUJER" , "jugador" => "Tomas", "intentos"=> 0, "puntaje" => 0];

$coleccionPartidas= [$partida1,$partida2,$partida3,$partida4,$partida5,$partida6,$partida7,$partida8,$partida9,$partida10];

return $coleccionPartidas;
} 

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
