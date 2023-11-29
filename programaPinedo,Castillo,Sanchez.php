<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
// Sanchez, TOMAS. FAI-4494. TUDW. tomas.sanchez2004@est.fi.uncoma.edu.ar. tomisanchezz.
// Pinedo, Emanuel. FAI-4871. TUDW emanuel.pinedo@est.fi.uncoma.edu.ar. emanuelPinedo.
// Javier, Castillo. FAI-4936. TUDW javier.castillo@est.fi.uncoma.edu.ar. JaviCast03.

/*************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**1)Funcion cargarColeccionPalabras */
/**
 * Esta funcion retorna un array con una coleccion de palabras(elementos del array) que se van a utilizar para ser adivinadas una vez iniciado el juego.
 * array $coleccionPalabras es un areglo indexado(indices numericos).
 * @return array - retorna un array indexado con palabras.
 */
function cargarColeccionPalabras(){
    
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS", 
        "ARBOL", "MUNDO", "PERRO", "VACAS", "MOUSE"
    ];
    
    return ($coleccionPalabras);
}

//*MODULO 1 en el archivo WORDIX.php**//
/**
 * Modulo 2
 * Este modulo crea las 10 partidas minimas precargadas para que el juego funcione. 
 * //array $collecPartida[] es un array indexado que contiene dentro arrays asosiativos.
 * @return array - retorna un array con 10 partidas precargadas
 * */ 
function cargarPartidas(){

    //se cargan las partidas dependiendo el indice
    $collecPartida[0]= array("palabraWordix" => "TINTO", "jugador" => "valentina", "intentos" => 1, "puntaje" => 14);
    $collecPartida[1]= array("palabraWordix" => "MOUSE", "jugador" => "valentina", "intentos" => 6, "puntaje" => 0);  
    $collecPartida[2]= array("palabraWordix" => "PERRO", "jugador" => "maria", "intentos" => 4, "puntaje" => 13); 
    $collecPartida[3]= array("palabraWordix" => "ARBOL", "jugador" => "pedro", "intentos" => 3, "puntaje" => 13); 
    $collecPartida[4]= array("palabraWordix" => "GATOS", "jugador" => "tomas", "intentos" => 6, "puntaje" => 0); 
    $collecPartida[5]= array("palabraWordix" => "MUJER", "jugador" => "tomas", "intentos" => 0, "puntaje" => 0); 
    $collecPartida[6]= array("palabraWordix" => "VERDE", "jugador" => "alejandro", "intentos" => 3, "puntaje" => 14); 
    $collecPartida[7]= array("palabraWordix" => "MELON", "jugador" => "martin", "intentos" => 2, "puntaje" => 15); 
    $collecPartida[8]= array("palabraWordix" => "HUEVO", "jugador" => "javier", "intentos" => 5, "puntaje" => 9); 
    $collecPartida[9]= array("palabraWordix" => "GOTAS", "jugador" => "emanuel", "intentos" => 2, "puntaje" => 15); 

    //retorna las 10 partidas.
    return $collecPartida;
} 

/** 
 * Modulo 3
 * Esta funcion le visualiza al usuario el menu de seleccion para poder jugar (tiene 7 modos y el 8 es el exit), si el usuario ingresa un numero menor a 1 y mayor a 9 se repite el menu hasta que el usuario ingrese un nuevo numero.
 * @param string $menu
 * @param int $numeroOpcionMenu
 *@return int $numeroOpcionMenu - retorna numero seleccionado del usuario
 */
function seleccionarOpcion(){

    //Menu con las opciones disponibles
    $menu="
    Elija una opcion para poder jugar del 1-7, pulse 8 (salir) para terminar el juego.\n
    1) Jugar al wordix con una palabra elegida \n
    2) Jugar al wordix con una palara aleatoria\n
    3) Mostrar una partida\n
    4) Mostrar la primer partida ganadora\n
    5) Mostrar resumen del jugador\n
    6) Mostrar listado de partidas ordenadas por jugador y por palabra\n
    7) Agregar una palabra de 5 letras a wordix\n
    8) Salir\n
    ";

    //imprime el menu
    echo $menu;
    //obtiene la opcion seleccionada por el usuario
    $numeroOpcionMenu=trim(fgets(STDIN));

    //valida que la opcion ingresada sea valida
    while($numeroOpcionMenu<1 || $numeroOpcionMenu>8){
        echo "Numero invalido ingrese un numero entre 1-8";
        echo $menu;
        $numeroOpcionMenu=trim(fgets(STDIN));
    }

    //retorna el numero de la opcion seleccionada por el usuario.
    return $numeroOpcionMenu;
    }

