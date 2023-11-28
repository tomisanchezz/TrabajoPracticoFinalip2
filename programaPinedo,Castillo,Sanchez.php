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
 * Este modulo va a funcionar para crear las 10 partidas minimas para el juego, donde $collecPartida es un araray indexado donde dentro tiene un array asosiativo con los juegos prejugados donde luego a collecPartida se lo cambia por coleccion de partidas y lo retorna.
 * //array $collecPartida[] es un array indexado.
 * @return array
 * */ 
function cargarPartidas(){

    $collecPartida[0]= array("palabraWordix" => "TINTO", "jugador" => "valentina", "intentos" => 1, "puntaje" => 14);
    $collecPartida[1]= array("palabraWordix" => "TINTO", "jugador" => "valentina", "intentos" => 6, "puntaje" => 0);  
    $collecPartida[2]= array("palabraWordix" => "PERRO", "jugador" => "maria", "intentos" => 4, "puntaje" => 13); 
    $collecPartida[3]= array("palabraWordix" => "ARBOL", "jugador" => "pedro", "intentos" => 3, "puntaje" => 13); 
    $collecPartida[4]= array("palabraWordix" => "GATOS", "jugador" => "tomas", "intentos" => 6, "puntaje" => 0); 
    $collecPartida[5]= array("palabraWordix" => "MUJER", "jugador" => "tomas", "intentos" => 0, "puntaje" => 0); 
    $collecPartida[6]= array("palabraWordix" => "VERDE", "jugador" => "alejandro", "intentos" => 3, "puntaje" => 14); 
    $collecPartida[7]= array("palabraWordix" => "MELON", "jugador" => "martin", "intentos" => 2, "puntaje" => 15); 
    $collecPartida[8]= array("palabraWordix" => "HUEVO", "jugador" => "javier", "intentos" => 5, "puntaje" => 9); 
    $collecPartida[9]= array("palabraWordix" => "GOTAS", "jugador" => "emanuel", "intentos" => 2, "puntaje" => 15); 

    return $collecPartida;
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
    3) Mostrar una collecPartida\n
    4) Mostrar la primer collecPartida ganadora\n
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
 * Este modulo retorna los datos de una collecPartida solicitada por el usuario.
 * @param string $todasLasPartidas, $datosDePartida
 * @param int $cantidadPartidas, $numPartida
 * @return $infoPartida
 */
