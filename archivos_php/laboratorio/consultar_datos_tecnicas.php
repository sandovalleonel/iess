<?php 
 
 
require '../../conexion_base/conexion_base.php';
    $id_tecnicas = $_POST['id_tecnicas'];////

	$sql = "SELECT `ID_TECNICAS`, `ID_GRAM`, `ID_ANTIBIOGRAMA`, `ID_EPLEX`, `ID_ARRAY`FROM `tecnicas` WHERE `ID_TECNICAS`=$id_tecnicas";
    $resultado = mysqli_query($conexion , $sql);
 
    $json = array();
    $array_tec = array();
    $eplex = array();
    $antibiograma = array();

    while($row = mysqli_fetch_array($resultado)){
        if($row[2] != null){
        $sql_antibiograma = "SELECT `ID_BACTERIA`, `FENOTIPO`,  `REPORTE_ACRODE_A_GUIA`, `OBSERVACION_ANTIBIOGRAMA` FROM `tecnica_antibiograma` WHERE `ID_ANTIBIOGRAMA` = '$row[2]'";
        $resultado_antibiograma = mysqli_fetch_array(mysqli_query($conexion , $sql_antibiograma));
        $antibiograma[] = array('id_bacteria'=>$resultado_antibiograma['ID_BACTERIA'],
                              'fenotipo'=>$resultado_antibiograma['FENOTIPO'],
                              'reporte'=>$resultado_antibiograma['REPORTE_ACRODE_A_GUIA'],
                              'observacion'=>$resultado_antibiograma['OBSERVACION_ANTIBIOGRAMA'] );
        }
        if($row[3] != null){
        $sql_eplex = "SELECT `ID_BACTERIA`, `MEC_RESISTENCIA`, `OBSERVACION_EPLEX` FROM `tecnica_eplex` WHERE `ID_EPLEX`='$row[3]'";
        $resultado_eplex = mysqli_fetch_array(mysqli_query($conexion , $sql_eplex));
        $eplex[] = array(   'id_bacteria'=>$resultado_eplex['ID_BACTERIA'],
                            'resistencia'=>$resultado_eplex['MEC_RESISTENCIA'],
                            'observacion'=>$resultado_eplex['OBSERVACION_EPLEX'] );
        }
        if($row[4] != null){
        $sql_array = "SELECT  `ID_BACTERIA`, `GEN_RESISTENCIA`, `OBSERVACION_ARRAY` FROM `tecnica_array` WHERE `ID_ARRAY`= '$row[4]'";
        $resultado_array = mysqli_fetch_array(mysqli_query($conexion , $sql_array));
        $array_tec[] = array('id_bacteria'=>$resultado_array['ID_BACTERIA'],
                            'resistencia'=>$resultado_array['GEN_RESISTENCIA'],
                            'observacion'=>$resultado_array['OBSERVACION_ARRAY']);
        }
        
        $json[] = array(
            'id_tecnicas'=>$row[0],
            'id_gram'=>$row[1],
            'id_antibiograma'=>$row[2],
            'antibiograma'=> $antibiograma,
            'id_eplex'=>$row[3],
            'eplex' => $eplex,
            'id_array'=>$row[4],
            'array'=>$array_tec
        );
            
    } 

$jsonstring = json_encode($json);
echo $jsonstring;
?>