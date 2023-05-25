

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Document</title>
</head>
<body>

<?php
$url = "https://apiintranet.kryptonbpo.com.br/test-dev/exercise-1";
$apicarro = json_decode(file_get_contents($url));


foreach($apicarro->carros as $Carro){

  switch ($Carro->motor_id) {
    case 1:
      echo "Carro " . $Carro->motor_id . "<br>";
      
      echo "<hr>";
      break;
    case 2:
      echo "Carro " . $Carro->motor_id . "<br>";
       
      echo "<hr>";
      break;
    case 3:
      echo "Carro " . $Carro->motor_id . "<br>";
      
      echo "<hr>";    
      break;
    case 4:
      echo "Carro " . $Carro->motor_id . "<br>";
      
      echo "<hr>";
      break;
}
} 

?>

</body>
</html>