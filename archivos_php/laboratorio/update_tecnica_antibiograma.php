<?php 
 if(isset($_POST['id_tecnicas'])){
    require '../../conexion_base/conexion_base.php';
    date_default_timezone_set('America/Guayaquil');
    $id_bacteria = $_POST['bacteria_antibiograma'];
    $fenotipo = $_POST['fenotipo_antibiograma'];
    $reporte = $_POST['reporte_antibiograma'];
    $observacion = $_POST['observacion_antibiograma'];
    $id_antibiograma = $_POST['id_antibiograma'];
    $id_tecnicas = $_POST['id_tecnicas'];

    $id_temp = time();
    $fecha_nueva = date('Y-m-d');

    if($id_antibiograma == ""){
        //ingresar antibiograma
        $sql_nuevo = "INSERT INTO `tecnica_antibiograma`(`ID_ANTIBIOGRAMA`, `ID_BACTERIA`, `FENOTIPO`, `FECHA_ANTIBIOGRAMA`, `REPORTE_ACRODE_A_GUIA`, `OBSERVACION_ANTIBIOGRAMA`) 
                        VALUES ($id_temp,$id_bacteria,'$fenotipo','$fecha_nueva','$reporte','$observacion')";
        mysqli_query($conexion, $sql_nuevo);

        //actualizar tabla tecnicas 
        $sql = "UPDATE `tecnicas` SET `ID_ANTIBIOGRAMA`='$id_temp' WHERE `ID_TECNICAS`=$id_tecnicas";
        $resultado_nuevo = mysqli_query($conexion, $sql);
        if($resultado_nuevo)
            echo "ok";
        
    }else{
        //actualizar antibiograma
        $sql_update = "UPDATE `tecnica_antibiograma`
         SET `ID_BACTERIA`='$id_bacteria',`FENOTIPO`='$fenotipo', `REPORTE_ACRODE_A_GUIA`='$reporte',`OBSERVACION_ANTIBIOGRAMA`='$observacion' WHERE `ID_ANTIBIOGRAMA`=$id_antibiograma";
        $resultado_update = mysqli_query($conexion, $sql_update);

        if ($resultado_update) 
             echo "ok";


    }

    

 }	

?>