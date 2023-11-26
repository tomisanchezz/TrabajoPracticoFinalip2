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
    //array $separarPalabra (arreglo indexado, valores string que pertenecen a cada letra de la palabra)
    //array $abc (arreglo multidimensional, los 3 índices tienen un tipo de letra)

    if($intentos<=6){
        $puntajeFinal = (CANT_INTENTOS+1) - $intentos;
    } else {
        $puntajeFinal = 0;
    }

    if($puntajeFinal>0){//Va a determinar el puntaje según las letras de la palabra
        $separarPalabra = str_split($palabra);//str_split divide un texto y lo hace un arreglo de caracteres
        $abc[0] = ["A","E","I","O","U"];
        $abc[1] = ["B","C","D","F","G","H","J","K","L","M"];
        $abc[2] = ["N","Ñ","P","Q","R","S","T","V","W","X","Y","Z"];

        for($i=0;$i<5;$i++){
            if(in_array($separarPalabra[$i], $abc[0])){//Si el valor de $separarPalabra esta en $abc[0], entonces dará true y se sumará un punto
                $puntajeFinal = $puntajeFinal + 1;
            } elseif (in_array($separarPalabra[$i], $abc[1])){
                $puntajeFinal = $puntajeFinal + 2;
            } elseif (in_array($separarPalabra[$i], $abc[2])){
                $puntajeFinal = $puntajeFinal + 3;
            }
        }
    }
}



/**
 * Modulo que retorna true 
 * @param array $letra, $grupo
 * @return boolean
 */
/**function pertenece($letra,$grupo){
    //boolean $abecedario
    $abecedario=false;
    foreach ($grupo as $letrasArreglo) {
    if($letrasArreglo === $letra){
            $abecedario=true;
        }
    }
    return $abecedario;
}
*/


/**
 * @param string $palabra
 * @param int $intentos
 * @return int
 */
/**function obtenerPuntajeWordix($palabra, $intentos){
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

            foreach($separarPalabra as $letra2){
                $perteneceAlGrupo=pertenece($letra2,$abc[0]);
                if($perteneceAlGrupo){
                    $puntajeFinal = $puntajeFinal + 1;
                } else {
                    $perteneceAlGrupo=pertenece($letra2, $abc[1]);
                    if ($perteneceAlGrupo) {
                        $puntajeFinal = $puntajeFinal + 2;
                    } else {
                        $perteneceAlGrupo=pertenece($letra2, $abc[2]);
                        if ($perteneceAlGrupo) {
                            $puntajeFinal = $puntajeFinal + 3;
                        }
                    }
                }
            }
    }
    return $puntajeFinal;
}
*/


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
 * Función que verifica que el usuario no repita la palabra
 * @param array $collecionPalabras, $partidasCargadas
 * @param string $usuario
 */
function palabraRepetida($collecionPalabras, $usuario, $partidasCargadas){
    //int $cantPalabras, $numPalabraElegida, $palabrasUsadas, $cantPartidas
    //string $palabraElegida
    //boolean $controlPalabra, $control

    $cantPalabras = count($collecionPalabras);
    echo "Hay " .$cantPalabras. " palabras, seleccione una para jugar ";
    $numPalabraElegida = solicitarNumeroEntre(1, $cantPalabras);
    $numPalabraElegida = (int)$cantPalabras - 1;
    $palabraElegida = $collecionPalabras[$numPalabraElegida];
    $controlPalabra = true;
    $indicePartidas = 0;
    $cantPartidas = count($partidasCargadas);
    while($controlPalabra) {
        while($indicePartidas < $cantPartidas) {
            if($partidasCargadas[$indicePartidas]["jugador"] == $usuario && $partidasCargadas[$indicePartidas]["palabraWordix"] == $palabraElegida) {
                echo "esta palabra ya fue usada, elija otra. ";
                $numPalabraElegida = solicitarNumeroEntre(1, $cantPalabras);
                $numPalabraElegida = (int)$cantPalabras - 1;
                $palabraElegida = $collecionPalabras[$numPalabraElegida];
                $indicePartidas = 0;
                $palabraFinal = opcionesFinales($collecionPalabras, $usuario, $partidasCargadas);
                if($palabraFinal){
                    $controlPalabra = false;
                }

            }
        }

    }
}



/**
 * Funcion para jugar wordix con una palabra aleatoria
 * @param array $collecionPalabrasAleatorias, $partidasCargadasAleatorias
 * @param string $usuarioRandom
 */
function palabraRandom($collecionPalabrasAleatorias, $usuarioRandom, $partidasCargadasAleatorias) {
    //int $indicePalabraAleatoria, $indiceAleatorio, $cantPartidasAleatorio
    //string $palabraAleatoria
    //boolean $controlPalabraAleatoria, $controlAleatorio

    $indicePalabraAleatoria = array_rand($collecionPalabrasAleatorias);//array_rand va a devolver una palabra aleatoria.
    $palabraAleatoria = $collecionPalabrasAleatorias[$indicePalabraAleatoria];
    $indiceAleatorio = 0;
    $cantPartidasAleatorio = count($partidasCargadasAleatorias);
    $controlPalabraAleatoria = true;
    $controlAleatorio = false;

}



/**
 * Funcion para cuando el jugador se quede sin palabras para jugar.
 * @param array $collecionFinal, $partidasFinal
 * @param string $usuarioFinal
 * @return boolean
 */
function opcionesFinales($collecionPalabrasFinal, $usuarioFinal, $partidasFinal) {
    //int $cantPalabrasFinal, $cantPartidasFinal
    //boolean $resultadoFinal
    $cantPalabrasFinal = count($collecionPalabrasFinal);
    $cantPartidasFinal = 0;
    $resultadoFinal = false;
    foreach($partidasFinal as $totalPartidas){
        if($totalPartidas["jugador"] == $usuarioFinal){
            $cantPartidasFinal = $cantPartidasFinal + 1;
        }
        if($cantPalabrasFinal == $cantPartidasFinal){
            echo "Ya se jugaron todas las partidas. ";
            $resultadoFinal = true;
        }

    }

    return $resultadoFinal;
}



/**
 * Mostrar primer partida ganadora de un usuario
 * @param string $nombre
 * @param array $listaDePartidas (Funcion cargarPartidas)
 * @return int
 */
function mostrarPartidaGanadora($nombre, $listaDePartidas){
    //int $indiceDePartidaGanada, $cantPartidasListado
    //array $partidaGanada
    //boolean $condicion
    $condicion = false;
    $indiceDePartidaGanada = 0;
    $cantPartidasListado = count($listaDePartidas);
    $partidaGanada = [];

    while($indiceDePartidaGanada < $cantPartidasListado && !$condicion){
        if($listaDePartidas[$indiceDePartidaGanada]["jugador"] == $nombre){
            $partidaGanada = $listaDePartidas[$indiceDePartidaGanada];
        }
        if ($partidaGanada["jugador"] == $nombre && $partidaGanada["puntaje"] > 0){
            $condicion = true;
            $indiceDePartidaGanada;
        } else {
            $partidaGanada = $partidaGanada + 1;
        }
    }
    return $indiceDePartidaGanada;
}