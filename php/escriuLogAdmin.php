<?php

function registraAccio($nom,$accio, $dia, $hora)
{
     // ECHO "HOLA";

     $linia = "$nom - $accio  - Dia:$dia - Hora:$hora";

     $fichero = fopen($_SERVER['DOCUMENT_ROOT']."/recursos/log/admin.log", "a");
     fwrite($fichero, $linia . PHP_EOL);
     fclose($fichero);
}

