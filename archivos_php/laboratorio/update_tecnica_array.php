<?php 
 if(isset($_POST['id_tecnicas'])){
    require '../../conexion_base/conexion_base.php';
    date_default_timezone_set('America/Guayaquil');
    $id_bacteria = $_POST['bacteria_array'];
    $gen_resistencia = $_POST['gen_resistencia_array'];
    $observacion = $_POST['observacion_array'];
    $id_array = $_POST['id_array'];
    $id_tecnicas = $_POST['id_tecnicas'];

    $id_temp = time();
    $fecha_nueva = date('Y-m-d');

    if($id_array == ""){
        //ingresar antibiograma
        $sql_nuevo = "INSERT INTO `tecnica_array`(`ID_ARRAY`, `ID_BACTERIA`, `GEN_RESISTENCIA`, `FECHA_ARRAY`, `OBSERVACION_ARRAY`) 
                        VALUES ('$id_temp','$id_bacteria','$gen_resistencia','$fecha_nueva','$observacion')";
        mysqli_query($conexion, $sql_nuevo);

        //actualizar tabla tecnicas 
        $sql = " UPDATE `tecnicas` SET `ID_ARRAY`='' WHERE `ID_TECNICAS`=$id_tecnicas ";
        $resultado_nuevo = mysqli_query($conexion, $sql);
        if($resultado_nuevo)
            echo "ok";
        
    }else{
        //actualizar antibiograma
        $sql_update = "UPDATE `tecnica_array` SET `ID_BACTERIA`='$id_bacteria',`GEN_RESISTENCIA`='$gen_resistencia',`OBSERVACION_ARRAY`='$observacion' WHERE `ID_ARRAY` = $id_array";
        $resultado_update = mysqli_query($conexion, $sql_update);

        if ($resultado_update) 
             echo "ok";


    }

    

 }	

?>