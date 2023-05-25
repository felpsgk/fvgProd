<?php

//fetch.php

include('conexao.php');

if(isset($_POST["sistemas"]))
{
 $query = "
 SELECT sistema, 
 COUNT(sistema) AS atendimentosXsistema 
 FROM atendimento 
 WHERE dia = '".$_POST["sistemas"]."'
 group by sistema 
 order by atendimentosXsistema 
 DESC LIMIT 5
 ";
 //echo $query;

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'sistema'   => $row["sistema"],
   'atendimentosXsistema'  => $row["atendimentosXsistema"]
  );
 }
 echo json_encode($output);
}

if(isset($_POST["erros"]))
{
 $query = "
 SELECT erro, 
 COUNT(erro) AS atendimentosXerro 
 FROM atendimento 
 WHERE dia = '".$_POST["erros"]."' 
 group by erro 
 order by atendimentosXerro 
 DESC LIMIT 5
 ";
 //echo $query;

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'erro'   => $row["erro"],
   'atendimentosXerro'  => $row["atendimentosXerro"]
  );
 }
 echo json_encode($output);
}

if(isset($_POST["medicos"]))
{
 $query = "
 SELECT medico, 
 COUNT(medico) AS atendimentosXmedico 
 FROM atendimento 
 WHERE dia = '".$_POST["medicos"]."' 
 group by medico 
 order by atendimentosXmedico 
 DESC LIMIT 5
 ";
 //echo $query;

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'medico'   => $row["medico"],
   'atendimentosXmedico'  => $row["atendimentosXmedico"]
  );
 }
 echo json_encode($output);
}

if(isset($_POST["medicos_status"]))
{
 $query = "
 SELECT medico, COUNT(medico) AS atendimentosXmedicos_status, 
 SUM(CASE WHEN status = 'resolvido' THEN 1 ELSE 0 end) AS resolvido,
 SUM(CASE WHEN status = 'em analise' THEN 1 ELSE 0 end) AS analise,
 SUM(CASE WHEN status = 'resolvido paliativo' THEN 1 ELSE 0 end) AS paliativo
 FROM atendimento 
 WHERE dia = '".$_POST["medicos_status"]."'
 group by medico 
 order by atendimentosXmedicos_status
 DESC LIMIT 5
 ";
 //echo $query;

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'medico'   => $row["medico"],
   'atendimentosXmedicos_status'  => $row["atendimentosXmedicos_status"],
   'resolvido'  => $row["resolvido"],
   'analise'  => $row["analise"],
   'paliativo'  => $row["paliativo"]
  );
 }
 echo json_encode($output);
}

if(isset($_POST["erros_status"]))
{
 $query = "
 SELECT erro, COUNT(medico) AS atendimentosXerros_status, 
 SUM(CASE WHEN status = 'resolvido' THEN 1 ELSE 0 end) AS resolvido,
 SUM(CASE WHEN status = 'em analise' THEN 1 ELSE 0 end) AS analise,
 SUM(CASE WHEN status = 'resolvido paliativo' THEN 1 ELSE 0 end) AS paliativo
 FROM atendimento 
 WHERE dia = '".$_POST["erros_status"]."'
 group by erro 
 order by atendimentosXerros_status
 DESC LIMIT 5
 ";
 //echo $query;

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'erro'   => $row["erro"],
   'atendimentosXerros_status'  => $row["atendimentosXerros_status"],
   'resolvido'  => $row["resolvido"],
   'analise'  => $row["analise"],
   'paliativo'  => $row["paliativo"]
  );
 }
 echo json_encode($output);
}

?>