//*MODULOS 4 Y 5 en el archivo WORDIX.php**//
/**
 * Modulo 6.
 * El modulo retorna informacion detallada de una partida especifica la cual permite a los usuarios revisar sus partidas pasadas, identificandola por el numero que ingresa el usuario.
 * @param string $todasLasPartidas, $datosDePartida
 * @param int $cantidadPartidas, $numPartida
 * @return string $respuesta - mensaje detallado de partida seleccionada
 */
function datosPartida($numPartida, $partidas) {
    // Verifica que el número de partida sea válido
    if ($numPartida >= 0 && $numPartida < count($partidas)) {
        // Obtiene los datos de la partida seleccionada
        $datosPartida = $partidas[$numPartida];
        
        // Construye la respuesta detallada de la partida
        $respuesta = "*******\n" . "Partida Wordix $numPartida: " . "Palabra: " . $datosPartida["palabraWordix"] . 
        "\n" . "Jugador: " . $datosPartida["jugador"] . "\n" . "Puntaje: " . $datosPartida["puntaje"] . "\n" . 
        "Intentos: " . $datosPartida["intentos"] . "\n" . "*******\n";
    } else {
        // Si el número de partida es inválido, devuelve un mensaje de error
        $respuesta = "Error: Número de partida inválido.\n";
    }
    
    // Retorna la respuesta
    return $respuesta;
}

/**
 * Modulo 7
 * Este modulo tiene la funcion de tomar la palabra nueva que quiere ingresar el usuario, meterla en el array de coleccion de palabras y luego retornar el mismo array pero con la nueva palabra agregada
 * array $coleccionPalabras ya explicado en el cargarColeccionPalabras().
 * @param string $coleccionPalabras, $palabraNueva.
 * @return string array $coleccionPalabras - retorna el array colecionPalabras pero con la nueva palabra
 */

 function agregarPalabra($coleccionPalabras, $palabraNueva){

    //agrega la nueva palabra al final del array
    $coleccionPalabras[]=$palabraNueva;

    //retorna el array actualizado
    return $coleccionPalabras;
 }

 //Consigna 8
/**
 * Este modulo busca y retorna la informacion sobre la primera partida ganada por un jugador especifico introducido por el usuario.
 * @param array $coleccPartida
 * @param string $jugador
 * @return int
 */
function primerPartida($coleccPartida,$jugador){
    //incializacion de variables

    $i=0;
    $vic=false;

    //Array para almacenar la información de la primera partida ganada por el jugador
    $jugadorVictoria=array("palabraWordix" => "", "jugador" => "", "intentos" => 0, "puntaje" => 0);
    
    // Recorre las partidas para encontrar la primera ganada por el jugador
    foreach($coleccPartida as $elemento){
        $i++;

        //Si encuentra una partida ganada por el jugador, almacena la información y sale del bucle
        if($elemento["jugador"]==$jugador && $elemento["puntaje"]>0){
            $vic=true;
            $jugadorVictoria["palabraWordix"]=$elemento["palabraWordix"];
            $jugadorVictoria["jugador"]=$elemento["jugador"];
            $jugadorVictoria["intentos"]=$elemento["intentos"];
            $jugadorVictoria["puntaje"]=$elemento["puntaje"];
            break;
        }
        
    }

    // Genera la respuesta en base a si se encontró una partida ganada o no
    if($vic){
        $partidaGanada="***************************************************\n".
            "Partida WORDIX ". ($i).": palabra " . $jugadorVictoria["palabraWordix"]."\n".
            "Jugador: ". $jugadorVictoria["jugador"]. "\n".
            "Puntaje: ".$jugadorVictoria["puntaje"]."\n".
            "Intento: Adivinó la palabra en ". $jugadorVictoria["intentos"]." intentos \n".
            "***************************************************\n";
    }
    else{
        $partidaGanada="El jugador $jugador no ganó ninguna collecPartida.";
    }

    // Retorna la información de la partida ganada o el mensaje de que no se encontró ninguna
    return $partidaGanada;
}
            
