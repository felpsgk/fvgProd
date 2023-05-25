<?php

function readAndar()
{

    require 'conexao.php';

    $sql = "SELECT andar FROM andar;";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);

    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>

        <option name="andar" value="<?php echo $row['andar'] ?>"><?php echo $row['andar'] ?></option>

<?php endwhile;
}
?>