<?php

function readTurno()
{

    require 'conexao.php';

    $sql = "SELECT turno FROM turno;";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);

    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>

        <option name="turno" value="<?php echo $row['turno'] ?>"><?php echo $row['turno'] ?></option>

<?php endwhile;
}
?>