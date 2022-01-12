<?php

session_start();

$nom = $_POST['nom'];
$cognom = $_POST['cognom'];
$poblacio =  $_POST['poblacio'];
$email = $_POST['email'];
$contrasenya = $_POST['contrasenya1'];
$contrasenya2 = $_POST['contrasenya2'];
$tipus = $_POST['tipus'];

$servidor = "192.168.1.52";
$usuari = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";

include("../entity/dadesFormulari.php");
$dades = new DadesFormulari($nom , $cognom, $poblacio ,$email,$contrasenya,$tipus);
$_SESSION['dadesformulari']= serialize($dades);
$dadessesio =  unserialize($_SESSION['dadesformulari']);

$_SESSION['nomguarda'] = $dadessesio->getNom();
$_SESSION['cognomguarda'] = $dadessesio->getCognom();
$_SESSION['poblacioguarda'] = $dadessesio->getPoblacio();
$_SESSION['emailguarda'] = $dadessesio->getEmail();
$_SESSION['contrasenyaguarda'] = $dadessesio->getContrasenya();





// Creem la connexio
$connexio = mysqli_connect($servidor, $usuari, $contrasenyabs, $base_dades);


if (mysqli_connect_errno()) {
    echo "La conexion  a la base de datos  MYSQL ha fallado." . mysqli_connect_errno();
} else {
    echo "La conexion realizada correctamente!";
}

// $avalidar = "SELECT * from alumnat WHERE email='$email'";
// $resultado1 = $connexio->query($avalidar);
// // $contador1 = mysqli_num_rows($resultado1);

// $pvalidar = "SELECT * FROM professor WHERE email = '$email'";
// $resultado2 = $connexio->query($pvalidar);
// // $contador2 = mysqli_num_rows($resultado2);


if ($contrasenya != $contrasenya2) {
    // $host = $_SERVER['HTTP_HOST'];
    // // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    // $html = 'registreUsuariNou.php';
    // $url = "http://$host/wwwjorge/php/$html";
    // echo $url;

    return header("Location: ../../admin.php?afegir=true&parametre=error");
}




$hashed_password = password_hash($contrasenya, PASSWORD_DEFAULT);

if ($tipus == "Alumnat") {



    $buscarCorreu   = "SELECT * from alumnat WHERE email='$email'";

    $resultat1 = mysqli_query($connexio, $buscarCorreu);


    // $contador1 = mysqli_num_rows($resultat1);

    if (mysqli_num_rows($resultat1) > 0) {
        // $host = $_SERVER['HTTP_HOST'];
        // // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        // $html = 'registreUsuariNou.php';
        // $url = "http://$host/php/$html";
        // echo $url;
        // header("Location:  $url?error=alumne");

        header("Location:  ../../admin.php?afegir=true&error=alumne");
    } else {
        $sql = "INSERT INTO alumnat (nom,cognom,email,poblacio, contrasenya,rol,data) VALUES ('$nom','$cognom','$email' ,'$poblacio','$hashed_password','ALUMNAT',now())";
        session_start();
        include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';



        registraAccio( $_SESSION['usuario'],"Nou Usuari",  date('d-m-Y'),   date('H:i:s'));


    }
} else {



    $buscarCorreu   = "SELECT * from professorat WHERE email='$email'";

    $resultat1 = mysqli_query($connexio, $buscarCorreu);


    // $contador1 = mysqli_num_rows($resultat1);

    if (mysqli_num_rows($resultat1) > 0) {
        // $host = $_SERVER['HTTP_HOST'];
        // // $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        // $html = 'registreUsuariNou.php';
        // $url = "http://$host/php/$html";
        // echo $url;
        header("Location: ../../admin.php?afegir=true&error=professorat");
    } else {
        $sql = "INSERT INTO professorat (nom,cognom,email,poblacio,contrasenya,rol,data) VALUES ('$nom','$cognom','$email', '$poblacio','$hashed_password','PROFESSOR',now())";
        session_start();
        include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
        registraAccio( $_SESSION['usuario'],"Nou Usuari",  date('d-m-Y'),   date('H:i:s'));


    
    }
}

$insert = mysqli_query($connexio, $sql);

echo "<hr>";

if ($insert) {
    echo "DATOS INSERTADOS CORRECTAMENTE";
    return header("Location: ../../admin.php?visualitza=true&&crud=true");

    } else {
    echo "Error: " . mysqli_error($connexio);
}

mysqli_close($connexio);


