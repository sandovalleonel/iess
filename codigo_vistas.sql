
CREATE OR REPLACE VIEW v_diagnostico as
SELECT di.ID_DIAGNOSTICO, di.ID_PACIENTE, concat(pa.NOM_PACIENTE,' ',pa.APELLIDO_PACIENTE) nom_paciente, di.ID_PERSONALMEDICO,concat(pe.NOM_PERSONAL,' ',pe.APE_PERSONAL) nom_medico, di.ID_ENFERMEDAD,en.NOM_ENFERMEDAD, di.ID_ENFERMEDAD_2, di.DIAGNOSTICO, di.FECHA_DIAGNOSTICO
FROM diagnostico di, enfermedad en, personal_medico pe, pacientes pa
WHERE en.ID_ENFERMEDAD=di.ID_ENFERMEDAD AND
	  pe.ID_PERSONALMEDICO = di.ID_PERSONALMEDICO AND
      pa.ID_PACIENTE=di.ID_PACIENTE;
    


CREATE OR REPLACE view v_diagnostico_2 AS
SELECT vd.ID_DIAGNOSTICO, vd.ID_PACIENTE, vd.nom_paciente, vd.ID_PERSONALMEDICO, vd.nom_medico, vd.ID_ENFERMEDAD,vd.NOM_ENFERMEDAD, vd.ID_ENFERMEDAD_2,e.NOM_ENFERMEDAD nom_enfermedad_2, vd.DIAGNOSTICO, vd.FECHA_DIAGNOSTICO 
FROM v_diagnostico vd, enfermedad e 
WHERE vd.ID_ENFERMEDAD_2=e.ID_ENFERMEDAD;


CREATE OR REPLACE view v_ped_examen as
SELECT px.ID_DIAGNOSTICO, px.ID_PEDIDO, px.ID_TIPO_EXAMEN,ptx.TIPO_DE_EXAMEN, px.FECHA_PEDIDO 
FROM pedido_examen  px, pedido_tipo_examen ptx
WHERE px.ID_TIPO_EXAMEN = ptx.ID_TIPO_EXAMEN;


CREATE OR REPLACE view v_prescripcion AS
SELECT aba.ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__, aba.ID_DIAGNOSTICO, aba.ID_ANTIBIOTICO, an.NOMBRE_ANTIBIOTICO, aba.ATB_24_H, aba.INICIO, aba.MEDICO_RESPONSABLE, aba.DOSIS, aba.TIEMPO, aba.ESCALA, aba.MANTIENE, aba.DESCALA, aba.AJUSTE_DOSIS, aba.fin 
FROM antibiotico__basado_en_antibiograma_manua aba, antibiotico an
WHERE aba.ID_ANTIBIOTICO=an.ID_ANTIBIOTICO;

---------------
CREATE OR REPLACE view v_ped_examen as
SELECT px.ID_DIAGNOSTICO, px.ID_PEDIDO, px.ID_TIPO_EXAMEN,ptx.TIPO_DE_EXAMEN, px.FECHA_PEDIDO ,px.id_prescripcion
FROM pedido_examen  px, pedido_tipo_examen ptx
WHERE px.ID_TIPO_EXAMEN = ptx.ID_TIPO_EXAMEN;