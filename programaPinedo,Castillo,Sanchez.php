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
 * Este modulo va a funcionar para crear las 10 partidas minimas para el juego, donde $partida es un araray indexado donde dentro tiene un array asosiativo con los juegos prejugados donde luego a partida se lo cambia por coleccion de partidas y lo retorna.
 * //array $partida[] es un array indexado.
 * @return array
 * */ 
function cargarPartidas(){

    $partida[0]= array("palabraWordix" => "TINTO", "jugador" => "Valentina", "intentos" => 1, "puntaje" => 14);
    $partida[1]= array("palabraWordix" => "TINTO", "jugador" => "Valentina", "intentos" => 6, "puntaje" => 0);  
    $partida[2]= array("palabraWordix" => "PERRO", "jugador" => "Maria", "intentos" => 4, "puntaje" => 13); 
    $partida[3]= array("palabraWordix" => "ARBOL", "jugador" => "Pedro", "intentos" => 3, "puntaje" => 13); 
    $partida[4]= array("palabraWordix" => "GATOS", "jugador" => "Tomas", "intentos" => 6, "puntaje" => 0); 
    $partida[5]= array("palabraWordix" => "MUJER", "jugador" => "Tomas", "intentos" => 0, "puntaje" => 0); 
    $partida[6]= array("palabraWordix" => "VERDE", "jugador" => "Alejandro", "intentos" => 3, "puntaje" => 14); 
    $partida[7]= array("palabraWordix" => "MELON", "jugador" => "Martin", "intentos" => 2, "puntaje" => 15); 
    $partida[8]= array("palabraWordix" => "HUEVO", "jugador" => "Javie", "intentos" => 5, "puntaje" => 9); 
    $partida[9]= array("palabraWordix" => "GOTAS", "jugador" => "Emanuel", "intentos" => 2, "puntaje" => 15); 

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
 * Modulo 6.
 * Este modulo retorna los datos de una partida solicitada por el usuario.
 * @param string $todasLasPartidas, $datosDePartida
 * @param int $cantidadPartidas, $numPartida
 * @return $infoPartida
 */
function datosPartida($numPartida) {
    $todasLasPartidas=cargarPartidas();
    
    if($numPartida>=0 && $numPartida<count($todasLasPartidas)){
        $datosDePartida= $todasLasPartidas[$numPartida -1];
        $infoPartida="Partida WORDIX $numPartida: palabra ". $datosDePartida["palabraWordix"]. "\n".
        "Jugador: " . $datosDePartida["jugador"]. "\n".
        "Puntaje: ". $datosDePartida["puntaje"]. " puntos \n";
        if($datosDePartida["puntaje"]>0){
            $infoPartida.="Adivinó la palabra en ".$datosDePartida["intentos"]." intentos \n";
        }
        else{
            $infoPartida.="No adivinó la palabra";
        }

       }

    else{
        $infoPartida="El numero de partida no existe.";
    }
    return $infoPartida;
}


/**
 * Modulo 7
 * Este modulo tiene la funcion de tomar la palabra nueva que quiere ingresar el usuario, meterla en el array de coleccion de palabras y luego retornar el mismo array pero con la nueva palabra agregada
 * @param string $coleccionPalabras, $palabraNueva
 */

 function agregarPalabra($coleccionPalabras, $palabraNueva){

    $coleccionPalabras[]=$palabraNueva;

    return $coleccionPalabras;
 }



 //Consigna 8
/**
 * @param array $collecPartida
 * @param string $jugador
 * @return int
 */
function primerPartida($collecPartida,$jugador){
    //int $partidaGanada
    $partidaGanada=-1;
    foreach($collecPartida as $value){
        if ($value["jugador"]==$jugador && $value["puntaje"]>0){
            $partidaGanada=$value;
        }
    }
    return $partidaGanada;
}

/** Modulo 9
 *  Este modulo retorna un string que comparte informacion sobre un jugador solicitado por el usuario
 * @param string $nombreDeJugador, $buscarJugador
 * @param int $partidasJugadas, $victorias, $sumaPuntaje, $porcentajeVictorias
 * @return string $resumenDelJugador 
 */
function resumenJugador2($nombreDeJugador){
    $datosDePartida=cargarPartidas();
    $buscarJugador=strtolower($nombreDeJugador);
    $partidasJugadas=0;
    $victorias=0;
    $sumaPuntaje=0;
    if($datosDePartida["jugador"] == $buscarJugador){
        //@param string $indice
        foreach($datosDePartida as $indice){
            
            if($indice["jugador"]==$buscarJugador){
                $partidasJugadas++;
                //@param int $intPuntos
                $intPuntos=(int)$indice["puntaje"];
                $sumaPuntaje= $sumaPuntaje + $intPuntos;
                if($intPuntos>0){
                    $victorias++;
                }

            }
        }
        
        if($partidasJugadas>0){
            $porcentajeVictorias= $victorias / $partidasJugadas * 100;
        }
        else{
            $porcentajeVictorias="0%";
        }
        $resumenDelJugador="Jugador: ". $buscarJugador."\n".
        "Partidas: ". $partidasJugadas."\n".
        "Puntaje final: ". $sumaPuntaje."\n".
        "Victorias: ". $victorias."\n".
        "Porcentaje de victorias: ". $porcentajeVictorias."\n";
        
    }
    else{
        $resumenDelJugador="Este jugador no existe.";
    }
    return $resumenDelJugador;
}

//Consinga 10
/**
 * @return string
 */
function solicitarJugador(){
    //string $nombre
    echo "Ingrese su nombre ";
    $nombre=trim(fgets(STDIN));
    $nombre=strtolower($nombre);//el nombre pasa a minúsculas
    switch ($nombre) {
        case "": //si no ingresa nada, se le asigna "1" a nombre, para q se repita la condición y vuelva a ingresar el nombre.
            $nombre = "1";
            break;
    }
    while($nombre[0] != ctype_alpha($nombre[0])){//verifica que el primer caracter sea una letra y se repite hasta q empiece por una letra.
        echo "Ingrese su nombre con el 1er caracter como una letra ";
        $nombre=trim(fgets(STDIN));
        switch ($nombre) {
            case "":
                $nombre = "1";
                break;
        }
    } 
    $nombre = strtolower($nombre);
    return $nombre;
}



/**
 * Modulo 11 (comparacion)
 * @param array $a, $b
 * @return int
 */

 function cmp($a, $b) {
    if (strcasecmp($a["jugador"], $b["jugador"]) == 0){ // Primero, compara por el nombre del jugador y si es igual a 0 entra al if
         return strcasecmp($a["palabraWordix"], $b["palabraWordix"]);
     } else {
        return strcasecmp($a["jugador"], $b["jugador"]); //Si los nombres no son iguales a 0, entonces se ordena según el nombre
     }
    }

/**
 * Modulo 11
 * @param array $collec
 */

 function partidasOrdenadas($collec){
    uasort($collec,'cmp'); //uasort ordena el array asociativo
    print_r($collec); //print_r va a imprimir el array
 }



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$coleccionPartidas=cargarPartidas();
$numAnterior=0;
$palabrasDisponibles = cargarColeccionPalabras();
$PedirNombre= solicitarJugador();
$datoPartida3=  datosPartida($numPartida);



//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

do {
    $opcion = seleccionarOpcion();
    echo $opcion;

    switch ($opcion) {
        case 1: 
            echo $PedirNombre;
            $nombre=trim(fgets(STDIN));

            echo "selecciona un numero para empezar a jugar";
            $numElegido=trim(fgets(STDIN));
            if ($numElegido>=1 && $numElegido< count($coleccionPalabras)){
                if($numElegido  == $numAnterior ){
                    echo "Ya utilizo este numero, ingrese otro";
                    $numElegido=trim(fgets(STDIN));
                }
                $numAnterior = $numElegido;
                
        $partida= jugarWordix($numElegido, strtolower($nombre)) ;
            }

            $coleccionPartidas[]=  array("palabraWordix" => $numElegido, "jugador" => $nombre, "intentos" => $intentos, "puntaje" => $puntajeFinal);
            break;
        case 2: 
            echo $PedirNombre;
            $nombre=trim(fgets(STDIN));

            $palabraElegida = $palabrasDisponibles[array_rand($palabrasDisponibles)];

            $partida= jugarWordix($palabraElegida, strtolower($nombre));

            $coleccionPartidas[]=  array("palabraWordix" => $palabraElegida, "jugador" => $nombre, "intentos" => $intentos, "puntaje" => $puntajeFinal);

            break;
        case 3: 
            echo $PedirNombre;
            $nombre=trim(fgets(STDIN));

            echo $datoPartida3;

            break;
            
        
    }
} while ($opcion>=1 && $opcion<8);

echo seleccionarOpcion();