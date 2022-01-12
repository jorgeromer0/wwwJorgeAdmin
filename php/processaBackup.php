<?php
session_start();

$servidor = "192.168.1.52";
$usuario = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";

// Creem la connexio
$connexio = mysqli_connect($servidor, $usuario, $contrasenyabs, $base_dades);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



$sql_query = "SELECT idprof, nom, cognom, email,contrasenya, poblacio,rol,data,imatgeperfil FROM professorat";
$resultset = mysqli_query($connexio, $sql_query) or die("error base de datos:" . mysqli_error($conn));
while ($usuario = mysqli_fetch_assoc($resultset)) {

    $linia = $usuario['idprof'] . "::" . $usuario['nom'] . "::" . $usuario['cognom'] . "::" . $usuario['contrasenya'] . "::" .  $usuario['email'] . "::" . $usuario['poblacio'] . "::" . $usuario['rol'] . "::" . $usuario['data'] . "::" . $usuario['imatgeperfil'];

    $fecha = date('dmY');
    $hora = date('His');
    $fichero = fopen($_SERVER['DOCUMENT_ROOT'] . '/recursos/backups/backup_prof_' . $fecha . "_" . $hora . ".txt", "a");
    fwrite($fichero, $linia . PHP_EOL);
}
fclose($fichero);

$sql_query = "SELECT idalum, nom, cognom, email,contrasenya, poblacio,rol,data,imatgeperfil FROM alumnat";
$resultset = mysqli_query($connexio, $sql_query) or die("error base de datos:" . mysqli_error($conn));
while ($usuario = mysqli_fetch_assoc($resultset)) {

    $linia = $usuario['idalum'] . "::" . $usuario['nom'] . "::" . $usuario['cognom'] . "::" . $usuario['contrasenya'] . "::" .  $usuario['email'] . "::" . $usuario['poblacio'] . "::" . $usuario['rol'] . "::" . $usuario['data'] . "::" . $usuario['imatgeperfil'];

    $fecha = date('dmY');
    $hora = date('His');
    $fichero = fopen($_SERVER['DOCUMENT_ROOT'] . '/recursos/backups/backup_alum_' . $fecha . "_" . $hora . ".txt", "a");
    fwrite($fichero, $linia . PHP_EOL);
}
fclose($fichero);

include  $_SERVER['DOCUMENT_ROOT'] . '/php/escriuLogAdmin.php';


registraAccio($_SESSION['usuario'], "Backup realitzat",  date('d-m-Y'),   date('H:i:s'));

return header("Location: ../admin.php?visualitza=true&&crud=true");
