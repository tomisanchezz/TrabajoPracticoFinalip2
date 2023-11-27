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
    $partida[8]= array("palabraWordix" => "HUEVO", "jugador" => "Javier", "intentos" => 5, "puntaje" => 9); 
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
        $menos=1;
        
        $datosDePartida= $todasLasPartidas[$numPartida - $menos];
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
    
    $vic=false;
    for ($i = 0; $i < count($collecPartida); ){
        if($collecPartida[$i]["jugador"]==$jugador && $collecPartida[$i]["puntaje"]>0){
            $vic=true;
            break;
        }
        $i++;
    }
    $i+=1;
    if($vic==true){
        $partidaGanada="******************\n".
            "Partida WORDIX ". ($i).": palabra " . $collecPartida[$i]["palabraWordix"]."\n".
            "Jugador: ". $collecPartida[$i]["jugador"]. "\n".
            "Puntaje: ".$collecPartida[$i]["puntaje"]."\n".
            "Intento: Adivinó la palabra en ". $collecPartida[$i]["intentos"]." intentos \n".
            "******************\n";
    }
    else{
        $partidaGanada="El jugador $jugador no ganó ninguna partida.";
    }
    return $partidaGanada;
}
            
        
    

/** Modulo 9
 *  Este modulo retorna un string que comparte informacion sobre un jugador solicitado por el usuario
 * @param string $nombreDeJugador, $buscarJugador
 * @param int $partidasJugadas, $victorias, $sumaPuntaje, $porcentajeVictorias
 * @return string $resumenDelJugador 
 */
function resumenJugador($nombreDeJugador,$partida){
    
    $arrayResumen=["jugador" => "",
    "partidas" => 0,"puntaje" => 0,"victorias" => 0,
    "intento1" => 0,"intento2" => 0,"intento3" => 0,
    "intento4" => 0,"intento5" => 0,"intento6" => 0 ];

    foreach($partida as $unaPartida){
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
        echo "Ingrese su nombre con el 1er caracter como una letra ";
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
$palabras=cargarColeccionPalabras();
$palabrasDisponibles = cargarColeccionPalabras();
$coleccionPalabras= cargarColeccionPalabras();
$collec = [];
//Proceso:


//print_r($partida);
//imprimirResultado($partida);
    
    
do {
    $opcion = seleccionarOpcion();
    $opcionElegida=true;
    $cantDePalabras=count(cargarColeccionPalabras());

    switch ($opcion) {
        case 1: 
            $pedirNombre= solicitarJugador();
            $palabrasDisponibles = cargarColeccionPalabras();
            echo "Selecciona un numero entre 1 y ". $cantDePalabras. " para empezar a jugar: ";
            $numElegido=trim(fgets(STDIN));
            do{
                echo ("Numero incorrecto, ingrese un numero entre 1 y ". $cantDePalabras. " para empezar a jugar: ");
                $numElegido=trim(fgets(STDIN));
            }while($numElegido<1 || $numElegido>$cantDePalabras);

            if($numElegido  == $numAnterior ){
                    echo "Ya utilizo este numero, ingrese otro";
                    $numElegido=trim(fgets(STDIN));
                }

            $numAnterior = $numElegido;
            $partida= jugarWordix($palabras[$numElegido], strtolower($pedirNombre)) ;
            $coleccionPartidas[]=  $partida;

            break;
        case 2: 
            $pedirNombre= solicitarJugador();
            $palabrasDisponibles = cargarColeccionPalabras();
            
            $palabraElegida= "";
            $palabraRepetiva=false;
            do{
                $palabraElegida = $palabrasDisponibles[array_rand($palabrasDisponibles)];

                //*Verificar si la palabra ya se jugo
                $palabraRepetiva=false;
                foreach($coleccionPartidas as $partida){
                    if (isset($partida["palabra"]) && $partida["palabra"] == $palabraElegida){
                        $palabraRepetiva=true;
                        break;
                    }
                }

                if (!$palabraRepetiva){
                    $partida= jugarWordix($palabraElegida, strtolower($pedirNombre));
                    $coleccionPartidas[]= $partida;
                }else{
                     echo "La palabra ya se utilizo anteriormente. Se le generara otra a continuacion.. \n";
                     $palabraRepetiva=false; // Restablecer la bandera para el próximo intento
                }

            }while($palabraRepetiva);

            $partida= jugarWordix($palabraElegida, strtolower($pedirNombre));
            $coleccionPartidas[]=  $partida;

            break;
        case 3: 
            
            echo("Ingrese el numero de la partida que quiere ver: ");
            $numPartida=trim(fgets(STDIN));
            $datoPartida3=  datosPartida($numPartida);
            echo $datoPartida3;
        
            if($datoPartida3 == "El numero de partida no existe."){
                do{
                    echo("Ingrese el numero de la partida que quiere ver: ");
            $numPartida=trim(fgets(STDIN));
            $datoPartida3=  datosPartida($numPartida);
            echo $datoPartida3;
                }while($datoPartida3 =="El numero de partida no existe.");
            }
        

            break;
        case 4:

            echo("ingrese nombre");
            $nombree=trim(fgets(STDIN));
            $p=cargarPartidas();
            $primeraVic=primerPartida($p, $nombree);
            echo($primeraVic);
            break;
        case 5:
            echo"ingresenombre: ";
            $nombree=trim(fgets(STDIN));
            $resumen=resumenJugador($nombree, $coleccionPartidas);
            echo($resumen[0]);
            echo($resumen[1]);
            echo($resumen[2]);
            break;
        case 6:
            partidasOrdenadas($collec);
            break;
        case 7:
            $nuevaPalabra= leerPalabra5Letras();

            $collePalabra= agregarPalabra($coleccionPalabras,$nuevaPalabra);

            $coleccionPalabras = $collePalabra;
            echo "¡Felicidades tu palabra se guardo correctamente!";
            break;
        case 8;
        $opcionElegida = false;
        break;
            
    }
} while ($opcionElegida == true );
