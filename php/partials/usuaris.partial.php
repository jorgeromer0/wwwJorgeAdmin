<?php



$servidor = "localhost";
$usuario = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";

// Creem la connexio
$connexio = mysqli_connect($servidor, $usuario, $contrasenyabs, $base_dades);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>


<div class="container home">
    <h2>Administració::Gestió d'usuaris</h2>
    <table id="data_table" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Cognom</th>
                <th>Email</th>
                <th>Poblacio</th>
                <th>Rol</th>
                <th>Data creació</th>
                <th>Imatge</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_query = "SELECT idprof, nom, cognom, email, poblacio,rol,data, imatgeperfil FROM professorat";
            $resultset = mysqli_query($connexio, $sql_query) or die("error base de datos:" . mysqli_error($conn));
            while ($usuario = mysqli_fetch_assoc($resultset)) {
            ?>
                <tr id="<?php echo $usuario['idprof']; ?>">
                    <td><?php echo $usuario['idprof']; ?></td>
                    <td><?php echo $usuario['nom']; ?></td>
                    <td><?php echo $usuario['cognom']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['poblacio']; ?></td>
                    <td><?php echo $usuario['rol']; ?></td>
                    <td><?php echo $usuario['data']; ?></td>

                    <td>
                        <?php

                        $imagen = $usuario['imatgeperfil'];
            
                        if ($imagen != "imatgedefecte.png") {
                            echo "<img src='http://".$_SERVER['SERVER_NAME'].":8080/recursos/img/imatgesperfil/professorat/$imagen'  width='40'>";
                        }

                        if ($imagen == "imatgedefecte.png") {
                            echo "<img src='http://".$_SERVER['SERVER_NAME'].":8080/recursos/img/imatgesperfil/$imagen'  width='40'>";
                        }

                        ?>
                    </td>
                    <?php if ($usuario['rol'] != 'ADMIN') : ?>

                        <td><a class="btn btn-danger" href="../php/eliminaProfessorat.php?id=<?php echo $usuario['idprof']; ?>" onclick='return confirm("Realment vols eliminar l usuari amb id <?php echo $usuario['idprof']; ?> ");'> 🗑️ Borrar</a>
                            <a class="btn btn-warning" href="admin.php?edita=true&id=<?php echo $usuario['idprof']; ?>&rol=<?php echo $usuario['rol']; ?>"> ✏️ Modifica</a>
                        </td>


                    <?php endif; ?>

                </tr>
            <?php } ?>
            <?php
            $sql_query = "SELECT idalum, nom, cognom, email, poblacio,rol,data ,imatgeperfil FROM alumnat";
            $resultset = mysqli_query($connexio, $sql_query) or die("error base de datos:" . mysqli_error($conn));
            while ($usuario = mysqli_fetch_assoc($resultset)) {
            ?>
                <tr id="<?php echo $usuario['idalum']; ?>">
                    <td><?php echo $usuario['idalum']; ?></td>
                    <td><?php echo $usuario['nom']; ?></td>
                    <td><?php echo $usuario['cognom']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['poblacio']; ?></td>
                    <td><?php echo $usuario['rol']; ?></td>
                    <td><?php echo $usuario['data']; ?></td>
                    <td>
                        <?php

                        $imagen = $usuario['imatgeperfil'];

                        if ($imagen != "imatgedefecte.png") {
                            echo "<img src='http://".$_SERVER['SERVER_NAME'].":8080/recursos/img/imatgesperfil/alumnat/$imagen'  width='40'>";
                        }

                        if ($imagen == "imatgedefecte.png") {
                            echo "<img src='http://".$_SERVER['SERVER_NAME'].":8080/recursos/img/imatgesperfil/$imagen'  width='40'>";
                        }

                        ?>
                    </td>
                    <td><a class="btn btn-danger" href="../php/eliminaAlumnat.php?id=<?php echo $usuario['idalum']; ?>" onclick='return confirm("Realment vols eliminar l usuari amb id <?php echo $usuario['idalum']; ?> ");'> 🗑️ Borrar</a>
                        <a class="btn btn-warning" href="admin.php?edita=true&id=<?php echo $usuario['idalum']; ?>&rol=<?php echo $usuario['rol']; ?>"> ✏️ Modifica</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>


    <div class="col-md-12">

        <a href="admin.php?afegir=true" class="btn btn-success mt-4"> 🧍‍♂️ Afegeix usuari nou </a>
        <a href="../php/processaBackup.php" class="btn btn-primary mt-4"> 💾 Fes un Backup dels usuaris </a>

        <?php
        if (isset($_GET['ver']) && $_GET['ver'] == 'true') { ?>
            <a href='admin.php?visualitza=true&&crud=true&&ver=false' class="btn btn-info mt-4"> 📄 Visualitza Log </a>

        <?php
        } else { ?>
            <a href='admin.php?visualitza=true&&crud=true&ver=true' class="btn btn-info mt-4"> 📄 Visualitza Log </a>
        <?php  }
        ?>
    </div>
</div>

<?php
if (isset($_GET['ver']) && $_GET['ver'] == "true") {
    // include "../php/partials/dadesUsuari.partial.php";
    include "php/partials/visualtizaLog.partial.php";
}
?>