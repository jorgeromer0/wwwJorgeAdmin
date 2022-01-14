
<?php

if (basename($_SERVER['PHP_SELF']) == 'index.php') {
    $url = "./php/desconnecta.php";
} else {
    $url = $_SERVER['PHP_SELF'];
    $data = explode("php", $url);
    $index = $data[0];
    $url ="http://".$_SERVER['SERVER_NAME']."/php/desconnecta.php";
}

if (!isset($_SESSION)) {
    session_start();
}



if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    print ' <div class="alert alert-primary mx-auto text-md-center text-left" role="alert">';

    $imagen =    $_SESSION['img'];
    // echo $_SESSION['rol'];
    // echo $imagen;
    if ($_SESSION['rol'] == "alumnat" && $imagen != "imatgedefecte.png") {
        echo "<img src='http://". $_SERVER['SERVER_NAME'] ."/recursos/img/imatgesperfil/alumnat/$imagen'  width='40'>";
    }

    if ($_SESSION['rol'] == "professorat" && $imagen != "imatgedefecte.png") {
        echo "<img src='http://". $_SERVER['SERVER_NAME'] ."/recursos/img/imatgesperfil/professorat/$imagen'  width='40'>";
    }

    if ($imagen == "imatgedefecte.png") {
        echo "<img src='http://". $_SERVER['SERVER_NAME'] ."/recursos/img/imatgesperfil/$imagen'  width='40'>";
    }

    echo " Hola " . $_SESSION['usuario'] . ', estas registrat com a ' .     $_SESSION['rol'] . ' <a href=' . $url . '>Desconnecta\'t </a>    </div>';
}


?>