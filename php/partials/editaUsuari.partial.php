<?php

// session_start();

$servidor = "192.168.1.52";
$usuari = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";

$connexio = mysqli_connect($servidor, $usuari, $contrasenyabs, $base_dades);
$rol = $_GET['rol'];
$id = $_GET['id'];

if ($rol  == "ALUMNAT") {
    $sql = "SELECT * FROM alumnat WHERE  idalum ='$id'";
    $resultado = $connexio->query($sql) or die($connexio->error);;
    $row = $resultado->fetch_assoc();
} else {
    $sql = "SELECT * FROM professorat WHERE  idprof ='$id'";
    $resultado = $connexio->query($sql) or die($connexio->error);;
    $row = $resultado->fetch_assoc();
}




?>


<main id="contingut">

    <h3>Edita Dades Usuari </h3>

    <form action="./php/processaEditaUsuari.php" method="post">
    <p>Id: <input type="text" name="id" size="40" value=" <?php echo  ($rol  == "ALUMNAT") ?   $row['idalum'] :  $row['idprof'] ?>" readonly></p>
        <p>Nom: <input type="text" name="nom" size="40" value=" <?php echo $row['nom']; ?>"></p>
        <p>Cognom: <input type="text" name="cognom" size="40" value=" <?php echo $row['cognom']; ?>"></p>
        <p>Poblacio: <input type="text" name="poblacio" size="40" value=" <?php echo $row['poblacio']; ?>"></p>
        <p>Email: <input type="text" name="email" size="40" value="<?php echo $row['email']; ?>" readonly></p>
        <p>Contrasenya: <input type="text" name="contrasenya" size="40" value="<?php echo $row['contrasenya']; ?>" readonly></p>
        <p>Tipus d'usuari: <input type="text" name="rol" size="40" value="<?php echo $row['rol']; ?>" readonly></p>
        <p>Data: <input type="text" name="data" size="40" value="<?php echo $row['data']; ?>" readonly></p>


        <p>
            <input type="submit" value="Enviar">
        </p>
    </form>

</main>
<div class='alert alert-primary mx-auto text-md-center text-left' role="alert"> <a href='./admin.php?visualitza=true&&crud=true'>Cancel·la </a> </div>