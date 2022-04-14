<?php 
 if(isset($_POST['id_tecnicas'])){
    require '../../conexion_base/conexion_base.php';
    date_default_timezone_set('America/Guayaquil');
    $id_bacteria = $_POST['bacteria_eplex'];
    $gen_resistencia = $_POST['resistencia_eplex'];
    $observacion = $_POST['observacion_eplex'];
    $id_eplex = $_POST['id_eplex'];
    $id_tecnicas = $_POST['id_tecnicas'];

    $id_temp = time();
    $fecha_nueva = date('Y-m-d');

    if($id_eplex == ""){
        //ingresar eplex
        $sql_nuevo = "INSERT INTO `tecnica_eplex`(`ID_EPLEX`, `ID_BACTERIA`, `MEC_RESISTENCIA`, `FECHA_EPLEX`, `OBSERVACION_EPLEX`) 
                        VALUES ($id_temp,$id_bacteria,'$gen_resistencia','$fecha_nueva','$observacion')";
        mysqli_query($conexion, $sql_nuevo);

        //actualizar tabla tecnicas 
        $sql = "UPDATE `tecnicas` SET `ID_EPLEX`='$id_temp' WHERE `ID_TECNICAS`=$id_tecnicas";
        $resultado_nuevo = mysqli_query($conexion, $sql);
        if($resultado_nuevo)
            echo "ok";
        
    }else{
        //actualizar eplex
        $sql_update = "UPDATE `tecnica_eplex` SET `ID_BACTERIA`='$id_bacteria',`MEC_RESISTENCIA`='$gen_resistencia',`OBSERVACION_EPLEX`='$observacion' WHERE `ID_EPLEX`=$id_eplex";
        $resultado_update = mysqli_query($conexion, $sql_update);

        if ($resultado_update) 
             echo "ok";


    }

    

 }	

?>