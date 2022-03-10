<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

?>
<?php
session_start();


$usuari = $_POST['usuari'];
$password = $_POST['password'];
$tipus = "ADMIN";

$servidor = "localhost";
$usuario = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";


// Creem la connexio
$connexio = mysqli_connect($servidor, $usuario, $contrasenyabs, $base_dades);

print "professorat a entrado";
$sql = "SELECT * from professorat where nom = '$usuari' AND rol = 'ADMIN'";
$result = mysqli_query($connexio, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
echo $usuari;
echo $count;

if ($count == 1) {
    $hash = "SELECT  contrasenya from professorat where nom = '$usuari' AND rol = 'ADMIN'";
    $consulta_hash = mysqli_query($connexio, $hash);
    if ($consulta_hash) {
        echo "DATOS INSERTADOS CORRECTAMENTE";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
    $row2 = mysqli_fetch_array($consulta_hash, MYSQLI_ASSOC);

    // var_dump($row2);

    $result = password_verify($password, $row2['contrasenya']);

    // var_dump($result);

    if ($result) {
        print "CONTRASENYA VALIDA";
        $_SESSION['loggedin'] = true;
        $_SESSION['usuario'] = $usuari;
        $_SESSION['rol'] = $tipus;
$_SESSION['img'] = "imatgedefecte.png";

        // $host = $_SERVER['HTTP_HOST'];
        // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        // $html = 'usuariRegistrat.php';
        // $url = "http://$host/php/$html";
        // echo $url;
        include  'escriuLogAdmin.php';

        echo "hola document";


        include_once 'escriuLogAdmin.php';
        registraAccio($_SESSION['usuario'], "Login",  date('d-m-Y'),   date('H:i:s'));


        // header('Location: usuariRegistrat.php');

        header("Location: ../admin.php?visualitza=true");
    } else {
        // $host = $_SERVER['HTTP_HOST'];
        // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        // $html = 'loginUsuari.php';
        // $url = "http://$host/php/$html";
        // echo $url;

        return header("Location: ../admin.php?parametre=errorc");
    }
} else {

    // $host = $_SERVER['HTTP_HOST'];
    // // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    // $html = 'loginUsuari.php';
    // $url = "http://$host/php/$html";
    // echo $url;

    return header("Location: ../admin.php?parametre=errorusuari");
}
