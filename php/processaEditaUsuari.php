<?php

session_start();
$servidor = "localhost";
$usuari = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";

$connexio = mysqli_connect($servidor, $usuari, $contrasenyabs, $base_dades);
$usuario =     $_SESSION['usuario'];
$rol = $_POST['rol'];
// $rol2 = $rol;

$id = $_POST['id'];

if ($rol  == "ALUMNAT") {
    $sql = "SELECT * FROM alumnat WHERE  idalum ='$id'";
    $resultado = $connexio->query($sql) or die($connexio->error);;
    $row = $resultado->fetch_assoc();
    $id = $row['idalum'];
    $nombre1 = "idalum";
    $rol = "alumnat";
} else {
    $sql = "SELECT * FROM professorat WHERE  idprof ='$id'";
    $resultado = $connexio->query($sql) or die($connexio->error);;
    $row = $resultado->fetch_assoc();
    $id = $row['idprof'];
    $nombre1 = "idprof";
    $rol = "professorat";

}




$nom = $_POST['nom'];
$cognom = $_POST['cognom'];
$poblacio = $_POST['poblacio'];


$sql = "UPDATE $rol SET nom='$nom', cognom='$cognom',  poblacio='$poblacio'   WHERE $nombre1=$id ";


// $sql = "UPDATE data SET Age='28' WHERE id=201";


//  $connexio->query($sql);

if (mysqli_query($connexio, $sql)) {
    include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
        registraAccio( $_SESSION['usuario'],"Modificat",  date('d-m-Y'),   date('H:i:s'));



    echo "Registre actualitzat correctament";
    // include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogUsuari.php';



    // registraAccio("Dades Usuari Modificades", $usuario, $rol2,  date('d-m-Y'),   date('H:i:s'));
} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}




// $host = $_SERVER['HTTP_HOST'];
// // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
// $html = 'usuariRegistrat.php';
// $url = "http://$host/php/$html";
// echo $url;

 return header("Location: ../admin.php?visualitza=true&&crud=true");


// $row = $resultado->fetch_assoc();
