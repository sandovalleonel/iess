<?php

if(isset($_GET['id']) && isset($_GET['proceso'])){
    require '../../conexion_base/conexion_base.php';


    $id = $_GET['id'];
    $op =  $_GET['proceso'];

    $sql = "";

    switch ($op) {
        case 1:
            $sql = "DELETE FROM `recepcion_muestra_emocultivo` WHERE ID_RECEPCION_MUESTRA_EMOCULTIVO=$id";
            break;
        case 2:
            $sql = "DELETE FROM `tincion_gram` WHERE ID_GRAM=$id";
            break;
        case 3:
            $sql = "DELETE FROM `tecnicas` WHERE ID_TECNICAS=$id";
            break;
    }

    
    //echo $sql;  
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) 
            die("<br>Error al eliminar <a href='../../vistas/laboratorio/ver_pacientes'>Volver </a>").mysqli_error($conexion);
    header("location: ../../vistas/laboratorio/ver_pacientes");     
    echo "eliminado correctamente";

}else{
    echo "error";
}
?>