/** Modulo 9
 *  Este modulo genera un resumen detallado en el desempeño de un jugador con todas sus partidas brindando una vision sobre su rendimiento.
 * array arrayResumen es un array asociativo
 * @param string $nombreDeJugador, $buscarJugador
 * @param int $partidasJugadas, $victorias, $sumaPuntaje, $porcentajeVictorias
 * @return string $resumenDelJugador - info detallada del jugador
 */
function resumenJugador($nombreDeJugador, $collecPartida) {
    // Inicialización del array asociativo $arrayResumen para almacenar la información del jugador
    $arrayResumen = [
        "jugador" => "",
        "partidas" => 0,
        "puntaje" => 0,
        "victorias" => 0,
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    // Recorre las partidas para recopilar información del jugador
    foreach ($collecPartida as $unaPartida) {
        // Verifica si la partida corresponde al jugador en cuestión
        if ($nombreDeJugador == $unaPartida["jugador"]) {
            $arrayResumen["jugador"] = $nombreDeJugador;
            $arrayResumen["partidas"] += 1;
            $arrayResumen["puntaje"] += $unaPartida["puntaje"];

            // Incrementa el contador de victorias si el puntaje de la partida es mayor que 0
            if ($unaPartida["puntaje"] > 0) {
                $arrayResumen["victorias"] += 1;
            }

            // Utiliza un switch para contar la frecuencia de cada número de intentos en las partidas del jugador
            switch ($unaPartida["intentos"]) {
                case 1:
                    $arrayResumen["intento1"] += 1;
                    break;
                case 2:
                    $arrayResumen["intento2"] += 1;
                    break;
                case 3:
                    $arrayResumen["intento3"] += 1;
                    break;
                case 4:
                    $arrayResumen["intento4"] += 1;
                    break;
                case 5:
                    $arrayResumen["intento5"] += 1;
                    break;
                case 6:
                    $arrayResumen["intento6"] += 1;
                    break;
            }
        }
    }

    // Construcción de la respuesta final
    $resp1 = "***************************************************\n" .
        "Jugador: " . $arrayResumen["jugador"] . "\n" .
        "Partidas: " . $arrayResumen["partidas"] . "\n" .
        "Puntaje final: " . $arrayResumen["puntaje"] . "\n" .
        "Victorias: " . $arrayResumen["victorias"] . "\n";

    // Calcula y agrega el porcentaje de victorias al resumen, o establece 0% si no hay partidas
    if ($arrayResumen["partidas"] > 0) {
        $porcentajeVictorias = $arrayResumen["victorias"] / $arrayResumen["partidas"] * 100;
        $resp2 = "Porcentaje de victorias: " . $porcentajeVictorias . "%\n";
    } else {
        $resp2 = "Porcentaje de victorias: 0% \n";
    }

    // Agrega la información detallada sobre los intentos de adivinanza al resumen
    $resp3 = "Adivinadas: \n" . "     Intento 1: " . $arrayResumen["intento1"] . "\n" .
        "     Intento 2: " . $arrayResumen["intento2"] . "\n" . "     Intento 3: " . $arrayResumen["intento3"] . "\n" .
        "     Intento 4: " . $arrayResumen["intento4"] . "\n" . "     Intento 5: " . $arrayResumen["intento5"] . "\n" .
        "     Intento 6: " . $arrayResumen["intento6"] . "\n" . "***************************************************\n";

    // Retorna el resumen del jugador como un array con tres elementos
    $arrayRespuesta = [$resp1, $resp2, $resp3];
    return $arrayRespuesta;
}



//MODULO 10
/**
 * Este modulo solicita al usuario ingresar un nombre donde realiza validaciones para que el nombre ingresado sea valido. Transforma la palabra ingresadas a minusculas.
 * @param string $nombre
 * @return strin  $nombre
 */
function solicitarJugador(){
    //string $nombre
    echo "Ingrese su nombre: ";
    $nombre=trim(fgets(STDIN));
    $nombre=strtolower($nombre);//strtolower se utiliza para cambiar la variable a minusculas
    switch ($nombre) {
        case "": //si no ingresa nada, se le asigna "1" a nombre, para q se repita la condición y vuelva a ingresar el nombre.
            $nombre = "1";
            break;
    }
    while($nombre[0] != ctype_alpha($nombre[0])){//verifica que el primer caracter sea una letra y se repite hasta q empiece por una letra.
        echo "\nIngrese su nombre con el 1er caracter como una letra \n";
        $nombre=trim(fgets(STDIN));
        switch ($nombre) {
            case "":
                $nombre = "1";
                break;
        }
    } 
    
    return strtolower($nombre);
}

/**
 * Modulo 11 (comparacion)
 * Este modulo es de comparacion, inciando por el nombre del jugador y luego por la palabra wordix.
 *  $a y $b son arrays asociativos multidimensionales, ya que contienen múltiples pares clave-valor y se utilizan en un contexto de comparación.
 * @param array $a, $b
 * @return int
 */

 function cmp($a, $b) {
    if (strcasecmp($a["jugador"], $b["jugador"]) == 0){ // Primero, compara por el nombre del jugador y si es igual a 0 entra al if
         return strcasecmp($a["palabraWordix"], $b["palabraWordix"]);//se utiliza para comparar cadenas de texto sin distinguir mayúsculas de minúsculas
     } else {
        return strcasecmp($a["jugador"], $b["jugador"]); //Si los nombres no son iguales a 0, entonces se ordena según el nombre
     }
    }

/**
 * Modulo 11.
 * Ordena la coleccion de partidas segun el nombre del jugador y luego la palabra, dependiendo de la funcion cmp()
 * @param array $collec
 */

 function partidasOrdenadas($collecPartida){
    uasort($collecPartida,'cmp'); //uasort ordena el array asociativo
    print_r($collecPartida); //print_r va a imprimir el array
 }
 /**
 * Función que maneja las opciones finales cuando el jugador se queda sin palabras para jugar.
 *
 * @param array $collecionPalabrasFinal - Colección de palabras disponibles.
 * @param string $usuarioFinal - Nombre del jugador.
 * @param array $partidasFinal - Lista de partidas jugadas.
 * @return boolean - Devuelve true si se jugaron todas las palabras, false de lo contrario.
 */
function opcionesFinales($collecionPalabrasFinal, $usuarioFinal, $partidasFinal) {
    // Obtener la cantidad de palabras y partidas
    $cantPalabrasFinal = count($collecionPalabrasFinal);
    $cantPartidasFinal = 0;
    $resultadoFinal = false;

    // Contar las partidas del jugador
    foreach($partidasFinal as $totalPartidas){
        if($totalPartidas["jugador"] == $usuarioFinal){
            $cantPartidasFinal++;
        }

        // Verificar si se jugaron todas las palabras
        if($cantPalabrasFinal == $cantPartidasFinal){
            echo "Ya se jugaron todas las partidas. ";
            $resultadoFinal = true;
        }
    }

    return $resultadoFinal;
}

/**
 * Función que verifica si un usuario existe en la lista de partidas.
 *
 * @param string $user - Nombre de usuario a verificar.
 * @param array $partidasLista - Lista de partidas (obtenida mediante la función cargarPartidas).
 * @return boolean - Devuelve true si el usuario existe, false de lo contrario.
 */
function usuarioExiste($user, $partidasLista){
    $existe = false;

    // Verificar si el usuario existe en la lista de partidas
    foreach($partidasLista as $partidasExisten){
        if($partidasExisten["jugador"] == $user){
            $existe = true;
        }
    }

    return $existe;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//array $palabrasRep, $palabraYaJugada, $palabrasJugadas, $palabrasRep, $palabra, $coleccionPartidas, $coleccionPalabras
//boolean $opcionElegida, $numeroRepetido, $palabraUsada, $usuarioExiste
//int $opcion, $cantDePalabras, $numeroPalabras, $cantPalabrasRep, $palbrasJugadas, $partidasDisponibles, $numPartida
//string $pedirNombre, $indiceAleatorio,$palabraAleatoria, $palabraNueva,$palabraUsada, $respuesta, $primeraVic, $resumen, $partidasOrdenadas, $nuevaPalabra, $palabraAgregada

//Inicialización de variables:
$coleccionPartidas=cargarPartidas();
$coleccionPalabras= cargarColeccionPalabras();
$palabrasJugadas = [];
$palabrasRep=[];

//Proceso  
do {

    // Seleccionar opción del menú:
    // Se solicita al usuario que elija una opción del menú y se asigna a la variable $opcion.
    $opcion = seleccionarOpcion();
    $opcionElegida=true;
    
    // Switch para manejar las diferentes opciones del menú:
    switch ($opcion) {
        case 1:
            // Opción para jugar Wordix con una palabra elegida:
        
            // Solicitar el nombre del jugador:
            $pedirNombre = solicitarJugador();
        
            // Obtener la cantidad de palabras disponibles y palabras ya repetidas:
            $cantDePalabras = count($coleccionPalabras);
            $cantPalabrasRep = count($palabrasRep);
        
            // Verificar si todas las palabras han sido jugadas ya por el jugador:
            $palabrasTerminadas = opcionesFinales($coleccionPalabras, $pedirNombre, $coleccionPartidas);
        
            if (!$palabrasTerminadas) {
                // Inicializar la variable para controlar si se repite el número de palabra:
                $numeroRepetido = true;
        
                while ($numeroRepetido) {
                    // Solicitar al usuario el número de palabra entre 1 y la cantidad de palabras disponibles:
                    echo "Ingrese número de palabra entre 1 y $cantDePalabras: ";
                    $numeroPalabras = solicitarNumeroEntre(1, $cantDePalabras);
                    $numeroPalabras = $numeroPalabras - 1;
                    $palabra = $coleccionPalabras[$numeroPalabras];
                    $numeroRepetido = false;
        
                    // Verificar si el jugador ya jugó con esa palabra:
                    foreach ($coleccionPartidas as $partidasYaIngresadas) {
                        if ($partidasYaIngresadas["jugador"] === $pedirNombre && $partidasYaIngresadas["palabraWordix"] === $palabra) {
                            $numeroRepetido = true;
                            echo "Esta combinación de jugador y palabra ya ha sido jugada.\n";
                            break;
                        }
                    }
        
                    if (!$numeroRepetido) {
                        // Almacenar el número de palabra y el jugador que la jugó:
                        $palabrasRep[] = ["numeroPalabra" => $numeroPalabras, "jugador" => $pedirNombre];
        
                        // Jugar Wordix con la palabra seleccionada:
                        $partida = jugarWordix($coleccionPalabras[$numeroPalabras], $pedirNombre);
                        $coleccionPartidas[] = $partida;
                    }
                }
            }
            break;
        
        case 2:
            // Opción para jugar Wordix con una palabra aleatoria:
        
            // Solicitar el nombre del jugador:
            $pedirNombre = solicitarJugador();
        
            // Recargar la colección de palabras:
            $coleccionPalabras = cargarColeccionPalabras();
        
            // Inicializar la variable para controlar si la palabra aleatoria ya fue usada:
            $palabraUsada = true;
        
            // Obtener la cantidad de palabras disponibles y palabras ya repetidas:
            $cantDePalabras = count($coleccionPalabras);
            $cantDePalabrasRep = count($palabrasRep);
        
            // Verificar si todas las palabras han sido jugadas ya por el jugador:
            $palabrasTerminadas = opcionesFinales($coleccionPalabras, $pedirNombre, $coleccionPartidas);
        
            if (!$palabrasTerminadas) {
                while ($palabraUsada) {
                    $palabraUsada = false;
        
                    // Generar un índice aleatorio para seleccionar una palabra de la colección:
                    $indiceAleatoria = array_rand($coleccionPalabras);
                    $palabraAleatoria = $coleccionPalabras[$indiceAleatoria];
        
                    // Verificar si el jugador ya jugó con esa palabra:
                    foreach ($coleccionPartidas as $palabraNueva) {
                        if ($palabraNueva["palabraWordix"] === $palabraAleatoria && $palabraNueva["jugador"] == $pedirNombre) {
                            echo "\nYa jugó con esta palabra, le daremos otra.\n";
                            $palabraUsada = true;
                            break;
                        }
                    }
                }
        
                if (!$palabraUsada) {
                    // Almacenar el número de palabra y el jugador que la jugó:
                    $palabrasJugadas[] = ["numeroPalabra" => $indiceAleatoria, "jugador" => $pedirNombre];
        
                    // Jugar Wordix con la palabra aleatoria seleccionada:
                    $collecPartida = jugarWordix($coleccionPalabras[$indiceAleatoria], $pedirNombre);
                    $coleccionPartidas[] = $collecPartida;
                }
            }
            break;
                case 3:
                    // Opción para mostrar información de una partida específica:
                
                    // Obtener la cantidad de partidas disponibles:
                    $partidasDisponibles = count($coleccionPartidas);
                
                    // Solicitar al usuario el número de partida que desea ver:
                    echo "Ingrese el numero de partida que desea ver (entre 1 y $partidasDisponibles): ";
                    $numPartida = (int)trim(fgets(STDIN));
                    $numPartida = $numPartida - 1;
                
                    // Obtener y mostrar la información de la partida seleccionada:
                    $respuesta = datosPartida($numPartida, $coleccionPartidas);
                    echo $respuesta;
                    break;
                
                case 4:
                    // Opción para mostrar información sobre la primera partida ganada por un jugador:
                
                    // Solicitar al usuario el nombre del jugador:
                    $pedirNombre = solicitarJugador();
                
                    // Verificar si el usuario existe en las partidas:
                    $usuarioExiste = usuarioExiste($pedirNombre, $coleccionPartidas);
                
                    if ($usuarioExiste) {
                        // Si el usuario existe, obtener y mostrar la información de la primera partida ganada:
                        $primeraVic = primerPartida($coleccionPartidas, $pedirNombre);
                        echo $primeraVic;
                    } else {
                        // Si el usuario no existe, mostrar un mensaje de error:
                        echo "\nEl usuario ingresado no existe o no ha jugado ninguna partida. \n";
                    }
                    break;
                
                case 5:
                    // Opción para mostrar un resumen detallado del desempeño de un jugador:
                
                    // Solicitar al usuario el nombre del jugador:
                    $pedirNombre = solicitarJugador();
                
                    // Obtener el resumen del jugador y mostrar la información detallada:
                    $resumen = resumenJugador($pedirNombre, $coleccionPartidas);
                    // Verificar si el usuario existe en las partidas:
                        $usuarioExiste = usuarioExiste($pedirNombre, $coleccionPartidas);
                
                    if ($usuarioExiste) {
                    // Si el usuario existe, obtener y muestra el resumen del jugador.
                        echo $resumen[0];
                        echo $resumen[1];
                        echo $resumen[2];
                    } else {
                        echo "\nEl jugador ingresado no existe o no ha jugado ninguna partida.\n";
                    }
                    break;
                
                case 6:
                    // Opción para mostrar un listado de partidas ordenadas por jugador y por palabra:
                
                    // Obtener el listado de partidas ordenadas:
                    $partidasOrdenadas = partidasOrdenadas($coleccionPartidas);
                    break;
                
                    case 7:
                        // Opción para agregar una palabra de 5 letras a Wordix:
                    
                        // Leer la nueva palabra de 5 letras ingresada por el usuario:
                        $nuevaPalabra = leerPalabra5Letras();
                    
                        // Verificar si la palabra ya existe en la colección:
                        $palabraExistente = false;
                        foreach ($coleccionPalabras as $palabra) {
                            if (strcasecmp($palabra, $nuevaPalabra) === 0) {
                                $palabraExistente = true;
                                break;
                            }
                        }
                    
                        // Mostrar mensaje de acuerdo al resultado de la verificación:
                        if (!$palabraExistente) {
                            // La palabra no existe, agregarla a la colección:
                            $coleccionPalabras[] = $nuevaPalabra;
                            echo "¡Felicidades! Tu palabra se guardó correctamente.\n";
                        } else {
                            // La palabra ya existe, mostrar un mensaje de advertencia:
                            echo "Error: La palabra ya existe en la colección.\n";
                        }
                        break;
                
                case 8:
                    // Opción para salir del juego:
                    $opcionElegida = false;
                    break;
                
            
    }
} while ($opcionElegida == true );
