<?php
session_start();



$servidor = "localhost";
$usuario = "projectes_jorge";
$contrasenyabs = "projectes_jorge";
$base_dades = "projectes_jorge";
$connexio = mysqli_connect($servidor, $usuario, $contrasenyabs, $base_dades);
$id = $_GET['id'];


    

$sql = "
SELECT rp.idproj, pj.titol, pj.cicle, c.curs, pj.descripcio,pj.paraulesclau, a.nom as nomalumne, a.cognom as cognomsalumne, p.nom, p.cognom from relacioprojecte rp 
     
INNER JOIN professorat p ON p.idprof = rp.idprof     
INNER JOIN alumnat a ON a.idalum = rp.idalum    
 INNER JOIN curs c ON c.idcurs = rp.idcrus     
INNER JOIN projecte pj ON pj.idproj = rp.idproj 
WHERE rp.idproj=" . $id ."
  ;";


  $resultado = mysqli_query($connexio, $sql);


if (mysqli_query($connexio, $sql)) {
    // include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
    // registraAccio( $_SESSION['usuario'],"Elimina Projecte",  date('d-m-Y'),   date('H:i:s'));

    echo "Registre actualitzat correctament";

} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}




            while ($row = mysqli_fetch_object($resultado)) {
                $porciones1 = explode("/", $row->curs);
        
                $memoria_projecte = "". $row->idproj."_".$row->cicle."_".$porciones1[0]."".$porciones1[1]."_".$row->nomalumne."_".$row->cognomsalumne.".pdf";
            
            
                $ruta = "../../wwwjorge/recursos/projectes/".$row->cicle."/".$porciones1[0]."/".$porciones1[1]."/".$memoria_projecte;
            

            $total =  $ruta;

            unlink($total);


}







$sql = "DELETE FROM relacioprojecte WHERE idproj =" . $id;


if (mysqli_query($connexio, $sql)) {
    // include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
    // registraAccio( $_SESSION['usuario'],"Elimina Projecte",  date('d-m-Y'),   date('H:i:s'));

    echo "Registre actualitzat correctament";

} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}



$sql = "DELETE FROM projecte WHERE idproj =" . $id;


if (mysqli_query($connexio, $sql)) {
    // include  $_SERVER['DOCUMENT_ROOT'].'/php/escriuLogAdmin.php';

    
    // registraAccio( $_SESSION['usuario'],"Elimina Projecte",  date('d-m-Y'),   date('H:i:s'));

    echo "Registre actualitzat correctament";

} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}



header('Location: ../admin.php?visualitza=true&&projecte=true&borar=true');