function datosPartida($numPartida, $partidas) {
    if ($numPartida >= 0 && $numPartida < count($partidas)) {
        $datosPartida = $partidas[$numPartida];
        $respuesta = "*******\n". "Partida Wordix $numPartida: " . "palabra " . $datosPartida["palabraWordix"] . 
        "\n" . "Jugador: " . $datosPartida["jugador"] . "\n" . "Puntaje: " . $datosPartida["puntaje"] . "\n" . 
        "Intentos: " . $datosPartida["intentos"] . "\n" . "*******\n";
    } else {
        $respuesta = "Error: Número de collecPartida inválido.\n";
    }
    return $respuesta;
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
 * @param array $coleccPartida
 * @param string $jugador
 * @return int
 */
function primerPartida($coleccPartida,$jugador){
    $i=0;
    $vic=false;
    $jugadorVictoria=array("palabraWordix" => "", "jugador" => "", "intentos" => 0, "puntaje" => 0);
    foreach($coleccPartida as $elemento){
        $i++;
        if($elemento["jugador"]==$jugador && $elemento["puntaje"]>0){
            $vic=true;
            $jugadorVictoria["palabraWordix"]=$elemento["palabraWordix"];
            $jugadorVictoria["jugador"]=$elemento["jugador"];
            $jugadorVictoria["intentos"]=$elemento["intentos"];
            $jugadorVictoria["puntaje"]=$elemento["puntaje"];
            break;
        }
        
    }
    
    if($vic){
        $partidaGanada="******************\n".
            "Partida WORDIX ". ($i).": palabra " . $jugadorVictoria["palabraWordix"]."\n".
            "Jugador: ". $jugadorVictoria["jugador"]. "\n".
            "Puntaje: ".$jugadorVictoria["puntaje"]."\n".
            "Intento: Adivinó la palabra en ". $jugadorVictoria["intentos"]." intentos \n".
            "******************\n";
    }
    else{
        $partidaGanada="El jugador $jugador no ganó ninguna collecPartida.";
    }
    return $partidaGanada;
}
            
        
    

/** Modulo 9
 *  Este modulo retorna un string que comparte informacion sobre un jugador solicitado por el usuario
 * @param string $nombreDeJugador, $buscarJugador
 * @param int $partidasJugadas, $victorias, $sumaPuntaje, $porcentajeVictorias
 * @return string $resumenDelJugador 
 */
function resumenJugador($nombreDeJugador,$collecPartida){
    
    $arrayResumen=["jugador" => "",
    "partidas" => 0,"puntaje" => 0,"victorias" => 0,
    "intento1" => 0,"intento2" => 0,"intento3" => 0,
    "intento4" => 0,"intento5" => 0,"intento6" => 0 ];

    foreach($collecPartida as $unaPartida){
        if($nombreDeJugador==$unaPartida["jugador"]){ 
            $arrayResumen["jugador"]=$nombreDeJugador;
            $arrayResumen["partidas"]+= 1;
            $arrayResumen["puntaje"]+= $unaPartida["puntaje"];

            if($unaPartida["puntaje"]>0){
                $arrayResumen["victorias"]+=1;
            }
            switch($unaPartida["intentos"]){
                case 1:
                    $arrayResumen["intento1"]+=1;
                    break;
                case 2:
                    $arrayResumen["intento2"]+=1;
                    break;
                case 3:
                    $arrayResumen["intento3"]+=1;
                    break;
                case 4:
                    $arrayResumen["intento4"]+=1;
                    break;
                case 5:
                    $arrayResumen["intento5"]+=1;
                    break;
                case 6:
                    $arrayResumen["intento6"]+=1;
                    break;
            }
          
        }
        
    }
      
    $resp1="******************\n".
    "Jugador: ". $arrayResumen["jugador"]."\n".
    "Partidas: ". $arrayResumen["partidas"]."\n".
    "Puntaje final: ". $arrayResumen["puntaje"]."\n".
    "Victorias: ". $arrayResumen["victorias"]."\n";
    
    if($arrayResumen["partidas"]>0){
        $porcentajeVictorias = $arrayResumen["victorias"] / $arrayResumen["partidas"] * 100;
        $resp2="Porcentaje de victorias: " . $porcentajeVictorias . "%\n";
    }
    else{
        $resp2= "Porcentaje de victorias: 0% \n";
    }
    $resp3="Adivinadas: \n" . "     Intento 1: " . $arrayResumen["intento1"] . "\n" . "     Intento 2: " . 
    $arrayResumen["intento2"] . "\n" . "     Intento 3: " . $arrayResumen["intento3"] . 
    "\n" . "     Intento 4: " . $arrayResumen["intento4"]. "\n". "     Intento 5: " . $arrayResumen["intento5"]. "\n".
    "     Intento 6: " . $arrayResumen["intento6"]. "\n".
    "******************\n";

    $arrayRespuesta=[$resp1, $resp2, $resp3];
    return $arrayRespuesta;
}
//Consinga 10
/**
 * @return string
 */
function solicitarJugador(){
    //string $nombre
    echo "Ingrese su nombre: ";
    $nombre=trim(fgets(STDIN));
    $nombre=strtolower($nombre);//el nombre pasa a minúsculas
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
 * Modulo 11.
 * @param array $collec
 */

 function partidasOrdenadas($collecPartida){
    uasort($collecPartida,'cmp'); //uasort ordena el array asociativo
    print_r($collecPartida); //print_r va a imprimir el array
 }



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$coleccionPartidas=cargarPartidas();
$coleccionPalabras= cargarColeccionPalabras();
$palabrasJugadas = [];
$palabrasRep=[];
//Proceso:


//print_r($collecPartida);
//imprimirResultado($collecPartida);
    
    
do {
    $opcion = seleccionarOpcion();
    $opcionElegida=true;
    

    switch ($opcion) {
        case 1:
            $pedirNombre = solicitarJugador();
            $cantDePalabras = count($coleccionPalabras);
            $cantPalabrasRep=count($palabrasRep);
            
            if (count($palabrasRep) === $cantDePalabras) {
                    echo "El usuario ya ha jugado con todas las palabras! Seleccione la opcion 7 para agregar mas\n";
                    break;
                }
            $numeroRepetido = true;
            while ($numeroRepetido) {
                echo "Ingrese numero de palabra entre 1 y " . $cantDePalabras . " :";
                $numeroPalabras = solicitarNumeroEntre(1, $cantDePalabras);
                $numeroPalabras = $numeroPalabras - 1;
                $palabra = $coleccionPalabras[$numeroPalabras];
                $numeroRepetido = false;
                foreach ($palabrasRep as $jugada) {
                    if ($jugada['numeroPalabra'] === $numeroPalabras && $jugada['jugador'] === $pedirNombre) {
                        echo "Esta combinación de jugador y palabra ya ha sido jugada.\n";
                        $numeroRepetido = true;
                        break;
                    }
                }
                if (!$numeroRepetido) {
                    $palabrasRep[] = ["numeroPalabra" => $numeroPalabras, "jugador" => $pedirNombre];
                    $partida = jugarWordix($coleccionPalabras[$numeroPalabras], $pedirNombre);
                    $coleccionPartidas[] = $partida;
                }
            }
            break;
        
            case 2:
                $pedirNombre = solicitarJugador();
                $coleccionPalabras = cargarColeccionPalabras();
                $palabraUsada = true;
                $cantDePalabras=count($coleccionPalabras);
                $cantDePalabrasRep=count($palabrasRep);
                foreach($coleccionPartidas as $partidasJugadas){
                if ($cantDePalabrasRep === $cantDePalabras && $partidasJugadas["jugador"]==$pedirNombre) {
                    echo "El usuario ya ha jugado con todas las palabras! Seleccione la opcion 7 para agregar mas\n";
                    $opcion=seleccionarOpcion();
                }
                }
                while ($palabraUsada) {
                    $palabraUsada = false;
                    $indiceAleatoria = array_rand($coleccionPalabras);
                    $palabraAleatoria = $coleccionPalabras[$indiceAleatoria]; // Accedemos a la palabra aleatoria
                    foreach ($coleccionPartidas as $palabraNueva) {
                        if ($palabraNueva["palabraWordix"] === $palabraAleatoria && $palabraNueva["jugador"] == $pedirNombre) {
                            $palabraUsada = true;
                            break;
                        }
                    }
                    if(count($palabrasJugadas) === $cantDePalabras){
                        echo "\nEl usuario ya ha jugado con todas las palabras \n";
                        echo "Elija una opción de nuevo. ";
                        break;
                    }
                    if (!$palabraUsada) {
                        $palabrasJugadas[] = $indiceAleatoria;
                        $collecPartida = jugarWordix($coleccionPalabras[$indiceAleatoria], $pedirNombre);
                        $coleccionPartidas[] = $collecPartida;
                    }
                    
                }
                
                break;
        case 3: 
            $partidasDisponibles = count($coleccionPartidas);
            echo "Ingrese el numero de partida que desea ver (entre 1 y $partidasDisponibles)";
            $numPartida = (int)trim(fgets(STDIN));
            $numPartida = $numPartida - 1;
            $respuesta = datosPartida($numPartida , $coleccionPartidas);
            echo $respuesta; 
                break;
        case 4:
            $pedirNombre = solicitarJugador();
            $usuarioExiste = usuarioExiste($pedirNombre, $coleccionPartidas);
            if ($usuarioExiste){
                $primeraVic=primerPartida($coleccionPartidas, $pedirNombre);
                echo($primeraVic);
            } else {
                echo "\nEl usuario ingresado no existe. \n";
            }
            break;
        case 5:
            $nombre=solicitarJugador();
            $resumen=resumenJugador($nombre, $coleccionPartidas);
            echo($resumen[0]);
            echo($resumen[1]);
            echo($resumen[2]);
            break;
        case 6:
            $partidasOrdenadas = partidasOrdenadas($coleccionPartidas);
            break;
        case 7:
            $nuevaPalabra= leerPalabra5Letras();
            $palabraAgregada=$coleccionPalabras;
            $coleccionPalabras= agregarPalabra($palabraAgregada,$nuevaPalabra);
            
            echo "¡Felicidades tu palabra se guardo correctamente!";
            break;
        case 8:
        $opcionElegida = false;
        break;
            
    }
} while ($opcionElegida == true );
