<?php
if (isset($_GET['borar']) && $_GET['borar'] == "true") {
            print ' <div class="alert alert-success mx-auto text-md-center text-left" role="alert"> S\'han eliminat correctament el projecte.    </div>';
        }
?>
<main id="contingut">
            <?php
            // session_start();

            $servidor = "localhost";
            $usuari = "projectes_jorge";
            $contrasenyabs = "projectes_jorge";
            $base_dades = "projectes_jorge";
            // $usuario =     $_SESSION['usuario'];
            // $rol = $_SESSION['rol'];
            // $imagen = $_SESSION['img'];
            // $loggin =     $_SESSION['loggedin'];


            // echo $rol;

            $connexio = mysqli_connect($servidor, $usuari, $contrasenyabs, $base_dades);

// $titol = $_POST["title"];
// $ciclo = $_POST["ciclo"];
// $curs = $_POST["curs"];
// $descripcio = $_POST["descripcio"];
// $nalumnat = $_POST["nalumnat"];
// $nprofesorat = $_POST["nprofesorat"];
// echo "TITOL ".$titol;
// echo "CICLO ".$ciclo;
// echo "CURS ".$curs;
// echo "N ALUM ".$nalumnat;
// echo "N PROF ".$nprofesorat;

    

            $query = "
SELECT rp.idproj, pj.titol, pj.cicle, c.curs, pj.descripcio,pj.paraulesclau, a.nom as nomalumne, a.cognom as cognomsalumne, p.nom, p.cognom from relacioprojecte rp      
INNER JOIN professorat p ON p.idprof = rp.idprof     
INNER JOIN alumnat a ON a.idalum = rp.idalum    
 INNER JOIN curs c ON c.idcurs = rp.idcrus     
INNER JOIN projecte pj ON pj.idproj = rp.idproj   ";



            $resultado = mysqli_query($connexio, $query);

            if ($resultado->num_rows > 0) {
                echo '<table class="table">
           <thead>
               <tr>
                   <th scope="col">Id</th>
                   <th scope="col">Titol </th>
                   <th scope="col">Cicle</th>
                   <th scope="col">Curs</th>
                   <th scope="col">Descripcio</th>
                   <th scope="col">Paraules Clau</th>
                   <th scope="col">Alumnat</th>
                   <th scope="col">Professor</th>
                   <th scope="col">Fitxer</th>
                   <th>Accions</th>

       
               </tr>
           </thead>
           <tbody>';


    
                while ($row = mysqli_fetch_object($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row->idproj . " </td>";
                    echo "<td>" . $row->titol . "</td>";
                    echo "<td>" . $row->cicle . "</td>";
                    echo "<td>" . $row->curs . "</td>";
                    echo "<td>" . $row->descripcio . "</td>";
                    echo "<td>" . $row->paraulesclau . "</td>";

                    echo "<td>" . $row->nomalumne . ' ' . $row->cognomsalumne . "</td>";
                    echo "<td>" . $row->nom . '' . $row->cognom . "</td>";
                    $porciones1 = explode("/", $row->curs);
                    // $porciones2 = explode(" ", );
    
                    $memoria_projecte = "". $row->idproj."_".$row->cicle."_".$porciones1[0]."".$porciones1[1]."_".$row->nomalumne."_".$row->cognomsalumne.".pdf";
                
                
                    $ruta = "/recursos/projectes/".$row->cicle."/".$porciones1[0]."/".$porciones1[1]."/".$memoria_projecte;
                    // echo $ruta;

                    // $_SESSION['ruta'] = $_SERVER['SERVER_NAME'] .":8080".$ruta;

                    echo "<td><a href='http://". $_SERVER['SERVER_NAME'] .":8080$ruta'>Fitxer</a></td>";

                ?>

<td><a class="btn btn-danger" href="../php/eliminaProjecte.php?id=<?php  echo $row->idproj; ?>" onclick='return confirm("Realment vols eliminar el projecte amb id <?php echo $row->idproj; ?> ");'> 🗑️ </a>

<?php
                    echo "</tr>";
                
                }

            }
                echo "</table>";
?>

        </main>