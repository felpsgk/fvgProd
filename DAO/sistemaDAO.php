<?php

function readSistema()
{

    require 'conexao.php';
    
    $sql = "SELECT id, sistema FROM sistema ORDER BY sistema ASC;";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);

    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>

        <option id="sistema" value="<?php echo $row['sistema'] ?>"><?php echo $row['sistema'] ?></option>

<?php endwhile;
}
?>