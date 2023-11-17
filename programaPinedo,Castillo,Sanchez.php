<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
// Sanchez, TOMAS. FAI-4494. TUDW. tomas.sanchez2004@est.fi.uncoma.edu.ar. tomisanchezz.
// Pinedo, Emanuel. FAI-4871. TUDW emanuel.pinedo@est.fi.uncoma.edu.ar.
// Javier, Castillo. FAI-4936. TUDW javier.castillo@est.fi.uncoma.edu.ar. JaviCast03
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

//*MODULO 1 en el archivo WORDIX.php**//


/**
 * Modulo 2
 * Este modulo va a funcionar para crear las 10 partidas minimas para el juego, donde $partida es un araray indexado con los juegos prejugados donde luego a partida se lo cambia por coleccion de partidas y lo retorna.
 * //array $partida[] es un array indexado.
 * @return array
 * */ 
function cargarPartidas(){

    $partida = array(
        array("palabraWordix" => "TINTO", "jugador" => "Valentina", "intentos" => 1, "puntaje" => 14),
        array("palabraWordix" => "TINTO", "jugador" => "Valentina", "intentos" => 1, "puntaje" => 14),
        array("palabraWordix" => "PERRO", "jugador" => "Maria", "intentos" => 4, "puntaje" => 13),
        array("palabraWordix" => "ARBOL", "jugador" => "Pedro", "intentos" => 3, "puntaje" => 13),
        array("palabraWordix" => "GATOS", "jugador" => "Tomas", "intentos" => 6, "puntaje" => 0),
        array("palabraWordix" => "VERDE", "jugador" => "Alejandro", "intentos" => 3, "puntaje" => 14),
        array("palabraWordix" => "MELON", "jugador" => "Martin", "intentos" => 2, "puntaje" => 15),
        array("palabraWordix" => "HUEVO", "jugador" => "Javie", "intentos" => 5, "puntaje" => 9),
        array("palabraWordix" => "GOTAS", "jugador" => "Emanuel", "intentos" => 2, "puntaje" => 15),
        array("palabraWordix" => "MUJER", "jugador" => "Tomas", "intentos" => 0, "puntaje" => 0)
    );

    return $partida;
} 

/** 
 * Modulo 3
 * Esta funcion le visualiza al usuario el menu de seleccion para poder jugar (tiene 7 modos y el 8 es el exit), si el usuario ingresa un numero menor a 1 y mayor a 9 se repite el menu hasta que el usuario ingrese un numero
 * @param string $menu
 * @param int $numeroOpcionMenu
 *@return int $numeroOpcionMenu
 */
function seleccionarOpcion(){
    
    $menu="
    1) Jugar al wordix con una palabra elegida \n
    2) Jugar al wordix con una palara aleatoria\n
    3) Mostrar una partida\n
    4) Mostrar la primer partida ganadora\n
    5) Mostrar resumen del jugador\n
    6) Mostrar listado de partidas ordenads por jugador y por palabra\n
    7) Agregar una palabra de 5 letras a wordix\n
    8) Salir\n
    ";

    echo $menu;
    $numeroOpcionMenu=trim(fgets(STDIN));

    while($numeroOpcionMenu<1 || $numeroOpcionMenu>8){
        echo "Numero invalido ingrese un numero entre 1-8";
        echo $menu;
        $numeroOpcionMenu=trim(fgets(STDIN));
    }

    return $numeroOpcionMenu;
    }

//*MODULOS 4 Y 5 en el archivo WORDIX.php**//

/**
 * Modulo 7
 * Este modulo tiene la funcion de tomar la palabra nueva que quiere ingresar el usuario, meterla en el array de coleccion de palabras y luego retornar el mismo array pero con la nueva palabra agregada
 * @param string $coleccionPalabras, $palabraNueva
 */

 function agregarPalabra($coleccionPalabras, $palabraNueva){

    $coleccionPalabras[]=$palabraNueva;

    return $coleccionPalabras;
 }

 /**
  * Modulo 10
  *Este modulo solicita al usuario el ingreso de un nombre de jugador, asegurándose de que comience con una letra y devolviendo el nombre en minúsculas.
  *@param string $nombreIngresado
  *@return $nombreIngresado
  */
 function solicitarjugador(){

     echo"Ingrese el nombre de un jugador: ";
    $nombreIngresado=trim(fgets(STDIN));

    if(!ctype_alpha($nombreIngresado[0])){
        while(!ctype_alpha($nombreIngresado[0])){
            echo"Ingrese el nombre de un jugador: ";
            $nombreIngresado=trim(fgets(STDIN));
        }
    }

    return strtolower($nombreIngresado);
 }

/**
 * Modulo 11
 * 
 */

 function cmp($a, $b) {
   // Primero, compara por el nombre del jugador
    $resultado = strcasecmp($a["jugador"], $b["jugador"]);

    // Si los nombres son iguales, compara por la palabra
    if ($resultado == 0) {
        $resultado = strcasecmp($a["palabraWordix"], $b["palabraWordix"]);
    }

$coleccionPartidas = cargarPartidas();
// Ordenar la colección de partidas usando uasort y la función de comparación
uasort($coleccionPartidas, "cmp");
// Mostrar el resultado usando print_r, solo nombre y palabra
foreach ($coleccionPartidas as $partida) {
    echo "Jugador: " . $partida["jugador"] . ", Palabra: " . $partida["palabraWordix"];
}

 }



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$collecionPartidas=cargarPartidas();

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
echo seleccionarOpcion();