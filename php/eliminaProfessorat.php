<?php
session_start();



$servidor = "192.168.1.52";
$usuario = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";
$connexio = mysqli_connect($servidor, $usuario, $contrasenyabs, $base_dades);
$id = $_GET['id'];
$sql = "DELETE FROM professorat WHERE idprof =" . $id;


if (mysqli_query($connexio, $sql)) {
    include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
    registraAccio( $_SESSION['usuario'],"Elimina Professor",  date('d-m-Y'),   date('H:i:s'));

    echo "Registre actualitzat correctament";
    header('Location: ../admin.php?visualitza=true&&crud=true');
} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}
