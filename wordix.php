<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Este modulo verifica que el usuario ingrese un número y no una letra
 * @param float $min
 * @param float $max
 * @return float
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero

    $numero = trim(fgets(STDIN));

    if (is_numeric($numero)) { //determina si un string es un número. puede ser float como entero.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
        if (is_numeric($numero)) {
            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * Escribe un mensaje de bienvenida al usuario
 * @param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/**
 * Modulo que obtiene la longitud de nros de carácteres de $cadena y comprueba que todas sean letras
 * @param int $cadena
 * @return boolean
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 *  Esta funcion se va a utilizar para que el usuario pueda ingresar una palabra de 5 letras, la cual si ingresa una palabra que no contenga 5 letras le pide que lo ingrese devuelta.
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * @param string $palabra
 * @param int $intentos
 * @return int
 */
function obtenerPuntajeWordix($palabra, $intentos){
    //int $puntajeFinal, $i
    //array $separarPalabra (arreglo indexado, valores string que pertenecen a cada letra de la palabra)
    //array $abc (arreglo multidimensional, los 3 índices tienen un tipo de letra)

    if($intentos<=6){
        $puntajeFinal = (CANT_INTENTOS+1) - $intentos;
    } else {
        $puntajeFinal = 0;
    }

    if($puntajeFinal>0){
        $separarPalabra = str_split($palabra);//str_split divide un texto y lo hace un arreglo de caracteres
        $abc[0] = ["A","E","I","O","U"];
        $abc[1] = ["B","C","D","F","G","H","J","K","L","M"];
        $abc[2] = ["N","Ñ","P","Q","R","S","T","V","W","X","Y","Z"];

        for($i=0;$i<5;$i++){
            if ($abc[0] == $separarPalabra[$i]){
                $puntajeFinal = $puntajeFinal + 1;
            } elseif ($abc[1] == $separarPalabra[$i]){
                $puntajeFinal = $puntajeFinal + 2;
            } else {
                $puntajeFinal = $puntajeFinal + 3;
            }
        }
    }
    return $puntajeFinal;
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    //array $arregloDeIntentosWordix, $teclado, int $nroIntento
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($palabraIntento,$nroIntento);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}



/**
 * Modulo 1
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